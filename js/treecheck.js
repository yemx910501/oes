function kkk(){
	var json = arguments[0], result="";
	//alert(json.checked);
		
	$(json.items).each(function(i){
		result += "<p>name:"+this.name + " value:"+this.value+" text: "+this.text+"</p>";
	});
	$("#resultBox").html(result);
}
