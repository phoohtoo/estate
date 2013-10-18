<?php 
If(!defined('BASEPATH')) 
exit('No direct script access allowed');

class Hello_world extends CI_Controller
{

	public function index()
	{
	/*	$data=array(
	'title'=>'Hello World',
	'content'=>'This is the content',
	'posts'=>array('Post 1','Post 2','Post 3')
	);*/
	
	//	$this->load->view('header');
	//	$this->load->view('hello_world',$data);
	//	$this->load->view('footer');
	
	$data=array(
	'title'=>'Title goes here',
	);
//	$this->load->library('template');
	$this->template->load('default','content',$data);

	//$this->template->load('default','estate2',$data);
	}
}

?>