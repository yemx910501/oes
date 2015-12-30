<?php
/*********************************************************************
*   			返回json，用于弹出提示信息
*statusCode —— 状态码（200：操作成功，300：操作失败，301：会话超时）
*message —— 提示信息
*navTabId —— 指定刷新
*callbackType —— closeCurrent：关闭当前tab，forward：forwardUr
*rel
*forwardUrl —— 只有callbackType="forward"时需要forwardUrl值
*confirmMsg
*********************************************************************/
	header("Content-type: text/html;charset=utf-8");
	echo "{";
	echo '"statusCode":"' . $statusCode . '",';
	echo '"message":"' . $message . '",';
	echo '"navTabId":"' . $navTabId . '",';
	echo '"callbackType":"' . $callbackType . '",';
	echo '"rel":"' . $rel . '",'; 
	echo '"forwardUrl":"' . $forwardUrl . '",';
	echo '"confirmMsg":"' . $confirmMsg . '"';
	echo "}";
?>