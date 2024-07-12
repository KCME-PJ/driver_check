<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ドライバー安全レベルチェック結果</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['join'])) {
        header('location: ./login.html');
        exit();
    }
    require_once '../db_access/database.php';
    require_once '../function/scoring.php';
    require_once '../function/session_user.php';
    require_once '../function/answer_check.php';
    $email = $_SESSION['join'];
    $user = session_user($email);
    $name = $user[0] . " " . $user[1];
    $answer = answer_chech($user[2]);
    if ($answer == 0) {
        header('location: ../index.php');
    }
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav ms-auto">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-fill"></i>&nbsp;<?php echo "$name さん"; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <?php
    require_once '../db_access/database.php';
    require_once '../function/scoring.php';
    $sql_ev = <<<SQL
    SELECT * FROM evaluations WHERE ev_id = ?
    SQL;
    $dbh = getDb();
    $sth = $dbh->prepare($sql_ev);
    $sth->bindValue(1, 1, PDO::PARAM_INT);
    $sth->execute();
    $evaluation = $sth->fetch(PDO::FETCH_ASSOC);

    $d_id = $user[2];
    $score = scoring($d_id);
    $total_score = $score[0];
    $time_stamp = strtotime($score[1]);
    $result = $score[2];
    $ans1 = $result["genre_correct"][1];
    $ans2 = $result["genre_correct"][2];
    $ans3 = $result["genre_correct"][3];
    $ans4 = $result["genre_correct"][4];
    $ans5 = $result["genre_correct"][5];
    $genre = $ans1 . ',' . $ans2 . ',' . $ans3 . ',' . $ans4 . ',' . $ans5;

    if ($total_score >= 40) {       //総合評価を判定
        $total_ev = $evaluation['total_ev_a'];
        $total_judge = "判定：A";
    } else {
        if ($total_score <= 28) {
            $total_ev = $evaluation['total_ev_c'];
            $total_judge = "判定：C";
        } else {
            if ($total_score >= 29) {
                $total_ev = $evaluation['total_ev_b'];
                $total_judge = "判定：B";
            }
        }
    }
    if ($ans1 >= 9) {       //気分の安定を判定
        $ans1_ev = $evaluation['mood_stability_a'];
        $ans1_judge = "判定：A";
    } else {
        if ($ans1 <= 3) {
            $ans1_ev = $evaluation['mood_stability_c'];
            $ans1_judge = "判定：C";
        } else {
            if ($ans1 >= 4) {
                $ans1_ev = $evaluation['mood_stability_b'];
                $ans1_judge = "判定：B";
            }
        }
    }
    if ($ans2 >= 9) {       //危険敢行度・用心深さを判定
        $ans2_ev = $evaluation['caution_a'];
        $ans2_judge = "判定：A";
    } else {
        if ($ans2 <= 5) {
            $ans2_ev = $evaluation['caution_c'];
            $ans2_judge = "判定：C";
        } else {
            if ($ans2 >= 6) {
                $ans2_ev = $evaluation['caution_b'];
                $ans2_judge = "判定：B";
            }
        }
    }
    if ($ans3 >= 9) {       //生活安定度を判定
        $ans3_ev = $evaluation['stability_a'];
        $ans3_judge = "判定：A";
    } else {
        if ($ans3 <= 4) {
            $ans3_ev = $evaluation['stability_c'];
            $ans3_judge = "判定：C";
        } else {
            if ($ans3 >= 5) {
                $ans3_ev = $evaluation['stability_b'];
                $ans3_judge = "判定：B";
            }
        }
    }
    if ($ans4 >= 9) {       //遵法態度を判定
        $ans4_ev = $evaluation['law_abiding_a'];
        $ans4_judge = "判定：A";
    } else {
        if ($ans4 <= 4) {
            $ans4_ev = $evaluation['law_abiding_c'];
            $ans4_judge = "判定：C";
        } else {
            if ($ans4 >= 5) {
                $ans4_ev = $evaluation['law_abiding_b'];
                $ans4_judge = "判定：B";
            }
        }
    }
    if ($ans5 == 10) {       //安全意識・意欲を判定
        $ans5_ev = $evaluation['safety_awareness_a'];
        $ans5_judge = "判定：A";
    } else {
        if ($ans5 <= 5) {
            $ans5_ev = $evaluation['safety_awareness_c'];
            $ans5_judge = "判定：C";
        } else {
            if ($ans5 >= 6) {
                $ans5_ev = $evaluation['safety_awareness_b'];
                $ans5_judge = "判定：B";
            }
        }
    }
    ?>


    <div class="container mt-3">
        <div class="row">
            <div class="col-sm  ">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="col-sm mt-3">
                <p class="mt-3"><?php echo $user[0] . " " . $user[1]; ?>さんの結果（<?php echo date('Y年m月d日_H時i分 回答', $time_stamp); ?>）</p>
                <hr>
                <p><b>総合得点：<?php echo $total_score ?></b></p>
                <hr>
                <p class="text-center"><b>総合評価（<?php echo $total_judge; ?>）</b></p>
                <hr>
                <p><?php echo $total_ev; ?></p>
                <hr>
                <p><b>気分の安定（<?php echo $ans1_judge; ?>）</b><br>
                    <?php echo $ans1_ev; ?></p>
                <hr>
                <p><b>危険敢行度・用心深さ（<?php echo $ans2_judge; ?>）</b><br>
                    <?php echo $ans2_ev; ?></p>
                <hr>
                <p><b>生活安全度（<?php echo $ans3_judge; ?>）</b><br>
                    <?php echo $ans3_ev; ?></p>
                <hr>
                <p><b>遵法態度（<?php echo $ans4_judge; ?>）</b><br>
                    <?php echo $ans4_ev; ?></p>
                <hr>
                <p><b>安全意識・意欲（<?php echo $ans5_judge; ?>）</b><br>
                    <?php echo $ans5_ev; ?></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['気分の安定', '危険敢行度・用心深さ', '生活安全度', '遵法態度', '安全意識・意欲'],
                datasets: [{
                    label: 'ドライバー安全レベルチェック評価',
                    data: [<?php echo $genre; ?>],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 10,
                    }
                },
            }
        });
    </script>
</body>

</html>