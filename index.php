<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset='utf-8'"/> 
<title>在线考试系统</title>
<link href="dwz/themes/css/login.css" rel="stylesheet" type="text/css"/>
<script src="dwz/js/jquery-1.7.2.js" type="text/javascript"></script>
<script src="js/login.js" type="text/javascript"></script>
</head>
<body> 
	<div id="login">
		<div id="login_header">
			<h1 class="login_logo">
				<img src="images/login_logo.gif" />
			</h1>
			<div class="login_headerContent">
				<div class="navList">
					<ul>
						<li><a href="#">设为首页</a></li>
						<li><a href="http://j-ui.com/" target="_blank">dwz框架</a></li>
					</ul>
				</div>
				<h2 class="login_title"><img src="images/login_title.png" /></h2>
			</div>
		</div>
		<div id="login_content">
			<div class="loginForm">
				<form id="loginForm" name="_loginForm" method="post" action="app/loginAction.php?op=login" onsubmit="return validateForm();">
					<p>
						<label>用户名：</label>
						<input type="text" name="username" id="username" class="login_input"/>
					</p>
					<p>
						<label>密&nbsp;&nbsp;&nbsp;码：</label>
						<input type="password" name="password" id="password" class="login_input"/>
					</p>
					<div class="login_bar">
						<input class="sub" type="submit" value=""/>
					</div>
					<p></p>  
				</form>
			</div>
			<div class="login_banner"><img src="images/login_banner.jpg" /></div>
			<div class="login_main">
				<ul class="helpList">
					<li>
						<span id="msg"></span>  
					</li>
				</ul>
				<div class="login_inner">
					<p>拼搏创造未来，努力成就未来</p>
					<p>成功，没有尽力而为，只有全力以赴！</p>
					<p>每次考完试，我都安慰自己：“没事的，重在参与。。。”</p>
				</div>
			</div>
		</div>
		<div id="login_footer">
			<p>Copyright © 2015 郑伟捷 ZWJ. All Rights Reserved.</P>
		</div>
	</div>
</body>
</html>
