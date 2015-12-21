<?php
	session_start();

	include 'common/showLanguage.php';
	include "common/UserLang.class.php";
	$userLang = new UserLang();
	$lang = $userLang->get(); //获取用户访问语言
	if($lang=="sc"){
		//简体中文
		$lang_array = $sc;
	}else if($lang=="tc"){
		//繁体中文
		$lang_array = $tc;
	}else{
		//English
		$lang_array = $en;
	}
	
	include 'common/commonFunc.php';
	$conn = createConn("mcteexam", "readonly");
	
	$pageSize = isset($_POST['pageSize'])?$_POST['pageSize']:$_SESSION['pageSize']; //每一页显示的记录数
	$currentPage = isset($_POST['currentPage'])?intval($_POST['currentPage']):1; //设置当前页
	$offset = $pageSize*($currentPage - 1); //计算记录偏移量
	
	$tp_rs = mysql_query("select * from testpaper where isreleased = 'Y' order by endtime desc,starttime desc limit " . $offset . "," . $pageSize);
	$record_rs = mysql_query("select count(*) from testpaper where isreleased = 'Y'"); //取得记录总数$rs，计算总页数用
	$row = mysql_fetch_array($record_rs);
	$numrows = $row[0];
	$pages = intval($numrows/$pageSize); //计算总页数
	if ($numrows%$pageSize){$pages++;}
	
	$tp_hand_ary = array();
	$tp_save_ary = array();
	$ishand_rs = mysql_query("select tpid,ishand from personalscore where empno='" . $_SESSION['EmpNo'] . "'");
	while($tpinfo = mysql_fetch_array($ishand_rs)){
		if($tpinfo['ishand']=="Y"){
			$tp_hand_ary[] = $tpinfo['tpid'];
		}else{
			$tp_save_ary[] = $tpinfo['tpid'];
		}
	}
?>

<link href="css/index.css" rel="stylesheet" type="text/css" media="screen">

<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><span><?php echo $lang_array['home_page_msg'];?></span></li>
		</ul>
	</div>
	<table class="table exam_table" width="100%" layoutH="75">
		<thead>
			<tr>
				<th width="50px"><?php echo $lang_array['exam_schedule'];?></th>
				<th width="130px"><?php echo $lang_array['tpname'];?></th>
				<th width="100px"><?php echo $lang_array['start_time'];?></th>
				<th width="100px"><?php echo $lang_array['end_time'];?></th>
				<th width="40px"><?php echo $lang_array['total_points'];?></th>
				<th width="50px"><?php echo $lang_array['allow_time'];?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				date_default_timezone_set("PRC"); //设置时区
				while($tp = mysql_fetch_array($tp_rs)){
					$starttime = date("Y/m/d H:i:s",$tp['starttime']);
					$endtime = date("Y/m/d H:i:s",$tp['endtime']);
					$nowtime = strtotime(date("Y/m/d H:i:s"));
					$s_time = strtotime($starttime);
					$e_time = strtotime($endtime);
					echo "<tr>";
					if($nowtime<$s_time){
						//考试未开始
						echo "<td class='failsStart'>" . $lang_array['exam_status']['no_start'] . "</td>";
					}else if(!in_array($tp['tpid'],$tp_hand_ary) && $s_time<=$nowtime && $nowtime<=$e_time){
						//当前登录者未交卷且进行中的考试
						echo "<td><a href='index.php?f=testpaper&s=exampaper&a=exampage&tpid=" . $tp['tpid'] . "' target='dialog' class='startTest' 
							rel='exam_" . $tp['tpid'] . "' max='true' title='" . $lang_array['home_page_msg'] . "'>" . (in_array($tp['tpid'],$tp_save_ary)?$lang_array['exam_status']['continue_exam']:$lang_array['exam_status']['start_exam']) 
							. "</a></td>";
					}else if(in_array($tp['tpid'],$tp_hand_ary) && $s_time<=$nowtime && $nowtime<=$e_time){
						//当前登录者已交卷且进行中的考试
						echo "<td class='hasEnded'>" . $lang_array['exam_status']['handed_in'] . "</td>";
					}else{
						echo "<td class='hasEnded'>" . $lang_array['exam_status']['has_ended'] . "</td>";
					}
					echo "<td class='tpname'>" . $tp['tpname'] . "</td>";
					echo "<td>" . date("Y/m/d H:i:s",$tp['starttime']) . "</td>";
					echo "<td>" . date("Y/m/d H:i:s",$tp['endtime']) . "</td>";
					echo "<td>" . $tp['totalscore'] . "</td>";
					echo "<td>" . $tp['allowtime'] . $lang_array['minutes'] . "</td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
	<?php include 'common/pagebar.php';?>
</div>
