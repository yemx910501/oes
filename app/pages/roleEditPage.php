<link href="css/testpaper.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
	dt {text-align: right;}
</style>
<script src="js/treecheck.js" type="text/javascript"></script>

<?php
	require_once dirname(__FILE__).'/../common/commonFunc.php';
	$conn = createConn(); // 创建数据库连接
	
	$roleId = $_GET['roleId'];
	$rs = mysql_query("select * from role where role_id = " . $roleId);
	$role = mysql_fetch_assoc($rs);
	
	$list_rs = mysql_query("select menu_id from role_menu_relation where role_id = " . $roleId);
	$menuList = array();
	while ($row = mysql_fetch_array($list_rs)) {
		$menuList[] = $row['menu_id'];
	}
?>

<h2 class="contentTitle" align="center">编辑角色信息</h2>

<div class="pageContent">
	<form method="post" action="app/roleAction.php?op=updateRole&roleId=<?php echo $roleId;?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="97">
			<dl>
				<dt>角色名称：</dt>
				<dd>
					<input type="text" name="roleName" minlength="2" maxlength="10" class="required floatLeft" value="<?php echo $role['role_name'];?>" 
						alt="请输入角色名" remote="app/roleAction.php?op=checkRole&roleId=<?php echo $roleId;?>"/>
				</dd>
			</dl>
			<dl>
				<dt>角色描述：</dt>
				<dd>
					<textarea name="roleDesc" class="required floatLeft" cols="20" rows="3" maxlength="25"><?php echo $role['role_desc'];?></textarea>
					<span class="info">请输入角色描述</span>
				</dd>
			</dl>
			<dl>
				<dt>权限：</dt>
				<dd>
					<div align="left" style="float:left;width: 200px">
						<ul class="tree treeFolder treeCheck expand" oncheck="kkk">
							<?php
								$f_rs = mysql_query("select * from menu where father_menu_id = 0");
								$s_rs = mysql_query("select * from menu where father_menu_id > 0");
								while ($fmenu = mysql_fetch_array($f_rs)) {
									if (in_array($fmenu['menu_id'], $menuList)) {
										echo "<li><a tname='menuList[]' tvalue='" . $fmenu['menu_id'] . "' checked>" . $fmenu['menu_name'] . "</a>";
									} else {
										echo "<li><a tname='menuList[]' tvalue='" . $fmenu['menu_id'] . "'>" . $fmenu['menu_name'] . "</a>";
									}
									echo "<ul>";
									mysql_data_seek($s_rs, 0); // 将$rs的行指针移动到指定的行号(0表示第一个记录)
									while ($smenu = mysql_fetch_array($s_rs)) {
										if ($smenu['father_menu_id'] == $fmenu['menu_id']) {
											if (in_array($smenu['menu_id'], $menuList)) {
												echo "<li><a tname='menuList[]' tvalue='" . $smenu['menu_id'] . "' checked>" . $smenu['menu_name'] . "</a></li>";
											} else {
												echo "<li><a tname='menuList[]' tvalue='" . $smenu['menu_id'] . "'>" . $smenu['menu_name'] . "</a></li>";
											}
											
										}
									}
									echo "</ul>";
									echo "</li>";
								}
								mysql_close($conn);
							?>
						</ul>
					</div>
					<div><span class="info">请为其授予权限（至少选一个）</span></div>
				</dd>
			</dl>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">修改</button></div></div></li>
				<li><div class="buttonActive"><div class="buttonContent"><button type="reset">重置</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">返回</button></div></div></li>
			</ul>
		</div>
	</form>
</div>


