<!DOCTYPE html>
<html lang="ja">

<head>
    <link rel="icon" href="./favicon01.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driving level check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .fixed-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: white;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0);
            z-index: 1000;
        }

        .content {
            margin-top: 190px;
        }
    </style>

    <script>
        let timeLeft = 600; //タイマーセット（600秒）
        function countdown() {
            if (timeLeft <= 0) {
                alert('制限時間を超えました。最初からやり直してください。');
                location.reload();
            } else {
                document.getElementById('timer').innerText = `残り時間: ${timeLeft} 秒`;
                timeLeft--;
                setTimeout(countdown, 1000); //1秒ごとにカウントダウン
            }
        }
        window.onload = countdown;
    </script>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['join'])) {
        header('location: ./login.html');
        exit();
    }
    require_once './db_access/database.php';
    require_once './function/session_check.php';
    require_once './function/session_user.php';
    require_once './function/check_answer-time.php';

    $email = $_SESSION['join'];
    $session_check = s_check($email);
    if ($session_check == 0) {
        header('location: ./login.html');
        exit();
    }
    $user = session_user($email);
    $d_id = $user[2];
    $a_time = answer_time($d_id);
    if ($a_time == 0) {
        header('Location: ./user/caution.html');
    }
    $name = $user[0] . " " . $user[1];
    ?>
    <div class="fixed-header">
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
                                    <li><a class="dropdown-item" href="./user/">前回のテスト結果</a></li>
                                    <li><a class="dropdown-item" href="./user/logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <h3 class="text-center" style="background-color: rgb(149, 241, 203); font-family: Meiryo UI;">ドライバー安全レベルチェック</h3>
        <b><i class="bi bi-alarm"></i> 制限時間：10分</b>
        <div id="timer">残り時間： 600 秒</div>
        <div class="container mt-3">
            <b>
                <p style="font-family: Meiryo UI;">次の質問を読んで、自分に当てはまれば「〇」当てはまらない場合は「×」を選択してください。<br>
                    【注意】ブラウザの「戻る」ボタンや「<i class="bi bi-arrow-clockwise"></i>」ボタンを押すと質問と回答がリセットされます。 </p>
            </b>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <form action="./question/answer.php" method="post">
                <table class="table table-striped align-middle" style="font-family: Meiryo UI;">
                    <thead>
                        <tr>
                            <th scope="col">項番</th>
                            <th scope="col" class="text-center">回答</th>
                            <th scope="col">質問</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once './db_access/database.php';
                        require_once './function/questions.php';
                        $email = $_SESSION['join'];
                        $user = session_user($email);
                        $q_table = question_tbl();
                        echo $q_table;
                        ?>
                    </tbody>
                </table>
                <input type="hidden" name="d_id" value="<?php echo $user[2]; ?>">
                <button type="submit" class="btn btn-outline-success mb-3">送信</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>