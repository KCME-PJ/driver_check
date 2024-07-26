<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>設問リスト</title>
    <!-- bootstrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- bootstrap5_icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- bootstrap5_datatables-css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.bootstrap5.min.css">
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
                                <li><a class="dropdown-item" href="../user/user_submit.php">ドライバー登録</a></li>
                                <li><a class="dropdown-item" href="../user/user_list.php">ドライバーリスト</a></li>
                                <li><a class="dropdown-item" href="../question/question_submit.php">設問登録</a></li>
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
                                <li><a class="dropdown-item" href="../user/logout_admin.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <b>
            <p style="font-family: Meiryo UI;">設問を修正する場合は <font color="green"><i class="bi bi-pencil-square"></i></font> ボタン、削除は <font color="red"><i class="bi bi-trash3-fill"></i></font> ボタン</p>
        </b>
        <a class="btn btn-outline-danger btn-sm" href="./question_submit.html">設問追加</a>
        <table id="questionList" class="table table-striped align-middle" style="font-family: Meiryo UI;">
            <thead>
                <tr>
                    <th scope="col">項番</th>
                    <th scope="col">回答</th>
                    <th scope="col">判定</th>
                    <th scope="col">設問</th>
                    <th scope="col">編集</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../db_access/database.php';
                $i = 0;
                $sql = <<<SQL
                    SELECT * FROM questions ORDER BY q_id ASC;
                    SQL;
                try {
                    $dbh = getDb();
                    $stmt = $dbh->query($sql);
                    foreach ($stmt as $row) {
                        $q_id = $row['q_id'];
                        $flag = $row['answer'];
                        $diag = $row['diagnosis'];
                        $question = $row['question'];
                        $flag_icon = "bi bi-circle";
                        $msg = $q_id . '番を削除しても大丈夫ですか？';
                        ++$i;
                        if ($flag == true) {
                            $flag_icon = "bi bi-circle";
                        } else {
                            $flag_icon = "bi bi-x-lg";
                        }
                        print <<<EOD
                                <tr>
                                    <th scope="row">$i</th>
                                    <td><i class="$flag_icon"></i></td>
                                    <td>$diag</td>
                                    <td>$question</td>
                                    <td>
                                        <a class="btn btn-outline-success btn-sm" href="question_edit-form.php?id=$q_id">
                                        <i class="bi bi-pencil-square"></i></a>
                                        <a class="btn btn-outline-danger btn-sm" href="question_delete.php?id=$q_id" onclick="return confirm('$msg')">
                                        <i class="bi bi-trash3-fill"></i></a>
                                    </td>
                                </tr>
                            EOD;
                    }
                } catch (PDOException $e) {
                    print "ERR! : {$e->getMessage()}";
                } finally {
                    $pdo = null;
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- bootstrap5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- jquery-1.12.4 -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <!-- bootstrap5_datatables-js -->
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap5.min.js"></script>
    <!-- datatables-日本語化js -->
    <script>
        $(function() {
            // datatableの設定を変更
            $("#questionList").DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Japanese.json"
                },
                // 件数切替の刻みを設定
                lengthMenu: [5, 10, 25, 50]
            });
        });
    </script>
</body>

</html>