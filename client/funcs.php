<?php
  if(session_status() === PHP_SESSION_NONE) {
    // セッションがまだ開始されていない場合のみ開始
    session_start();
  }
  
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

function db_conn()
  {
    try {
      $db_name = 'kadai08_db2_20231216';    //データベース名
      $db_id   = 'root';      //アカウント名
      $db_pw   = '';      //パスワード：XAMPPはパスワード無しに修正してください。
      $db_host = 'localhost'; //DBホスト
      $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
      return $pdo;
    } catch (PDOException $e) {
      exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
    header('Location: ' . $file_name);
    exit();
}

function loginCheck() {
    if (!isset($_SESSION['chk_ssid'])  ||  $_SESSION['chk_ssid']  !==  session_id()) {
        exit('LOGIN ERROR');
    } else {
        // ログイン済み処理
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}