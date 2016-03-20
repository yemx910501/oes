<?php
/************************************************************
*   				    用户
************************************************************/
	require_once dirname(__FILE__).'/common/commonFunc.php';
	
	$op = $_GET['op']; // 操作类型
	if ($op!="batchDel") { // 非批量删除
		$userId = isset($_GET['userId'])?$_GET['userId']:""; // 用户Id
	} else { // 批量删除
		$ids = $_POST['ids']; // 多个用户Id
	}
	
	$conn = createConn(); // 创建数据库连接
	$statusCode = "200";
	$navTabId = "oa2";
	$message = $callbackType = $rel = $forwardUrl = $confirmMsg = "";
	
	switch ($op) {
		case "checkUserId":
			echo "true";
			break;
		case "addUser":
			addUser();
			$message = "新增用户成功";
			$callbackType = "closeCurrent";
			break;
		case "updateUserRoles":
			updateUserRoles($userId); // 修改用户拥有的角色
			$message = "修改用户成功";
			$callbackType = "closeCurrent";
			break;
		case "delete":
			deleteUserById($userId); // 根据userId删除用户
			$message = "删除用户成功";
			break;
		case "batchDel":
			$del_count = batchDelUser($ids); // 批量删除用户
			$message = "成功删除" . $del_count . "个用户。";
			break;
	}
	
	mysql_close($conn);
	
	include dirname(__FILE__).'/common/message.php';
	
	
	/**
	 * 新增用户
	 **/
	function addUser() {
		mysql_query("set character_set_connection=utf8");
		$userId = isset($_POST['userId'])?test_input($_POST['userId']):""; // 用户Id
		$userName = isset($_POST['userName'])?test_input($_POST['userName']):""; // 用户名
		$password = isset($_POST['password'])?test_input($_POST['password']):""; // 密码
		$gender = isset($_POST['gender'])?test_input($_POST['gender']):""; // 性别
		mysql_query("insert into user(user_id,user_name,password,gender) values ('$userId', '$userName', '$password', '$gender')");
		
		if (isset($_POST['roleList'])) {
			$roleList = $_POST['roleList']; // 角色
			foreach ($roleList as $roleId) {
				mysql_query("insert into user_role_relation(user_id, role_id) values('$userId', $roleId)"); // 添加新用户角色关系
			}
		}
		
		if (isset($_POST['courseList'])) {
			$courseList = $_POST['courseList']; // 课程
			foreach ($courseList as $codeValue) {
				mysql_query("insert into user_course_relation(user_id, course_code) values('$userId', '$codeValue')"); // 添加新用户课程关系			
			}
		}
	}
	
	/**
	 * 修改用户拥有的角色
	 * $userId 用户Id
	 **/
	function updateUserRoles($userId) {
		mysql_query("set character_set_connection=utf8");
		$userId = isset($_POST['userId'])?test_input($_POST['userId']):""; // 用户Id
		$userName = isset($_POST['userName'])?test_input($_POST['userName']):""; // 用户名
		$password = isset($_POST['password'])?test_input($_POST['password']):""; // 密码
		mysql_query("update user set user_id='" . $userId . "', user_name='" . $userName . "', password= '" . $password . "'  where user_id = " . $userId);
		mysql_query("delete from user_role_relation where user_id = " . $userId); // 先删除旧的用户角色关系
		mysql_query("delete from user_course_relation where user_id = " . $userId); // 先删除旧的用户课程关系
		
		if (isset($_POST['roleList'])) {
			$roleList = $_POST['roleList']; // 角色
			foreach ($roleList as $roleId) {
				mysql_query("insert into user_role_relation(user_id, role_id) values('$userId', $roleId)"); // 添加新用户角色关系
			}
		}
		
		if (isset($_POST['courseList'])) {
			$courseList = $_POST['courseList']; // 课程
			foreach ($courseList as $codeValue) {
				mysql_query("insert into user_course_relation(user_id, course_code) values('$userId', '$codeValue')"); // 添加新用户课程关系			
			}
		}
	}
	
	/**
	 * 根据userId删除用户
	 * $userId 用户Id
	 **/
	function deleteUserById($userId) {
		mysql_query("delete from user_role_relation where user_id = " . $userId); // 删除用户角色关系
		mysql_query("delete from user_course_relation where user_id = " . $userId); // 删除用户课程关系
		mysql_query("delete from user where user_id = " . $userId); // 删除用户
	}
	
	/**
	 * 批量删除用户
	 * $ids 用户Id数组
	 * return
	 **/
	function batchDelUser($ids) {
		$del_count = 0;
		foreach ($ids as $userId) {
			deleteUserById($userId); // 根据userId删除用户
			$del_count++;
		}
		return $del_count;
	}
?>