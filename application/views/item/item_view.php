<?php


$field_array=array('eng_title','mya_title','type_name','location','description','photo','business_or_residence','sale_or_rent','remark','is_active','is_deleted');

echo anchor('item/listing/','Back');

foreach($field_array as $field_name)
{
	echo '<p>'.$field_name .' : ';
	if ($field_name=='photo') echo '<a href="'.base_url().'assets/uploads/original/'.$row->$field_name.'" target="_blank"><img src="'.base_url().'assets/uploads/thumbs/thumb_'.$row->$field_name.'"/></a>';
	else echo $row->$field_name.'</p>';
	}
	

echo '<p>';
echo anchor('item/listing/','Back');

?>