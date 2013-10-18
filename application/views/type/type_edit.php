<?php
echo anchor('type/listing/','Back');

echo form_open('type/update');
echo form_hidden('id',$row[0]->id);

$field_array=array('name');
foreach($field_array as $field_name)
{
	echo '<p>Type Name';
	echo form_input($field_name,$row[0]->$field_name).'</p>';
	echo form_error('type_name');
}
echo form_submit('','Update');
echo form_close();

echo anchor('type/listing/','Back');
?>