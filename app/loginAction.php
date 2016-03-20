<?php
/************************************************************
*   					登陆/注销
************************************************************/
	require_once dirname(__FILE__).'/common/commonFunc.php';
	
	session_start();
	$op = $_GET['op']; // 操作类型
	if ($op == "login") { // 登陆
		login();
	} else if ($op == "logout"){ // 注销
		logout();
	}
	
	/**
	 * 登陆
	 **/
	function login() {
		if (isset($_POST['username']) && isset($_POST['password'])
			&& $_POST['username'] != "" && $_POST['password'] != "") { // 用户名密码都不为空
			$userName = $_POST['username'];
			$password = $_POST['password'];
			
			$conn = createConn(); // 创建数据库连接
			$result = mysql_query("select * from user where user_id = '$userName' and password = '$password'");
			$count = mysql_num_rows($result);
			if ($count==1) { // 登录成功
				$userIdResult = mysql_fetch_array($result);
				$_SESSION['userId'] = $userName;
				$_SESSION['userName'] = $userIdResult['user_name'];
				echo "<script language='javascript'>";
				echo "window.location.href='../main.php';";
				echo "</script>";
			} else { // 登陆失败
				echo "<script language='javascript'>";
				echo "alert('用户名或密码错误！');";
				echo "window.location.href='../index.php';";
				echo "</script>";
			}
			mysql_close($conn);
		} else { // 用户名或密码为空
			echo "<script language='javascript'>";
			echo "alert('用户名、密码不能为空！');";
			echo "window.location.href='../index.php';";
			echo "</script>";
		}
	}
	
	/**
	 * 注销
	 **/
	function logout() {
		unset($_SESSION['userId']); // 删除用户名会话变量
		unset($_SESSION['userName']); // 删除用户名会话变量
		session_destroy(); // 删除当前所有的会话变量
		header("location:../index.php");
	}
?>