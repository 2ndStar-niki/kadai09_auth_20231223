<?php
  session_start();

  function connect() {
    return new PDO("mysql:dbname=kadai08_db2_20231216", "root");
  }

function img_tag($code) {
    $filename = "../images/$code.gif";
    // echo "Debug: $code - $filename<br>";  // Debugging output
  
    if (file_exists($filename)) {
      return '<img src="' . $filename . '" alt="" width="200px">';
    } else {
    // ファイルが存在しない場合は、デフォルトの画像を使用する。
      return '<img src="../images/noimage.jpg" alt="" width="200px">';
    }
  }
  
  
?>

