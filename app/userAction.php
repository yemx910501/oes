<?php
/************************************************************
*   				    用户
************************************************************/
	require_once dirname(__FILE__).'/common/commonFunc.php';
	
	$op = $_GET['op']; // 操作类型
	if ($op!="batchDel") { // 非批量删除
		$userId = $_GET['userId']; // 用户Id
	} else { // 批量删除
		$ids = $_POST['ids']; // 多个用户Id
	}
	
	$conn = createConn(); // 创建数据库连接
	$statusCode = "200";
	$navTabId = "oa2";
	$message = $callbackType = $rel = $forwardUrl = $confirmMsg = "";
	
	switch ($op) {
		case "updateUserRoles":
			$roleList = $_POST['roleList']; // 角色
			updateUserRoles($userId, $roleList); // 修改用户拥有的角色
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
	 * 修改用户拥有的角色
	 * $userId 用户Id
	 * $roleList 角色
	 **/
	function updateUserRoles($userId, $roleList) {
		mysql_query("set character_set_connection=utf8");
		mysql_query("delete from user_role_relation where user_id = " . $userId); // 先删除旧的用户角色关系
		foreach ($roleList as $roleId) {
			mysql_query("insert into user_role_relation(user_id, role_id) values('$userId', $roleId)"); // 添加新的用户角色关系
		}
	}
	
	/**
	 * 根据userId删除用户
	 * $userId 用户Id
	 **/
	function deleteUserById($userId) {
		mysql_query("delete from user where user_id = " . $userId); // 删除用户
		mysql_query("delete from user_role_relation where user_id = " . $userId); // 删除用户角色关系
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