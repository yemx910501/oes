-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-12-29 09:19:42
-- 服务器版本： 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oes`
--

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(10) NOT NULL,
  `menu_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `menu_url` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(10) NOT NULL,
  `father_menu_id` int(10) NOT NULL,
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_url`, `sort`, `father_menu_id`) VALUES
(1, '系统管理', '父菜单，无链接', 0, 0),
(2, '用户管理', 'app/pages/userPage.php', 1, 1),
(3, '角色管理', 'app/pages/rolePage.php', 2, 1),
(4, '菜单管理', 'app/pages/menuPage.php', 3, 1),
(5, '试卷管理', '父菜单，无链接', 4, 0),
(6, '试题管理', 'app/pages/questionPage.php', 5, 5),
(7, '试卷管理', 'app/pages/examPaperPage.php', 6, 5),
(8, '试卷批阅', 'app/pages/waitMarkPage.php', 7, 5),
(9, '题型管理', 'app/pages/questionTypePage.php', 8, 5),
(10, '课程管理', 'app/pages/coursePage.php', 9, 5);

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(10) NOT NULL,
  `role_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `role_desc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_desc`) VALUES
(1, '系统管理员', '在线考试系统的管理员'),
(2, '教师', ''),
(3, '学生', '');

-- --------------------------------------------------------

--
-- 表的结构 `role_menu_relation`
--

CREATE TABLE IF NOT EXISTS `role_menu_relation` (
  `role_id` int(10) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `role_menu_relation`
--

INSERT INTO `role_menu_relation` (`role_id`, `menu_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `gender` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`, `gender`) VALUES
('211006091', '叶明祥', '123456', 'M'),
('211006416', '郑伟捷', '123456', 'M');

-- --------------------------------------------------------

--
-- 表的结构 `user_role_relation`
--

CREATE TABLE IF NOT EXISTS `user_role_relation` (
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `user_role_relation`
--

INSERT INTO `user_role_relation` (`user_id`, `role_id`) VALUES
('211006091', 1),
('211006416', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
