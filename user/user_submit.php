<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ドライバー登録管理画面</title>
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
                            <a class="nav-link active" aria-current="page">ドライバー登録</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                管理メニュー
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="./user_list.php">ドライバーリスト</a></li>
                                <li><a class="dropdown-item" href="../question/question_submit.php">設問登録</a></li>
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
                                <i class="bi bi-person-fill"></i>&nbsp;
                                <?php echo "$name さん"; ?>
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
    <div class="container mt-5">
        <div class="card mb-3 mx-auto" style="max-width: 540px; background-color:rgb(243, 239, 238)">
            <div class="row g-0">
                <div class="col-md-4 text d-flex align-items-center justify-content-center">
                    <p>ドライバー登録<br>
                        <i class="bi bi-person-circle" style="font-size: 5rem;"></i>
                    </p>
                </div>
                <div class="col-md-8">
                    <form action="../function/driver_post.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <input class="form-control col-sm-1 mt-3" type="text" minlength="9" maxlength="9" name="e_number" placeholder="社員番号" required>
                                <input class="form-control col-sm-1 mt-3" type="text" name="l_name" placeholder="苗字（LastName）" required>
                                <input class="form-control col-sm-1 mt-3" type="text" name="f_name" placeholder="名前（FirstName）" required>
                                <input class="form-control col-sm-1 mt-3" type="email" name="email" placeholder="Email address" required>
                                <input class="form-control col-sm-1 mt-3" type="password" name="pass" placeholder="Password" required>
                                <button type="submit" class="btn btn-primary mt-3">登録</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>