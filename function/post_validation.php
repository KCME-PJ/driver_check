<?php
function validatePostData($data)
{
    $errors = [];

    //社員番号チェック（半角英数大文字）
    if (!preg_match('/^[A-Z0-9]+$/', $data['employee_number'])) {
        $errors[] = "社員番号は半角英数大文字で入力してください。";
    }

    //苗字のチェック
    if (empty($data['lname'])) {
        $errors[] = "苗字を入力してください。";
    }

    //名前のチェック
    if (empty($data['fname'])) {
        $errors[] = "名前を入力してください。";
    }

    //メールのチェック（半角英数）
    if (!preg_match('/^[a-zA-Z0-9@._-]+$/', $data['email'])) {
        $errors[] = "メールアドレスは半角英数で入力してください。";
    }

    //パスワードのチェック（半角英数）
    if (!preg_match('/^[a-zA-Z0-9]+$/', $data['pass'])) {
        $errors[] = "パスワードは半角英数字で入力してください。";
    }
    return $errors;
}
