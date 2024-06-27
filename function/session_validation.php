<?php
function session_vali($mail, $user_pass)
{
    $sql = <<<SQL
    SELECT email, pass FROM drivers WHERE email = ?;
    SQL;

    $dbh = getDb();
    $sth = $dbh->prepare($sql);
    $sth->bindValue(1, $mail, PDO::PARAM_STR);
    $sth->execute();
    $user_info = $sth->fetch();

    if (password_verify($user_pass, $user_info['pass'])) {
        return "1";
    } else {
        return "0";
    }

    $dbh = null;
}
