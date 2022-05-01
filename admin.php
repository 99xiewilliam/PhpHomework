<?php
require __DIR__.'/lib/db.inc.php';
//require __DIR__.'/auth-process.php';

if (ierg4210_auth() == false) {
    header('Location: login.php', true, 302);
    exit();
}

//$nonce = csrf_verifyNonce($_REQUEST['action'], $_POST['nonce']);


$res = ierg4210_cat_fetchall();
$options = '';


foreach ($res as $value){
    $options .= '<option value="'.$value["catid"].'"> '.$value["name"].' </option>';
//    echo $options;
}

//foreach ($res as $key => $value){
////    $options .= '<option value="'.$value["catid"].'"> '.$value["name"].' </option>';
//    echo "key:". $key . "value: ". $value . "<br>";
//}
//while ($value = $res->fetch()) {
//    $options .= '<option value="'.$value["catid"].'"> '.$value["name"].' </option>';
//}



//while ($row = $res) {
//    echo $row . "<br>";
//}

?>

<html>
<head>
    <title>Home</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <!--    <link rel="stylesheet" href="./static/css/common.css" />-->
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="./functions.js"></script>
    <style>
        table {
            border-collapse: collapse;
            margin-top: 200px;
            margin-left: 500px;
        }
        table th{
            border: 1px solid black;
            width: 80px;
            height: 40px;
            text-align: center;
            background-color: cornsilk;
        }

        table td{

            border: 1px solid black;
            width: 80px;
            height: 40px;
            text-align: center;

        }

    </style>
</head>
<body>
<fieldset>
    <h1>IERG4210 Shop - Admin Panel</h1>
    <fieldset>
        <legend> New Category</legend>
        <form id="cate_insert" method="POST" action="admin-process.php?action=<?php echo ($action = 'cat_insert'); ?>"
              enctype="multipart/form-data">
            <label for="cate_name"> Name</label>
            <div><input id="cate_name" type="text" name="name" required="true" pattern="^[\w\- ]+$" /></div>
            <input type="submit" value="Submit" />
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce($action); ?>">
        </form>
    </fieldset>
    <fieldset>
        <legend> Modify Category</legend>
        <form id="cate_edit" method="POST" action="admin-process.php?action=<?php echo ($action = 'cat_edit'); ?>"
              enctype="multipart/form-data">
            <label for="cate_id"> categoryId</label>
            <div> <input id="cate_id" type="text" name="catid" required="required" pattern="^\d+\.?\d*$"/></div>
            <label for="cate_name"> Name</label>
            <div><input id="cate_name" type="text" name="name" required="true" pattern="^[\w\- ]+$" /></div>
            <input type="submit" value="Submit" />
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce($action); ?>">
        </form>
    </fieldset>
    <fieldset>
        <legend> Delete Category</legend>
        <form id="cate_delete" method="POST" action="admin-process.php?action=<?php echo ($action = 'cat_delete'); ?>"
              enctype="multipart/form-data">
            <label for="cate_id"> categoryId</label>
            <div> <input id="cate_id" type="text" name="catid" required="required" pattern="^\d+\.?\d*$"/></div>
            <input type="submit" value="Submit" />
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce($action); ?>">
        </form>
    </fieldset>
    <fieldset>
        <legend> New Product</legend>
        <form id="prod_insert" method="POST" action="admin-process.php?action=<?php echo ($action = 'prod_insert'); ?>"
              enctype="multipart/form-data">
            <label for="prod_catid"> Category *</label>
            <div> <select id="prod_catid" name="catid"><?php echo $options; ?></select></div>
            <label for="prod_name"> Name *</label>
            <div> <input id="prod_name" type="text" name="name" required="required" pattern="^[\w\-]+$"/></div>
            <label for="prod_price"> Price *</label>
            <div> <input id="prod_price" type="text" name="price" required="required" pattern="^\d+\.?\d*$"/></div>
            <label for="prod_desc"> Description *</label>
            <div> <textarea id="prod_description" name="description" rows="5" cols="33"></textarea> </div>
            <label for="img_input"> Image * </label>
            <input id="img_input" type="file" name="file" required="true" accept="image/*"/>
            <div class="preview_box">123</div>
            <h3>拖拽上传</h3>

            <div id="drop_zone">Drop files here</div>
            <output id="list"></output>
            <input type="submit" value="Submit"/>
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce($action); ?>">
        </form>
    </fieldset>
    <fieldset>
        <legend> Modify Product</legend>
        <form id="prod_insert" method="POST" action="admin-process.php?action=<?php echo ($action = 'prod_edit'); ?>"
              enctype="multipart/form-data">
            <label for="prod_id"> ProdId</label>
            <div> <input id="prod_id" type="text" name="pid" required="required" pattern="^\d+\.?\d*$"/></div>
            <label for="prod_catid"> Category *</label>
            <div> <select id="prod_catid" name="catid"><?php echo $options; ?></select></div>
            <label for="prod_name"> Name *</label>
            <div> <input id="prod_name" type="text" name="name" required="required" pattern="^[\w\-]+$"/></div>
            <label for="prod_price"> Price *</label>
            <div> <input id="prod_price" type="text" name="price" required="required" pattern="^\d+\.?\d*$"/></div>
            <label for="prod_desc"> Description *</label>
            <div> <textarea id="prod_description" name="description" rows="5" cols="33"></textarea> </div>
            <!--                <label for="prod_image"> Image * </label>-->
            <!--                <div> <input type="file" name="file" required="true" accept="image/jpeg"/> </div>-->
            <input type="submit" value="Submit"/>
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce($action); ?>">
        </form>
    </fieldset>
    <fieldset>
        <legend> Delete Product</legend>
        <form id="prod_delete" method="POST" action="admin-process.php?action=<?php echo ($action = 'prod_delete'); ?>"
              enctype="multipart/form-data">
            <label for="prod_id"> prodId</label>
            <div> <input id="prod_id" type="text" name="pid" required="required" pattern="^\d+\.?\d*$"/></div>
            <input type="submit" value="Submit" />
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce($action); ?>">
        </form>
    </fieldset>
    <fieldset>
        <legend> Delete ProductByCatId</legend>
        <form id="prod_delete" method="POST" action="admin-process.php?action=<?php echo ($action = 'prod_delete_by_catid'); ?>"
              enctype="multipart/form-data">
            <label for="cate_id"> catId</label>
            <div> <input id="cate_id" type="text" name="catid" required="required" pattern="^\d+\.?\d*$"/></div>
            <input type="submit" value="Submit" />
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce($action); ?>">
        </form>
    </fieldset>
</fieldset>

<input type="button" onclick="getTable()" value="show table">
<div>
    <table>
        <thead>
        <tr>
            <th>email</th>
            <th>items</th>
            <th>sumprice</th>
            <th>paymentstate</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!--    <div class="modal-content">-->
<!--        <div class="modal-header">-->
<!--            <h4 class="modal-title" id="myModalLabel">订单</h4>-->
<!--        </div>-->
<!--        <div class="modal-body">-->
<!--            <div class="table-responsive">-->
<!--                <table class="table table-striped" id="shoppingCart">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th>email</th>-->
<!--                        <th>items</th>-->
<!--                        <th>sumprice</th>-->
<!--                        <th>paymentstate</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody></tbody>-->
<!--                </table>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

<!-- /.modal-content -->


<script>
    function getTable() {
        let datas = [

        ];
        $.ajax({
            type: "post",
            url: "/lib/getTable.php",
            data: {},
            dataType: "json",
            success: function(msg) {
//                let data = JSON.parse(msg);
                console.log(msg);
                //创建行，有几个人就创建几行
                datas = msg;
                let tbody =document.querySelector('tbody')
                for(let i = 0 ; i < datas.length ; i++){
                    //创建行
                    let tr = document.createElement('tr');
                    tbody.appendChild(tr);
                    //创建单元格
                    console.log(datas[i]);
//                    console.log(JSON.parse(datas[i]));
                    let ob = JSON.parse(datas[i]);
                    console.log(ob["items"]);
                    console.log(ob);
                    let count = 0;
                    for (let k in ob ){
                        if (k == "items") {
                            let td = document.createElement("td");
                            td.innerText = JSON.stringify(ob[k]);
                            tr.appendChild(td);
                        }else {
                            let td = document.createElement("td");
                            td.innerText = ob[k];
                            tr.appendChild(td);
                        }

                        count++;
                    }
                }
            },
            error: function(msg) {
                console.log(msg);
            }
        })




    }
    $("#img_input").on("change", function(e) {

        var file = e.target.files[0]; //获取图片资源

        // 只选择图片文件
        if (!file.type.match('image.*')) {
            return false;
        }

        var reader = new FileReader();

        reader.readAsDataURL(file); // 读取文件

        // 渲染文件
        reader.onload = function(arg) {

            var img = '<img class="preview" src="' + arg.target.result + '" alt="preview"/>';
            $(".preview_box").empty().append(img);
        }
    });
    // Setup the dnd listeners.
    var dropZone = document.getElementById('drop_zone');
    dropZone.addEventListener('dragover', handleDragOver, false);
    dropZone.addEventListener('drop', handleFileSelect, false);




</script>
</body>


</html>

