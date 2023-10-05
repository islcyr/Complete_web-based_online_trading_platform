<?php
    $t =array(["head"]=>"vBgBOLet4j1kgIVFI3NQpz/5l/c/WsCrmA68NTKB3CTo8A/j++I3As/A+fuT/E/+y1gCiKvkzSoTZXwOOZLcMirRA2VvTl1sMQPEp/+7JAkFOIYW9ckQCpinr517EuMR/fA6aAc3NJGBBrMGXHxVPXrt8d0wD9vimOMr6+1sFuNXnRlvesFRMzJ+n3826qvN1Q8lqrR1dzUWIIni4ly/2+SXCDPlT1HaqhSwxKasVztiMYP/lAa5o8iTW7WBpNbo0uMtFBXAao2KAmJF5frQ52xD5aLpnGKasSjHo3RyCcIuFePtJ7srECugyxiiTEmldb9/qSjgKnJt8MMqGSIf1Q==",
        ["iv"]=>"qFR0FK5aT/F8TA2gs7FT8g==",
        ["body"]=>"WK2d9NGPGVYLBSvki8DJYr1Rw9l6mspXF804Vz41xqtk80Onl2MjQxcB73KTaJuFHW69QmyLR0rZaO1HcRpA2ip01LGKeo2PgVR61kouRgskaMv+kDsVzOAjeWwIqOkSWGrEoRPpD3ZjoBFmGGvILoth2RoIxcmGYW7NPR5RJ3rHQrdVpxpH8xblgbyXzx8gGoIlmeYMYeOCJqNsNlthfojuGoLIT3Ufxlt9QhCY5/D8z6IvMP53dxvedAvPKqF2ut5UKLyv8kLUyRpf0T4iv7YJOsSlW0hFqz/XTciViXdFyu8SIO+1+H/H3pT0A5j0mr61bsgUs2OndGRjEwMdNskMpgz8opIwlpIKVAiDjJwGLwu4QMxPBukDiQKAuFvtQttO+oyUtzp08soPN8sL2c2hzjZFRCxMwmGRKn9si7ndpB9ea0cwWgCp5HP3VZ7+fVqzCzfXwsOTh5p1jsKg3Boxo8w0WNTikjIdc3pGjxYT/cR7/XLgAbyRXAUzNYtggJKtsVHR5nVNj+Q5sND5VyXvWHi26AmSfBrmkBlBP7j2I9vT/JXea60dymxtW/2ziii1s5HI+zzpWJVZx6DTHd576MyjcAalEKqdk/VWu7M="
    );

    function deenvelop($privateKey, $ciphertext){
        $ktmp = '1';
        $asycipher = base64_decode($ciphertext["head"]);
        openssl_private_decrypt($asycipher,$ktmp, $privateKey,OPENSSL_PKCS1_OAEP_PADDING);
        $sycipher = $ciphertext["body"];
        $iv = base64_decode($ciphertext["iv"]);
        $dec = openssl_decrypt($sycipher,"AES-256-CBC",$ktmp,OPENSSL_ZERO_PADDING,$iv);
     
        $nufile = fopen("deenv.txt", "a");
        fwrite($nufile, $ciphertext["head"]."+\n".$ktmp."-\n".$iv."@\n".$dec. "#\n");
        fclose($nufile);
       
        
        $trim = trim($dec);
        $pack = json_decode($trim,true);
        return $pack;
     }

     $priKey = openssl_pkey_get_private(file_get_contents("D:/Apache/keys/myshop_privkey.pem"));
     $pack = deenvelop($priKey,$t);
     var_dump($pack);
?>