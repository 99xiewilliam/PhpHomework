<?php
echo ($salt = mt_rand()) . "<br/>";
echo hash_hmac('sha256', $_REQUEST['password'], $salt);

function ierg4210_login() {
    if (empty($_POST['email']) || empty($_POST['pw'])
        || !preg_match("/^[\w=+\-\/][\w='+\-\/\.]*@[\w\-]+(\.[\w\-]+)*(\.[\w]{2,6})$/", $_POST['email'])
        || !preg_match("/^[\w@#$%\^\&\*\-]+$/", $_POST['pw'])) {
        throw new Exception('Wrong Credentials');
    }
    $login_success = false;

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
<h1>Login in page</h1>>
<form action="#" method="get">
    email：<input type="text" name="user" value="" placeholder="input email"><br>
    password：<input type="password" name="password" value="" placeholder="input password"><br>
    <input type="submit" name="" value="submit" placeholder=""><br>
</form>

</body>
</html>


