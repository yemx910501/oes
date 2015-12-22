-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2015 年 12 月 12 日 08:10
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `oes`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `menu`
-- 

CREATE TABLE `menu` (
  `menu_id` int(10) NOT NULL,
  `menu_name` varchar(20) default NULL,
  `menu_url` varchar(50) default NULL,
  `sort` int(10) default NULL,
  `father_menu_id` int(10) default NULL,
  PRIMARY KEY  (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

-- 
-- 导出表中的数据 `menu`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `role`
-- 

CREATE TABLE `role` (
  `role_id` int(10) NOT NULL,
  `role_name` varchar(20) default NULL,
  `role_desc` varchar(50) default NULL,
  PRIMARY KEY  (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

-- 
-- 导出表中的数据 `role`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `role_menu_relation`
-- 

CREATE TABLE `role_menu_relation` (
  `role_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  PRIMARY KEY  (`role_id`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

-- 
-- 导出表中的数据 `role_menu_relation`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `user`
-- 

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `gender` varchar(10) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

-- 
-- 导出表中的数据 `user`
-- 

