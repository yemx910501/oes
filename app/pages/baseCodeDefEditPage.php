<link href="css/testpaper.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
	dt {text-align: right;}
</style>
<script src="js/toggleurl.js" type="text/javascript"></script>

<?php
	require_once dirname(__FILE__).'/../common/commonFunc.php';
	$conn = createConn(); // 创建数据库连接
	$baseCodeDefId = $_GET['baseCodeDefId'];
	$rs = mysql_query("select * from base_code_def where base_code_id = " . $baseCodeDefId);
	$baseCodeDef = mysql_fetch_assoc($rs);
?>

<h2 class="contentTitle" align="center">编辑数据信息</h2>

<div class="pageContent">
	<form method="post" action="app/baseCodeDefAction.php?op=updateBaseCodeDef&baseCodeDefId=<?php echo $baseCodeDefId;?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="97">
			<dl>
				<dt>字典类型：</dt>
				<dd>
					<select class="combox" name="fatherBaseCodeDef" id="fatherBaseCodeDef">
						<option value="0">无</option>
						<?php
							$rs = mysql_query("select * from base_code_def where father_base_code = 0");
							while ($fatherBaseCodeDef = mysql_fetch_array($rs)) {
								if ($fatherBaseCodeDef['code_value'] == $baseCodeDef['father_base_code']) {
									echo "<option value='" . $fatherBaseCodeDef['code_value'] . "' selected>" . $fatherBaseCodeDef['display_value'] . "</option>";
								} else {
									echo "<option value='" . $fatherBaseCodeDef['code_value'] . "'>" . $fatherBaseCodeDef['display_value'] . "</option>";
								}
							}
							mysql_close($conn);
						?>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>字典编码：</dt>
				<dd>
					<!-- remote="app/baseCodeDefAction.php?op=checkBaseCodeDef&baseCodeDefId=<?php // echo $baseCodeDef['base_code_id'];?>" -->
					<input type="text" name="codeValue" value="<?php echo $baseCodeDef['code_value'];?>" class="required floatLeft" minlength="2" maxlength="10" alt="请输入字典编码"/>
				</dd>
			</dl>
			<dl>
				<dt>字典名称：</dt>
				<dd>
					<!-- remote="app/baseCodeDefAction.php?op=checkBaseCodeDef&baseCodeDefId=<?php // echo $baseCodeDef['base_code_id'];?>" -->
					<input type="text" name="displayValue" value="<?php echo $baseCodeDef['display_value'];?>" class="required floatLeft" minlength="2" maxlength="10" alt="请输入字典名称"/>
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

