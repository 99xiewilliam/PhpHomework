<?php
require __DIR__.'/lib/db.inc.php';
$res = ierg4210_cat_fetchall();
$action = 'login';
$nonce = csrf_getNonce($action);
//$options = '';
//echo ($salt = mt_rand()) . "<br/>";
//echo hash_hmac('sha256', $_REQUEST['password'], $salt);
//
//function ierg4210_login() {
//    if (empty($_POST['email']) || empty($_POST['pw'])
//        || !preg_match("/^[\w=+\-\/][\w='+\-\/\.]*@[\w\-]+(\.[\w\-]+)*(\.[\w]{2,6})$/", $_POST['email'])
//        || !preg_match("/^[\w@#$%\^\&\*\-]+$/", $_POST['pw'])) {
//        throw new Exception('Wrong Credentials');
//    }
//    $login_success = false;
//
//    if ($login_success) {
//        header('Location: admin.php', true, 302);
//        exit();
//    } else {
//        throw new Exception('Wrong Credentials');
//    }
//}
//
//function ierg4210_logout() {
//
//    header('Location: login.php', true, 302);
//    exit();
//}


//foreach ($res as $value){
//    $options .= '<option value="'.$value["catid"].'"> '.$value["name"].' </option>';
//    echo $options;
//}

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
    <!--    <script type="text/javascript" src="./static/js/function.js"></script>-->
</head>
<body>
<fieldset>
    <h1>Login</h1>
    <fieldset>
        <legend> Login in</legend>
        <form id="login" method="POST" action="admin-process.php?action=<?php echo $action; ?>"
              enctype="multipart/form-data">
            <label for="email"> email</label>
            <div> <input id="cate_id" type="text" name="email" required="required" pattern="^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$"/></div>
            <label for="password"> password</label>
            <div><input id="cate_name" type="password" name="pw" required="true" pattern="^(?=.*\d)(?=.*[a-zA-Z])[\da-zA-Z~!@#$%^&*._?]{8,15}$"/></div>
            <input type="submit" value="Submit" />
            <input type="hidden" name="nonce" value="<?php echo $nonce?>">
        </form>
    </fieldset>
</fieldset>
</body>
</html>

