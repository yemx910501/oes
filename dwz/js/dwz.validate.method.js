/**
 * @requires jquery.validate.js
 * @author ZhangHuihua@msn.com
 */
(function($){
	if ($.validator) {
		$.validator.addMethod("alphanumeric", function(value, element) {
			return this.optional(element) || /^\w+$/i.test(value);
		}, "Letters, numbers or underscores only please");
		
		$.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^[a-z]+$/i.test(value);
		}, "Letters only please"); 
		
		$.validator.addMethod("phone", function(value, element) {
			return this.optional(element) || /^[0-9 \(\)]{7,30}$/.test(value);
		}, "Please specify a valid phone number");
		
		$.validator.addMethod("postcode", function(value, element) {
			return this.optional(element) || /^[0-9 A-Za-z]{5,20}$/.test(value);
		}, "Please specify a valid postcode");
		
		$.validator.addMethod("date", function(value, element) {
			value = value.replace(/\s+/g, "");
			if (String.prototype.parseDate){
				var $input = $(element);
				var pattern = $input.attr('dateFmt') || 'yyyy-MM-dd';
	
				return !$input.val() || $input.val().parseDate(pattern);
			} else {
				return this.optional(element) || value.match(/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/);
			}
		}, "Please enter a valid date.");
		
		/* 验证真实姓名 */
		$.validator.addMethod("truename", function(value, element) {
			return this.optional(element) || /^[\u4e00-\u9fa5]{2,10}$/.test(value);
		}, "Please specify a valid truename");
		
		/* 验证身份证 */
		$.validator.addMethod("idnumber", function(value, element) {
			return this.optional(element) || /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/.test(value);
		}, "Please specify a valid idnumber");
		
		/* 验证手机号码 */
		$.validator.addMethod("mobilephone", function(value, element) {
			return this.optional(element) || /^[0-9]{11}$/.test(value);
		}, "Please specify a valid mobilephone");
		
		/* 验证地址 */
		$.validator.addMethod("address", function(value, element) {
			return this.optional(element) || /^.{1,100}$/.test(value);
		}, "Please specify a valid address");
		
		/* 验证试题分数 */
		$.validator.addMethod("score", function(value, element) {
			var flag = false, 
				OK_flag = true;
			if (/^[0-9]+(.[0-9]{1,1})?$/.test(value)) {
				if (value.indexOf(".") >= 0) {
					var decimal_part = value.split(".")[1];
					if (decimal_part != "5") {
						OK_flag = false; //小数部分必须为5
					} 
				}
				if (OK_flag) {
					//value = value.replace(/\s+/g,"");
					value = parseFloat(value);
					if (value>0 && value<=100) {
						flag = true;
					}
				}
			}
			return this.optional(element) || flag;
		}, "Please specify a valid score");
		
		/* 验证试题试题内容 */
		$.validator.addMethod("content", function(value, element) {
			var flag = true;
			if(value.indexOf(";")>=0 || value.indexOf("；")>=0){
				// 含有分号
				flag = false;
			}
			return this.optional(element) || flag;
		}, "Please specify a valid content");
		
		/* 验证试卷名 by ymx 2014/9/10*/
		$.validator.addMethod("tpname", function(value, element) {
			var flag = true;
			if(value.indexOf("\\")!=-1){
				//含有反斜杠
				flag = false;
			}
			return this.optional(element) || flag;
		}, "Please specify a valid tpname");
		
		/* 验证考试时间 by ymx 2014/10/15*/
		$.validator.addMethod("allowtime", function(value, element) {
			var flag = true;
			if(value<=0 || value>120){
				//时间范围：0~120(不包括0)
				flag = false;
			}
			return this.optional(element) || flag;
		}, "Please specify a valid allowtime");
		
		/* 验证ip地址 by ymx 2014/12/1*/
		$.validator.addMethod("ipAddress", function(value, element) {
			return this.optional(element) || /^(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.)(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.){2}([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))$/.test(value);
		}, "Please specify a valid ipAddress");
		
		/*自定义js函数验证
		 * <input type="text" name="xxx" customvalid="xxxFn(element)" title="xxx" />
		 */
		$.validator.addMethod("customvalid", function(value, element, params) {
			try{
				return eval('(' + params + ')');
			}catch(e){
				return false;
			}
		}, "Please fix this field.");
		
		$.validator.addClassRules({
			date: {date: true},
			alphanumeric: { alphanumeric: true },
			lettersonly: { lettersonly: true },
			phone: { phone: true },
			postcode: {postcode: true},
			truename: {truename: true},
			idnumber: {idnumber: true},
			mobilephone: {mobilephone: true},
			address: {address: true},
			score: {score: true},
			content: {content: true},
			tpname: {tpname: true},
			allowtime: {allowtime: true},
			ipAddress: {ipAddress:true}
		});
		$.validator.setDefaults({errorElement:"span"});
		$.validator.autoCreateRanges = true;
		
	}

})(jQuery);