<?php
require __DIR__.'/lib/db.inc.php';
include_once('auth-process.php');
if (ierg4210_auth() == false) {
//    header('Location: login.php', true, 302);
//    exit();
}

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
    <link rel="stylesheet" href="./static/css/common.css" />
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="./static/js/function.js"></script>

</head>
<body>
<fieldset>
    <h1>IERG4210 Shop - Admin Panel</h1>
    <fieldset>
        <legend> New Category</legend>
        <form id="cate_insert" method="POST" action="admin-process.php?action=cat_insert"
              enctype="multipart/form-data">
            <label for="cate_name"> Name</label>
            <div><input id="cate_name" type="text" name="name" required="true" pattern="^[\w\- ]+$" /></div>
            <input type="submit" value="Submit" />
        </form>
    </fieldset>
    <fieldset>
        <legend> Modify Category</legend>
        <form id="cate_edit" method="POST" action="admin-process.php?action=cat_edit"
              enctype="multipart/form-data">
            <label for="cate_id"> categoryId</label>
            <div> <input id="cate_id" type="text" name="catid" required="required" pattern="^\d+\.?\d*$"/></div>
            <label for="cate_name"> Name</label>
            <div><input id="cate_name" type="text" name="name" required="true" pattern="^[\w\- ]+$" /></div>
            <input type="submit" value="Submit" />
        </form>
    </fieldset>
    <fieldset>
        <legend> Delete Category</legend>
        <form id="cate_delete" method="POST" action="admin-process.php?action=cat_delete"
              enctype="multipart/form-data">
            <label for="cate_id"> categoryId</label>
            <div> <input id="cate_id" type="text" name="catid" required="required" pattern="^\d+\.?\d*$"/></div>
            <input type="submit" value="Submit" />
        </form>
    </fieldset>
    <fieldset>
        <legend> New Product</legend>
        <form id="prod_insert" method="POST" action="admin-process.php?action=prod_insert"
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
        </form>
    </fieldset>
    <fieldset>
        <legend> Modify Product</legend>
        <form id="prod_insert" method="POST" action="admin-process.php?action=prod_edit"
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
        </form>
    </fieldset>
    <fieldset>
        <legend> Delete Product</legend>
        <form id="prod_delete" method="POST" action="admin-process.php?action=prod_delete"
              enctype="multipart/form-data">
            <label for="prod_id"> prodId</label>
            <div> <input id="prod_id" type="text" name="pid" required="required" pattern="^\d+\.?\d*$"/></div>
            <input type="submit" value="Submit" />
        </form>
    </fieldset>
    <fieldset>
        <legend> Delete ProductByCatId</legend>
        <form id="prod_delete" method="POST" action="admin-process.php?action=prod_delete_by_catid"
              enctype="multipart/form-data">
            <label for="cate_id"> catId</label>
            <div> <input id="cate_id" type="text" name="catid" required="required" pattern="^\d+\.?\d*$"/></div>
            <input type="submit" value="Submit" />
        </form>
    </fieldset>
</fieldset>
<script>
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

