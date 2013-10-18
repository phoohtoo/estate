<?php



echo anchor('account/listing/','Back');

echo form_open('account/create');
$field_array=array('first_name','last_name','email_address','username','password');
foreach($field_array as $field)
{
	echo '<p>'.$field;
	echo form_input(array('name'=>$field)).'</p>';
}
echo form_submit('','Add');

echo form_close();


echo anchor('account/listing/','Back');
?>