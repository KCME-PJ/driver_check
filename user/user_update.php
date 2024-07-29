<?php
require_once '../db_access/database.php';
$driver_id = filter_input(INPUT_POST, 'driver_id') ?? null; //$_POST['driver_id']の存在をチェック、なければnullを代入
$lname = filter_input(INPUT_POST, 'lname');
$fname = filter_input(INPUT_POST, 'fname');
$auth = filter_input(INPUT_POST, 'auth');
$email = filter_input(INPUT_POST, 'address');
$d_id = filter_input(INPUT_POST, 'd_id');
$driver_id = empty($driver_id) ? null : $driver_id; //$_POST['driver_id']に有効な値があるかをチェック、空文字などであればnullを代入
$driver_id = mb_convert_kana($driver_id, 'as');
if (ctype_alnum($driver_id) || $driver_id == null) {
    $sql = <<<SQL
UPDATE drivers SET driver_id = ?, access_authority = ?, f_name = ?, l_name = ?, email = ? WHERE d_id = ?
SQL;
    $dbh = getDb();
    try {
        $sth = $dbh->prepare($sql);
        $sth->bindValue(1, $driver_id, PDO::PARAM_STR);
        $sth->bindValue(2, $auth, PDO::PARAM_INT);
        $sth->bindValue(3, $fname, PDO::PARAM_STR);
        $sth->bindValue(4, $lname, PDO::PARAM_STR);
        $sth->bindValue(5, $email, PDO::PARAM_STR);
        $sth->bindValue(6, $d_id, PDO::PARAM_INT);
        $sth->execute();
    } catch (Exception $e) {
        print "ERR! : {$e->getMessage()}";
    } finally {
        $dbh = null;
    }
    header('Location: ./user_list.php');
} else {
    echo "エラー：英数字以外の文字列もしくはスペースが含まれているようです。";
}
