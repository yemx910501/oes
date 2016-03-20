<link href="css/testpaper.css" rel="stylesheet" type="text/css" media="screen"></link>

<?php
	$pageSize = isset($_POST['pageSize'])?$_POST['pageSize']:10; // 每一页显示的记录数
	$currentPage = isset($_POST['currentPage'])?intval($_POST['currentPage']):1; // 设置当前页
	$offset = $pageSize*($currentPage - 1); // 计算记录偏移量
	$codeValue = isset($_POST['codeValue'])?$_POST['codeValue']:'';
	$displayValue = isset($_POST['displayValue'])?$_POST['displayValue']:'';
	
	require_once dirname(__FILE__).'/../common/commonFunc.php';
	$conn = createConn(); // 创建数据库连接
	mysql_query("set character_set_connection=utf8");
	
	
	$querySql = "select t.*, t2.display_value as father_code_value from base_code_def t left join base_code_def t2 on t.father_base_code = t2.code_value where 1=1";
	$countSql = "select count(*) from base_code_def bcd where 1=1";
	$whereSql = "";
	$orderSql = " order by bcd.father_base_code, c1.base_code_id limit " . $offset . "," . $pageSize;
	if ($codeValue != "") {
		$whereSql .= " and t.code_value like '%" . test_input($codeValue) . "%'";
	}
	if ($displayValue != "") {
		$whereSql .= " and t.display_value like '%" . test_input($displayValue) . "%'";
	}
	
	$sql = $querySql . $whereSql;
	$countSql = $countSql . $whereSql;
	$rs = mysql_query($sql);
	
	$record_rs = mysql_query($countSql); // 取得记录总数$rs，计算总页数用
	$row = mysql_fetch_array($record_rs);
	$numRows = $row[0];
	$pages = intval($numRows/$pageSize); // 计算总页数
	if ($numRows%$pageSize){$pages++;}
?>

<div class="pageHeader">
	<form id="pagerForm" onsubmit="return navTabSearch(this);" action="app/pages/baseCodeDefPage.php" method="post">
	<div class="searchBar" align="center">
	<input type="hidden" name="currentPage" value="1" />
	<input type="hidden" name="pageSize" value="<?php echo $pageSize?>" />
		<table class="searchContent">
			<tr>
				<td>字典编码：</td>
				<td>
					<input type="text" name="codeValue" value="<?php echo $codeValue;?>"/>	
				</td>
				<td>字典名称：</td>
				<td>
					<input type="text" name="displayValue" value="<?php echo $displayValue;?>"/>	
				</td>
			</tr>
		</table>
		<div class="subBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">查询</button></div></div></li>
			</ul>
		</div>
	</div>
	</form>
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="app/pages/baseCodeDefAddPage.php" target="navTab" title="新增数据字典"><span>新增数据字典</span></a></li>
			<li><a class="delete" href="app/baseCodeDefAction.php?op=batchDel" rel="ids[]" target="selectedTodo" title="确定要删除这些数据字典吗？"><span>批量删除</span></a></li>
	</div>
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th width="5px" align="center"><input class="checkboxCtrl" type="checkbox" group="ids[]"></th>
				<th width="20px" align="center">序号</th>
				<th width="40px" align="center">字典编码</th>
				<th width="80px" align="center">字典名称</th>
				<th width="20px" align="center">父字典名称</th>
				<th width="40px" align="center">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(is_resource($rs)){
					$sort = 0;
					while ($baseCodeDef = mysql_fetch_array($rs)) {
						echo "<tr target='sid_base_code_def' rel='" . $baseCodeDef['base_code_id'] . "'>";
						echo "<td><input type='checkbox' value='" . $baseCodeDef['base_code_id'] . "' name='ids[]'></td>";
						echo "<td>" . ++$sort . "</td>";
						echo "<td>" . $baseCodeDef['code_value'] . "</td>";
						echo "<td style='text-align:left;'>" . $baseCodeDef['display_value'] . "</td>";
						echo "<td style='text-align:center;'>" . (empty($baseCodeDef['father_code_value'])?"无":$baseCodeDef['father_code_value']) . "</td>";
						echo "<td>";
						echo "<a href='app/pages/baseCodeDefEditPage.php?baseCodeDefId=" . $baseCodeDef['base_code_id'] . "' target='navTab' title='修改数据字典' class='btnEdit'></a>";
						echo "<a href='app/baseCodeDefAction.php?op=delBaseCodeDef&baseCodeDefId=" . $baseCodeDef['base_code_id'] . "' target='ajaxTodo' title='删除这个数据字典？' class='btnDel'></a>";
						echo "</td>";
						echo "</tr>";
					}
				}
				mysql_close($conn);
			?>
		</tbody>
	</table>
	<?php require_once dirname(__FILE__).'/../common/pagebar.php';?>
</div>
