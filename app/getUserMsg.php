<?php
/************************************************************
*   					获取用户的菜单
************************************************************/
	$empNo = $_SESSION['EmpNo'];
	
	include 'common/commonFunc.php';
	$conn = createConn("mcteexam", "readonly");
	
	$user_rs = mysql_query("select * from user where empno = '" . $empNo . "'"); //查询登录用户是否为普通人员
	$count = mysql_num_rows($user_rs);
	if($count==0){
		//普通用户
		$menu_rs = mysql_query("select distinct m.* from menu m join rolemenurelation rm on m.menuid=rm.menuid where rm.roleid = 3 order by m.sort");
	}else{
		//管理员
		$menu_rs = mysql_query("select distinct m.* from menu m join rolemenurelation rm on m.menuid=rm.menuid join userrolerelation ur 
			on rm.roleid=ur.roleid join user u on u.userid=ur.userid where u.empno='" . $empNo . "' order by m.sort");
	}
	
	$lineAssistants = array(); //生产助理
	$lineAssistant_rs =  mysql_query("select u.empno from user u join userrolerelation urr on u.userid=urr.userid where urr.roleid = 5"); //查找所有生产助理的userid
	while($lineAssistant = mysql_fetch_array($lineAssistant_rs)){
		$lineAssistants[] = $lineAssistant['empno'];
	}
	
	$paging_rs = mysql_query("select pval from param where pname='pageSize'");
	$paging_param = mysql_fetch_assoc($paging_rs);
	$_SESSION['pageSize'] = $paging_param['pval'];
?>