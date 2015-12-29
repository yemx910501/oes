/* 表单验证 */
function validateForm() {
	var user = $("#username").val().trim(),
		pwd = $("#password").val();
		
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