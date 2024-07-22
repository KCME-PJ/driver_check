<?php
require_once '../db_access/database.php';
require_once '../classes/user.php';
require_once '../classes/user_mapper.php';
require_once '../function/post_validation.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeNumber = filter_input(INPUT_POST, 'e_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = filter_input(INPUT_POST, 'l_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fname = filter_input(INPUT_POST, 'f_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $pass = filter_input(INPUT_POST, 'pass', FILTER_DEFAULT);
    $postData = [
        'employee_number' => $employeeNumber,
        'lname' => $lname,
        'fname' => $fname,
        'email' => $email,
        'pass' => $pass
    ];
    $errors = validatePostData($postData);
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        exit;
    }
    $pdo = getDb();
    $user = new User(null, $employeeNumber, $lname, $fname, $email, $pass);
    $mapper = new UserMapper($pdo);
    try {
        if ($mapper->insert($user)) {
            header('Location: ../user/user_list.php');
            exit;
        } else {
            echo "ドライバーの登録に失敗しました。";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
