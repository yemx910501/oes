<?php
/************************************************************
*   					共用函数
************************************************************/
	/*
		创建数据库（mysql）连接
	*/ 
	function createConn() {
		$conn = mysql_connect("localhost", "root", "");
		if (!$conn) {
			die("Could not connect:" . mysql_errno());
		}
		mysql_query("set names ’utf8’ ");
		mysql_query("set character_set_client=utf8");
		mysql_query("set character_set_results=utf8");
		mysql_select_db("oes", $conn);
		return $conn;
	}
	
	/* 处理用户输入的数据 */
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data); // 去掉反斜杠
		$data = htmlspecialchars($data); // 把一些预定义的字符转换为 HTML 实体
		return $data;
	}
?>