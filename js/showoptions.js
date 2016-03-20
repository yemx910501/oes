$(function(){
	var questionTypeCode = $("#questionType").find("option:selected").val();
	if (questionTypeCode=="X" || questionTypeCode=="D" || questionTypeCode=="P") { // 单选题、多选题、判断题
		$("#answer_dl").hide();
		$("#answer").removeClass("required");
		
		$("#options_dl").show();
		$("#op_65").addClass("required"); // 65——A的ASCAII码
		$("#op_66").addClass("required");
	}
	
	$("#questionType").change(function(){
		var questionTypeCode = $(this).val();
		if (questionTypeCode=="X" || questionTypeCode=="D" || questionTypeCode=="P") { // 单选题、多选题、判断题
			if ($("#options_dl").is(":hidden")) { // 选项已隐藏
				$("#options_dl").show();
				$("#op_65").addClass("required"); // 65——A的ASCAII码
				$("#op_66").addClass("required");
				$("#answer_dl").hide();
				$("#answer").removeClass("required");
			}
		} else { // 其他题型
			if (!$("#options_dl").is(":hidden")) { // 选项已显示
				$("#options_dl").hide();
				$("#op_65").removeClass("required");
				$("#op_66").removeClass("required");
				
				$("#answer_dl").show();
				$("#answer").addClass("required");
			}
		}
	});
});
