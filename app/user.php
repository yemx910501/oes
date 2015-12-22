<?php
/************************************************************
*   				   用户操作
************************************************************/
	require_once dirname(__FILE__).'/common/commonFunc.php';

	$conn = createConn();
		
	function addUser($user) {
		$result = mysql_query("insert into user");
	}
	
?>