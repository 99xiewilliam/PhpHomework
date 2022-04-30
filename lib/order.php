<?php
header('Content-type:text/json;charset=utf-8');
include_once('db.inc.php');
$currency = $_POST["currency"];
$email = $_POST["email"];
$obj = $_POST["obj"];
$totalPrice = $_POST["totalPrice"];
$res = ierg4210_order_insert($currency, $email, $obj, $totalPrice);
?>
