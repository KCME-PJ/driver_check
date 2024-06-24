<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driving level check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <h3 class="text-center" style="background-color: rgb(149, 241, 203); font-family: Meiryo UI;">ドライバー安全レベルチェック</h3>
    <div class="container mt-3">
        <b>
            <p style="font-family: Meiryo UI;">次の質問を読んで、自分に当てはまれば「〇」当てはまらない場合は「×」を選択してください。<br>
                【注意】ブラウザの「戻る」ボタンを押すと質問と回答がリセットされます。 </p>
        </b>
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
                    $q_table = question_tbl();
                    echo $q_table;
                    ?>
                </tbody>
            </table>
            <input type="hidden" name="driver_id" value="5">
            <button type="submit" class="btn btn-outline-success mb-3">送信</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>