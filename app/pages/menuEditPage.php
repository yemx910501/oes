<link href="css/testpaper.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
	dt {text-align: right;}
</style>
<script src="js/toggleurl.js" type="text/javascript"></script>

<?php
	require_once dirname(__FILE__).'/../common/commonFunc.php';
	$conn = createConn(); // 创建数据库连接
	$menuId = $_GET['menuId'];
	$rs = mysql_query("select * from menu where menu_id = " . $menuId);
	$menu = mysql_fetch_assoc($rs);
?>

<h2 class="contentTitle" align="center">编辑菜单信息</h2>

<div class="pageContent">
	<form method="post" action="app/menuAction.php?op=updateMenu&menuId=<?php echo $menuId;?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="97">
			<dl>
				<dt>父菜单：</dt>
				<dd>
					<select class="combox" name="fatherMenu" id="fatherMenu">
						<option value="0">无</option>
						<?php
							$rs = mysql_query("select * from menu where father_menu_id = 0");
							while ($fmenu = mysql_fetch_array($rs)) {
								if ($fmenu['menu_id'] == $menu['father_menu_id']) {
									echo "<option value='" . $fmenu['menu_id'] . "' selected>" . $fmenu['menu_name'] . "</option>";
								} else {
									echo "<option value='" . $fmenu['menu_id'] . "'>" . $fmenu['menu_name'] . "</option>";
								}
							}
							mysql_close($conn);
						?>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>菜单名称：</dt>
				<dd>
					<input type="text" name="menuName" value="<?php echo $menu['menu_name'];?>" class="required floatLeft" minlength="2" maxlength="10" remote="app/menuAction.php?op=checkMenu&menuId=<?php echo $menu['menu_id'];?>" alt="请输入菜单名称"/>
				</dd>
			</dl>
			<dl>
				<dt>菜单路径：</dt>
				<dd>
					<input type="text" name="menuUrl" id="menuUrl" value="<?php echo $menu['menu_url'];?>" class="required menuUrl" value="父菜单，无链接" maxlength="50" readonly="true" alt="请输入链接"/>
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

