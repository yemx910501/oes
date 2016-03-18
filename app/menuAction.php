<?php
/************************************************************
*   				    菜单
************************************************************/
	require_once dirname(__FILE__).'/common/commonFunc.php';
	
	$conn = createConn(); // 创建数据库连接
	$op = $_GET['op']; // 操作类型
	if ($op != "batchDel") { // 非批量删除
		$menuId = isset($_GET['menuId'])?$_GET['menuId']:""; // 菜单Id
	} else { // 批量删除
		$ids = $_POST['ids']; // 多个菜单Id
	}
	switch ($op) {
		case "checkMenu":
			echo "true";
			// checkMenu($menuId);
			break;
		case "addMenu":
			addMenu($menuId);
			$statusCode = "200";
			$message = "添加菜单成功";
			$navTabId = "oa4";
			$callbackType = "closeCurrent";
			$rel = $forwardUrl = $confirmMsg = "";
			break;
		case "updateMenu":
			updateMenu($menuId);
			$statusCode = "200";
			$message = "修改菜单成功";
			$callbackType = "closeCurrent";
			$navTabId = "oa4";
			$rel = $forwardUrl = $confirmMsg = "";
			break;
		case "delMenu":
			deleteMenuById($menuId); // 根据menuId删除用户
			$statusCode = "200";
			$message = "删除菜单成功";
			$navTabId = "oa4";
			$callbackType = $rel = $forwardUrl = $confirmMsg = "";
			break;
		case "batchDel":
			$del_count = batchDelMenu($ids); // 批量删除用户
			$statusCode = "200";
			$message = "成功删除了" . $del_count . "个菜单。";
			$navTabId = "oa4";
			$rel = $forwardUrl = $confirmMsg = "";
			break;
	}
	mysql_close($conn);
	include dirname(__FILE__).'/common/message.php';
	
	/**
	 * 检验菜单名是否已存在
	 **/
	function checkMenu($menuId) {
		$menuName = isset($_GET['menuName'])?test_input($_GET['menuName']):"";
		if ($menuId != "") {
			$rs = mysql_query("select count(*) from menu where menu_name = '" . $menuName . "' and menu_id != '" . $menuId . "'");
		} else {
			$rs = mysql_query("select count(*) from menu where menu_name = '" . $menuName . "'");
		}
		
		if (mysql_num_rows($rs) == 0) {
			echo "true";
		} else {
			echo "false";
		}
	}
	
	/**
	 * 添加菜单
	 **/
	function addMenu($menuId) {
		mysql_query("set character_set_connection=utf8");
		$fatherMenuId = isset($_POST['fatherMenu'])?test_input($_POST['fatherMenu']):""; // 父菜单ID
		$menuName = isset($_POST['menuName'])?test_input($_POST['menuName']):""; // 菜单名称
		$menuUrl = isset($_POST['menuUrl'])?test_input($_POST['menuUrl']):""; // 菜单路径
		$sort_rs = mysql_query("select max(sort) as sort from menu");
		$sort = mysql_fetch_assoc($sort_rs);
		mysql_query("insert into menu(menu_name,menu_url,sort,father_menu_id) values('" . $menuName . "','" . $menuUrl . "'," . ($sort['sort']+1) . "," . $fatherMenuId . ")");
	}
	
	/**
	 * 修改菜单
	 **/
	function updateMenu($menuId) {
		mysql_query("set character_set_connection=utf8");
		$fatherMenuId = isset($_POST['fatherMenu'])?test_input($_POST['fatherMenu']):""; // 父菜单Id
		$menuName = isset($_POST['menuName'])?test_input($_POST['menuName']):""; // 菜单名称
		$menuUrl = isset($_POST['menuUrl'])?test_input($_POST['menuUrl']):""; // 菜单路径
		mysql_query("update menu set menu_name='" . $menuName . "', menu_url='" . $menuUrl . "', father_menu_id=" . $fatherMenuId . " where menu_id = " . $menuId);
	}
	
	/**
	 * 根据menuId删除菜单
	 * $menuId 菜单Id
	 **/
	function deleteMenuById($menuId) {
		$menuRs = mysql_query("select * from menu where menu_id = " . $menuId);
		$menu = mysql_fetch_array($menuRs);
		if ($menu['father_menu_id'] == 0) { // 父菜单
			mysql_query("delete from menu where menu_id = " . $menuId . " or father_menu_id = " . $menuId);
		} else { // 子菜单
			mysql_query("delete from menu where menu_id = " . $menuId); // 删除子菜单
		}
	}
	
	/**
	 * 批量删除菜单
	 * $ids 菜单Id数组
	 * return
	 **/
	function batchDelMenu($ids) {
		$del_count = 0;
		foreach ($ids as $menuId) {
			deleteMenuById($menuId); // 根据menuId删除用户
			$del_count++;
		}
		return $del_count;
	}
	
?>