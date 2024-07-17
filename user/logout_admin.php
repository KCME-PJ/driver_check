<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面ログアウト</title>
</head>

<body>
    <?php
    session_start();
    $_SESSION = array();
    session_destroy();
    ?>
    ログアウトしました。<br><br>
    <a href="./admin.html">再ログインはこちら。</a>
</body>

</html>