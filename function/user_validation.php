<?php
function user_vali($d_number, $e_number, $email)
{
    $sql1 = <<<SQL
    SELECT COUNT(*) AS cnt1 FROM drivers WHERE driver_id = ?
    SQL;
    $dbh = getDb();
    $sth1 = $dbh->prepare($sql1);
    $sth1->bindValue(1, $d_number, PDO::PARAM_STR);
    $sth1->execute();
    $driver = $sth1->fetch(PDO::FETCH_ASSOC);
    $d_cnt = $driver['cnt1'];

    if ($d_cnt > 0) {
        return $d_cnt;
    } else {
        $sql2 = <<<SQL
        SELECT COUNT(*) AS cnt2 FROM drivers WHERE employee_number = ?
        SQL;
        $sth2 = $dbh->prepare($sql2);
        $sth2->bindValue(1, $e_number, PDO::PARAM_STR);
        $sth2->execute();
        $employee = $sth2->fetch(PDO::FETCH_ASSOC);
        $e_cnt = $employee['cnt2'];

        if ($e_cnt > 0) {
            return $e_cnt;
        } else {
            $sql3 = <<<SQL
            SELECT COUNT(*) AS cnt3 FROM drivers WHERE email = ?
            SQL;
            $sth3 = $dbh->prepare($sql3);
            $sth3->bindValue(1, $email, PDO::PARAM_STR);
            $sth3->execute();
            $mail = $sth3->fetch(PDO::FETCH_ASSOC);
            $m_cnt = $mail['cnt3'];

            if ($m_cnt > 0) {
                return $m_cnt;
            } else {
                return "0";
            }
        }
    }
}
