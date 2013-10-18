<h1><?php  echo $title; ?></h1>
<p>
Hello World!
</p>
<ul>
<?php
foreach($posts as $post) 
{
?>
<li>
<?php 
echo $post;
?>
</li>
<?php
}
?>
</ul>
