<?php
If(!defined('BASEPATH')) 
exit('No direct script access allowed');

class Login extends CI_Controller
{
	function index()
	{
		$data['title']="Estate: Login";
		$data['headline']="Login";
		$data['main_content']='login';
		$this->load->view('includes/template3',$data);
	}
	
	function validate_credentials()
	{
		$this->load->model('account_model');
		$query=$this->account_model->validate();
		if($query)
		{
			$data=array(
			'username'=>$this->input->post('username'),
			'is_logged_in'=>true
			);
		
		$this->session->set_userdata($data);
		redirect('admin');
		}
		else
		{
		$this->index();
		}
	}
	
	function signup()
	{
		$data['main_content']='signup';
		$this->load->view('includes/template',$data);
	}
	
	function create_account()
	{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('first_name','First Name','trim|required');
			$this->form_validation->set_rules('last_name','Last Name','trim|required');
			$this->form_validation->set_rules('email_address','Email Address','trim|required|valid_email');
			$this->form_validation->set_rules('username','Username','trim|required|min_length[4]');
			$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[32]');
			$this->form_validation->set_rules('password2','Password Confirmation','trim|required|matches[password]');
			
			if($this->form_validation->run()==FALSE)
			{
				$this->signup();
			}
			else
			{
				$this->load->model('account_model');
				if($query=$this->account_model->create_account())
				{
					$data['main_content']='signup_successful';
					$this->load->view('includes/template',$data);
				}
				
			}
			
	}
}
?>