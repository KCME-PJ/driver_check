<?php
function user($d_id)
{
    $sql = <<<SQL
    SELECT * FROM drivers WHERE d_id = ?;
    SQL;
    $dbh = getDb();
    $sth = $dbh->prepare($sql);
    $sth->bindValue(1, $d_id, PDO::PARAM_INT);
    $sth->execute();
    $user_info = $sth->fetch();
    $l_name = $user_info['l_name'];
    $f_name = $user_info['f_name'];
    $driver_id = $user_info['driver_id'];

    require_once '../function/scoring.php';
    $score = scoring($d_id);
    $total_score = $score[0];
    $time_stamp = strtotime($score[1]);
    $result = $score[2];
    $ans1 = $result["genre_correct"][1];
    $ans2 = $result["genre_correct"][2];
    $ans3 = $result["genre_correct"][3];
    $ans4 = $result["genre_correct"][4];
    $ans5 = $result["genre_correct"][5];
    if ($total_score >= 40) {       //総合評価を判定
        $total_judge = "A";
    } else {
        if ($total_score <= 28) {
            $total_judge = "C";
        } else {
            if ($total_score >= 29) {
                $total_judge = "B";
            }
        }
    }
    if ($ans1 >= 9) {       //気分の安定を判定
        $ans1_judge = "A";
    } else {
        if ($ans1 <= 3) {
            $ans1_judge = "C";
        } else {
            if ($ans1 >= 4) {
                $ans1_judge = "B";
            }
        }
    }
    if ($ans2 >= 9) {       //危険敢行度・用心深さを判定
        $ans2_judge = "A";
    } else {
        if ($ans2 <= 5) {
            $ans2_judge = "C";
        } else {
            if ($ans2 >= 6) {
                $ans2_judge = "B";
            }
        }
    }
    if ($ans3 >= 9) {       //生活安定度を判定
        $ans3_judge = "A";
    } else {
        if ($ans3 <= 4) {
            $ans3_judge = "C";
        } else {
            if ($ans3 >= 5) {
                $ans3_judge = "B";
            }
        }
    }
    if ($ans4 >= 9) {       //遵法態度を判定
        $ans4_judge = "A";
    } else {
        if ($ans4 <= 4) {
            $ans4_judge = "C";
        } else {
            if ($ans4 >= 5) {
                $ans4_judge = "B";
            }
        }
    }
    if ($ans5 == 10) {       //安全意識・意欲を判定
        $ans5_judge = "A";
    } else {
        if ($ans5 <= 5) {
            $ans5_judge = "C";
        } else {
            if ($ans5 >= 6) {
                $ans5_judge = "B";
            }
        }
    }
    $dbh = null;
    return array($l_name, $f_name, $d_id, $driver_id, $total_score, $total_judge, $ans1, $ans1_judge, $ans2, $ans2_judge, $ans3, $ans3_judge, $ans4, $ans4_judge, $ans5, $ans5_judge, $time_stamp);
}
