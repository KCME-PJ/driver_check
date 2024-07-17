<?php
session_start();
$email = filter_input(INPUT_POST, 'email');
$pass = filter_input(INPUT_POST, 'pass');

require_once '../db_access/database.php';
require_once '../function/session_validation.php';

$user_valid = session_vali($email, $pass);
if ($user_valid == 0) {
    header('Location: ./login_err.html');
} else {
    $_SESSION['join'] = $email;     //sessionにメールアドレスを記録
    header('Location: ./index.php');
}
