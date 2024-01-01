<?php
  require 'funcs.php';
  $rows = array();
  $sum = 0;
  $pdo = connect();
  if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
  if (@$_POST['submit']) {
    @$_SESSION['cart'][$_POST['code']] += $_POST['num'];
  }
  foreach($_SESSION['cart'] as $code => $num) {
    $st = $pdo->prepare("SELECT * FROM goods WHERE code=?");
    $st->execute(array($code));
    $row = $st->fetch();
    $st->closeCursor();
    $row['num'] = strip_tags($num);
    $sum += $num * $row['price'];
    $rows[] = $row;
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>カート</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
<h1>カート</h1>
  <div>
  <a href="index.php">お買い物に戻る</a>
  </div>
</div>
<table>
  <tr><th>商品名</th><th>単価</th><th>数量</th><th>小計</th></tr>
  <?php foreach($rows as $r) { ?>
    <tr>
      <td><?php echo $r['name'] ?></td>
      <td><?php echo $r['price'] ?></td>
      <td><?php echo $r['num'] ?></td>
      <td><?php echo $r['price'] * $r['num'] ?> 円</td>
    </tr>
  <?php } ?>
  <tr><td colspan='2'> </td><td><strong>合計</strong></td><td><?php echo $sum ?> 円</td></tr>
</table>
<div class="base">
  <a href="cart_empty.php">カートを空にする</a>　
  <a href="buy.php">購入する</a>
</div>
</body>
</html>