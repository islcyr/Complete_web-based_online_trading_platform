<?php
    $con = new mysqli('localhost', 'root', '123456',"bookmanager");
	if ($con->connect_errno)
	{
		printf("Connect failed: %s\n", $concls->connect_error);
		exit();
	}

    $ktmp = '1';
    $cipher = base64_decode($_POST["head"]);
    $priKey = openssl_pkey_get_private(file_get_contents("D:/Apache/keys/myshop_privkey.pem"));
    openssl_private_decrypt($cipher,$ktmp, $priKey,OPENSSL_PKCS1_OAEP_PADDING);
    $body = $_POST["body"];
    $iv = base64_decode($_POST["iv"]);
    $dec = openssl_decrypt($body,"AES-256-CBC",$ktmp,OPENSSL_ZERO_PADDING,$iv);
	
    $trim = trim($dec);
    $pack = json_decode($trim,true);

    $hashedpass = openssl_digest($pack['passwd'],"sha256",false);

    $sql = "insert into users(username,password,useremail) 
        values(\"".$pack['name']."\",\"". $hashedpass."\",\"".$pack['mailadd']."\")";
	$result = $con->query($sql);

    // $sql1 = "select * from users where username = " . "\"" . $pack['name'] . "\"";
	// $result1 = $con->query($sql1);
    // $row1 = $result1->fetch_assoc();

    // $nufile = fopen("regs.txt", "a");
	// fwrite($nufile, $row1["username"] ."_".$row1["password"] ."+". $row1["useremail"]."#\n");
	// fclose($nufile);


	if($result)
        exit("Register Successful");
    else{
        $nufile = fopen("sqlerrors.txt","a");
        fwrite($nufile, $con->error.$pack["name"]." ".$pack["passwd"]." ".$pack['mailadd']."#\n");
        fclose($nufile);
        exit("Register Failed");
    }
