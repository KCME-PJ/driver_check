<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワードの再設定</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card mb-3 mx-auto" style="max-width: 680px; background-color:rgb(243, 239, 238)">
            <div class="row g-0">
                <div class="col-md-4 text d-flex align-items-center justify-content-center">

                    <i class="bi bi-person-circle" style="font-size: 5rem;"></i>

                </div>
                <div class="col-md-8">
                    <div class="card-header">
                        パスワードの再設定（再設定用コード発行後2時間以内有効）
                    </div>
                    <form action="./user/pw_update.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <label class="form-label">再設定用のコードが送信されました。</label>
                                <label class="form-label">メールアドレスおよびコードと新しいパスワードを入力して、Resetボタンを押してください。</label>
                                <label class="form-label">※メールが届いていない場合は、入力されたメールアドレスが間違えていないかご確認ください。</label>
                                <input class="form-control col-sm-1 mt-3" type="mail" name="mail" placeholder="Email" required>
                                <input class="form-control col-sm-1 mt-3" type="text" name="code" placeholder="Code" required>
                                <input class="form-control col-sm-1 mt-3" type="password" name="pass" placeholder="New Password" required>
                                <button type="submit" class="btn btn-primary mt-3 mb-3">Reset</button>
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