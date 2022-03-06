<?php
require __DIR__.'/lib/db.inc.php';
$res = ierg4210_cat_fetchall();

$products = '<ul>';

//foreach ($res as $value){
////    $products .= '<li><a href = "'.$value["file"].'"> '.$value["name"].'</a></li>';
//    $products .= '';
//}

$arr_id = array();
$arr_name = array();
$count = 0;
while ($value = $res->fetch_array()) {
    $arr_id[$count] = $value["catid"];
    $arr_name[$count] = $value["name"];
    $count++;
}
$index = 0;
while ($index < count($arr_id)) {
    $in = $arr_id[$index];
    $que = ierg4210_prod_fetchall_by_catid($in);
    while ($value = $que->fetch_array()) {
        echo $value["pid"] ."<br>";
        echo $value["name"] ."<br>";
    }
    $index++;
}

$products .= '</ul>';

echo '<div id = "maincontent">
<div id = "products">'.$products.'
</div>
</div>';

?>

