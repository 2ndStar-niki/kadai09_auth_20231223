<?php
  function connect() {
    return new PDO("mysql:dbname=kadai08_db2_20231216", "root");
  }

  function img_tag($code) {
    $imagePath = "../images/$code.gif";
    
    if (file_exists($imagePath)) {
        $name = $code;
    } else {
        $name = 'noimage';
        $imagePath = "../images/$name.jpg";
    }
    
    return '<img src="' . $imagePath . '" alt="' . $name . '" width="200px">';
}


?>