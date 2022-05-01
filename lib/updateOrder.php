<?php
header('Content-type:text/json;charset=utf-8');
include_once('db.inc.php');
$orderid = $_POST["orderid"];
$res = ierg4210_orderdigest_update($orderid);
echo json_encode(array(
    "res" => $res
));
?>