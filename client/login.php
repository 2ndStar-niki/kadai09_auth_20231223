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
    </div>
    <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
    <form name="form1" action="login_act.php" method="post">
        ID:<input type="text" name="lid" />
        PW:<input type="password" name="lpw" />
        <input type="submit" value="LOGIN" />
    </form>


</body>

</html>