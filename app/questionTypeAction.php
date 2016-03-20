<?php
/************************************************************
*   				    题型
************************************************************/
	require_once dirname(__FILE__).'/common/commonFunc.php';
	
	$conn = createConn(); // 创建数据库连接
	$op = $_GET['op']; // 操作类型
	if ($op != "batchDel") { // 非批量删除
		 $questionTypeId = isset($_GET['questionTypeId'])?$_GET['questionTypeId']:""; // 题型Id
	} else { // 批量删除
		$ids = $_POST['ids']; // 多个题型Id
	}
	switch ($op) {
		case "checkQuestionType":
			echo "true";
			// checkQuestionType($questionTypeId);
			break;
		case "addQuestionType":
			addQuestionType();
			$statusCode = "200";
			$message = "添加题型成功";
			$navTabId = "oa9";
			$callbackType = "closeCurrent";
			$rel = $forwardUrl = $confirmMsg = "";
			break;
		case "updateQuestionType":
			updateQuestionType($questionTypeId);
			$statusCode = "200";
			$message = "修改题型成功";
			$callbackType = "closeCurrent";
			$navTabId = "oa9";
			$rel = $forwardUrl = $confirmMsg = "";
			break;
		case "delQuestionType":
			deleteQuestionTypeById($questionTypeId); // 根据questionTypeId删除题型
			$statusCode = "200";
			$message = "删除题型成功";
			$navTabId = "oa9";
			$callbackType = $rel = $forwardUrl = $confirmMsg = "";
			break;
		case "batchDel":
			$del_count = batchDelQuestionType($ids); // 批量删除题型
			$statusCode = "200";
			$message = "成功删除了" . $del_count . "个题型。";
			$navTabId = "oa9";
			$callbackType = $rel = $forwardUrl = $confirmMsg = "";
			break;
	}
	mysql_close($conn);
	include dirname(__FILE__).'/common/message.php';
	
	/**
	 * 检验菜单名是否已存在
	 **/
	/*function checkQuestionType($questionTypeId) {
		$questionTypeName = isset($_GET['questionTypeName'])?test_input($_GET['questionTypeName']):"";
		if ($questionTypeId != "") {
			$rs = mysql_query("select count(*) from question_type where question_type_name = '" . $questionTypeName . "' and question_type_id != '" . $questionTypeId . "'");
		} else {
			$rs = mysql_query("select count(*) from question_type where question_type_name = '" . $questionTypeName . "'");
		}
		
		if (mysql_num_rows($rs) == 0) {
			echo "true";
		} else {
			echo "false";
		}
	}*/
	
	/**
	 * 新增题型
	 **/
	function addQuestionType() {
		mysql_query("set character_set_connection=utf8");
		$questionTypeCode = isset($_POST['questionTypeCode'])?test_input($_POST['questionTypeCode']):""; // 题型编码
		$questionTypeName = isset($_POST['questionTypeName'])?test_input($_POST['questionTypeName']):""; // 题型名称
		$questionTypeFlag = isset($_POST['questionTypeFlag'])?test_input($_POST['questionTypeFlag']):""; // 主/客观题Flag
		mysql_query("insert into question_type(question_type_code, question_type_name, question_type_flag) values('$questionTypeCode', '$questionTypeName', $questionTypeFlag)");
	}
	
	/**
	 * 修改题型
	 **/
	function updateQuestionType($questionTypeId) {
		mysql_query("set character_set_connection=utf8");
		$questionTypeCode = isset($_POST['questionTypeCode'])?test_input($_POST['questionTypeCode']):""; // 题型编码
		$questionTypeName = isset($_POST['questionTypeName'])?test_input($_POST['questionTypeName']):""; // 题型名称
		$questionTypeFlag = isset($_POST['questionTypeFlag'])?test_input($_POST['questionTypeFlag']):""; // 主/客观题Flag
		mysql_query("update question_type set question_type_code='$questionTypeCode', question_type_name='$questionTypeName', question_type_flag= $questionTypeFlag where question_type_id = " . $questionTypeId);
	}
	/**
	 * 根据questionTypeId删除题型
	 * $questionTypeID 题型ID
	 **/
	function deleteQuestionTypeById($questionTypeId) {
		mysql_query("delete from question_type where question_type_id = " . $questionTypeId); // 删除题型
		}
	
	/**
	 * 批量删除题型
	 * $ids 题型Id数组
	 * return
	 **/
	function batchDelQuestionType($ids) {
		$del_count = 0;
		foreach ($ids as $questionTypeId) {
			deleteQuestionTypeById($questionTypeId); // 根据questionTypeId删除用户
			$del_count++;
		}
		return $del_count;
	}
	
?>