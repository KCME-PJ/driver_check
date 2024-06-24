<?php
$flag = filter_input(INPUT_POST, 'btn_radio1');
$diagnosis = filter_input(INPUT_POST, 'btn_radio2');
$question = filter_input(INPUT_POST, 'question');

require_once '../db_access/database.php';
$sql = <<<SQL
INSERT INTO questions (answer, diagnosis, question) VALUES (?,?,?)
SQL;
$dbh = getDb();
try {
    $sth = $dbh->prepare($sql);
    $sth->bindValue(1, $flag, PDO::PARAM_INT);
    $sth->bindValue(2, $diagnosis, PDO::PARAM_INT);
    $sth->bindValue(3, $question, PDO::PARAM_STR);
    $sth->execute();
} catch (Exception $e) {
    print "ERR! : {$e->getMessage()}";
} finally {
    $dbh = null;
}
header('Location: ./question_list.php');
