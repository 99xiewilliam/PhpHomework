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
        $stmt=$db->prepare("INSERT INTO products 
    (catid, name, price, description) VALUES (?, ?, ?, ?)");
//        $sql="INSERT INTO products
//    (catid, name, price, description) VALUES ('".$catid."', '".$name."', '".$price."', '".$desc."');";
//        echo $sql;
//        $q = $db->query($sql);

//        $q->bindParam(1, $catid);
//        $q->bindParam(2, $name);
//        $q->bindParam(3, $price);
//        $q->bindParam(4, $desc);
//        $q->execute();
        $stmt->bind_param('ssss', $catid, $name, $price, $desc);
        $stmt->execute();
        $lastId = $db->insert_id;
//        $file = $_FILES["upfile"];
//        $filename = $file["tmp_name"];
//        $image_size = getimagesize($filename);
//        $imgpreviewsize = 1 / 1;


        // Note: Take care of the permission of destination folder (hints: current user is apache)
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/static/images/" . $lastId . ".jpg")) {
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
//    $stmt=$db->prepare("INSERT INTO products
//    (catid, name, price, description) VALUES (?, ?, ?, ?)");

    $stmt=$db->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param('s', $name);

    if ($stmt->execute()) {
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
//    $stmt=$db->prepare("INSERT INTO categories (name) VALUES (?)");
//    $stmt->bind_param('s', $name);
    $stmt = $db->prepare("UPDATE categories SET name = (?) WHERE catid = (?)");
    $stmt->bind_param('sd', $name, $catid);
    if ($stmt->execute()) {
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
//    $stmt = $db->prepare("UPDATE categories SET name = (?) WHERE catid = (?)");
//    $stmt->bind_param('sd', $name, $catid);
    $stmt = $db->prepare("DELETE FROM categories WHERE catid = (?)");
    $stmt->bind_param("d", $catid);
    if ($stmt->execute()) {
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
    $stmt = $db->prepare("DELETE FROM products WHERE catid = (?)");
    $stmt->bind_param("d", $catid);
//    $sql = "DELETE FROM products WHERE catid = ('".$catid."');";

    if ($stmt->execute()) {
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

    $stmt = $db->prepare("SELECT * FROM products WHERE catid = (?)");
    $stmt->bind_param("d", $catid);
    $stmt->execute();
//    $sql = "SELECT * FROM products WHERE catid = ('".$catid."');";
//    $result = $db->query($sql);

    return $stmt->get_result();
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
    $stmt = $db->prepare("SELECT * FROM products WHERE pid = (?)");
    $stmt->bind_param('d', $pid);
    $stmt->execute();
//    $sql = "SELECT * FROM products WHERE pid = ('".$pid."');";
//    $result = $db->query($sql);
    return $stmt->get_result();
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

    $sql = "";

    $stmt = $db->prepare("UPDATE products SET catid = (?), 
    name = (?), price = (?), description = (?) WHERE pid = (?)");
    $stmt->bind_param('dssss', $catid, $name, $price, $desc, $pid);
//    $sql = "SELECT * FROM products WHERE pid = ('".$pid."');";
//    $result = $db->query($sql);

    if ($stmt->execute()) {
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
    $stmt = $db->prepare("DELETE FROM products WHERE pid = (?)");
    $stmt->bind_param('d', $pid);
//    $sql = "DELETE FROM products WHERE pid = ('".$pid."');";
    if ($stmt->execute()) {
        echo "delete succ";
        return 1;
    }
}

function ierg4210_login() {
    global $db;
    $db = ierg4210_DB();

    if (empty($_POST['email']) || empty($_POST['pw'])
        || !preg_match("/^[\w=+\-\/][\w='+\-\/\.]*@[\w\-]+(\.[\w\-]+)*(\.[\w]{2,6})$/", $_POST['email'])
        || !preg_match("/^[\w@#$%\^\&\*\-]+$/", $_POST['pw'])) {
        throw new Exception('Wrong Credentials');
    }
    $email = $_POST['email'];
    $pwd = $_POST['pw'];
    $stmt = $db->prepare("SELECT * FROM user WHERE email = (?)");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $login_success = false;
    foreach ($res as $value) {
        $saltedPwd = hash_hmac('sha256', $pwd, $value['salt']);
        if ($saltedPwd == $value['password']) {
            $exp = time() + 3600 * 24 * 3;
            $token = array(
                'em' => $value['email'],
                'exp' => $exp,
                'k' => hash_hmac('sha256', $exp.$value['password'], $value['salt'])
            );
            setcookie('s4210', json_encode($token), $exp, '', '', true, true);
            $_SESSION['s4210'] = $token;
            $login_success =  true;
        }
    }

    if ($login_success) {
        header('Location: admin.php', true, 302);
        exit();
    } else {
        throw new Exception('Wrong Credentials');
    }
}

function ierg4210_logout() {

    header('Location: login.php', true, 302);
    exit();
}

