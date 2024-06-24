<?php
$d_id = filter_input(INPUT_GET, 'id');

require_once '../db_access/database.php';
$sql = <<<SQL
DELETE FROM drivers WHERE d_id = ?
SQL;
$dbh = getDb();
try {
    $sth = $dbh->prepare($sql);
    $sth->bindValue(1, $d_id, PDO::PARAM_INT);
    $sth->execute();
} catch (Exception $e) {
    print "ERR! : {$e->getMessage()}";
} finally {
    $dbh = null;
}
header('Location: ./user_list.php');
