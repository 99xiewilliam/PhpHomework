<?php
require __DIR__.'/lib/db.inc.php';
$res = ierg4210_prod_fetchOne(14);
$name = '';
$description = '';
$price = '';
$pid = 0;
while ($value = $res->fetch_array()) {
    $pid = $value["pid"];
    $name = $value["name"];
    $description = $value["$description"];
    $price = $value["price"];
}

$detail = '<h1><span>'.$name.'</span><b>'.$description.'</b></h1>
        <ul id="summary">
            <li id="summary_price">
                <div class="title">Price：</div>
                <div class="content">
                    <b>￥'.$price.'</b>
                </div>
            </li>
            <li id="summary_market">
                <div class="title">code：</div>
                <div class="content">
                    <span>'.$pid.'</span>
                </div>
            </li>
        </ul>';
?>

<!DOCTYPE HTMl>
<html>
<head>
    <title>details</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="../static/css/common.css" />
    <script type="text/javascript" src="../static/js/jquery.min.js"></script>
    <script type="text/javascript" src="../static/js/function.js"></script>
</head>
<body onload="myfunction()">
<div id="top">

</div>
<div class="clear"></div>

<!-- car -->
<div id="top_main">
    <div id="settle_up" class="lr">
        <div class="settle_up_mt" onmouseover="showElementById('settle_up_items', true);" onmouseout="showElementById('settle_up_items',false);">
            shopping car
            <b></b>
        </div>
        <div id="settle_up_items" onmouseover="showElementById('settle_up_items', true);" onmouseout="showElementById('settle_up_items',false);">
            <div id="sumPrice">Total Price: </div>
            <div id="no_goods">
<!--                <div>-Prod2   [1] @¥12500</div>-->
<!--                <div>-Prod3   [2] @¥12500</div>-->
            </div>
            <input type="button" value="check out">
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
                            <p>
                                <a href="#">123</a>
                                <a href="#">456</a>
                            </p>
                        </div>
                        <div>
                            <a href="#">huawei</a>
                            <p>
                                <a href="#">123</a>
                                <a href="#">456</a>
                            </p>
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
        <a href="../templates/index.html">Home</a>
        <span>&gt;</span>
        <a href="../templates/index.html">Category1</a>
        <span>&gt;</span>
        <a href="#">Java</a>
    </div>

    <!--details-->
    <div id="product_intro">
        <div id="preview">
            <div id="mediumImgContainer">
                <img id="medium" src="../static/images/java1.jpeg" />
                <div id="mask"></div>
                <div id="bigMask"></div>
                <div id="bigImgArea"></div>
            </div>
            <h1>
                <a class="backward_disabled" id="btnLeft"></a>
                <a class="forward" id="btnRight"></a>
                <div>
                    <ul id="icon_list">
                        <li><img src="../static/images/java1.jpeg" /></li>
                        <li><img src="../static/images/java2.jpeg" /></li>
                        <li><img src="../static/images/java3.jpeg" /></li>
                        <li><img src="../static/images/java4.jpeg" /></li>
                        <li><img src="../static/images/java5.jpeg" /></li>
                    </ul>
                </div>
            </h1>
        </div>
        <?php echo $detail ?>
        <ul id="choose">
            <li id="choose_amount">
                <div class="title">numbers：</div>
                <div class="content">
                    <a href="#" class="btn_reduce"></a>
                    <input type="text" value="1" id="itemNum" />
                    <a href="#" class="btn_add"></a>
                </div>
            </li>
            <li id="choose_btns" class="clear">
                <input type="button" value="add to cart" onclick="addCart()">
            </li>
        </ul>
    </div>

</div>
</body>
</html>