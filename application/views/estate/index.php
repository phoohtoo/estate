<?php

$dataArray=array();

?>

<?php 
	$i=0;
	foreach($data_Array as $data_table)
	{
	?>

		<div class="table table-striped table-bordered table-condensed">
<?php	
			echo $data_table; 
			 $page=$pag_Array[$i];
			 $i++;

?>
			 
		 </div>
<?php
			 echo $page;
} ?>
<div class="paging">
	<?php //echo $pagination; ?></div>