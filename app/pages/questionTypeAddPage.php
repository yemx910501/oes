<link href="css/testpaper.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
	dt {text-align: right;}
</style>

<?php
	require_once dirname(__FILE__).'/../common/commonFunc.php';
	$conn = createConn(); // 创建数据库连接
?>
<h2 class="contentTitle" align="center">新增题型</h2>
<div class="pageContent">
	<form method="post" action="app/questionTypeAction.php?op=addQuestionType" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="97">
			<dl>
				<dt>题型编码：</dt>
				<dd>
					<input type="text" name="questionTypeCode" class="required floatLeft" maxlength="10" alt="请输入题型编码"/>
				</dd>
			</dl>
			<dl>
				<dt>题型名称：</dt>
				<dd>
					<input type="text" name="questionTypeName" class="required floatLeft" minlength="2" maxlength="10" alt="请输入题型名称"/>
				</dd>
			</dl>
			<dl>
				<dt>主/客观题：</dt>
				<dd>
					<div class="floatLeft">
						<input type="radio" name="questionTypeFlag" value="1"/>主观题
						<input type="radio" name="questionTypeFlag" value="0" checked/>客观题
					</div>
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

