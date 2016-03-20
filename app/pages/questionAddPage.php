<link href="css/testpaper.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
	dt {text-align: right;}
</style>
<script src="js/showoptions.js" type="text/javascript"></script>
<script src="js/addoption.js" type="text/javascript"></script>

<?php
	require_once dirname(__FILE__).'/../common/commonFunc.php';
	$conn = createConn(); // 创建数据库连接
?>
<h2 class="contentTitle" align="center">新增试题</h2>
<div class="pageContent">
	<form method="post" action="app/questionAction.php?op=addQuestion" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="97">
			<dl>
				<dt>所属课程：</dt>
				<dd>
					<select class="combox" name="courseCode" id="courseCode">
						<?php
							$rs = mysql_query("select * from base_code_def where father_base_code = 'course'");
							while ($course = mysql_fetch_array($rs)) {
								echo "<option value='" . $course['code_value'] . "'>" . $course['display_value'] . "</option>";
							}
						?>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>试题类型：</dt>
				<dd>
					<select class="combox" name="questionType" id="questionType">
						<?php
							$rs = mysql_query("select * from question_type");
							while ($questionType = mysql_fetch_array($rs)) {
								echo "<option value='" . $questionType['question_type_code'] . "'>" . $questionType['question_type_name'] . "</option>";
							}
							mysql_close($conn);
						?>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>难易度：</dt>
				<dd>
					<div class="floatLeft">
						<input type="radio" name="degree" value="0" checked/>简单
						<input type="radio" name="degree" value="1"/>困难
					</div>
				</dd>
			</dl>
			<dl>
				<dt>试题分数：</dt>
				<dd>
					<dd>
						<input type="text" name="score" class="required floatLeft point score"/>
						<span>分</span>
					</dd>
				</dd>
			</dl>
			<dl>
				<dt>试题内容：</dt>
				<dd>
					<dd>
						<textarea class="required floatLeft" name="content" rows="4" cols="40" maxlength="100" ></textarea>
						<span class="info">请输入试题内容</span>
					</dd>
				</dd>
			</dl>
			<dl id="options_dl" style="display:none;">
				<dt>选项：</dt>
				<dd id="op_dd">
					<span class="textInput option">选项A：</span>
					<input type="text" id="op_65" name="options[]" class="floatLeft"/>
					<a href="#" id="addoption" title="增加选项" class="btnAdd"></a><br />
					<span class="textInput option">选项B：</span>
					<input type="text" id="op_66" name="options[]" class="floatLeft"/><br />
					<span class="textInput option">选项C：</span>
					<input type="text" id="op_67" name="options[]" class="floatLeft"/><br />
					<span class="textInput option">选项D：</span>
					<input type="text" id="op_68" name="options[]" class="floatLeft"/><br />
				</dd>
			</dl>
			<dl id="answer_dl" style="display:none;">
				<dt>试题答案：</dt>
				<dd>
					<dd>
						<textarea id="answer" class="required floatLeft" name="answer" rows="4" cols="40" maxlength="100" ></textarea>
						<span class="info">请输入试题答案</span>
					</dd>
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

