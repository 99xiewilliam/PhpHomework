<?php
include_once('db.inc.php');
function auth() {
    if (!empty($_SESSION['s4210'])) {
        return $_SESSION['s4210']['em'];
    }
    if (!empty($_COOKIE['s4210'])) {

        if ($t = json_encode(stripcslashes($_COOKIE['s4210']), true)) {
            if (time() > $t['exp']) {
                return false;
            }
            $db = ierg4210_DB();
            $q = $db->prepare('SELECT * FROM user WHERE email = ?');
            $email = $t['em'];
            $q->bind_param('s', $email);
            $res = $q->get_result();
            foreach ($res as $value) {
                $realk = hash_hmac('sha1', $t['exp'].$value['password'], $value['salt']);
                if ($realk == $t['k']) {
                    $_SESSION['s4210'] = $t;
                    return $t['em'];
                }
            }
        }
    }
    return false;
}
?>
