<?php

echo anchor('account/listing/','Back');

echo form_open('account/update');
echo form_hidden('id',$row[0]->id);

$field_array=array('first_name','last_name','email_address','username');
foreach($field_array as $field_name)
{
	echo '<p>'.$field_name;
	echo form_input($field_name,$row[0]->$field_name).'</p>';
}
echo form_submit('','Update');
echo form_close();

echo anchor('account/listing/','Back');
?>