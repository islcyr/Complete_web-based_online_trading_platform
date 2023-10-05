<?php

$con = new mysqli('localhost', 'root', '123456', "shoppingcart");
if ($con->connect_errno) {
	printf("Connect failed: %s\n", $concls->connect_error);
	exit();
}

$sql = "select * from goods where goods_id = " . "\"" . $_POST["idinput"] . "\"";
$result = $con->query($sql);
$row = $result->fetch_assoc();

session_start();
$username = $_SESSION["username"];
$goods_id = $row["goods_id"];
$goods_name = $row["goods_name"];
$goods_Price = $row["goods_Price"];


$goods_num = $_POST["numinput"];

$sqlano = "select buy_goods_id from buy where buy_goods_id = " . "\"" . $_POST["idinput"] . "\"";
$resultano = $con->query($sqlano);
$rowano = $resultano->fetch_assoc();
if ($resultano->num_rows == 0) {
	$sql_2 = "insert into buy(buy_goods_id,buy_goods_num,buy_goods_price,user_name) 
        values(\"" . $goods_id . "\",\"" . $goods_num . "\",\"" . $goods_Price . "\",\"" . $username . "\")";
	$result_2 = $con->query($sql_2);
} else {
	$sqlano1 = "select buy_goods_num from buy where buy_goods_id = " . "\"" . $_POST["idinput"] . "\"";
	$resultano1 = $con->query($sqlano1);
	$rowano1 = $resultano1->fetch_assoc();
	$buy_goods_num = $rowano1["buy_goods_num"];
	if ($buy_goods_num >= 1) {
		$num = $buy_goods_num + $goods_num;
		$sql_3 = "UPDATE buy SET buy_goods_num = $num Where buy_goods_id = $goods_id ";
		$result_3 = $con->query($sql_3);
	}
}
