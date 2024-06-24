<?php
$q_id = filter_input(INPUT_POST, 'id');
$flag = filter_input(INPUT_POST, 'btn_radio1');
$diagnosis = filter_input(INPUT_POST, 'btn_radio2');
$question = filter_input(INPUT_POST, 'question');

require_once '../db_access/database.php';
$sql = <<<SQL
UPDATE questions SET answer = ?, diagnosis = ?, question = ? WHERE q_id = ?
SQL;
$dbh = getDb();
try {
    $sth = $dbh->prepare($sql);
    $sth->bindValue(1, $flag, PDO::PARAM_INT);
    $sth->bindValue(2, $diagnosis, PDO::PARAM_INT);
    $sth->bindValue(3, $question, PDO::PARAM_STR);
    $sth->bindValue(4, $q_id, PDO::PARAM_INT);
    $sth->execute();
} catch (Exception $e) {
    print "ERR! : {$e->getMessage()}";
} finally {
    $dbh = null;
}
header('Location: ./question_list.php');
