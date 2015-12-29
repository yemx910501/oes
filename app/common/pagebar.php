<?php
/************************************************************
*   			           分页条
************************************************************/
	$numRows = 0;
?>
<div class="panelBar">
	<div class="pages">
		<span>显示</span>
		<select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
			<?php 
				for ($i=1; $i<=5; $i++) {
					$j = $i * 10;
					echo "<option value='$j'" . ($pageSize==$j?'selected':'') . ">$j</option>";
				}
			?>
		</select>
		<span>条，共<?php echo $numRows;?>条</span>
	</div>
	
	<div class="pagination" targetType="navTab" totalCount="<?php echo $numRows;?>" numPerPage="<?php echo $pageSize;?>" pageNumShown="10" currentPage="<?php echo $currentPage;?>"></div>
</div>