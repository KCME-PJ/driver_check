<?php
$e_mail = filter_input(INPUT_POST, 'email');
date_default_timezone_set('Asia/Tokyo');    //タイムゾーンの設定
$code = random_int(1000, 9999);             //暗号学的にセキュアな方法で、等確率に出る整数を取得する
$today = date("Y-m-d H:i:s");               //MySQLのDATETIMEフォーマット

require_once '../db_access/database.php';
require_once '../function/reset-pass_validation.php';
require_once '../function/session_user.php';
require_once '../db_access/config.php';     //API-Key
require '../send_mail/vendor/autoload.php'; //sendgrid-send_mail

$m_vali = reset_vali($e_mail);
var_dump($m_vali);

if ($m_vali == 0) {
    header("Location: ../reset_pw.php");
}
if ($m_vali > 1) {
    header("Location: ../reset_pw.php");
}
if ($m_vali == 1) {
    $user = session_user($e_mail);
    $name = $user[0] . " " . $user[1] . "さん";
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("kotsu-anzen@kcme.jp", "交通安全事務局");
    $email->setSubject("交通安全事務局からセキュリティコードをお送りします");
    $email->addTo("$e_mail", "$name");
    $email->addContent("text/plain", "パスワードの再設定依頼を受け付けました。（再設定用コード発行後2時間以内有効）
    再設定用のコード：$code
    
    【注意】このコードは誰とも共有しないでください。");
    $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    $response = $sendgrid->send($email);
    echo "メールの登録が1つある";
    try {
        $sql = <<<SQL
        UPDATE drivers SET reset_code = ?, reset_at = ? WHERE email = ?
        SQL;
        $dbh = getDb();
        $sth = $dbh->prepare($sql);
        $sth->bindValue(1, $code, PDO::PARAM_INT);
        $sth->bindValue(2, $today, PDO::PARAM_STR);
        $sth->bindValue(3, $e_mail, PDO::PARAM_STR);
        $sth->execute();

        header("Location: ../reset_pw.php");
    } catch (Exception $e) {
        echo 'Caught exception: ' . $e->getMessage() . "\n";
        //print "ERR! : {$e->getMessage()}";
    } finally {
        $dbh = null;
    }
}
