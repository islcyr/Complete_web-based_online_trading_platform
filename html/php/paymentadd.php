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

$sql1 = "select * from buy where user_name = " . "\"" . $username . "\"  and buy_goods_id = " . "\"" . $_POST["idinput"]  . "\" " ;
$result1 = $con->query($sql1);
$row1 = $result1->fetch_assoc();

$buy_goods_num = $row1["buy_goods_num"];
$buy_goods_price = $row1["buy_goods_price"];



$sql = "insert into payment(pay_goods_id,pay_goods_num,pay_goods_price,user_name) 
    values(\"".$_POST['idinput']."\",\"".$buy_goods_num."\",\"".$buy_goods_price."\",\"".$username."\")" ;
$result = $con->query($sql);

