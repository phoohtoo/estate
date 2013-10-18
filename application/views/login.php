
	
	
	<?php
	$attributes = array('class' => 'form-signin');
	echo form_open('login/validate_credentials',$attributes); ?>
	<h2 class="form-signin-heading">Please login!</h2>
	<?php
	echo form_input('username','','class="input-block-level" placeholder="User Name"');
	echo form_input('password','','class="input-block-level" placeholder="Password"');
	echo form_submit('submit','Login','class="btn btn-large btn-primary"');
	echo '<br><br>';
	echo anchor('login/signup','Create Account');
	echo form_close();
	
	echo '<br><br>';
	

	?>

	