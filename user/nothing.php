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
    require_once '../classes/user_status.php';
    require_once '../classes/user_status_mapper.php';

    $email = $_SESSION['join'];
    $login_user = session_user($email);
    $auth = $login_user[3];
    if ($auth == 0) {
        header('Location: ../user/auth_ng.html');
    }
    $name = $login_user[0] . " " . $login_user[1];
    $pdo = getDb();
    $Mapper = new UserStatusMapper($pdo);
    $d_id = filter_input(INPUT_GET, 'd_id');
    $d_status = $Mapper->findById($d_id);
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
    <div class="container">
        <form class="row g-3 mt-3" action="../function/update_post.php" method="post">
            <div class="col-xl-2">
                <label for="employee" class="form-label">社員番号</label>
                <input type="text" minlength="9" maxlength="9" class="form-control" id="employee" name="employee" value="<?php echo $d_status->getEmployeeNumber(); ?>" style="text-align:center" required>
            </div>
            <div class="col-xl-2">
                <label for="driver_id" class="form-label">運転者ID</label>
                <input type="text" minlength="3" maxlength="8" class="form-control" id="driver_id" name="driver_id" value="<?php echo $d_status->getDriverId(); ?>" style="text-align:right">
            </div>
            <div class="col-xl-2">
                <label for="lname" class="form-label">姓（LastName）</label>
                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $d_status->getLname(); ?>" required>
            </div>
            <div class="col-xl-2">
                <label for="fname" class="form-label">名（FirstName）</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $d_status->getFname(); ?>" required>
            </div>
            <div class="col-xl-1">
                <label for="auth" class="form-label">アクセス権</label>
                <input type="number" class="form-control" id="auth" name="auth" value="<?php echo $d_status->getAccessLevel(); ?>" style="text-align:center" required>
            </div>
            <div class=" col-xl-3">
                <label for="address" class="form-label">MailAddress</label>
                <input type="email" class="form-control" id="address" name="address" value="<?php echo $d_status->getEmail(); ?>" required>
            </div>
            <div>
                <input type="hidden" class="form-control" name="d_id" value="<?php echo $d_status->getId(); ?>">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-outline-primary">ドライバー情報修正</button>
                <button type="button" onclick="history.back()" class="btn btn-outline-warning">戻る</button>
                ※アクセス権：[0]user、[1]admin
            </div>
        </form>
    </div>
    <div class="text-center mt-5">
        テスト履歴がありません。
    </div>

    <!-- bootstrap-script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>