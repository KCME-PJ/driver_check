<?php
function answer_time($d_id)
{
    date_default_timezone_set('Asia/Tokyo');
    //テスト実施記録の確認、なければテスト画面へ遷移する、記録があれば経過時間を確認する
    $sql_count = <<<SQL
    SELECT COUNT(*) AS cnt FROM answers WHERE d_id = ?
    SQL;
    $dbh = getDb();
    $sth1 = $dbh->prepare($sql_count);
    $sth1->bindValue(1, $d_id, PDO::PARAM_STR);
    $sth1->execute();
    $driver = $sth1->fetch(PDO::FETCH_ASSOC);
    $d_cnt = $driver['cnt'];
    if ($d_cnt == 0) {
        return "1";
    }

    //前回からの経過時間を確認する、8時間以上であればテスト画面へ遷移する、8時間未満であればテスト結果画面へ遷移する
    $sql_time = <<<SQL
    SELECT * FROM answers WHERE d_id = ? ORDER BY create_at DESC LIMIT 1
    SQL;
    $dbh = getDb();
    try {
        $sth = $dbh->prepare($sql_time);
        $sth->bindValue(1, $d_id, PDO::PARAM_STR);
        $sth->execute();
        $checker = $sth->fetch(PDO::FETCH_ASSOC);
        $a_time = strtotime($checker['create_at']);
        $today = strtotime(date("Y-m-d H:i:s"));
        $diff_time = ($today - $a_time) / 3600;     //時間に換算
        if ($diff_time < 168) {                     //回答して168時間（1週間）以上のみ再度回答可
            return "0";
        }
        return "1";
    } catch (Exception $e) {
        print "ERR! : {$e->getMessage()}";
    } finally {
        $dbh = null;
    }
}
