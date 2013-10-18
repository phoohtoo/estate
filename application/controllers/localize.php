<?php
class Localize extends CI_Controller {
public function index()
{

//get posted language
if(isset($_POST['language']))
{
$language = $_POST['language'];

//redirect('item/listing','refresh');
}
else
{
$language = "english";
}

// load language file
//$this->load->helper('language');
$this->lang->load('codepursuit', $language);

$this->load->view('localizeTest');
}
}



?>