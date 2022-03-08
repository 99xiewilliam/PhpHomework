<?php
require __DIR__.'/lib/db.inc.php';
$res = ierg4210_cat_fetchall();

$products = '';
$arr_id = array();
$arr_name = array();
$count = 0;
while ($value = $res->fetch_array()) {
    $arr_id[$count] = $value["catid"];
    $arr_name[$count] = $value["name"];
    $count++;
}
$count = 0;
$que = ierg4210_prod_fetchall_by_catid(1);
while ($value1 = $que->fetch_array()) {

}


$index = 0;
while ($index < count($arr_id)) {
    $in = $arr_id[$index];
    $products .= '
                    <div class="cate_item" onmouseover="showNaviSubItems(this);">
                        <h3>
                            <a href="#">'.$arr_name[$index].'</a>
                        </h3>
                        <div class="sub_cate_box">
                            <div class="sub_cate_items">';

    $que = ierg4210_prod_fetchall_by_catid($in);
    while ($value1 = $que->fetch_array()) {
        $products .= '<div>
                                    <a href="#">'.$value1["name"].'</a>
                                </div>';
    }


    $products .= '</div>
              </div>
          </div>';
    $index++;
}
?>

<!DOCTYPE HTMl>
<html>
<head>
    <title>Home</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="../static/css/common.css" />
    <script type="text/javascript" src="../static/js/function.js"></script>
    <script type="text/javascript" src="../static/js/jquery.min.js"></script>
</head>
<body>
<div id="top">

</div>
<div class="clear"></div>

<!-- car -->
<div id="top_main">
    <div id="settle_up" class="lr">
        <div class="settle_up_mt" onmouseover="showElementById('settle_up_items', true);" onmouseout="showElementById('settle_up_items',false);">
            shopping car ¥25000
            <b></b>
        </div>
        <div id="settle_up_items" onmouseover="showElementById('settle_up_items', true);" onmouseout="showElementById('settle_up_items',false);">
            <div id="no_goods">
                <b></b>
                Shopping List (Total:¥25000)
                <div>-Prod2   [1] @¥12500</div>
                <div>-Prod3   [2] @¥12500</div>
                <input type="button" value="check out">
            </div>
        </div>
    </div>
</div>

<!-- nav -->
<div id="nav">
    <div id="category">
        <div id="cate_mt" onmouseover="showElementById('all_cate',true);"  onmouseout="showElementById('all_cate',false);">
            <a href="#">all categories</a>
            <span></span>
        </div>
        <div id="all_cate" onmouseover="showElementById('all_cate', true);" onmouseout="showElementById('all_cate', false);">
            <?php echo $products; ?>
        </div>
    </div>
</div>
<div class="clear"></div>

<!-- main -->
<div id="main">
    <div class="bread-crumb">
        <a href="#">Home</a>
        <span>&gt;</span>
        <a href="#">Category1</a>
    </div>
    <div class="view grid-nosku">

        <div class="product">
            <div class="product-iWrap">
                <!--page-->
                <div class="productImg-wrap">
                    <a class="productImg" href="../templates/detail.html">
                        <img src="https://img13.360buyimg.com/n1/s200x200_jfs/t1/186038/9/7947/120952/60bdd993E41eea7e2/48ab930455d7381b.jpg">
                    </a>
                </div>
                <!--price-->
                <p class="productPrice">
                    <em><b>¥</b>25.00</em>
                </p>
                <!--title-->
                <p class="productTitle">
                    <a href="../templates/detail.html"> java </a>
                </p>
                <input type="button" value="add cart" class="productStatus">
            </div>
        </div>
        <div class="product">
            <div class="product-iWrap">
                <!--page-->
                <div class="productImg-wrap">
                    <a class="productImg" href="../templates/detail.html">
                        <img src="https://img13.360buyimg.com/n1/s200x200_jfs/t1/186038/9/7947/120952/60bdd993E41eea7e2/48ab930455d7381b.jpg">
                    </a>
                </div>
                <!--price-->
                <p class="productPrice">
                    <em><b>¥</b>25.00</em>
                </p>
                <!--title-->
                <p class="productTitle">
                    <a href="../templates/detail.html"> java </a>
                </p>

                <input type="button" value="add cart" class="productStatus">

            </div>
        </div>


    </div>
</div>
</body>
</html>

