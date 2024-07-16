<?php
function s_check($email)
{
    $sql = <<<SQL
    SELECT COUNT(*) AS cnt1 FROM drivers WHERE email = ?
    SQL;
    $dbh = getDb();
    $sth1 = $dbh->prepare($sql);
    $sth1->bindValue(1, $email, PDO::PARAM_STR);
    $sth1->execute();
    $driver = $sth1->fetch(PDO::FETCH_ASSOC);
    $d_cnt = $driver['cnt1'];

    if ($d_cnt > 0) {
        return "1";
    }
    if ($d_cnt == 0) {
        return "0";
    }
}
