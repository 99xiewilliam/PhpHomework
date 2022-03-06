<?php
require __DIR__.'/lib/db.inc.php';
$res = ierg4210_cat_fetchall();

$products = '<ul>';

//foreach ($res as $value){
////    $products .= '<li><a href = "'.$value["file"].'"> '.$value["name"].'</a></li>';
//    $products .= '';
//}

while ($value = $res->fetch_array()) {
    $products .= '<option value="'.$value["catid"].'"> '.$value["name"].' </option>';
}

$products .= '</ul>';

echo '<div id = "maincontent">
<div id = "products">'.$products.'
</div>
</div>';

?>

<!DOCTYPE HTMl>
<html>
<head>
    <title>Home</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="../static/css/common.css" />
    <script type="text/javascript" src="../static/js/function.js"></script>
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
            <div class="cate_item" onmouseover="showNaviSubItems(this);">
                <h3>
                    <a href="#">books</a>
                    <a href="#">music</a>
                    <a href="#">art</a>
                </h3>
                <div class="sub_cate_box">
                    <div class="sub_cate_items">
                        <div>
                            <a href="#">books</a>
                            <p>
                                <a href="#">123</a>
                                <a href="#">456</a>
                            </p>
                        </div>
                        <div>
                            <a href="#">music</a>
                            <p>
                                <a href="#">123</a>
                                <a href="#">456</a>
                            </p>
                        </div>
                        <div>
                            <a href="#">art</a>
                            <p>
                                <a href="#">123</a>
                                <a href="#">456</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cate_item" onmouseover="showNaviSubItems(this);">
                <h3>
                    <a href="#">phone</a>
                </h3>
                <div class="sub_cate_box">
                    <div class="sub_cate_items">
                        <div>
                            <a href="#">iphone</a>
                        </div>
                        <div>
                            <a href="#">huawei</a>

                        </div>
                        <div>
                            <a href="#">oppo</a>
                        </div>
                    </div>
                </div>
            </div>
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
