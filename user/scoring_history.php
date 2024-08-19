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

    $d_id = filter_input(INPUT_GET, 'd_id');

    //テスト実施履歴の有無を確認し、なければnothing.phpへ飛ばす
    $answer = answer_chech($d_id);
    if ($answer == 0) {
        header("Location: ./nothing.php?d_id=$d_id");
    }
    $driver = user($d_id);
    $driver_name = $driver[0] . " " . $driver[1];
    $score = scoring($d_id);
    $time_stamp = strtotime($score[1]);
    $ans_1 = $driver[6];
    $ans_2 = $driver[8];
    $ans_3 = $driver[10];
    $ans_4 = $driver[12];
    $ans_5 = $driver[14];
    $genre = $ans_1 . "," . $ans_2 . "," . $ans_3 . "," . $ans_4 . "," . $ans_5;
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
                            <a class="nav-link active" aria-current="page">ドライバー情報</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                管理メニュー
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="./user_list.php">ドライバーリスト</a></li>
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
                                <li><a class="dropdown-item" href="./logout_admin.php">Logout</a></li>
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
                    <th scope="col">社員番号</th>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card-body">
                    <form action="../function/update_post.php" method="post">
                        <div class="mb-3">
                            <label for="employee" class="form-label">社員番号</label>
                            <input type="text" minlength="9" maxlength="9" class="form-control" id="employee" name="employee" value="<?php echo $driver[3]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="driver_id" class="form-label">運転者ID</label>
                            <input type="text" minlength="3" maxlength="8" class="form-control" id="driver_id" name="driver_id" value="<?php echo $driver[17]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="form-label">姓（LastName）</label>
                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $driver[0]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="fname" class="form-label">名（FirstName）</label>
                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $driver[1]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="auth" class="form-label">アクセス権 [0]user、[1]admin</label>
                            <input type="number" max="1" min="0" class="form-control" id="auth" name="auth" value="<?php echo $driver[18]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">MailAddress</label>
                            <input type="email" class="form-control" id="address" name="address" value="<?php echo $driver[19]; ?>" required>
                        </div>
                        <div>
                            <input type="hidden" class="form-control" name="d_id" value="<?php echo $driver[2]; ?>">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary">ドライバー情報修正</button>
                            <button type="button" onclick="history.back()" class="btn btn-outline-warning">戻る</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-lg-6 offset-lg-2 offset-md-0">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <!-- chart.js-script -->
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
    <!-- bootstrap-script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>