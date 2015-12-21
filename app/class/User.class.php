<?php
/************************************************************
*   				   用户类
************************************************************/
	require_once dirname(__FILE__).'/../common/commonFunc.php';

	Class User {
		private $userId;
		private $userName;
		private $password;
		private $gender;
		
		function addUser($user) {
			$conn = createConn();
			$result = mysql_query("insert into user");
		}
	}
?>