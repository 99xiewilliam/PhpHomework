<?php
header('Content-type:text/json;charset=utf-8');
include_once('db.inc.php');
$name = $_POST["email"];
$res = ierg4210_order_limit($name);
$result = array();

$i = 0;
while ($value = $res->fetch_array()) {
    $result[$i] = '{"email":"'.$value['email'].'","items":'.$value['items'].',"sumprice":"'.$value['sumprice'].'","paymentstate":"'.$value['paymentstate'].'"}';
    $i += 1;
}

echo json_encode($result);
?>
