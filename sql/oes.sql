-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-03-20 16:34:11
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
-- 表的结构 `base_code_def`
--

CREATE TABLE IF NOT EXISTS `base_code_def` (
  `base_code_id` int(11) NOT NULL AUTO_INCREMENT,
  `father_base_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code_value` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_value` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`base_code_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `base_code_def`
--

INSERT INTO `base_code_def` (`base_code_id`, `father_base_code`, `code_value`, `display_value`) VALUES
(3, '0', 'course', '课程'),
(6, 'course', 'chinese', '语文'),
(7, 'course', 'math', '数学'),
(8, 'course', 'english', '英语');

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `menu_url` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(10) NOT NULL,
  `father_menu_id` int(10) NOT NULL,
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_url`, `sort`, `father_menu_id`) VALUES
(1, '系统管理', '父菜单，无链接', 0, 0),
(2, '用户管理', 'app/pages/userPage.php', 1, 1),
(3, '角色管理', 'app/pages/rolePage.php', 2, 1),
(4, '菜单管理', 'app/pages/menuPage.php', 3, 1),
(5, '考试管理', '父菜单，无链接', 4, 0),
(6, '试题管理', 'app/pages/questionPage.php', 5, 5),
(7, '试卷管理', 'app/pages/examPaperPage.php', 6, 5),
(8, '试卷批阅', 'app/pages/waitMarkPage.php', 7, 5),
(9, '题型管理', 'app/pages/questionTypePage.php', 8, 5),
(10, '基础数据', '父菜单，无链接', 9, 0),
(11, '数据字典', 'app/pages/baseCodeDefPage.php', 10, 10),
(14, '安全中心', '父菜单，无链接', 11, 0),
(15, '个人信息', 'app/pages/messagePage.php', 12, 14),
(16, '修改密码', 'app/pages/passwordEditPage.php', 13, 14);

-- --------------------------------------------------------

--
-- 表的结构 `objective_answer`
--

CREATE TABLE IF NOT EXISTS `objective_answer` (
  `objective_answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `objective_answer` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `check_flag` int(11) NOT NULL,
  PRIMARY KEY (`objective_answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `course_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '外键',
  `question_type_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '外键',
  `degree` int(11) NOT NULL COMMENT '0：简单  1：困难',
  `question_content` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `score` float NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `question`
--

INSERT INTO `question` (`question_id`, `course_code`, `question_type_code`, `degree`, `question_content`, `score`) VALUES
(2, 'math', 'J', 0, '1+1=?', 10);

-- --------------------------------------------------------

--
-- 表的结构 `question_type`
--

CREATE TABLE IF NOT EXISTS `question_type` (
  `question_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_type_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `question_type_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `question_type_flag` int(1) NOT NULL,
  PRIMARY KEY (`question_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `question_type`
--

INSERT INTO `question_type` (`question_type_id`, `question_type_code`, `question_type_name`, `question_type_flag`) VALUES
(2, 'X', '单选题', 0),
(3, 'D', '多选题', 0),
(4, 'P', '判断题', 0),
(5, 'T', '填空题', 1),
(6, 'J', '简答题', 1);

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `role_desc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_desc`) VALUES
(1, '系统管理员', '在线考试系统的管理员'),
(2, '教师', '教师'),
(3, '学生', '学生');

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
(1, 10),
(1, 11),
(1, 14),
(1, 15),
(1, 16),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 14),
(2, 15),
(2, 16),
(3, 14),
(3, 15),
(3, 16);

-- --------------------------------------------------------

--
-- 表的结构 `subjective_answer`
--

CREATE TABLE IF NOT EXISTS `subjective_answer` (
  `subjective_answer _id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `subjective_answer` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`subjective_answer _id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `subjective_answer`
--

INSERT INTO `subjective_answer` (`subjective_answer _id`, `question_id`, `subjective_answer`) VALUES
(1, 2, '2');

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
('211006416', '郑伟捷', '123456', 'M'),
('211006417', '周星驰', '123456', 'M'),
('211006418', '周杰伦', '123456', 'M'),
('211006419', '周润发', '123456', 'M'),
('211006420', '周笔畅', '123456', 'F');

-- --------------------------------------------------------

--
-- 表的结构 `user_course_relation`
--

CREATE TABLE IF NOT EXISTS `user_course_relation` (
  `user_id` int(11) NOT NULL,
  `course_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`course_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `user_course_relation`
--

INSERT INTO `user_course_relation` (`user_id`, `course_code`) VALUES
(211006091, 'chinese'),
(211006091, 'english'),
(211006091, 'math'),
(211006416, 'chinese'),
(211006416, 'english'),
(211006416, 'math'),
(211006417, 'chinese'),
(211006418, 'math'),
(211006419, 'english'),
(211006420, 'chinese'),
(211006420, 'english'),
(211006420, 'math');

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
('211006091', 2),
('211006091', 3),
('211006416', 2),
('211006417', 3),
('211006418', 3),
('211006419', 3),
('211006420', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
