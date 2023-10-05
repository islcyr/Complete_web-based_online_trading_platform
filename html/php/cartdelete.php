<?php
session_start();
if (!isset($_SESSION["username"])){
	exit("请先登录！");
}

$con = new mysqli('localhost', 'root', '123456', "shoppingcart");
if ($con->connect_errno) {
	printf("Connect failed: %s\n", $concls->connect_error);
	exit();
}

$username = $_SESSION["username"];

$sql = "DELETE FROM buy WHERE user_name = " . "\"" . $username . "\"  and buy_goods_id = " . "\"" . $_POST["idinput"]  . "\" " ;
$result = $con->query($sql);