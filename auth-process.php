<?php

//include_once('lib/db.inc.php');
header('Content-Type: application/json');

function ierg4210_register() {
    global $db;
    $db = ierg4210_DB();
    echo $_POST['email'] . "<br>";
    echo $_POST['pw'] . "<br>";
    echo !preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/", $_POST['email']);
    echo !preg_match("/^(?=.*\d)(?=.*[a-zA-Z])[\da-zA-Z~!@#$%^&*._?]{8,15}$/", $_POST['pw']);


    if (empty($_POST['email']) || empty($_POST['pw'])
        || !preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/", $_POST['email'])
        || !preg_match("/^(?=.*\d)(?=.*[a-zA-Z])[\da-zA-Z~!@#$%^&*._?]{8,15}$/", $_POST['pw'])) {

        throw new Exception('Wrong Credentials');
    }

    $email = $_POST['email'];
    $pwd = $_POST['pw'];
    $salt = mt_rand();
    $flag = $_POST['actor'];;
    echo $_POST['actor'];
    $saltPassword = hash_hmac('sha256', $pwd, $salt);
//    echo "xiaoxinxin" ."<br>";

    $stmt = $db->prepare("INSERT INTO user (email, password, salt, flag) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssdd', $email, $saltPassword, $salt, $flag);
    if ($stmt->execute()) {
        echo "update succ";
        return 1;
    }

}

function ierg4210_login() {
    global $db;
    $db = ierg4210_DB();
    session_start([
        'cookie_lifetime' => 86400,
    ]);

    if (empty($_POST['email']) || empty($_POST['pw'])
        || !preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/", $_POST['email'])
        || !preg_match("/^(?=.*\d)(?=.*[a-zA-Z])[\da-zA-Z~!@#$%^&*._?]{8,15}$/", $_POST['pw'])) {
        throw new Exception('Wrong Credentials');
    }

    $email = $_POST['email'];
    $sanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($sanitized, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Wrong Credentials');
    }

    $pwd = $_POST['pw'];
    $stmt = $db->prepare("SELECT * FROM user WHERE email = (?)");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $login_success = false;
    $flag = 0;
    foreach ($res as $value) {
        $saltedPwd = hash_hmac('sha256', $pwd, $value['salt']);
        $flag = $value['flag'];
        if ($saltedPwd == $value['password']) {
            $exp = time() + 3600 * 24 * 3;
            $token = array(
                'em' => $value['email'],
                'exp' => $exp,
                'k' => hash_hmac('sha256', $exp.$value['password'], $value['salt'])
            );
            setcookie('s4210', json_encode($token), $exp, '', '', true, true);
            setcookie('y_email', $email, time() + 3600 * 24 * 3, "/");
            $_SESSION['s4210'] = $token;
            $login_success =  true;
        }
    }

    if ($login_success && $flag == 1) {
        header('Location: admin.php', true, 302);
        exit();
    } else if ($login_success && $flag == 0) {
        header('Location: main.php', true, 302);
        exit();
    } else {
        header('Location: login.php', true, 302);
        exit();
    }
}

//function ierg4210_login() {
//    if (empty($_POST['email']) || empty($_POST['pw'])
//        || !preg_match("/^[\w=+\-\/][\w='+\-\/\.]*@[\w\-]+(\.[\w\-]+)*(\.[\w]{2,6})$/", $_POST['email'])
//        || !preg_match("/^[\w@#$%\^\&\*\-]+$/", $_POST['pw'])) {
//        throw new Exception('Wrong Credentials');
//    }
//
//    $email = $_POST['email'];
//    $db = ierg4210_DB();
//    $q = $db->prepare('SELECT * FROM account WHERE email = ?');
//    $q->bind_param("s", $email);
//
//    $login_success = false;
//
//    if ($login_success) {
//        header('Location: admin.php', true, 302);
//        exit();
//    } else {
//        throw new Exception('Wrong Credentials');
//    }
//}

function ierg4210_logout() {
    session_start([
        'cookie_lifetime' => 86400,
    ]);
    $_SESSION = array();
    if (isset($_COOKIE['s4210'])) {
        setcookie('s4210', '', time() - 1, '/');
    }
    session_destroy();
    header('Location: login.php', true, 302);
    exit();
}

//function ierg4210_auth() {
//    if (!empty($_SESSION['s4210'])) {
//        return $_SESSION['s4210']['em'];
//    }
//    if (!empty($_COOKIE['s4210'])) {
//        if ($t = json_decode(stripcslashes($_COOKIE['s4210']), true)) {
//
//            if (time() > $t['exp']) {
//                return false;
//            }
//            $db = ierg4210_DB();
//            $q = $db->prepare('SELECT * FROM user WHERE email = ?');
//            $email = $t['em'];
//            $q->bind_param('s', $email);
//            $res = $q->get_result();
//            foreach ($res as $value) {
//                $realk = hash_hmac('sha256', $t['exp'].$value['password'], $value['salt']);
//                if ($realk == $t['k']) {
//                    $_SESSION['s4210'] = $t;
//                    return $t['em'];
//                }
//            }
//        }
//    }
//    return false;
//}

//// input validation
//if (empty($_REQUEST['action']) || !preg_match('/^\w+$/', $_REQUEST['action'])) {
//    echo json_encode(array('failed'=>'undefined'));
//    exit();
//}
//try {
//    if (($returnVal = call_user_func($_REQUEST['action'])) === false) {
//        if ($db && $db->errorCode())
//            error_log(print_r($db->errorInfo(), true));
//        echo json_encode(array('failed'=>'1'));
//    }
//    echo 'while(1);' . json_encode(array('success' => $returnVal));
//} catch(PDOException $e) {
//    error_log($e->getMessage());
//    echo json_encode(array('failed'=>'error-db'));
//} catch(Exception $e) {
//    echo 'while(1);' . json_encode(array('failed' => $e->getMessage()));
//}
?>
