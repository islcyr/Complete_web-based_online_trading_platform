<?php

$con = new mysqli('localhost', 'root', '123456', "bookmanager");

if ($con->connect_errno) {
	printf("Connect failed: %s\n", $concls->connect_error);
	exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();
	if(array_key_exists("challenge", $_SESSION)){
		$challenge =  $_SESSION["challenge"];
		unset($_SESSION["challenge"]);
	}else{
		exit("not challenged");
	}

	$sql = "select password from users where username = " . "\"" . $_POST["nameinput"] . "\"";
	$result = $con->query($sql);
	if ($result->num_rows == 0)
		exit("NO USER");
	else if ($result->num_rows > 1)
		exit("Error muntiple name");
	$row = $result->fetch_assoc();

	$nufile = fopen("inputs.txt", "a");
	$hashedChallenge = hash("sha256", $challenge . $row["password"]);
	fwrite($nufile, $hashedChallenge . "#\n");
	fclose($nufile);

	$var = $_POST["nameinput"];
	$varbool = $var . "bool";

	session_start();
	if (isset($_SESSION["username"]) && $_SESSION["username"] == $var && isset($_SESSION[$varbool]) && $_SESSION[$varbool] === true && $hashedChallenge == $_POST["passwdinput"]) {
		// echo "您已经成功登陆";
		exit("True");
	} else {
		//  验证失败，将 $_SESSION["admin"] 置为 false
		$_SESSION[$varbool] = false;
	}

	if ($hashedChallenge == $_POST["passwdinput"]) {
		session_start();
		$_SESSION["username"] = $var;
		$_SESSION[$varbool] = true;
		exit("True");
	} else
		exit("False");
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	session_start();
	$challenge = openssl_random_pseudo_bytes(8, $strong);
	function strToHex($str)
	{
		$hex = "";
		for ($i = 0; $i < strlen($str); $i++)
			$hex .= dechex(ord($str[$i]));
		$hex = strtoupper($hex);
		return $hex;
	}
	$challenge = strToHex($challenge);
	$_SESSION["challenge"] = $challenge;
	exit($challenge);
} else {
	exit("Else");
}
