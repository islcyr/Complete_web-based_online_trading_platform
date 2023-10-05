<?php
    $localcertfile = "D:/Apache/keys/myshop_privkey.pem";
    $selfurl = "http://myshopp.com/";

    function exchangeCert($target){
        global $selfurl;
        global $localcertfile;
        $remoteCert = getCert($target);
        $remoteAuth = (postCert($selfurl, ['cert'=>$remoteCert]) == "True");
        $selfCert = ['cert'=>file_get_contents($localcertfile)];
        $selfAuth = (postCert($target, $selfCert) == "True");
        return ['remoteAuth'=>$remoteAuth,'selfAuth'=>$selfAuth];
    }

    function getCert($target){
        $curl = curl_init() ;
        curl_setopt ($curl, CURLOPT_URL, $target.'certificate.php') ;
        curl_setopt ($curl, CURLOPT_HEADER, 1) ;
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1) ;
        $data = curl_exec ( $curl ) ;
        if(curl_getinfo($curl, CURLINFO_HTTP_CODE) == '200') {
            $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $bodyInfo = substr($data, $headerSize);
        }
        curl_close ( $curl ) ;
        return $bodyInfo;
    }

    function postCert($target, $pdata){        
        $curl = curl_init() ;
        curl_setopt($curl, CURLOPT_URL, $target.'verify.php') ;
        curl_setopt($curl, CURLOPT_HEADER,  1 ) ;
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1) ;
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pdata);
        $data = curl_exec($curl) ;
        if(curl_getinfo($curl, CURLINFO_HTTP_CODE) == '200') {
            $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $bodyInfo = substr($data, $headerSize);
        }
        curl_close($curl);
        return $bodyInfo;
    }
?>