<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ドライバー安全レベルチェックログアウト</title>
</head>

<body>
    <?php
    session_start();
    $_SESSION = array();
    session_destroy();
    ?>
    ログアウトしました。<br><br>
    <a href="../login.html">再ログインはこちら。</a>
</body>

</html>