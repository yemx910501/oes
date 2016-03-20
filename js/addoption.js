$(document).ready(function(){
	$("#addoption").on("click", function(){
		var op_last = $("input:last", $("#op_dd")),
			op_id = op_last.attr("id"),
			last_no = op_id.substring(3, op_id.length),
			op_value = op_last.val();
		if (op_value != "") {
			var next_no = parseInt(last_no)+1;
			if (next_no <= 90) { // Z
				var capital = String.fromCharCode(next_no); // ASCII码对应字母
				// var capital = lowerLetter.toUpperCase( ); //转大写
				// var lowerLetter = capital.toLowerCase( );  //转小写
				$("#op_dd").append("<span class='textInput option'>选项" + capital + "：</span>"+
					"<input type='text' class='textInput floatLeft' id='op_" + next_no + "' name='options[]'/></br>");
			} else {
				alert("选项数已到最大限度！");
			}
		} else {
			var capital = String.fromCharCode(parseInt(last_no)); // ASCII码对应字母
			alert("选项"+ capital +"不能为空！");
		}
	});
});
