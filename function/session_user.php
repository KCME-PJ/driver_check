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
    $f_name = $user_info['fname'];
    $driver_id = $user_info['driver_id'];

    $dbh = null;
    return array($l_name, $f_name, $driver_id);
}
