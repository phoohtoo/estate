<?php
echo anchor('item/listing/','Back');
echo form_open_multipart('item/create');
$field_array=array('eng_title','mya_title','type_name','location','description','photo','business_or_residence','sale_or_rent','remark','is_active','is_deleted');



foreach($field_array as $field)
{
		
	
	if($field=='type_name')
	{
	echo '<p>'.$field;
	echo $typeList;
	//echo  form_dropdown($field,$data, '#', 'id="country"');
	}
		else if($field=='business_or_residence')
	{
	$num=-1;
	echo '<p>';	
	echo ' '.form_radio($field, 2, true).'Any ';
	echo ' '.form_radio($field, 0,$num==0).'Business ';
	echo ' '.form_radio($field, 1, $num==1).'Residence ';


	}
	else if($field=='sale_or_rent')
	{
	echo '<p>For';
	echo ' '.form_radio($field, 2,true).'Any ';
	echo ' '.form_radio($field, 0,  $num==0).'Sales ';
	echo ' '.form_radio($field, 1, $num==1).'Rent ';

	}
	else if($field=='is_active')
	{
	echo '<p>Status';
	echo ' '.form_radio($field, 0, true).'Active  ';
	echo ' '.form_radio($field, 1, $num==1).'Inactive ';

	}
	else if($field=='is_deleted')
	{
	echo '<p>Action';
	echo ' '.form_radio($field, 0, true).' Normal';
	echo ' '.form_radio($field, 1, $num==1).'Deleted ';

	}
	
	else if($field=='photo')
	{
		echo '<p>'.$field;
		echo form_upload(array('name'=>$field)).'</p>';
		//echo "<input  id='name' type='file'  name='feed_path' ></input>";
	}	
	else
	{
		echo '<p>'.$field;
		echo form_input(array('name'=>$field)).'</p>';
	}
}
echo '<p>';
echo form_submit('','Add','class="btn btn-large"');
echo form_close();
echo anchor('item/listing/','Back');
?>