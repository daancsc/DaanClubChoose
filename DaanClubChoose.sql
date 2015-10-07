-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2015 年 10 月 07 日 11:14
-- 伺服器版本: 5.5.44-MariaDB-1ubuntu0.14.04.1
-- PHP 版本： 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `DaanClubChoose`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `account` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '排序規則為utf8_bin(分大小寫)',
  `password` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '排序規則為utf8_bin(分大小寫)',
  `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `choose`
--

CREATE TABLE IF NOT EXISTS `choose` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL COMMENT '即為student.id',
  `choose1` int(11) DEFAULT NULL,
  `choose2` int(11) DEFAULT NULL,
  `choose3` int(11) DEFAULT NULL,
  `choose4` int(11) DEFAULT NULL,
  `choose5` int(11) DEFAULT NULL,
  `choose6` int(11) DEFAULT NULL,
  `choose7` int(11) DEFAULT NULL,
  `choose8` int(11) DEFAULT NULL,
  `choose9` int(11) DEFAULT NULL,
  `choose10` int(11) DEFAULT NULL,
  `choose11` int(11) DEFAULT NULL,
  `choose12` int(11) DEFAULT NULL,
  `choose13` int(11) DEFAULT NULL,
  `choose14` int(11) DEFAULT NULL,
  `choose15` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `result` int(11) DEFAULT NULL COMMENT '選課結果(即為clubs.sn)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `clubs`
--

CREATE TABLE IF NOT EXISTS `clubs` (
  `id` int(11) NOT NULL,
  `sn` int(10) NOT NULL,
  `groupnum` int(11) NOT NULL COMMENT '要給合併同學一起選的課程號碼要一樣，其餘不可重複(無效)',
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '當開不只一班時,最後三個字元格式:(一)、(二)...',
  `teacher` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '授課教師',
  `place` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '上課地點',
  `place_rain` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '雨備地點',
  `max` int(11) NOT NULL COMMENT '名額限制',
  `stu_in` int(11) NOT NULL COMMENT '已錄取學生數'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) NOT NULL,
  `item` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastchanged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `commit` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '備註'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL,
  `account` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '排序規則為utf8_bin(分大小寫)',
  `password` text CHARACTER SET utf8 COLLATE utf8_bin COMMENT '排序規則為utf8_bin(分大小寫)',
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `seat` int(11) DEFAULT NULL,
  `chosen` int(1) NOT NULL COMMENT '是否已選課',
  `exclude` int(11) NOT NULL COMMENT '不能參加此課程(未添加功能)',
  `stage` int(10) NOT NULL COMMENT '第幾梯次上',
  `change2` int(10) DEFAULT NULL COMMENT '是否重選',
  `forced` int(10) NOT NULL COMMENT '強制'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `choose`
--
ALTER TABLE `choose`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sn` (`id`),
  ADD FULLTEXT KEY `id` (`account`);
ALTER TABLE `student`
  ADD FULLTEXT KEY `id_2` (`account`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `choose`
--
ALTER TABLE `choose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
