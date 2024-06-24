<?php
function reset_vali($email_vali)
{
    $sql = <<<SQL
    SELECT COUNT(*) AS cnt FROM drivers WHERE email = ?
    SQL;
    $dbh = getDb();
    $sth = $dbh->prepare($sql);
    $sth->bindValue(1, $email_vali, PDO::PARAM_STR);
    $sth->execute();
    $email = $sth->fetch(PDO::FETCH_ASSOC);
    $m_cnt = $email['cnt'];

    if ($m_cnt > 0) {
        return $m_cnt;
    } else {
        return "0";
    }
}
