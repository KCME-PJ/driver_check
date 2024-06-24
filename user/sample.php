<?php
date_default_timezone_set('Asia/Tokyo');    //タイムゾーンの設定
$code = random_int(1000, 9999);             //暗号学的にセキュアな方法で、等確率に出る整数を取得する
$today = date("Y-m-d H:i:s");               //MySQLのDATETIMEフォーマット

echo 'random_int:' . $code;
echo "<br/>";
echo $today;
