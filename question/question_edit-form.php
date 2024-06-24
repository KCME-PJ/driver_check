<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ドライバー安全レベルチェック ログイン</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <?php
    $q_id = filter_input(INPUT_GET, 'id');

    require_once '../db_access/database.php';
    $sql = <<<SQL
        SELECT * FROM questions WHERE q_id = ?
        SQL;
    $dbh = getDb();
    try {
        $sth = $dbh->prepare($sql);
        $sth->bindValue(1, $q_id, PDO::PARAM_INT);
        $sth->execute();
        foreach ($sth as $row) {
            $flag = $row['answer'];
            $diag = $row['diagnosis'];
            $que = $row['question'];
        }
    } catch (Exception $e) {
        print "ERR! : {$e->getMessage()}";
    } finally {
        $dbh = null;
    }
    ?>
</head>

<body>
    <div class="container mt-5">
        <div class="card mb-3 mx-auto" style="max-width: 700px;">
            <div class="row g-0">
                <div class="col-md-3 text d-flex align-items-center justify-content-center">
                    <p class="text-center">Question<br>
                        <i class="bi bi-question-diamond" style="font-size: 4rem;"></i><br>
                        Edit<br>
                        <button type="button" onclick="history.back()" class="btn btn-outline-danger mt-3">cancel</button>
                    </p>
                </div>
                <div class="col-md-8">
                    <form action="./question_edit-add.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btn_radio1" id="radio_id1" value="1" required autocomplete="off" <?php if ($flag == true) echo "checked" ?>>
                                    <label class="btn btn-outline-primary" for="radio_id1"><i class="bi bi-circle"></i></label>
                                    <input type="radio" class="btn-check" name="btn_radio1" id="radio_id2" value="0" autocomplete="off" <?php if ($flag == false) echo "checked" ?>>
                                    <label class="btn btn-outline-primary" for="radio_id2"><i class="bi bi-x-lg"></i></label>
                                </div>
                                <div class="btn-group mt-3" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btn_radio2" id="radio_id3" value="1" required autocomplete="off" <?php if ($diag == 1) echo "checked" ?>>
                                    <label class="btn btn-outline-primary" for="radio_id3"><i class="bi bi-1-square"></i></label>
                                    <input type="radio" class="btn-check" name="btn_radio2" id="radio_id4" value="2" autocomplete="off" <?php if ($diag == 2) echo "checked" ?>>
                                    <label class="btn btn-outline-primary" for="radio_id4"><i class="bi bi-2-square"></i></label>
                                    <input type="radio" class="btn-check" name="btn_radio2" id="radio_id5" value="3" autocomplete="off" <?php if ($diag == 3) echo "checked" ?>>
                                    <label class="btn btn-outline-primary" for="radio_id5"><i class="bi bi-3-square"></i></label>
                                    <input type="radio" class="btn-check" name="btn_radio2" id="radio_id6" value="4" autocomplete="off" <?php if ($diag == 4) echo "checked" ?>>
                                    <label class="btn btn-outline-primary" for="radio_id6"><i class="bi bi-4-square"></i></label>
                                    <input type="radio" class="btn-check" name="btn_radio2" id="radio_id7" value="5" autocomplete="off" <?php if ($diag == 5) echo "checked" ?>>
                                    <label class="btn btn-outline-primary" for="radio_id7"><i class="bi bi-5-square"></i></label>
                                </div>
                                <input type="text" class="form-control mt-3" name="question" value="<?php echo $que; ?>" required>
                                <input type="hidden" name="id" value="<?php echo $q_id; ?>">
                                <button type="submit" class="btn btn-primary mt-3">修正</button>

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