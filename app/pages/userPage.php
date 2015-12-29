<style type="text/css">
	p.select_info {font-size: 18px; color: #FF0000; text-align:center; margin-top:200px;}
</style>
<?php
	require_once dirname(__FILE__).'/../common/commonFunc.php';
	session_start();
	
	$path = "app/pages/";
	$pageSize = isset($_POST['pageSize'])?$_POST['pageSize']:10; // 每一页显示的记录数
	$currentPage = isset($_POST['currentPage'])?intval($_POST['currentPage']):1; // 设置当前页
	$userId = isset($_POST['userId'])?$_POST['userId']:''; // 学号
	$roleId = isset($_POST['role'])?$_POST['role']:''; // 角色Id
	$offset = $pageSize * ($currentPage - 1); // 计算记录偏移量
	
	$conn = createConn(); // 创建数据库连接
	mysql_query("set character_set_connection=utf8");
	$querySql = "select distinct u.* from user u join user_role_relation urr on u.user_id = urr.user_id where 1 = 1";
	$countSql = "select count(*) from user u where 1 = 1";
	$whereSql = "";
	$orderSql = " order by urr.role_id asc, u.user_id asc limit $offset, $pageSize";
	
	if ($userId!="") {
		$whereSql .= " and u.user_id like '%" . test_input($userId) . "%'";
	}
	
	if ($roleId!="") {
		$whereSql .= " and u.user_id in (select u.user_id from user_role_relation urr 
			 join user u on urr.user_id = u.user_id where urr.role_id = '$roleId')";
	}
	
	$sql = $querySql . $whereSql . $orderSql;
	$countSql .= $whereSql;
	$rs = mysql_query($sql); // 读取指定记录数
	$recordRs = mysql_query($countSql); // 取得记录总数，用于计算总页数
	$row = mysql_fetch_array($recordRs);
	$numRows = $row[0];
	$pages = intval($numRows/$pageSize); // 计算总页数
	if ($numRows%$pageSize) { // 余数不为0
		$pages++;
	}
	
	// 查询角色为系统管理员的用户
	$listRs = mysql_query("select u.user_id from user_role_relation urr join user u on urr.user_id = u.user_id where urr.role_id = 1");
	$adminList = array();
	while ($admin = mysql_fetch_array($listRs)) {
		$adminList[] = $admin['user_id'];
	}
?>

<div class="pageHeader">
	<form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo $path;?>userPage.php" method="post">
		<div class="searchBar" align="center">
			<input type="hidden" name="currentPage" value="1" />
			<input type="hidden" name="pageSize" value="<?php echo $pageSize?>" />
			<table class="searchContent">
				<tr>
					<td>用户ID：</td>
					<td>
						<input type="text" name="userId" value="<?php echo $userId;?>"/>					
					</td>
					<td>角色：</td>
					<td>
						<select class="combox" name="role">
							<option value=''>--请选择--</option>
							<?php
								$role_rs = mysql_query("select * from role order by role_id");
								while ($role = mysql_fetch_array($role_rs)) {
									echo "<option value='" . $role['role_id'] . "'" . ($roleId==$role['role_id']?'selected':'') . ">" 
										 . $role['role_name'] . "</option>";
								}
							?>
						</select>
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
			<li><a class="delete" href="<?php echo $path;?>batchDeleteUser.php" rel="ids[]" target="selectedTodo" title="确定要删除这些用户吗？"><span>批量删除</span></a></li>
		</ul>
	</div>
	<?php 
		if ($numRows>0) {
	?>
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th width="5px" align="center"><input class="checkboxCtrl" type="checkbox" group="ids[]"></th>
				<th width="20px" align="center">序号</th>
				<th width="80px" align="center">用户ID</th>
				<th width="80px" align="center">姓名</th>
				<th width="40px" align="center">性别</th>
				<th width="120px" align="center">角色</th>
				<th width="40px" align="center">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if (is_resource($rs)) {
					$sort = 0;
					while ($user = mysql_fetch_array($rs)) {
						$roleRs = mysql_query("select group_concat(r.role_name) as role_name from role r join user_role_relation urr on r.role_id = urr.role_id 
							where urr.user_id = " . $user['user_id']); // 查找用户拥有的角色
						$role = mysql_fetch_array($roleRs);
						
						echo "<tr target='sid_user' rel='" . $user['user_id'] . "'>";
						if (in_array($user['user_id'], $adminList) && !in_array($_SESSION['userId'], $adminList)) {
							// 本条记录角色为系统管理员 && 目前登录用户不是系统管理员
							echo "<td>—</td>";
						} else {
							echo "<td><input type='checkbox' value='" . $user['user_id'] . "' name='ids[]'></td>";
						}
						
						echo "<td>" . ++$sort . "</td>";
						echo "<td>" . $user['user_id'] . "</td>";
						echo "<td>" . $user['user_name'] . "</td>";
						echo "<td>" . ($user['gender']=="M"?"男":"女") . "</td>";
						echo "<td>" . $role['role_name'] . "</td>";
						echo "<td>";
						
						if (in_array($user['user_id'], $adminList) && !in_array($_SESSION['userId'], $adminList)) {
							echo "[无权]";
						} else {
							echo "<a href='" . $path . "userEditPage.php?userId=" . $user['user_id'] . "' target='navTab' title='修改用户信息' class='btnEdit'></a>";
							echo "<a href='app/deleteUser?userId=" . $user['user_id'] . "' target='ajaxTodo' title='删除用户？' class='btnDel'></a>";
						}
						echo "</td>";
						echo "</tr>";
					}
				}
			?>
		</tbody>
	</table>
	<?php
			include dirname(__FILE__).'/../common/pagebar.php';
		}else{
	?>
	<div layoutH="138">
		<p class="select_info"><?php echo "找不到符合条件的记录！";?></p>
	</div>
	<?php }?>
</div>
