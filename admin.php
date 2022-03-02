<?php
require __DIR__.'/lib/db.inc.php';
$res = ierg4210_cat_fetchall();
$options = '';


//foreach ($res as $value){
//    $options .= '<option value="'.$value["catid"].'"> '.$value["name"].' </option>';
//    echo $options;
//}

//foreach ($res as $key => $value){
////    $options .= '<option value="'.$value["catid"].'"> '.$value["name"].' </option>';
//    echo "key:". $key . "value: ". $value . "<br>";
//}
while ($value = $res->fetch_array()) {
    $options .= '<option value="'.$value["catid"].'"> '.$value["name"].' </option>';
}
//while ($row = $res) {
//    echo $row . "<br>";
//}

?>

<html>
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
                <label for="prod_image"> Image * </label>
                <div> <input type="file" name="file" required="true" accept="image/jpeg"/> </div>
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
</html>
