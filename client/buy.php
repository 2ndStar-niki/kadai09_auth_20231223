<?php
  require 'funcs.php';
  $error = $name = $address = $tel = '';
  if (@$_POST['submit']) {
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $tel = htmlspecialchars($_POST['tel']);
    if (!$name) $error .= 'お名前を入力してください。<br>';
    if (!$address) $error .= 'ご住所を入力してください。<br>';
    if (!$tel) $error .= '電話番号を入力してください。<br>';
    if (preg_match('/[^\d-]/', $tel)) $error .= '電話番号が正しくありません。<br>';
    if (!$error) {
      $pdo = connect();
      $body = "商品が購入されました。\n\n"
       . "お名前: $name\n"
       . "ご住所: $address\n"
       . "電話番号: $tel\n\n";
      foreach($_SESSION['cart'] as $code => $num) {
        $st = $pdo->prepare("SELECT * FROM goods WHERE code=?");
        $st->execute(array($code));
        $row = $st->fetch();
        $st->closeCursor();
        $body .= "商品名: {$row['name']}\n"
          . "単価: {$row['price']} 円\n"
          . "数量: $num\n\n";
      }
      // $from = "ocknsn@gmail.com";
      // $to = "ocknsn@gmail.com";
      // mb_send_mail($to, "購入メール", $body, "From: $from");
      $_SESSION['cart'] = null;
      require 'buy_complete.php';
      exit();
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>購入</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
<h1>購入</h1>
  <div>
  <a href="index.php">お買い物に戻る</a>
  <a href="cart.php">カートに戻る</a>
  </div>
</div>
<div class="base">
  <?php if ($error) echo "<span class=\"error\">$error</span>" ?>
  <form action="buy.php" method="post">
    <p>
      お名前<br>
      <input type="text" name="name" value="<?php echo $name ?>">
    </p>
    <p>
      ご住所<br>
      <input type="text" name="address" size="60" value="<?php echo $address ?>">
    </p>
    <p>
      電話番号<br>
      <input type="text" name="tel" value="<?php echo $tel ?>">
    </p>
    <p>
      <input type="submit" name="submit" value="購入">
    </p>
  </form>
</div>
</body>
</html>