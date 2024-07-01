<?php
function session_user($mail)
{
    $sql = <<<SQL
    SELECT * FROM drivers WHERE email = ?;
    SQL;

    $dbh = getDb();
    $sth = $dbh->prepare($sql);
    $sth->bindValue(1, $mail, PDO::PARAM_STR);
    $sth->execute();
    $user_info = $sth->fetch();
    $l_name = $user_info['l_name'];
    $f_name = $user_info['f_name'];
    $d_id = $user_info['d_id'];
    $access_auth = $user_info['access_authority'];

    $dbh = null;
    return array($l_name, $f_name, $d_id, $access_auth);
}
