<?php
echo anchor('item/listing/','Back');
echo form_open('item/update');
echo form_hidden('id',$row->id);

$field_array=array('eng_title','mya_title','type_name','location','description','photo','business_or_residence','sale_or_rent','remark','is_active','is_deleted');

foreach($field_array as $field_name)
{
	
	if($field_name=='type_name')
	{
	echo '<p>'.$field_name;
	echo $typeList;
	}
	else if($field_name=='business_or_residence')
	{
	echo '<p>';	
	echo ' '.form_radio($field_name, 2, $row->$field_name==2).'Any ';
	echo ' '.form_radio($field_name, 0,$row->$field_name==0).'Business ';
	echo ' '.form_radio($field_name, 1, $row->$field_name==1).'Residence ';


	}
	else if($field_name=='sale_or_rent')
	{
	echo '<p>For';
	echo ' '.form_radio($field_name, 2, $row->$field_name==2).'Any';
	echo ' '.form_radio($field_name, 0, $row->$field_name==0).'Sales ';
	echo ' '.form_radio($field_name, 1, $row->$field_name==1).'Rent ';

	}
	else if($field_name=='is_active')
	{
	echo '<p>Status';
	echo ' '.form_radio($field_name, 0, $row->$field_name==0).'Active  ';
	echo ' '.form_radio($field_name, 1, $row->$field_name==1).'Inactive ';

	}
		else if($field_name=='is_deleted')
	{
	echo '<p>Action';
	echo ' '.form_radio($field_name, 0, $row->$field_name==0).'Normal  ';
	echo ' '.form_radio($field_name, 1, $row->$field_name==1).'Deleted ';

	}
	else
	{
	echo '<p>'.$field_name;
	echo form_input($field_name,$row->$field_name).'</p>';
	}
	
}
echo '<p>';
echo form_submit('','Update');
echo form_close();
echo anchor('item/listing/','Back');
?>