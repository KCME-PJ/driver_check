<?php
$email = filter_input(INPUT_POST, 'email');
date_default_timezone_set('Asia/Tokyo');    //タイムゾーンの設定
$code = random_int(1000, 9999);             //暗号学的にセキュアな方法で、等確率に出る整数を取得する
$today = date("Y-m-d H:i:s");               //MySQLのDATETIMEフォーマット

require_once '../db_access/database.php';
require_once '../function/reset-pass_validation.php';

$m_vali = reset_vali($email);

if ($m_vali == 0) {
    header("Location: ./reset_pw.php?mail=$email");
}
if ($m_vali > 1) {
    header("Location: ./reset_pw.php?mail=$email");
} else {
    try {
        $sql = <<<SQL
        UPDATE drivers SET reset_code = ?, reset_at = ? WHERE email = ?
        SQL;
        $dbh = getDb();
        $sth = $dbh->prepare($sql);
        $sth->bindValue(1, $code, PDO::PARAM_INT);
        $sth->bindValue(2, $today, PDO::PARAM_STR);
        $sth->bindValue(3, $email, PDO::PARAM_STR);
        $sth->execute();

        header("Location: ./reset_pw.php?mail=$email");
    } catch (Exception $e) {
        print "ERR! : {$e->getMessage()}";
    } finally {
        $dbh = null;
    }
}
