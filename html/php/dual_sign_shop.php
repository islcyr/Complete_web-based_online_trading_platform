<?php

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
$pack = deenvelop($priKey,$_POST["ciph"]);

$DS = base64_decode($pack["DS"]);
$PIMD = $pack["PIMD"];
$OI = $pack["OI"];
$OIMD = hash("sha256",$OI);
$POMD = hash("sha256",$PIMD . $OIMD);
$pub_key_id = $_POST["userpubkey"];
$pubkey = "-----BEGIN PUBLIC KEY-----\n".$pub_key_id."\n"."-----END PUBLIC KEY-----\n";
$result = openssl_verify(
    $POMD,
    $DS,
    $pubkey,
    "RSA-SHA256"
 );

 // var_dump($_POST);
//  var_dump($pack);
//  var_dump($POMD);
//  var_dump($pub_key_id);

 $nufile = fopen("ds.txt", "a");
 fwrite($nufile, $DS."+".$POMD."-".$pub_key_id."@\n".$result. "#\n");
 fclose($nufile);

 exit($result);