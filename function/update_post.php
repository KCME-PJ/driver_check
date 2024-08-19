<?php
require_once '../db_access/database.php';
require_once '../classes//user_status.php';
require_once '../classes/user_status_mapper.php';
require_once '../function/update_validation.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_number = filter_input(INPUT_POST, 'employee', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $driver_id = filter_input(INPUT_POST, 'driver_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null; //$_POST['driver_id']の存在をチェック、なければnullを代入
    $l_name = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $f_name = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'address', FILTER_VALIDATE_EMAIL);
    $d_id = filter_input(INPUT_POST, 'd_id', FILTER_VALIDATE_INT);
    $auth = filter_input(INPUT_POST, 'auth', FILTER_VALIDATE_INT);
    $driver_id = empty($driver_id) ? null : $driver_id; //driver_idに有効な値があるかをチェック、空文字などであればnullを代入
    $postData = [
        'employee_number' => $employee_number,  //''内はvalidateUpdateData classの引数に合わせる
        'driver_id' => $driver_id,
        'l_name' => $l_name,
        'f_name' => $f_name,
        'email' => $email,
        'access_authority' => $auth
    ];
    $errors = validateUpdateData($postData);
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        exit;
    }
    $updateData = [
        'd_id' => $d_id,
        'driver_id' => $driver_id,
        'access_authority' => $auth,
        'employee_number' => $employee_number,
        'l_name' => $l_name,
        'f_name' => $f_name,
        'email' => $email,
    ];
    $pdo = getDb();
    $user = new UserStatus($updateData);
    $mapper = new UserStatusMapper($pdo);
    try {
        if ($mapper->driverUpdate($user)) {
            header('Location: ../user/user_list.php');
            exit;
        } else {
            echo "ドライバーの登録に失敗しました。";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
