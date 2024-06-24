<?php
$d_number = filter_input(INPUT_POST, 'd_number');
$e_number = filter_input(INPUT_POST, 'e_number');
$l_name = filter_input(INPUT_POST, 'l_name');
$f_name = filter_input(INPUT_POST, 'f_name');
$email = filter_input(INPUT_POST, 'email');
$pass = filter_input(INPUT_POST, 'pass');
$h_pass = password_hash($pass, PASSWORD_DEFAULT);

require_once '../db_access/database.php';
require_once '../function/user_validation.php';

$user_vali = user_vali($d_number, $e_number, $email);
echo $user_vali;

if ($user_vali > 0) {
    header('Location: ./err.html');
} else {
    try {
        $sql2 = <<<SQL
        INSERT INTO drivers (driver_id, employee_number, f_name, l_name, email, pass) VALUES (?,?,?,?,?,?)
        SQL;
        $dbh = getDb();
        $sth = $dbh->prepare($sql2);
        $sth->bindValue(1, $d_number, PDO::PARAM_INT);
        $sth->bindValue(2, $e_number, PDO::PARAM_STR);
        $sth->bindValue(3, $f_name, PDO::PARAM_STR);
        $sth->bindValue(4, $l_name, PDO::PARAM_STR);
        $sth->bindValue(5, $email, PDO::PARAM_STR);
        $sth->bindValue(6, $h_pass, PDO::PARAM_STR);
        $sth->execute();
        header('Location: ./success.html');
    } catch (Exception $e) {
        print "ERR! : {$e->getMessage()}";
    } finally {
        $dbh = null;
    }
}
