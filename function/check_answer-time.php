<?php
function answer_time($d_id)
{
    date_default_timezone_set('Asia/Tokyo');
    $sql = <<<SQL
    SELECT * FROM answers WHERE d_id = ? ORDER BY create_at DESC LIMIT 1
    SQL;
    $dbh = getDb();
    try {
        $sth = $dbh->prepare($sql);
        $sth->bindValue(1, $d_id, PDO::PARAM_STR);
        $sth->execute();
        $checker = $sth->fetch(PDO::FETCH_ASSOC);
        $a_time = strtotime($checker['create_at']);
        $today = strtotime(date("Y-m-d H:i:s"));
        $diff_time = ($today - $a_time) / 3600;     //時間に換算

        if ($diff_time < 8) {                       //回答して8時間以上のみ再度回答可
            return "0";
        }
        return "1";
    } catch (Exception $e) {
        print "ERR! : {$e->getMessage()}";
    } finally {
        $dbh = null;
    }
}
