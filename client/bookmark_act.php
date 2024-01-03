// bookmark.php

session_start();
require 'funcs.php';
$pdo = connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_SESSION['name'];
    $goodsCode = $_POST['goods_code'];
    $isBookmarked = $_POST['is_bookmarked'];

    if ($isBookmarked == 'true') {
        // Insert into bookmarks
        $stmt = $pdo->prepare("INSERT INTO bookmarks (user_id, goods_code) VALUES ((SELECT id FROM users WHERE name = ?), ?)");
        $stmt->execute([$user, $goodsCode]);
    } else {
        // Delete from bookmarks
        $stmt = $pdo->prepare("DELETE FROM bookmarks WHERE user_id = (SELECT id FROM users WHERE name = ?) AND goods_code = ?");
        $stmt->execute([$user, $goodsCode]);
    }
}
