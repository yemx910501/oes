$(function(){
	$("#loginForm").on("keypress", "#username,#password", function(e){
		if (e.which==13) {
			// 回车
			$("#btn_login").triggerHandler("click");
		}
	});

	$("#btn_login").click(function(){
		var user = $("#username").val().trim(),
			pwd = $("#password").val(),
			chk_flag = validate_form(user, pwd);
		
		if (!chk_flag) {
			return false;
		}
		
		// 验证用户名、密码
		$.post("app/login.php", {
				username : user,
				password : pwd
			}, function(msg){
				if (msg=="success") {
					alert("登录成功！");
					document.location.replace("app/pages/main.php");
				} else {
					$("#msg").html("用户名或密码错误！"); 
				}
			}
		);
	});
});

/* 表单验证 */
function validate_form(user, pwd) {
	if (user=="") {
		$("#msg").html("用户名不能为空！");
		$("#username").focus();  
		return false;
	}
	
    if (pwd=="") {
        $("#msg").html("密码不能为空！");  
        $("#password").focus();
		return false;
    }
	
	return true;
}