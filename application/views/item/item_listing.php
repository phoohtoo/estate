<?php
echo anchor('admin/','Back to admin page');
?>
 | 
<?php
echo anchor('item/add','Add a new item');
?>
<br>
	<div class="search"> 
	<?php 
	echo form_open('item/listing');
	?>
	 English Title :
	 <?php
	echo form_input('eng_title');
	?>
Myanmar Title :
	<?php  echo form_input('mya_title'); ?>
Property Type :
	<?php  echo form_input('type_name'); ?>
	<br>
Location :
	<?php  echo form_input('location'); ?>
Description :
	<?php 
	echo form_input('description'); 
	?>
Remark :
	<?php 
	echo form_input('remark'); 
	
	echo form_submit('search','Search');
	echo form_close();
	?>
	</div>
<br>
<div class="paging">
	<?php echo $pagination; ?></div>
	<div class="table table-striped table-bordered table-condensed">
	<?php echo $data_table; ?></div>

	<div class="paging"><?php echo $pagination; ?></div>
<br>
<?php
echo anchor('admin/','Back to admin page');
?>
 | 
<?php
echo anchor('item/add','Add a new item');

?>
