<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $certstr = $_POST["cert"];
        $cert = openssl_x509_parse($certstr);
        $certObj = openssl_x509_read($certstr);
        $certstr = getCert("http://mycaserver.com/");
        $cacert = openssl_x509_parse($certstr);
        $cacertObj = openssl_x509_read($certstr);
        if($cert["issuer"] != $cacert["subject"]){
            exit("False");
        }
        if(openssl_x509_verify($certObj, $cacertObj)==1){
            exit("True");
        }else{
            exit("False");
        }
    }

    function getCert($target){
        $curl  =  curl_init() ;
        curl_setopt ( $curl , CURLOPT_URL ,  $target.'certificate.php' ) ;
        curl_setopt ( $curl , CURLOPT_HEADER ,  1 ) ;
        curl_setopt ( $curl , CURLOPT_RETURNTRANSFER ,  1 ) ;
        $data  =  curl_exec ( $curl ) ;
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == '200') {
            $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $bodyInfo = substr($data, $headerSize);
        }
        curl_close ( $curl ) ;
        return $bodyInfo;
    }
?>