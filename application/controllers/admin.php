<?php 
If(!defined('BASEPATH')) 
exit('No direct script access allowed');

class admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}
	
	function is_logged_in()
	{
		$is_logged_in=$this->session->userdata('is_logged_in');
		if(!isset($is_logged_in)||$is_logged_in!=true)
		{
			echo 'You don\'t have permission to access this page.<a href="../index.php/login">Login</a>';
			die();
		}
	}
	
	public function index()
	{
		
		$data['title']="Estate: Admin Panel";
		$data['headline']="Admin Panel";

		$data['main_content']='admin/admin';
		$this->load->view('includes/template4',$data);
		
		
		
	}
	
	
	
}

?>