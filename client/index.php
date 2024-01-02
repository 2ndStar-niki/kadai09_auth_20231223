<?php
  session_start();

  require 'funcs.php';
  loginCheck();
 
  $pdo = connect();
  $st = $pdo->query("SELECT * FROM goods");
  $goods = $st->fetchAll();

  $name = $_SESSION['name'];
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
<img src="../images/kongo.png" alt="KONGO">
  <div>
  <a href="parchaseds.php">購入履歴</a>
  <a href="bookmarks.php">お気に入り</a>
  <a href="logout.php">ログアウト</a>
  <p><?php echo $name ?>さん、ようこそ</p>
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
        for ($j = 0; $j <= 9; $j++) {
          echo "<option>$j</option>";
        }
        ?>
      </select>
      <input type="hidden" name="code" value="<?php echo $goods[$i]['code'] ?>">
      <?php
      // 数量が0の場合はボタンを無効化
      if ($goods[$i]['code'] == 0) {
        echo '<input type="submit" name="submit" value="カートへ" disabled>';
      } else {
        echo '<input type="submit" name="submit" value="カートへ">';
      }
      ?>
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
