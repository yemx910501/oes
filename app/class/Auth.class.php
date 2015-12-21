<?php
/************************************************************
*   				   登录类
************************************************************/
	require_once dirname(__FILE__).'/../common/commonFunc.php';
	
	class Auth
	{
		var $user_id;
		var $username;
		var $password;
		var $ok;
		var $salt = "34asdf34";
		var $domain = ".domain.com";
		
		function Auth()
		{
			global $db;
	 
			$this->user_id = 0;
			$this->username = "Guest";
			$this->ok = false;
			
			if(!$this->check_session()) $this->check_cookie();
			
			return $this->ok;
		}
		
		function check_session()
		{
			if(!empty($_SESSION['auth_username']) && !empty($_SESSION['auth_password']))
				return $this->check($_SESSION['auth_username'], $_SESSION['auth_password']);
			else
				return false;
		}
	 
		function check_cookie()
		{
			if(!empty($_COOKIE['auth_username']) && !empty($_COOKIE['auth_password']))
				return $this->check($_COOKIE['auth_username'], $_COOKIE['auth_password']);
			else
				return false;
		}
	 
		function check($username, $password)
		{
			$conn = createConn();
			$result = mysql_query("SELECT * FROM user WHERE user_name = '$username'");
			$count = mysql_num_rows($result);
			if($count==1)
			{
				$userIdResult = mysql_fetch_array($result);
				$db_password = $userIdResult['password'];
				if(md5($db_password . $this->salt) == $password)
				{
					$this->user_id = $userIdResult['user_id'];;
					$this->username = $username;
					$this->ok = true;
					return true;
				}
			}			
			return false;
		}
		
		/* 登录 */
		function login($username, $password)
		{
			$conn = createConn();
			$result = mysql_query("SELECT * FROM user WHERE user_name = '$username' AND password = '$password'");
			$count = mysql_num_rows($result);
			if($count==1)
			{
				$userIdResult = mysql_fetch_array($result);
				$this->user_id = $userIdResult['user_id'];
				$this->username = $username;
				$this->ok = true;
				
				$_SESSION['auth_username'] = $username;
				$_SESSION['auth_password'] = md5($password . $this->salt);
				setcookie("auth_username", $username, time()+60*60*24*30, "/", $this->domain);
				setcookie("auth_password", md5($password . $this->salt), time()+60*60*24*30, "/", $this->domain);
				
				mysql_close($conn);
				return true;
			}
			
			mysql_close($conn);
			return false;
		}
		
		/* 退出 */
		function logout()
		{
			$this->user_id = 0;
			$this->username = "Guest";
			$this->ok = false;
	 
			$_SESSION['auth_username'] = "";
			$_SESSION['auth_password'] = "";
	 
			setcookie("auth_username", "", time() - 3600, "/", $this->domain);
			setcookie("auth_password", "", time() - 3600, "/", $this->domain);
		}
		
	}
?>
