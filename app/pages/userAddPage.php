<link href="css/testpaper.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
	dt {text-align: right;}
</style>
<script src="js/toggleurl.js" type="text/javascript"></script>
<?php
	require_once dirname(__FILE__).'/../common/commonFunc.php';
	$conn = createConn(); // 创建数据库连接
?>
<h2 class="contentTitle" align="center">新增用户</h2>
<div class="pageContent">
	<form method="post" action="app/userAction.php?op=addUser" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="97">
			<dl>
				<dt>用户ID：</dt>
				<dd>
					<input type="text" name="userId" class="required floatLeft"  maxlength="10"  alt="请输入用户ID"/>
				</dd>
				</dd>
			</dl>
			<dl>
				<dt>姓名：</dt>
				<dd>
					<input type="text" name="userName" class="required floatLeft" minlength="2" maxlength="10"  alt="请输入用户名"/>
				</dd>
			</dl>
			<dl>
				<dt>密码：</dt>
				<dd>
					<input type="text" name="password" class="required floatLeft" minlength="6" maxlength="10"  alt="请设置密码"/>
				</dd>
			</dl>
			<dl>
				<dt>性别：</dt>
				<dd><input type="radio" name="gender" value="M" checked="checked" />男 <input type="radio" name="gender" value="F" />女</dd>
			</dl>
			<dl>
				<dt>选择角色：</dt>
				<dd>
					<div class="floatLeft">
						<input type="checkbox" name="roleList[]" value="1" />系统管理员
						<input type="checkbox" name="roleList[]" value="2" />教师
						<input type="checkbox" name="roleList[]" value="3" />学生
					</div>
					<div><span class="info">请为其授予角色（至少选一个）</span></div>
				</dd>
			</dl>
			<dl>
				<dt>选择课程：</dt>
				<dd>
					<div class="floatLeft">
						<?php
							$courseRs = mysql_query("select * from base_code_def where father_base_code = 'course' order by base_code_id");
							while ($course = mysql_fetch_array($courseRs)) {
								echo "<input type='checkbox' name='courseList[]' value='" . $course['code_value'] . "'/><span>" . $course['display_value'] . "</span>";
							}
							mysql_close($conn);
						?>
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

