<?php
require __DIR__.'/lib/db.inc.php';
if (ierg4210_auth() == false) {
    header('Location: login.php', true, 302);
    exit();
}
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
    foreach ($que as $value1) {
        $products .= '<div>
                                    <a href="#">'.$value1["name"].'</a>
                                </div>';

        $products_detail .= '
        <div class="product">
            <div class="product-iWrap">
                <!--page-->
                <div class="productImg-wrap">
                    <a class="productImg" href="./detail.php?pictureid='. $value1["pid"] .'&name='.$value1["name"].'">
                        <img src="/static/images/'. $value1["pid"] .'.jpg">
                    </a>
                </div>
                <!--price-->
                <p class="productPrice">
                    <em><b>¥</b>'.$value1["price"].'</em>
                </p>
                <!--title-->
                <p class="productTitle">
                    <a href="./detail.html"> '.$value1["name"].' </a>
                </p>
<!--                <input type="button" value="add cart" class="productStatus">-->
            </div>
        </div>
        ';
    }
//    while ($value1 = $que->fetch_array()) {
//
//    }


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
    <link rel="stylesheet" href="./static/css/common.css" />
    <link rel="stylesheet" href="./static/css/jquery.pagination.css" />
    <script type="text/javascript" src="./static/js/jquery.min.js"></script>
    <script type="text/javascript" src="./static/js/function.js"></script>
    <script type="text/javascript" src="./static/js/jquery.pagination.js"></script>
</head>
<body>
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
            </div>
<!--            <input type="button" value="check out">-->
            <form id="cate_insert" method="POST" action="admin-process.php?action=<?php echo ($action = 'logout'); ?>"
                  enctype="multipart/form-data">
                <input type="submit" value="check out" />
                <input type="hidden" name="nonce" value="<?php echo csrf_getNonce($action); ?>">
            </form>
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

        <?php echo $products_detail; ?>
    </div>
    <div class="pagination"></div>
</div>
<script>
    $('.pagination').pagination();
</script>
</body>
</html>

