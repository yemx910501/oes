<?php
/************************************************************
*   				   Session封装类
************************************************************/
	class Session
	{
		function Session()
		{
			session_start();
		}
	 
		function set($name, $value)
		{
			$_SESSION[$name] = $value;
		}
	 
		function get($name)
		{
			if(isset($_SESSION[$name]))
				return $_SESSION[$name];
			else
				return false;
		}
	 
		function del($name)
		{
			unset($_SESSION[$name]);
		}
	 
		function destroy()
		{
			$_SESSION = array();
			session_destroy();
		}
	 
		function save_prefs()
		{
			global $db, $auth;
			$prefs = serialize($this->prefs);
			$db->query("UPDATE condra_users SET prefs = '$prefs' WHERE id = '{$auth->id}'");
		}
	}
?>