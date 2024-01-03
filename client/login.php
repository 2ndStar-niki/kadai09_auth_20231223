<?php
session_start();

// ログイン処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lid = $_POST['lid'];
    $lpw = $_POST['lpw'];
    
    // DB接続
    require_once('funcs.php');
    $pdo = db_conn();

    // データ登録SQL作成
    $stmt = $pdo->prepare('SELECT * FROM users WHERE lid = :lid;');
    $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
    $status = $stmt->execute();

    // SQL実行時にエラーがある場合STOP
    if($status === false) {
        sql_error($stmt);
    }

    // 抽出データ数を取得
    $val = $stmt->fetch();

    // if($val['id'] != '' && password_verify($lpw, $val['lpw'])){ //* PasswordがHash化の場合はこっちのIFを使う
    if($val['id'] != '') {
        //Login成功時 該当レコードがあればSESSIONに値を代入
        $_SESSION['chk_ssid'] = session_id();
        $_SESSION['name'] = $val['name'];
        header('Location: index.php');
        exit();
    } else {
        //Login失敗時(Logout経由)
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css" />
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
    <title>ログイン</title>
</head>

<body>

    <div class="header">
        <h1>ログイン</h1>
        <a href="signup.php">ユーザー登録</a>
    </div>

    <form name="form1" action="" method="post">
        ID:<input type="text" name="lid" />
        PW:<input type="password" name="lpw" />
        <input type="submit" value="ログイン" />
    </form>

</body>

</html>
