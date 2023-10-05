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

$sql1 = "select * from buy where user_name = " . "\"" . $username . "\"  and buy_goods_id = 1" ;
$result1 = $con->query($sql1);
$row1 = $result1->fetch_assoc();
$buy_goods_id1= $row1["buy_goods_id"];
$buy_goods_num1 = $row1["buy_goods_num"];
$buy_goods_price1 = $row1["buy_goods_price"];

$sql2 = "select * from buy where user_name = " . "\"" . $username . "\"  and buy_goods_id = 2" ;
$result2 = $con->query($sql2);
$row2 = $result2->fetch_assoc();
$buy_goods_id2= $row2["buy_goods_id"];
$buy_goods_num2 = $row2["buy_goods_num"];
$buy_goods_price2 = $row2["buy_goods_price"];

$sql3 = "select * from buy where user_name = " . "\"" . $username . "\"  and buy_goods_id = 3" ;
$result3 = $con->query($sql3);
$row3 = $result3->fetch_assoc();
$buy_goods_id3= $row3["buy_goods_id"];
$buy_goods_num3 = $row3["buy_goods_num"];
$buy_goods_price3 = $row3["buy_goods_price"];

$sql4 = "select * from buy where user_name = " . "\"" . $username . "\"  and buy_goods_id = 4" ;
$result4 = $con->query($sql4);
$row4 = $result4->fetch_assoc();
$buy_goods_id4= $row4["buy_goods_id"];
$buy_goods_num4 = $row4["buy_goods_num"];
$buy_goods_price4 = $row4["buy_goods_price"];

$arr = array
(
    array($buy_goods_id1,$buy_goods_num1,$buy_goods_price1),
    array($buy_goods_id2,$buy_goods_num2,$buy_goods_price2),
    array($buy_goods_id3,$buy_goods_num3,$buy_goods_price3),
    array($buy_goods_id4,$buy_goods_num4,$buy_goods_price4)
);
$a= json_encode($arr);
echo $a;


// $nufile = fopen("cart.txt", "a");
// fwrite($nufile, $a . "#\n");
// fclose($nufile);

