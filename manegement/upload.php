<?php
  require 'funcs.php';
  $error = '';
  if (@$_POST['submit']) {
    $code = $_POST['code'];
    if (move_uploaded_file($_FILES['pic']['tmp_name'], "../images/$code.gif")) {
      header('Location: index.php');
      exit();
    } else {
      $error .= 'ファイルを選択してください。<br>';
    }
  } else {
    $code = $_GET['code'];
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>商品画像アップロード</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
  <h1>商品画像アップロード</h1>
  <div>
  <a href="index.php">一覧に戻る</a>　
  <a href="../client/index.php" target="_blank">サイト確認</a>
  </div>
</div>
<div class="base">
  <?php if ($error) echo "<span class=\"error\">$error</span>" ?>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <p>
      商品画像(GIFのみ)<br>
      <input type="file" name="pic">
    </p>
    <p>
      <input type="hidden" name="code" value="<?php echo $code ?>">
      <input type="submit" name="submit" value="追加">
    </p>
  </form>
</div>
</body>
</html>