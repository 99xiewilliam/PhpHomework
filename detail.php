<?php
require __DIR__.'/lib/db.inc.php';
$res = ierg4210_prod_fetchOne($_GET['pictureid']);
$name = '';
$description = '';
$price = '';
$pid = 0;
while ($value = $res->fetch_array()) {
    $pid = $value["pid"];
    $name = $value["name"];
    $description = $value["description"];
    $price = $value["price"];
}
$img = "/static/images/". $_GET['pictureid'] .".jpg";
$pictureName = $_GET['name'];

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
$addCart = $_GET['pictureid'];
$decreaseOne = $_GET['pictureid'];

//$addCart = 'addCart('.$_GET['pictureid'].')';

?>

<!DOCTYPE HTMl>
<html>
<head>
    <title>details</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./static/css/common.css" />
    <script src="https://www.paypal.com/sdk/js?client-id=AVnRk8Ji9MPkY_1d54G0PHbagBCArY-r9xTcw9SHo5xN5C5YFhoNAgva7gtjC08Bx7UlV7Jvm02grfn4&currency=USD"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AVnRk8Ji9MPkY_1d54G0PHbagBCArY-r9xTcw9SHo5xN5C5YFhoNAgva7gtjC08Bx7UlV7Jvm02grfn4&components=buttons"></script>
    <script type="text/javascript" src="./static/js/jquery.min.js"></script>
    <script type="text/javascript" src="./myfunction.js"></script>
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
            </div>
            <!--            <div class="container">-->
            <!--                <div class="row">-->
            <!--                    <div class="col-sm-12 col-md-10 col-md-offset-1">-->
            <!--                        <table class="table table-hover">-->
            <!--                            <thead>-->
            <!--                            <tr>-->
            <!--                                <th>Product</th>-->
            <!--                                <th>Quantity</th>-->
            <!--                                <th class="text-center">Price</th>-->
            <!--                                <th class="text-center">Total</th>-->
            <!--                                <th> </th>-->
            <!--                            </tr>-->
            <!--                            </thead>-->
            <!--                            <tbody>-->
            <!--                            <tr>-->
            <!--                                <td class="col-sm-8 col-md-6">-->
            <!--                                    <div class="media">-->
            <!--                                        <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>-->
            <!--                                        <div class="media-body">-->
            <!--                                            <h4 class="media-heading"><a href="#">Apple gift card</a></h4>-->
            <!--                                            <h5 class="media-heading"> by <a href="#">Apple</a></h5>-->
            <!--                                            <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>-->
            <!--                                        </div>-->
            <!--                                    </div></td>-->
            <!--                                <td class="col-sm-1 col-md-1" style="text-align: center">-->
            <!--                                    <input type="email" class="form-control" id="exampleInputEmail1" value="3">-->
            <!--                                </td>-->
            <!--                                <td class="col-sm-1 col-md-1 text-center"><strong>$10.0</strong></td>-->
            <!--                                <td class="col-sm-1 col-md-1 text-center"><strong>$30.0</strong></td>-->
            <!--                                <td class="col-sm-1 col-md-1">-->
            <!--                                    <button type="button" class="btn btn-danger">-->
            <!--                                        <span class="glyphicon glyphicon-remove"></span> Remove-->
            <!--                                    </button></td>-->
            <!--                            </tr>-->
            <!--                            <tr>-->
            <!--                                <td class="col-md-6">-->
            <!--                                    <div class="media">-->
            <!--                                        <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>-->
            <!--                                        <div class="media-body">-->
            <!--                                            <h4 class="media-heading"><a href="#">Google Play gift card</a></h4>-->
            <!--                                            <h5 class="media-heading"> by <a href="#">Google</a></h5>-->
            <!--                                            <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>-->
            <!--                                        </div>-->
            <!--                                    </div></td>-->
            <!--                                <td class="col-md-1" style="text-align: center">-->
            <!--                                    <input type="email" class="form-control" id="exampleInputEmail1" value="2">-->
            <!--                                </td>-->
            <!--                                <td class="col-md-1 text-center"><strong>$10.0</strong></td>-->
            <!--                                <td class="col-md-1 text-center"><strong>$20.0</strong></td>-->
            <!--                                <td class="col-md-1">-->
            <!--                                    <button type="button" class="btn btn-danger">-->
            <!--                                        <span class="glyphicon glyphicon-remove"></span> Remove-->
            <!--                                    </button></td>-->
            <!--                            </tr>-->
            <!--                            <tr>-->
            <!--                                <td>   </td>-->
            <!--                                <td>   </td>-->
            <!--                                <td>   </td>-->
            <!--                                <td><h5>Subtotal</h5></td>-->
            <!--                                <td class="text-right"><h5><strong>$50.0</strong></h5></td>-->
            <!--                            </tr>-->
            <!--                            <tr>-->
            <!--                                <td>   </td>-->
            <!--                                <td>   </td>-->
            <!--                                <td>   </td>-->
            <!--                                <td><h3>Total</h3></td>-->
            <!--                                <td class="text-right"><h3><strong>$50.0</strong></h3></td>-->
            <!--                            </tr>-->
            <!--                            <tr>-->
            <!--                                <td>   </td>-->
            <!--                                <td>   </td>-->
            <!--                                <td>   </td>-->
            <!--                                <td>-->
            <!--                                <td>-->
            <!---->
            <!--                                    <form action="payments.php" method="post" id="form1">-->
            <!--                                        <input type="hidden" name="cmd" value="_cart" />-->
            <!--                                        <input type="hidden" name="upload" value="1" />-->
            <!--                                        <input type="hidden" name="business" value="sb-5dmam5523323@business.example.com" />-->
            <!--                                        <input type="hidden" name="currency_code" value="HKD" />-->
            <!--                                        <input type="hidden" name="charset" value="utf-8" />-->
            <!--                                        <input type="hidden" name="item_name_1" value="Apple gift card" />-->
            <!--                                        <input type="hidden" name="amount_1" value="10.0" />-->
            <!--                                        <input type="hidden" name="quantity_1" value="3" />-->
            <!--                                        <input type="hidden" name="item_name_2" value="Google Play gift card" />-->
            <!--                                        <input type="hidden" name="amount_2" value="10.0" />-->
            <!--                                        <input type="hidden" name="quantity_2" value="2" />-->
            <!--                                        must be unique-->
            <!---->
            <!--                                        <input type="hidden" name="custom" value="0" />-->
            <!--                                        <input type="hidden" name="invoice" value="0" />-->
            <!---->
            <!--                                        <input type="submit" class="btn btn-success" form="form1" value="Checkout">-->
            <!--                                    </form>-->
            <!--                                    <button type="button" class="btn btn-success" type="submit" form="form1" value="Submit" style = "display: none">-->
            <!--                                        Checkout <span class="glyphicon glyphicon-play"></span>-->
            <!--                                    </button></td>-->
            <!--                            </tr>-->
            <!--                            </tbody>-->
            <!--                        </table>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <div id="paypal-button-container"></div>
            <input type="button" value="check out" onclick="">
        </div>
    </div>
</div>

<!-- nav -->
<div id="nav">
    <div id="category">
        <div id="cate_mt" onmouseover="showElementById('all_cate',true);"  onmouseout= "showElementById('all_cate',false);">
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
        <a href="./main.php">Home</a>
        <span>&gt;</span>
        <a href="./main.php">Category1</a>
        <span>&gt;</span>
        <a href="#"><?php echo $pictureName ?></a>
    </div>

    <!--details-->
    <div id="product_intro">
        <div id="preview">
            <div id="mediumImgContainer">
                <img id="medium" src=<?php echo $img ?> />
                <div id="mask"></div>
                <div id="bigMask"></div>
                <div id="bigImgArea"></div>
            </div>
            <!--            <h1>-->
            <!--                <a class="backward_disabled" id="btnLeft"></a>-->
            <!--                <a class="forward" id="btnRight"></a>-->
            <!--                <div>-->
            <!--                    <ul id="icon_list">-->
            <!--                        <li><img src="./static/images/java1.jpeg" /></li>-->
            <!--                        <li><img src="./static/images/java2.jpeg" /></li>-->
            <!--                        <li><img src="./static/images/java3.jpeg" /></li>-->
            <!--                        <li><img src="./static/images/java4.jpeg" /></li>-->
            <!--                        <li><img src="./static/images/java5.jpeg" /></li>-->
            <!--                    </ul>-->
            <!--                </div>-->
            <!--            </h1>-->
        </div>
        <?php echo $detail ?>
        <ul id="choose">
            <li id="choose_amount">
                <div class="title">numbers：</div>
                <div class="content">
                    <a href="#" class="btn_reduce" onclick="downValue()"></a>
                    <input type="text" value="1" id="itemNum" />
                    <a href="#" class="btn_add" onclick="upValue()"></a>
                </div>
            </li>
            <li id="choose_btns" class="clear">
                <input type="button" value="add to cart" onclick="addCart(<?php echo $addCart?>)">
                <input type="button" value="decrease one" onclick="decreaseOne(<?php echo $decreaseOne?>)">
                <input type="button" value="test" onclick="saveOrder()">
            </li>

        </ul>
    </div>

</div>

<script>
    function getUserName() {
        if (document.cookie.length > 0) {
            c_start = document.cookie.indexOf("y_email=");
            console.log(c_start);
            if (c_start != -1) {
                c_start = c_start + 8;
                c_end = document.cookie.indexOf(";", c_start);
                if (c_end == -1) {
                    c_end = document.cookie.length;
                    return unescape(document.cookie.substring(c_start, c_end));
                }
            }
        }
    }
    /* A function to simulate the communication with server */
    function getFromServer(obj) {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve(JSON.stringify({
                    purchase_units: obj
                }));
            }, 100);
        });
    }

    function saveOrder() {
        let email = getUserName();
        let sumPrice = 0;
        let items = [];
        for (let i = 0; i < localStorage.length; i++) {
            let key = localStorage.key(i);
            let obj = JSON.parse(localStorage.getItem(key));
            if(typeof(obj["name"]) != "undefined"
                && typeof(obj["count"]) != "undefined"
                && typeof(obj["price"]) != "undefined") {
                let item = {pid:obj["pid"], name: obj["name"], price: obj["price"], quantity: obj["count"] };
                items.push(item);
                sumPrice += parseInt(obj["price"]) * parseInt(obj["count"]);
            }

        }
        console.log(items);
        let res = JSON.stringify(items);
        console.log(res);
        $.ajax({
            type: "post",
            url: "/lib/orders.php",
            data: {currency_code: 'USD', email: email, items: res, sumPrice: sumPrice},
            dataType: "json",
            success: function(msg) {
//                let data = JSON.parse(msg);
                console.log(msg);
                // let pid = data["pid"];
                // localStorage.setItem(pid, JSON.stringify(data));
                // let goods = document.getElementById("no_goods");
                // let div = document.createElement("div");
                // let info = "<div>"+ data["name"] + '[' + data["count"]
                //     + ']' + '¥' + data["price"] + "</div>" ;
                // div.innerHTML = info;
                // goods.appendChild(div);
            },
            error: function(msg) {
                console.log(msg);
            }
        })
    }

    paypal.Buttons({
        /* Sets up the transaction when a payment button is clicked */
        createOrder: async (data, actions) => { /* async is required to use await in a function */
            /* Use AJAX to get required data from the server; For dev/demo purposes: */
            let sumPrice = 0;
            let items = [];
            for (let i = 0; i < localStorage.length; i++) {
                let key = localStorage.key(i);
                let obj = JSON.parse(localStorage.getItem(key));
                if(typeof(obj["name"]) != "undefined"
                    && typeof(obj["count"]) != "undefined"
                    && typeof(obj["price"]) != "undefined") {
                    let item = {name: obj["name"], unit_amount: { currency_code: 'USD', value: obj["price"] }, quantity: obj["count"] };
                    items.push(item);
                    sumPrice += parseInt(obj["price"]) * parseInt(obj["count"]);
                }

            }
            let amount = {currency_code: 'USD', value: sumPrice, breakdown: { item_total: { currency_code: 'USD', value: sumPrice } }}

            let dataObj = [{
                amount: amount,
                // custom_id: "aabbccddeeff",  /* digest */
                // invoice_id: "001122334455", /* lastInsertId(); must be unique to avoid blocking */
                items: items
            }];
            let order_details = await getFromServer(dataObj)
                .then(data => JSON.parse(data));

            /* Use fetch() instead in real code to get server resources */
            // let order_details = await fetch(/* resource url*/)
            //     .then(response => response.json()) /* json string to javascript object */
            //     .then(data => {
            //         /* process over data */
            //         return /* return value */;
            //     });

            return actions.order.create(order_details);
        },

        /* Finalize the transaction after payer approval */
        onApprove: (data, actions) => {
            return actions.order.capture().then(function (orderData) {
                /* Successful capture! For dev/demo purposes: */
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);

                /* When ready to go live, remove the alert and show a success message within this page. For example: */
                // const element = document.getElementById('paypal-button-container');
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                /* Or go to another URL:  */
                // actions.redirect('thank_you.html');
            });
        },
    }).render('#paypal-button-container');
</script>
</body>
</html>