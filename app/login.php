<?php
/************************************************************
*   					登录验证
************************************************************/
	session_start();
	require_once dirname(__FILE__).'/class/Auth.class.php';  // 先把类包含进来，实际路径根据实际情况进行修改。
	
	$_auth = new Auth();  // 实例化一个对象
	$username = $_POST['username'];
	$password = $_POST['password'];
	if ($_auth->login($username, $password)) { // 登录成功
		echo "success";
	} else { // 登陆失败
		echo "fail";
	}
?>