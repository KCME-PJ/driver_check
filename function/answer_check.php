<?php
function answer_chech($d_id)
{
    $sql = <<<SQL
    SELECT COUNT(*) AS cnt1 FROM answers WHERE d_id = ?
    SQL;
    $dbh = getDb();
    $sth1 = $dbh->prepare($sql);
    $sth1->bindValue(1, $d_id, PDO::PARAM_STR);
    $sth1->execute();
    $driver = $sth1->fetch(PDO::FETCH_ASSOC);
    $d_cnt = $driver['cnt1'];

    if ($d_cnt == 0) {
        return "0";
    }
    $dbh = null;
    return "1";
}
