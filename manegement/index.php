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
<title>商品一覧</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
  <h1>商品一覧</h1>
  <div>
  <a href="insert.php">商品追加</a>　
  <a href="../client/index.php" target="_blank">サイト確認</a>
  </div>
</div>
<table>
<?php
  $count = 0; // カウンターの初期化
  foreach ($goods as $g) {
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
      <p><?php echo $g['price'] ?> 円</p>
      <p><a href="edit.php?code=<?php echo $g['code'] ?>">修正</a></p>
      <p><a href="upload.php?code=<?php echo $g['code'] ?>">画像</a></p>
      <p><a href="delete.php?code=<?php echo $g['code'] ?>" onclick="return confirm('削除してよろしいですか？')">削除</a></p>
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