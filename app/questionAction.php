<?php
/************************************************************
*   				    试题
************************************************************/
	require_once dirname(__FILE__).'/common/commonFunc.php';
	
	$conn = createConn(); // 创建数据库连接
	$op = $_GET['op']; // 操作类型
	if ($op != "batchDel") { // 非批量删除
		$questionId = isset($_GET['questionId'])?$_GET['questionId']:""; // 数据字典Id
	} else { // 批量删除
		$ids = $_POST['ids']; // 数据字典Id
	}
	switch ($op) {
		case "addQuestion":
			addQuestion();
			$statusCode = "200";
			$message = "新增试题成功";
			$navTabId = "oa6";
			$callbackType = "closeCurrent";
			$rel = $forwardUrl = $confirmMsg = "";
			break;
		case "updateBaseCodeDef":
			updateBaseCodeDef($baseCodeDefId);
			$statusCode = "200";
			$message = "修改数据字典成功";
			$callbackType = "closeCurrent";
			$navTabId = "oa11";
			$rel = $forwardUrl = $confirmMsg = "";
			break;
		case "delBaseCodeDef":
			deleteBaseCodeDefById($baseCodeDefId); // 根据baseCodeDefId删除数据
			$statusCode = "200";
			$message = "删除数据字典成功";
			$navTabId = "oa11";
			$callbackType = $rel = $forwardUrl = $confirmMsg = "";
			break;
		case "batchDel":
			$del_count = batchDelBaseCodeDef($ids); // 批量删除数据
			$statusCode = "200";
			$message = "成功删除了" . $del_count . "个数据字典。";
			$navTabId = "oa4";
			$callbackType = $rel = $forwardUrl = $confirmMsg = "";
			break; 
	}
	mysql_close($conn);
	include dirname(__FILE__).'/common/message.php';
	
	/**
	 * 新增试题
	 **/
	function addQuestion() {
		mysql_query("set character_set_connection=utf8");
		$courseCode = isset($_POST['courseCode'])?$_POST['courseCode']:""; // 课程编码
		$questionTypeCode = isset($_POST['questionType'])?$_POST['questionType']:""; // 题型
		$degree = isset($_POST['degree'])?$_POST['degree']:""; // 难易度
		$score = isset($_POST['score'])?test_input($_POST['score']):""; // 分数
		$content = isset($_POST['content'])?test_input($_POST['content']):""; // 试题内容
		
		// 插入试题表
		mysql_query("insert into question(course_code, question_type_code, degree, question_content, score) values('$courseCode', '$questionTypeCode', $degree, '$content', $score)");
		$questionId = mysql_insert_id(); // 上一步 INSERT 操作产生的 ID
		
		// 新增答案
		$questionTypeRs = mysql_query("select * from question_type where question_type_code = '$questionTypeCode'");
		$questionType = mysql_fetch_array($questionTypeRs);
		if ($questionType['question_type_flag']==1) { // 主观题
			$answer = isset($_POST['answer'])?test_input($_POST['answer']):""; // 答案
			mysql_query("insert into subjective_answer(question_id, subjective_answer) values($questionId, '$answer')");
		} else { // 客观题
			/* if (isset($_POST['options']) {
				$options = $_POST['options']; // 选项
				foreach ($options as $option) {
					// 客观题答案
				}
			} */
		}
	}
	
	/**
	 * 修改菜单
	 **/
	function updateBaseCodeDef($baseCodeDefId) {
		mysql_query("set character_set_connection=utf8");
		$fatherBaseCodeDef = isset($_POST['fatherBaseCodeDef'])?test_input($_POST['fatherBaseCodeDef']):""; // 父字典code
		$codeValue = isset($_POST['codeValue'])?test_input($_POST['codeValue']):""; // 字典编码
		$displayValue = isset($_POST['displayValue'])?test_input($_POST['displayValue']):""; // 字典名称
		mysql_query("update base_code_def set father_base_code ='" . $fatherBaseCodeDef . "', code_value='" . $codeValue . "', display_value='" . $displayValue . "' where base_code_id = " . $baseCodeDefId);
	}
	
	/**
	 * 根据menuId删除菜单
	 * $menuId 菜单Id
	 **/
	function deleteBaseCodeDefById($baseCodeDefId) {
		$baseCodeDefRs = mysql_query("select * from base_code_def where base_code_id = " . $baseCodeDefId);
		$baseCodeDef = mysql_fetch_array($baseCodeDefRs);
		if ($baseCodeDef['father_base_code'] == 0) { // 父字典
			mysql_query("delete from base_code_def where base_code_id = " . $baseCodeDefId . " or father_base_code = " . $baseCodeDef['code_value']);
			// mysql_query("delete from _relation where _id = " . $Id); // 删除关系表
		} else { // 子字典
			//mysql_query("delete from role_menu_relation where menu_id = " . $menuId); // 删除关系表
			mysql_query("delete from base_code_def where base_code_id = " . $baseCodeDefId); // 删除子数据字典
		}
	}
	
	/**
	 * 批量删除菜单
	 * $ids 菜单Id数组
	 * return
	 **/
	function batchDelBaseCodeDef($ids) {
		$del_count = 0;
		foreach ($ids as $baseCodeDefId) {
			deleteBaseCodeDefById($baseCodeDefId); // 根据baseCodeDefId删除用户
			$del_count++;
		}
		return $del_count;
	}
	
?>