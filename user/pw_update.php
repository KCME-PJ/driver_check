<?php
$mail = filter_input(INPUT_POST, 'mail');
$code = filter_input(INPUT_POST, 'code');
$pass = filter_input(INPUT_POST, 'pass');
$h_pass = password_hash($pass, PASSWORD_DEFAULT);

require_once '../db_access/database.php';
require_once '../function/check_code-time.php';

$check = check_code($mail, $code);

if ($check == 0) {
    header('Location: ./check_ng.html');
} else {
    try {
        $sql = <<<SQL
        UPDATE drivers SET pass = ? WHERE email = ?
        SQL;
        $dbh = getDb();
        $sth = $dbh->prepare($sql);
        $sth->bindValue(1, $h_pass, PDO::PARAM_STR);
        $sth->bindValue(2, $mail, PDO::PARAM_STR);
        $sth->execute();

        header('Location: ./check_ok.html');
    } catch (Exception $e) {
        print "ERR! : {$e->getMessage()}";
    } finally {
        $dbh = null;
    }
}
