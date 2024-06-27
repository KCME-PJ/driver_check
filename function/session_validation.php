<?php
function session_vali($email, $pass)
{
    $result = null;
    $sql = <<<SQL
    SELECT * FROM drivers WHERE email = ?;
    SQL;

    $dbh = getDb();
    $sth = $dbh->prepare($sql);
    $sth->bindValue(1, $email, PDO::PARAM_STR);
    $sth->execute();
    $user_info = $sth->fetch();

    if (password_verify($pass, $user_info['pass'])) {
        $result = 1;
        return $result;
    } else {
        $result = 0;
        return $result;
    }

    $dbh = null;
}
