-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-12-23 02:52:23
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `shop`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `goods`
--

CREATE TABLE `goods` (
  `code` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `price` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `goods`
--

INSERT INTO `goods` (`code`, `name`, `price`, `comment`) VALUES
(1, 'アンパンマン', 22000, '全てを暴力で解決する。'),
(2, 'カレーパンマン', 20000, '困った時はカレーを吹きかける。'),
(3, 'しょくぱんまん', 35000, '謎のイケメンキャラ。'),
(4, 'バイキンマン', 40000, '稀代の天才科学者。'),
(5, 'ドキンちゃん', 25000, '隠れメンヘラ系女子。'),
(6, 'かびるんるん', 5500, 'サイバイマンとキャラ被り。'),
(7, 'ロールパンナちゃん', 24000, '正義と悪を併せ持つ二重人格。'),
(8, 'メロンパンナちゃん', 32000, 'メロメロパンチが十八番。'),
(9, 'クリームパンダちゃん', 19000, 'パンではなくパンダちゃん。'),
(10, 'コキンちゃん', 13000, '空前絶後の泣き虫。'),
(11, 'あかちゃんまん', 77000, 'パンではなくあかちゃん。'),
(12, 'だだんだん', 50000, '適当に名付けられてそう。'),
(13, 'おむすびまん', 30000, '生粋の旅人。'),
(14, 'てんどんまん', 12000, 'うるさいイメージ。'),
(15, 'やきそばパンマン', 34000, '危ないヘラの使い手。'),
(16, 'めいけんチーズ', 8800, '言葉を理解できる犬。'),
(17, 'バタコさん', 20000, '年齢不詳。'),
(18, 'ジャムおじさん', 123000, 'メカも作れるパン職人。');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `goods`
--
ALTER TABLE `goods`
  ADD UNIQUE KEY `code` (`code`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `goods`
--
ALTER TABLE `goods`
  MODIFY `code` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
