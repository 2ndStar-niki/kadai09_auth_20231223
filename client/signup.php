<?php
session_start();

// ログイン済みの場合、マイページへリダイレクト
if (isset($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}

// データベース接続
require_once('funcs.php');
$pdo = db_conn();

// エラーメッセージの初期化
$errors = array();

// フォームから値が入力された場合
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // フォームの入力値を代入
    $name = $_POST['name'];
    $lid = $_POST['lid'];
    $lpw = $_POST['lpw'];

    /* バリデーション */
    // ユーザー名の重複確認
    $sql = 'SELECT COUNT(*) FROM users WHERE name = :name';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['COUNT(*)'] == 1) {
        $errors['name'] = '※このユーザー名は既に使用されています';
    }

    // バリデーションクリア（エラーメッセージなし）の場合
    if (empty($errors)) {
        // パスワードのハッシュ化
        $hashed_password = password_hash($lpw, PASSWORD_DEFAULT);

        // ユーザー登録処理
        $sql = 'INSERT INTO users (name, lid, lpw) VALUES (:name, :lid, :lpw)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
        $stmt->bindValue(':lpw', $hashed_password, PDO::PARAM_STR);
        $stmt->execute();

        // 登録後にログイン処理
        $_SESSION['chk_ssid'] = session_id();
        $_SESSION['name'] = $name;
        header('Location: index.php');
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
    <title>ユーザー登録</title>
</head>

<body>

    <div class="header">
        <h1>ユーザー登録</h1>
        <a href="login.php">ログイン</a>
    </div>

    <form name="form1" action="" method="post">
        ユーザー名:<input type="text" name="name" />
        <?php if(isset($errors['name'])) echo $errors['name']; ?>
        ID:<input type="text" name="lid" />
        PW:<input type="password" name="lpw" />
        <input type="submit" value="ユーザー登録" />
    </form>

</body>

</html>
