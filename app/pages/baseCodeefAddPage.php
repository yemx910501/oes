<link href="css/testpaper.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
	dt {text-align: right;}
</style>

<?php
	require_once dirname(__FILE__).'/../common/commonFunc.php';
	$conn = createConn(); // 创建数据库连接
?>
<h2 class="contentTitle" align="center">新增数据字典</h2>
<div class="pageContent">
	<form method="post" action="app/baseCodeDefAction.php?op=addBaseCodeDef" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="97">
			<dl>
				<dt>字典类型：</dt>
				<dd>
					<select class="combox" name="fatherBaseCodeDefId" id="fatherBaseCodeDefId">
						<option value="0">无</option>
						<?php
							$rs = mysql_query("select * from base_code_def where father_base_code_id = 0");
							while ($fatherBaseCodeDef = mysql_fetch_array($rs)) {
								echo "<option value='" . $fatherBaseCodeDef['base_code_id'] . "'>" . $fatherBaseCodeDef['display_value'] . "</option>";
							}
							mysql_close($conn);
						?>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>字典编码：</dt>
				<dd>
					<input type="text" name="codeValue" class="required floatLeft" minlength="2" maxlength="10" alt="请输入字典编码"/><!-- remote="" -->
				</dd>
			</dl>
			<dl>
				<dt>字典名称：</dt>
				<dd>
					<input type="text" name="displayValue" id="menuUrl" class="required menuUrl" maxlength="20" alt="请输入字典名称"/>
				</dd>
			</dl>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">确定</button></div></div></li>
				<li><div class="buttonActive"><div class="buttonContent"><button type="reset">重置</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">返回</button></div></div></li>
			</ul>
		</div>
	</form>
</div>

