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

// $sql = "select * from buy where user_name = " . "\"" . $username . "\"  and buy_goods_id = " . "\"" . $_POST["idinput"]  . "\" " ;
// $result = $con->query($sql);
// $row = $result->fetch_assoc();

// $buy_goods_num = $row["buy_goods_num"];

$num = $_POST["numinput"];

$sql_1 = "UPDATE buy SET buy_goods_num = $num Where buy_goods_id = " . "\"" . $_POST["idinput"]  . "\" and user_name = " . "\"" . $username . "\" ";
$result_1 = $con->query($sql_1);

// $sql1 = "select * from buy where user_name = " . "\"" . $username . "\"  and buy_goods_id = " . "\"" . $_POST["idinput"]  . "\" " ;
// $result1 = $con->query($sql1);
// $row1 = $result1->fetch_assoc();

// $buy_goods_num1 = $row1["buy_goods_num"];

// $nufile = fopen("cartadd.txt", "a");
// fwrite($nufile, $_POST["idinput"]."+".$_POST["numinput"]."+".$num ."+".$username. "#\n");
// fclose($nufile);

// exit(1);