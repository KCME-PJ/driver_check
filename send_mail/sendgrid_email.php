<?php
require_once 'config.php';
require 'vendor/autoload.php';

$email = new \SendGrid\Mail\Mail();
$email->setFrom("kotsu-anzen@kcme.jp", "交通安全事務局");
$email->setSubject("PHPからメール送信テスト");
$email->addTo("ken-fujita@kcme.jp", "テスト太郎さん");
$email->addContent("text/plain", "パスワードの再設定依頼を受け付けました。（再設定用コード発行後2時間以内有効）
設定用のコード：1234");

$sendgrid = new \SendGrid(SENDGRID_API_KEY);
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ' . $e->getMessage() . "\n";
}
