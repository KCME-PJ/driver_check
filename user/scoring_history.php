<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ドライバー安全レベルチェック履歴</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['join'])) {
        header('location: ../login.html');
        exit();
    }
    require_once '../db_access/database.php';
    require_once '../function/session_user.php';
    require_once '../function/user_info.php';
    require_once '../function/answer_check.php';
    require_once '../function/scoring.php';
    $email = $_SESSION['join'];
    $login_user = session_user($email);
    $auth = $login_user[3];
    if ($auth == 0) {
        header('Location: ../user/auth_ng.html');
    }
    $name = $login_user[0] . " " . $login_user[1];

    //$d_id = filter_input(INPUT_GET, 'd_id');
    $d_id = "9";

    //テスト実施履歴の有無を確認し、なければnothing.phpへ飛ばす
    $answer = answer_chech($d_id);
    if ($answer == 0) {
        header('Location: ./nothing.php');
    }
    var_dump($answer);

    $driver = user($d_id);
    $driver_name = $driver[0] . " " . $driver[1];
    $score = scoring($d_id);
    $time_stamp = strtotime($score[1]);
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">管理画面</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-left">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page">ドライバーリスト</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                管理メニュー
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="./user_submit.php">ドライバー登録</a></li>
                                <li><a class="dropdown-item" href="../question/question_submit.php">質問登録</a></li>
                                <li><a class="dropdown-item" href="../question/question_list.php">設問リスト</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="http://pc6140/task/index.php">安全品質課ポータル</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
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
    <div class="container mt-3">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col">テスト日</th>
                    <th scope="col">運転者ID</th>
                    <th scope="col">氏名</th>
                    <th colspan="2">総合得点</th>
                    <th colspan="2">気分の安定</th>
                    <th colspan="2">用心深さ</th>
                    <th colspan="2">生活安定度</th>
                    <th colspan="2">遵法態度</th>
                    <th colspan="2">安全意識</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <td scope="row"><?php echo date('Y年m月d日_H時i分', $time_stamp); ?></td>
                    <td><?php echo $driver[3]; ?></td>
                    <td><?php echo $driver_name; ?></td>
                    <td><?php echo $driver[4]; ?></td>
                    <td><?php echo $driver[5]; ?></td>
                    <td><?php echo $driver[6]; ?></td>
                    <td><?php echo $driver[7]; ?></td>
                    <td><?php echo $driver[8]; ?></td>
                    <td><?php echo $driver[9]; ?></td>
                    <td><?php echo $driver[10]; ?></td>
                    <td><?php echo $driver[11]; ?></td>
                    <td><?php echo $driver[12]; ?></td>
                    <td><?php echo $driver[13]; ?></td>
                    <td><?php echo $driver[14]; ?></td>
                    <td><?php echo $driver[15]; ?></td>
                </tr>
            </tbody>
        </table>

    </div>

    <!-- bootstrap-script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>