<link href="css/testpaper.css" rel="stylesheet" type="text/css" media="screen"></link>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="app/pages/questionTypeAddPage.php" target="navTab" title="新增题型"><span>新增题型</span></a></li>
			<li><a class="delete" href="app/questionTypeAction.php?op=batchDel" rel="ids[]" target="selectedTodo" title="确定要删除这些题型吗？"><span>批量删除</span></a></li>
	</div>
	<table class="table" width="100%" layoutH="50">
		<thead>
			<tr>
				<th width="5px" align="center"><input class="checkboxCtrl" type="checkbox" group="ids[]"></th>
				<th width="20px" align="center">序号</th>
				<th width="40px" align="center">题型编码</th>
				<th width="40px" align="center">题型</th>
				<th width="80px" align="center">主/客观题</th>
				<th width="40px" align="center">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php
				require_once dirname(__FILE__).'/../common/commonFunc.php';
				$conn = createConn(); // 创建数据库连接
				
				$sort = 0;
				$rs = mysql_query("select * from question_type");
				while ($questionType = mysql_fetch_array($rs)) {
					echo "<tr target='sid_questionType' rel='" . $questionType['question_type_id'] . "'>";
					echo "<td><input type='checkbox' value='" . $questionType['question_type_id'] . "' name='ids[]'></td>";
					echo "<td>" . ++$sort . "</td>";
					echo "<td>" . $questionType['question_type_code'] . "</td>";
					echo "<td>" . $questionType['question_type_name'] . "</td>";
					echo "<td style='text-align:center;'>" . ($questionType['question_type_flag']==1?"主观题":"客观题") . "</td>";
					echo "<td>";
					echo "<a href='app/pages/questionTypeEditPage.php?questionTypeId=" . $questionType['question_type_id'] . "' target='navTab' title='修改题型信息' class='btnEdit'></a>";
					echo "<a href='app/questionTypeAction.php?op=delQuestionType&questionTypeId=" . $questionType['question_type_id'] . "' target='ajaxTodo' title='删除这个题型？' class='btnDel'></a>";
					echo "</td>";
					echo "</tr>";
				}
				mysql_close($conn);
			?>
		</tbody>
	</table>
</div>
