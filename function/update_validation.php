<?php
function validateUpdateData($data)
{
    $errors = [];

    //社員番号チェック（半角英数大文字）
    if (!preg_match('/^[A-Z0-9]+$/', $data['employee_number'])) {
        $errors[] = "社員番号は半角英数大文字で入力してください。";
    }

    //運転者IDチェック（半角英数字もしくはnull）
    if (!ctype_alnum($data['driver_id']) && $data['driver_id'] !== null) {
        $errors[] = "運転者IDに半角英数字以外の文字列もしくはスペースが含まれているようです。";
    }

    //苗字のチェック
    if (empty($data['l_name'])) {
        $errors[] = "苗字を入力してください。";
    }

    //名前のチェック
    if (empty($data['f_name'])) {
        $errors[] = "名前を入力してください。";
    }

    //メールのチェック（半角英数）
    if (!preg_match('/^[a-zA-Z0-9@._-]+$/', $data['email'])) {
        $errors[] = "正しいメールアドレスか確認をお願いします。";
    }

    //アクセス権のチェック（半角数字）
    if (!preg_match('/^[0-1]+$/', $data['access_authority'])) {
        $errors[] = "アクセス権は半角数字、値は0か1で入力してください。";
    }
    return $errors;
}
