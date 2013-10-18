<?php
echo anchor('type/listing/','Back');

echo form_open('type/create');
$field_array=array('name');
foreach($field_array as $field)
{
	echo '<p>Type Name';
	echo form_input(array('name'=>$field)).'</p>';
	echo form_error('name');
}
echo form_submit('','Add');

echo form_close();

echo anchor('type/listing/','Back');
?>