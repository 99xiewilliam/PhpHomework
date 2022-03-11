<?php
header('Content-type:text/json;charset=utf-8');
include_once('db.inc.php');
$pid = $_POST["pid"];
$res = ierg4210_prod_fetchOne($pid);
$name = '';
$price = '';
while ($value = $res->fetch_array()) {
    $name = $value["name"];
    $price = $value["price"];
}
$num = 1;
$data = '{"pid":"'.$pid.'","name":"'.$name.'","price":"'.$price.'","count":"'.$num.'"}';
echo json_encode($data);
?>
