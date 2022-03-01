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
    $username = "xiaohao";
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
        $sql="INSERT INTO products (catid, name, price, description) VALUES (?, ?, ?, ?);";
        $q = $db->prepare($sql);
        $q->bindParam(1, $catid);
        $q->bindParam(2, $name);
        $q->bindParam(3, $price);
        $q->bindParam(4, $desc);
        $q->execute();
        $lastId = $db->lastInsertId();

        // Note: Take care of the permission of destination folder (hints: current user is apache)
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/admin/lib/images/" . $lastId . ".jpg")) {
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
    $_POST['catid'] = (int) $_POST['catid'];
    if (!preg_match('/^[\w\- ]+$/', $_POST['name']))
        throw new Exception("invalid-name");

    $catid = $_POST["catid"];
    $sql = "DELETE FROM categories WHERE catid = ('".$catid."');";
    if ($db-query($sql) === TRUE) {
        echo "delete succ";
        return 1;
    }
}
function ierg4210_prod_delete_by_catid(){

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
function ierg4210_prod_fetchOne(){
    global $db;
    $db = ierg4210_DB();
    if (!preg_match('/^\d*$/', $_POST['pid']))
        throw new Exception("invalid-pid");
    $_POST['pid'] = (int) $_POST['pid'];

    $pid = $_POST["pid"];
    $sql = "SELECT * FROM WHERE pid = ('".$pid ."');";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        //如果return $result->fetch_array()会有问题（admin.php会无限循环）不过我还没找到是什么原因
        return $result;
    }


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

