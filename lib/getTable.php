<?php
header('Content-type:text/json;charset=utf-8');
include_once('db.inc.php');
$res = ierg4210_order_fetchall();
//echo $res;
$result = array();

$i = 0;
//$data = '{"pid":"'.$pid.'","name":"'.$name.'","price":"'.$price.'","count":"'.$num.'"}';
while ($value = $res->fetch_array()) {
    $result[$i] = '{"email":"'.$value['email'].'","items":'.$value['items'].',"sumprice":"'.$value['sumprice'].'","paymentstate":"'.$value['paymentstate'].'"}';
//    echo $options;
    $i += 1;
}
//foreach ($res as $value){
//    $result[i] = '{"email":"'.$value['email'].'","items":"'.$value['items'].'","sumprice":"'.$value['sumprice'].'","paymentstate":"'.$value['paymentstate'].'"}';
////    echo $options;
//    $i += 1;
//}
echo json_encode($result);
?>