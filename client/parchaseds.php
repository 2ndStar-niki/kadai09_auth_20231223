<?php
  require 'funcs.php';
  $pdo = connect();
  $st = $pdo->query("SELECT * FROM parchaseds");
  $parchaseds = $st->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>購入履歴</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
<h1>購入履歴</h1>
  <div>
  <a href="index.php">お買い物に戻る</a>
  <a href="bookmarks.php">お気に入り</a>
  </div>
</div>

<table>
<?php
  $count = 0; // カウンターの初期化
  foreach ($parchaseds as $g) {
    if ($count % 2 == 0) {
      // 偶数回目の行の開始
      echo '<tr>';
    }
?>
  <td class="img">
      <?php echo img_tag($g['code']) ?>
    </td>
    <td>
      <p class="goods"><?php echo $g['name'] ?></p>
      <p><?php echo nl2br($g['comment']) ?></p>
    </td>
    <td width="80">
      <p><?php echo $g[''] ?> 個</p>
      <p><?php echo $g['price'] ?> 円</p>
    </td>
  <?php
    $count++;
    if ($count % 2 == 0) {
      // 偶数回目の行の終了
      echo '</tr>';
    }
  }
  
  // ループ終了後、奇数回目の場合の行を閉じる
  if ($count % 2 != 0) {
    echo '<td></td><td></td><td></td></tr>';
  }
?>
</table>
</body>
</html>