<?php
function check_code($mail, $code)
{
    date_default_timezone_set('Asia/Tokyo');
    $sql = <<<SQL
    SELECT * FROM drivers WHERE email = ?
    SQL;
    $dbh = getDb();
    try {
        $sth = $dbh->prepare($sql);
        $sth->bindValue(1, $mail, PDO::PARAM_STR);
        $sth->execute();
        $checker = $sth->fetch(PDO::FETCH_ASSOC);
        $c_code = $checker['reset_code'];
        $c_time = strtotime($checker['reset_at']);
        $today = strtotime(date("Y-m-d H:i:s"));
        $diff_time = ($today - $c_time) / 3600;     //時間に換算

        if ($diff_time > 2) {                       //リセット用コードを発行して2時間以内のみパスワード変更許可
            return "0";
        } else {
            if ($code <> $c_code) {
                return "0";
            } else {
                return "1";
            }
        }
    } catch (Exception $e) {
        print "ERR! : {$e->getMessage()}";
    } finally {
        $dbh = null;
    }
}
