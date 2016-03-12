<?php
/************************************************************
*   				    角色
************************************************************/
	require_once dirname(__FILE__).'/common/commonFunc.php';
	
	$conn = createConn(); // 创建数据库连接
	$op = $_GET['op']; // 操作类型
	$roleId = isset($_GET['roleId'])?$_GET['roleId']:"";
	switch ($op) {
		case "checkRole":
			checkRole($roleId);
			break;
		case "updateRole":
			updateRole($roleId);
			$statusCode = "200";
			$message = "修改角色成功";
			$callbackType = "closeCurrent";
			$navTabId = "oa3";
			$rel = $forwardUrl = $confirmMsg = "";
			break;
	}
	mysql_close($conn);
	include dirname(__FILE__).'/common/message.php';
	
	/**
	 *检验角色名是否已存在
	 **/
	function checkRole($roleId) {
		$roleName = isset($_GET['roleName'])?test_input($_GET['roleName']):"";
		$rs = mysql_query("select count(*) from role where role_name='" . $roleName . "' and role_id != '" . $roleId . "'");
		if (mysql_num_rows($rs)==0) {
			echo "true";
		} else {
			echo "false";
		}
	}
	
	/**
	 * 修改角色
	 **/
	function updateRole($roleId) {
		$roleName = isset($_POST['roleName'])?test_input($_POST['roleName']):""; // 角色名称
		$roleDesc = isset($_POST['roleDesc'])?test_input($_POST['roleDesc']):""; // 角色描述
		$menuList = isset($_POST['menuList'])?$_POST['menuList']:""; // 角色拥有的菜单
		if ($menuList!="") {
			if ($roleName!="" && $roleDesc!="") {
				mysql_query("set character_set_connection=utf8");
				mysql_query("update role set role_name='" . $roleName . "',role_desc='" . $roleDesc . "' where role_id = " . $roleId);
			}
			
			mysql_query("delete from role_menu_relation where role_id = " . $roleId);
			foreach ($menuList as $menuId) {
				mysql_query("insert into role_menu_relation(role_id, menu_id) values(" . $roleId . "," . $menuId . ")");
			}
		}
	}
?>