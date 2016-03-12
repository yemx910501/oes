<link href="css/testpaper.css" rel="stylesheet" type="text/css" media="screen"></link>
<div class="pageContent">
	<table class="table" width="100%" layoutH="50">
		<thead>
			<tr>
				<th width="5px" align="center"><input class="checkboxCtrl" type="checkbox" group="ids[]"></th>
				<th width="20px" align="center">序号</th>
				<th width="80px" align="center">角色名称</th>
				<th width="100px" align="center">角色描述</th>
				<th width="40px" align="center">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php
				require_once dirname(__FILE__).'/../common/commonFunc.php';
				$conn = createConn(); // 创建数据库连接
				
				$sort = 0;
				$rs = mysql_query("select * from role");
				while ($role = mysql_fetch_array($rs)) {
					echo "<tr target='sid_role' rel='" . $role['role_id'] . "'>";
					echo "<td><input type='checkbox' value='" . $role['role_id'] . "' name='ids[]'></td>";
					echo "<td>" . ++$sort . "</td>";
					echo "<td>" . $role['role_name'] . "</td>";
					echo "<td style='text-align:left;'>" . $role['role_desc'] . "</td>";
					echo "<td>";
					echo "<a href='app/pages/roleEditPage.php?roleId=" . $role['role_id'] . "' target='navTab' title='修改角色信息' class='btnEdit'></a>";
					echo "</td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
</div>
