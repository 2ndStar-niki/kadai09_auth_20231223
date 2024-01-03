<?php
  require 'funcs.php';
  $pdo = connect();
  $st = $pdo->query("SELECT * FROM goods");
  $goods = $st->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>KONGO</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
  <h1>お気に入り</h1>
  <div>
  <a href="index.php">お買い物に戻る</a>
  <a href="parchaseds.php">購入履歴</a>
  </div>
</div>

<?php
for ($i = 0; $i < count($goods); $i++) {
  // 5項目ごとに新しい行を開く
  if ($i % 5 == 0) {
    echo '<div class="clearfix">';
  }
  ?>
  <div class="content">
    <?php echo img_tag($goods[$i]['code']) ?>
    <p class="goods"><?php echo $goods[$i]['name'] ?></p>
    <p><?php echo nl2br($goods[$i]['comment']) ?></p>
    <p><?php echo $goods[$i]['price'] ?> 円</p>
    <form action="cart.php" method="post">
      <select name="num">
        <?php
        for ($j = 0; $j <= 9999; $j++) {
          echo "<option>$j</option>";
        }
        ?>
      </select>
      <input type="hidden" name="code" value="<?php echo $goods[$i]['code'] ?>">
      <input type="submit" name="submit" value="カートへ">
      <img src="../images/bookmark_no.jpeg" alt="ブックマーク未" height="24px" class="bookmark-btn" data-code="<?php echo $goods[$i]['code']; ?>">
    </form>
  </div>
  <?php
  // 5項目ごとに行を閉じる
  if (($i + 1) % 5 == 0 || $i == count($goods) - 1) {
    echo '</div>';
  }
}
?>
</body>
</html>
