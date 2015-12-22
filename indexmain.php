<?php
	session_start();
	require_once 'app/common/commonFunc.php';
	$conn = createConn();
	
	$pageSize = isset($_POST['pageSize'])?$_POST['pageSize']:10; // 每一页显示的记录数
	$currentPage = isset($_POST['currentPage'])?intval($_POST['currentPage']):1; // 设置当前页
	$offset = $pageSize*($currentPage - 1); // 计算记录偏移量
?>

<link href="css/index.css" rel="stylesheet" type="text/css" media="screen">

<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><span>在线考试</span></li>
		</ul>
	</div>
	<table class="table exam_table" width="100%" layoutH="75">
		<thead>
			<tr>
				<th width="50px">考试进度</th>
				<th width="130px">试卷名</th>
				<th width="100px">开始时间</th>
				<th width="100px">结束时间</th>
				<th width="40px">总分</th>
				<th width="50px">答题时间</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
	<?php include 'app/common/pagebar.php';?>
</div>
