<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>設問登録</title>
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
    $email = $_SESSION['join'];
    $user = session_user($email);
    $auth = $user[3];
    $d_id = $user[2];
    if ($auth == 0) {
        header('Location: ../user/auth_ng.html');
    }
    $name = $user[0] . " " . $user[1];
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
                            <a class="nav-link active" aria-current="page">設問登録</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                管理メニュー
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="../user/user_submit.php">ドライバー登録</a></li>
                                <li><a class="dropdown-item" href="../user/user_list.php">ドライバーリスト</a></li>
                                <li><a class="dropdown-item" href="./question_list.php">設問リスト</a></li>
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
                                <li><a class="dropdown-item" href="../user/logout_admin.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="card mb-3 mx-auto" style="max-width: 700px;">
            <div class="row g-0">
                <div class="col-md-3 text d-flex align-items-center justify-content-center">
                    <p>Question<br>
                        <i class="bi bi-question-diamond" style="font-size: 4rem;"></i>
                    </p>
                </div>
                <div class="col-md-8">
                    <form action="./question_add.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btn_radio1" id="radio_id1" value="1" required autocomplete="off">
                                    <label class="btn btn-outline-primary" for="radio_id1"><i class="bi bi-circle"></i></label>
                                    <input type="radio" class="btn-check" name="btn_radio1" id="radio_id2" value="0" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="radio_id2"><i class="bi bi-x-lg"></i></label>
                                </div>
                                <div class="btn-group mt-3" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btn_radio2" id="radio_id3" value="1" required autocomplete="off">
                                    <label class="btn btn-outline-primary" for="radio_id3"><i class="bi bi-1-square"></i></label>
                                    <input type="radio" class="btn-check" name="btn_radio2" id="radio_id4" value="2" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="radio_id4"><i class="bi bi-2-square"></i></label>
                                    <input type="radio" class="btn-check" name="btn_radio2" id="radio_id5" value="3" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="radio_id5"><i class="bi bi-3-square"></i></label>
                                    <input type="radio" class="btn-check" name="btn_radio2" id="radio_id6" value="4" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="radio_id6"><i class="bi bi-4-square"></i></label>
                                    <input type="radio" class="btn-check" name="btn_radio2" id="radio_id7" value="5" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="radio_id7"><i class="bi bi-5-square"></i></label>
                                </div>
                                <input type="text" class="form-control col-sm-1 mt-3" name="question" placeholder="設問" required>
                                <button type="submit" class="btn btn-primary mt-3">登録</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstrap-script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>