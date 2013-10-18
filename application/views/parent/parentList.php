<div class="search">
	<fieldset>
		<legend>Search</legend>
		<form name='search' action=<?=site_url('parent1/index/');?> method='post'>
		<table>
			<tr>
				<td>english title</td>
				<td>Myanmar title</td>					
				<td>Remarks</td>
			</tr>
			<tr>
				<td><input name="eng_title" type='text' value='<?php echo $eng_title; ?>'></td>					
				<td><input name="mya_title" type='text' value='<?php echo $mya_title; ?>'></td>					
				<td><input name="remarks" type='text' value=''></td>
				<td><input type='submit' name='search' value='Search'></td>
			</tr>
		</table>
		</form>
	</fieldset>
</div>
<div class="content">
	<h3>Parent Details</h3>
	<br />				
	<div class="data"><?php echo $table; ?></div>
	<div class="paging"><?php echo $pagination; ?></div>
</div>