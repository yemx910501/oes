<link href="css/testpaper.css" rel="stylesheet" type="text/css" media="screen"></link>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="app/pages/menuAddPage.php" target="navTab" title="添加菜单"><span>添加菜单</span></a></li>
			<li><a class="delete" href="app/menuAction.php?op=batchDel" rel="ids[]" target="selectedTodo" title="确定要删除这些菜单吗？"><span>批量删除</span></a></li>
	</div>
	<table class="table" width="100%" layoutH="50">
		<thead>
			<tr>
				<th width="5px" align="center"><input class="checkboxCtrl" type="checkbox" group="ids[]"></th>
				<th width="20px" align="center">序号</th>
				<th width="40px" align="center">菜单名</th>
				<th width="80px" align="center">菜单路径</th>
				<th width="20px" align="center">排序</th>
				<th width="20x" align="center">父菜单ID</th>
				<th width="40px" align="center">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php
				require_once dirname(__FILE__).'/../common/commonFunc.php';
				$conn = createConn(); // 创建数据库连接
				
				$sort = 0;
				$rs = mysql_query("select * from menu");
				while ($menu = mysql_fetch_array($rs)) {
					echo "<tr target='sid_menu' rel='" . $menu['menu_id'] . "'>";
					echo "<td><input type='checkbox' value='" . $menu['menu_id'] . "' name='ids[]'></td>";
					echo "<td>" . ++$sort . "</td>";
					echo "<td>" . $menu['menu_name'] . "</td>";
					echo "<td style='text-align:left;'>" . $menu['menu_url'] . "</td>";
					echo "<td style='text-align:center;'>" . $menu['sort'] . "</td>";
					echo "<td style='text-align:center;'>" . $menu['father_menu_id'] . "</td>";
					echo "<td>";
					echo "<a href='app/pages/menuEditPage.php?menuId=" . $menu['menu_id'] . "' target='navTab' title='修改菜单信息' class='btnEdit'></a>";
					echo "<a href='app/menuAction.php?op=delMenu&menuId=" . $menu['menu_id'] . "' target='ajaxTodo' title='删除这个菜单？' class='btnDel'></a>";
					echo "</td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
</div>
