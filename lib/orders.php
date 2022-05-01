<?php
header('Content-type:text/json;charset=utf-8');
include_once('db.inc.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [];
    $salt = bin2hex(random_bytes(32));
    $currency_code = $_POST["currency_code"];
    $email = $_POST["email"];
    $items = $_POST["items"];
    $sumPrice = $_POST["sumPrice"];
    $lastId = ierg4210_orderdigest_insert($currency_code, $email, $salt, $items, $sumPrice);

    $invoice = sprintf("%016d", $lastId).substr(bin2hex(random_bytes(32)), 0, 16);

    array_push(
        $data,
        $currency_code,
        $email,
        $salt,
        $items,
        $sumPrice
    );
    $digest = hash("sha256", implode(";", $data));


    echo json_encode(array(
        "invoice" => $invoice,
        "digest" => $digest,
        "orderid" => $lastId
    ));
}
?>
