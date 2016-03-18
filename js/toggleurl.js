$(document).ready(function(){
	var fatherMenuId = $("#fatherMenu").val();
	if (fatherMenuId > 0) {
		$("#menuUrl").addClass("required");
        $("#menuUrl").removeAttr("readonly");
	}
	
	$("#fatherMenu").change(function(){
        if ($(this).val() == 0) {
            $("#menuUrl").removeClass("required");
            $("#menuUrl").val("父菜单，无链接");
            $("#menuUrl").attr("readonly","true");
        } else {
			$("#menuUrl").addClass("required");
            $("#menuUrl").removeAttr("readonly");
			if ($("#menuUrl").val() == "父菜单，无链接") {
				$("#menuUrl").val("");
			}
        }
	});
});
