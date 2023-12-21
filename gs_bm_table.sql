-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 12 月 21 日 15:47
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db231216`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `title` varchar(64) NOT NULL,
  `publisher` varchar(64) NOT NULL,
  `link` text NOT NULL,
  `imgLink` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `title`, `publisher`, `link`, `imgLink`, `date`) VALUES
(16, 'ねこ 121号', 'ネコ・パブリッシング', 'https://play.google.com/store/books/details?id=M39YEAAAQBAJ&source=gbs_api', 'http://books.google.com/books/content?id=M39YEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-17 16:53:33'),
(18, 'ＮＨＫ まる得マガジン おうちでカフェ風　“映える”いちごレシピ2021年3月／4月', 'ＮＨＫ出版', 'http://books.google.co.jp/books?id=OXIfEAAAQBAJ&dq=%E3%81%84%E3%81%A1%E3%81%94&hl=&source=gbs_api', 'http://books.google.com/books/content?id=OXIfEAAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-12-17 16:57:00'),
(27, 'A Japanese Grammar', 'Brill Archive', 'http://books.google.co.jp/books?id=ncUeAAAAIAAJ&dq=a&hl=&source=gbs_api', 'http://books.google.com/books/content?id=ncUeAAAAIAAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-17 20:23:35'),
(53, 'Masterpieces of the J. Paul Getty Museum: Photographs', 'Getty Publications', 'http://books.google.co.jp/books?id=DI0XAgAAQBAJ&dq=j&hl=&source=gbs_api', 'http://books.google.com/books/content?id=DI0XAgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-21 09:02:33'),
(57, '成功者Ｋ', '羽田圭介', 'https://play.google.com/store/books/details?id=alhqEAAAQBAJ&source=gbs_api', 'http://books.google.com/books/content?id=alhqEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-21 09:37:20'),
(58, 'るるぶＫ-ＰＯＰ×韓国語', '著者（不明）', 'http://books.google.co.jp/books?id=L92LDwAAQBAJ&dq=k&hl=&source=gbs_api', 'http://books.google.com/books/content?id=L92LDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-21 09:37:20'),
(59, 'A Winter\'s Dream', 'Sophie Claire', 'https://play.google.com/store/books/details?id=0xXQDwAAQBAJ&source=gbs_api', 'http://books.google.com/books/content?id=0xXQDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-21 19:34:15'),
(60, 'Winter\'s Crossing - James Galway & Phil Coulter Songbook', 'James Galway,Phil Coulter', 'https://play.google.com/store/books/details?id=iSoLAQAAQBAJ&source=gbs_api', 'http://books.google.com/books/content?id=iSoLAQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-21 19:34:15'),
(62, 'SPRiNG　2022年2月号', 'SPRiNG編集部', 'http://books.google.co.jp/books?id=zbRVEAAAQBAJ&dq=spring&hl=&source=gbs_api', 'http://books.google.com/books/content?id=zbRVEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-21 19:41:13'),
(63, '東京とんかつ会議', '山本益博,マッキー牧元,河田剛', 'http://books.google.co.jp/books?id=zuQ_DwAAQBAJ&dq=%E3%81%A8%E3%82%93%E3%81%8B%E3%81%A4&hl=&source=gbs_api', 'http://books.google.com/books/content?id=zuQ_DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-21 23:37:20'),
(64, 'Sea Monsters Chapter 2', 'Eef Monsterboards', 'http://books.google.co.jp/books?id=Rhj9AgAAQBAJ&dq=sea&hl=&source=gbs_api', 'http://books.google.com/books/content?id=Rhj9AgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-21 23:43:47'),
(65, 'Beach Read', 'Emily Henry', 'https://play.google.com/store/books/details?id=lxGuDwAAQBAJ&source=gbs_api', 'http://books.google.com/books/content?id=lxGuDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-21 23:44:16'),
(66, 'Island Geographies', 'Elaine Stratford', 'https://play.google.com/store/books/details?id=6V1uDQAAQBAJ&source=gbs_api', 'http://books.google.com/books/content?id=6V1uDQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-21 23:45:05'),
(67, 'The Secret of the Island', 'Jules Verne', 'https://play.google.com/store/books/details?id=zdJ4DwAAQBAJ&source=gbs_api', 'http://books.google.com/books/content?id=zdJ4DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-21 23:45:05'),
(68, 'Island Sustainability II', 'S. Favro,C. A. Brebbia', 'http://books.google.co.jp/books?id=ZxM9il-b2GYC&dq=island&hl=&source=gbs_api', 'http://books.google.com/books/content?id=ZxM9il-b2GYC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-12-21 23:45:05');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
