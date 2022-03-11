<?php
//完成
function ierg4210_DB() {
	// connect to the database
	// TODO: change the following path if needed
	// Warning: NEVER put your db in a publicly accessible location
	// FETCH_ASSOC:
	// Specifies that the fetch method shall return each row as an
	// array indexed by column name as returned in the corresponding
	// result set. If the result set contains multiple columns with
    // the same name, PDO::FETCH_ASSOC returns only a single value
	// per column name.

    $servername = "localhost";
    $username = "root";
    $password = "123456";
    $dbname = "store";
    $db = new mysqli($servername, $username, $password, $dbname);
    if ($db->connect_error) {
        die("Connection failed");
    }


	return $db;
}

//完成
function ierg4210_cat_fetchall() {
    // DB manipulation
    global $db;
    $db = ierg4210_DB();
    $sql = "SELECT * FROM categories LIMIT 100;";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        //如果return $result->fetch_array()会有问题（admin.php会无限循环）不过我还没找到是什么原因
        return $result;
    }

}

// Since this form will take file upload, we use the tranditional (simpler) rather than AJAX form submission.
// Therefore, after handling the request (DB insert and file copy), this function then redirects back to admin.html
function ierg4210_prod_insert() {
    // input validation or sanitization
    // DB manipulation
    global $db;
    $db = ierg4210_DB();

    // TODO: complete the rest of the INSERT command
    if (!preg_match('/^\d*$/', $_POST['catid']))
        throw new Exception("invalid-catid");
    $_POST['catid'] = (int) $_POST['catid'];
    if (!preg_match('/^[\w\- ]+$/', $_POST['name']))
        throw new Exception("invalid-name");
    if (!preg_match('/^[\d\.]+$/', $_POST['price']))
        throw new Exception("invalid-price");
    if (!preg_match('/^[\w\- ]+$/', $_POST['description']))
        throw new Exception("invalid-textt");

//    $sql="INSERT INTO products (catid, name, price, description) VALUES (?, ?, ?, ?)";
//    $q = $db->prepare($sql);

    // Copy the uploaded file to a folder which can be publicly accessible at incl/img/[pid].jpg

    if ($_FILES["file"]["error"] == 0
        && $_FILES["file"]["type"] == "image/jpeg"
        && mime_content_type($_FILES["file"]["tmp_name"]) == "image/jpeg"
        && $_FILES["file"]["size"] < 5000000) {
        $catid = $_POST["catid"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $desc = $_POST["description"];
        $sql="INSERT INTO products 
    (catid, name, price, description) VALUES ('".$catid."', '".$name."', '".$price."', '".$desc."');";
        echo $sql;
        $q = $db->query($sql);

//        $q->bindParam(1, $catid);
//        $q->bindParam(2, $name);
//        $q->bindParam(3, $price);
//        $q->bindParam(4, $desc);
//        $q->execute();
        $lastId = $db->insert_id;
//        $file = $_FILES["upfile"];
//        $filename = $file["tmp_name"];
//        $image_size = getimagesize($filename);
//        $imgpreviewsize = 1 / 1;


        // Note: Take care of the permission of destination folder (hints: current user is apache)
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/IERG4210_Homeword1_1155162650/templates/lib/images/" . $lastId . ".jpg")) {
//            $code = "<a href=/var/www/html/IERG4210_Homeword1_1155162650/templates/lib/images/" . $lastId . ".jpg target='_blank'><img src=/var/www/html/IERG4210_Homeword1_1155162650/templates/lib/images/" . $lastId . ".jpg width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);
//            echo $code;
            // redirect back to original page; you may comment it during debug
            header('Location: admin.php');

            exit();
        }
    }
    // Only an invalid file will result in the execution below
    // To replace the content-type header which was json and output an error message
    header('Content-Type: text/html; charset=utf-8');
    echo 'Invalid file detected. <br/><a href="javascript:history.back();">Back to admin panel.</a>';
    exit();
}

// TODO: add other functions here to make the whole application complete
//完成
function ierg4210_cat_insert() {
    global $db;
    $db = ierg4210_DB();

    if (!preg_match('/^[\w\- ]+$/', $_POST['name'])) {
        throw new Exception("invalid-cat-name");
    }

    $name = $_POST["name"];

    $sql="INSERT INTO categories (name) VALUES ('".$name."');";
    if ($db->query($sql) === TRUE) {
        echo "insert succ";
        return 1;
    }

}

function ierg4210_cat_edit(){
    global $db;
    $db = ierg4210_DB();
    if (!preg_match('/^[\w\- ]+$/', $_POST["name"])) {
        throw new Exception("invalid-cat-name");
    }
    $_POST['catid'] = (int) $_POST['catid'];
    if (!preg_match('/^[\w\- ]+$/', $_POST['name']))
        throw new Exception("invalid-name");

    $name = $_POST["name"];
    $catid = $_POST["catid"];
    $sql = "UPDATE categories SET name = ('".$name."') WHERE catid = ('".$catid."');";

    if ($db->query($sql) === TRUE) {
        echo "update succ";
        return 1;
    }
}

function ierg4210_cat_delete(){
    global $db;
    $db = ierg4210_DB();

    if (!preg_match('/^\d*$/', $_POST['catid']))
        throw new Exception("invalid-catid");
    $_POST['catid'] = (int) $_POST['catid'];

    $catid = $_POST["catid"];
    $sql = "DELETE FROM categories WHERE catid = ('".$catid."');";
    if ($db->query($sql) === TRUE) {
        echo "delete succ";
        return 1;
    }
}

function ierg4210_prod_delete_by_catid(){
    global $db;
    $db = ierg4210_DB();

    if (!preg_match('/^\d*$/', $_POST['catid']))
        throw new Exception("invalid-catid");
    $_POST['catid'] = (int) $_POST['catid'];

    $catid = $_POST["catid"];

    $sql = "DELETE FROM products WHERE catid = ('".$catid."');";
    if ($db->query($sql) === TRUE) {
        echo "delete succ";
        return 1;
    }

}
function ierg4210_prod_fetchall_by_catid($catid){
    global $db;
    $db = ierg4210_DB();

    if (!preg_match('/^\d*$/', $catid))
        throw new Exception("invalid-catid");
    $catid = (int) $catid;

    $sql = "SELECT * FROM products WHERE catid = ('".$catid."');";
    $result = $db->query($sql);
    return $result;
//    if ($result->num_rows > 0) {
//        //如果return $result->fetch_array()会有问题（admin.php会无限循环）不过我还没找到是什么原因
//        return $result;
//    }

}
//完成
function ierg4210_prod_fetchAll(){
    global $db;
    $db = ierg4210_DB();
    $sql = "SELECT * FROM products LIMIT 100;";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        //如果return $result->fetch_array()会有问题（admin.php会无限循环）不过我还没找到是什么原因
        return $result;
    }
}

function ierg4210_prod_fetchOne($pid){
    global $db;
    $db = ierg4210_DB();
    if (!preg_match('/^\d*$/', $pid))
        throw new Exception("invalid-pid");
    $pid = (int) $pid;

//    $pid = $_POST["pid"];
    $sql = "SELECT * FROM products WHERE pid = ('".$pid."');";
    $result = $db->query($sql);
    return $result;
//    if ($result->num_rows > 0) {
//        //如果return $result->fetch_array()会有问题（admin.php会无限循环）不过我还没找到是什么原因
//        return $result;
//    }
}

function ierg4210_prod_edit(){
    global $db;
    $db = ierg4210_DB();
    if (!preg_match('/^\d*$/', $_POST['pid']))
        throw new Exception("invalid-pid");
    $_POST['pid'] = (int) $_POST['pid'];
    if (!preg_match('/^\d*$/', $_POST['catid']))
        throw new Exception("invalid-catid");
    $_POST['catid'] = (int) $_POST['catid'];
    if (!preg_match('/^[\w\- ]+$/', $_POST['name']))
        throw new Exception("invalid-name");

    if (!preg_match('/^[\d\.]+$/', $_POST['price']))
        throw new Exception("invalid-price");
    if (!preg_match('/^[\w\- ]+$/', $_POST['description']))
        throw new Exception("invalid-textt");

    $pid = $_POST["pid"];
    $catid = $_POST["catid"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $desc = $_POST["description"];

    $sql = "UPDATE products SET catid = ('".$catid."'), 
    name = ('".$name."'), price = ('".$price."'), description = ('".$desc."') WHERE pid = ('".$pid."');";
    if ($db->query($sql) === TRUE) {
        echo "update succ";
        return 1;
    }
}

function ierg4210_prod_delete(){
    global $db;
    $db = ierg4210_DB();
    if (!preg_match('/^\d*$/', $_POST['pid']))
        throw new Exception("invalid-pid");
    $_POST['pid'] = (int) $_POST['pid'];

    $pid = $_POST["pid"];
    $sql = "DELETE FROM products WHERE pid = ('".$pid."');";
    if ($db->query($sql) === TRUE) {
        echo "delete succ";
        return 1;
    }
}

//function thumb($file,$dw,$dh,$path){//这四个参数分别是1、要缩略的图片，2、画布的宽（也就是你要缩略的宽）3、画布的高（也就是你要缩略的高），4、保存路径）
//    //获取用户名图
//    $srcImg = getImg($file);//调用下面那个函数，实现根据图片类型来创建不同的图片画布
//    //获取原图的宽高
//    $infoSrc = getimagesize($file);//这个getimagesize()是php里面的系统函数用来获取图片的具体信息的
//    $sw = $infoSrc[0];//获取要缩略图片的宽
//    $sh = $infoSrc[1]; //获取要缩略的图片的高
//    //创建缩略图画布
//    $destImg = imagecreatetruecolor($dw, $dh);
//    //为缩略图填充背景色
//    $bg = imagecolorallocate($destImg,250,250,250);
//    imagefill($destImg,0,0,$bg);
//    //计算例缩放的尺寸
//    if($dh/$dw>$sh/$sw){
//        $fw=$dw;
//        $fh=$sh/$sw*$fw;
//    }else{
//        $fh=$dh;
//        $fw=$fh*$sw/$sh;
//    }
//    //居中放置
//    $dx=($dw-$fw)/2;
//    $dy=($dh-$fh)/2;
//    //创建缩略图
//    imagecopyresampled($destImg, $srcImg, 0, 0, 0, 0 ,$fw, $fh,$sw, $sh);
//    $baseName='thumb_'.basename($file);//给缩略的图片命名，basename()是系统内置函数用来获取后缀名的
//    $savePath=$path.'/'.$baseName;//设置缩略图片保存路径
//    imagejpeg($destImg,$savePath);//把缩略图存放到上一步设置的保存路径里
//
//}
//function getImg($file){//这是以一个动态创建图片画布的函数（根据具体的图片类型创相应类型的画布）
//    $info=getimagesize($file);
//    $fn=$info['mime'];//获得图片类型；
//    switch($fn){
//        case 'image/jpeg'://如果类型是imag/jpeg就创建jpeg类型的画布
//            $img=imagecreatefromjpeg($file);
//            break;
//        case 'image/gif':
//            $img=imagecreatefromgif($file);//如果类型是gif就创建gif类型的画布
//        case 'image/png':
//            $img=imagecreatefrompng($file);//如果类型是png就创建png类型的画布
//            break;
//
//    }
//    return $img;//返回画布类型
//}

