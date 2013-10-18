<body>
<Head>
<title>
Language Setting
</title>

<?=lang('title')?> 


<form action="http://localhost/estate/index.php/localize" name="language" method="post">
		<select style="width: 200px;" class="language" name="language" onchange="this.form.submit();">
				<option value="english">-- Select Language --</option>
				<option value="english">English</option>
				<option value="myanmar-zg">Myanmar</option>
				
		</select>
</form>
</bodY>
</html>