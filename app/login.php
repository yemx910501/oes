<?php
/************************************************************
*   					登录验证
************************************************************/
	require_once dirname(__FILE__).'/common/commonFunc.php';
	
	session_start();

	if (isset($_POST['username']) && isset($_POST['password'])
			&& $_POST['username'] != "" && $_POST['password'] != "") { // 用户名密码都不为空
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$conn = createConn(); // 创建数据库连接
		$result = mysql_query("SELECT * FROM USER WHERE USER_ID = '$username' AND PASSWORD = '$password'");
		$count = mysql_num_rows($result);
		if ($count==1) { // 登录成功
			$userIdResult = mysql_fetch_array($result);
			$_SESSION['auth_user_id'] = $username;
			$_SESSION['auth_username'] = $userIdResult['user_name'];
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
?>