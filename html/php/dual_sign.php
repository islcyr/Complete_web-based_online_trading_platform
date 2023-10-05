<?php
session_start();
$username = $_SESSION["username"];
$PI = json_encode(array(
    "price"=>$_POST["sum"],
    "name"=>$username
));
// $PI = $_POST["sum"] . "/" . $username;
// exit($PI);

$num_1 = $_POST["num_1"];
$num_2 = $_POST["num_2"];
$num_3 = $_POST["num_3"];
$num_4 = $_POST["num_4"];

if ($num_1 == null)
    $num_1 = 0;
if ($num_2 == null)
    $num_2 = 0;
if ($num_3 == null)
    $num_3 = 0;
if ($num_4 == null)
    $num_4 = 0;

$OI = $num_1 . "/" . $num_2 . "/" . $num_3 . "/" . $num_4 . "/" . $username . "/" . $_POST["addrinput"] . "/" . $_POST["nameinput"];
// exit($OI);

$all = ($PI . "+" . $OI);
exit($all);
