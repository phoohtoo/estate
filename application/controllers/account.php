<?php
class account extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
	/*
		$data['title']="Classroom: Home Page";
		$data['headline']="Welcome to the Classroom Management System";
		$data['include']='student_index';
		
		$this->load->view('template',$data);
		*/
	}
	
	function add()
	{
		$data['title']="Estate: Add Account";
		$data['headline']="Add a New Account";
		
		$data['main_content']='account/account_add';
		$this->load->view('includes/template2',$data);
	}
	
	function create()
	{
		
		$this->load->model('account_model','',TRUE);
		$this->account_model->addAccount($_POST);
		redirect('account/listing','refresh');
	}
	
	function listing()
	{
		$this->load->model('account_model','',TRUE);
		$accounts_qty=$this->account_model->listAccounts();
		
		$this->table->set_heading('','User Name','First Name','Last Name','Email Address');
		
		$table_row=array();
		foreach($accounts_qty->result() as $account)
		{
			$table_row=null;
			//$table_row[]=anchor('student/edit/'.$student->id,'edit');
			$table_row[]='<nobr>'.
			anchor('account/edit/'.$account->id,'edit').' | '.
			anchor('account/delete/'.$account->id,'delete',
			"onClick=\" return confirm('Are you sure you want to ' +
			'delete the record for $account->username?')\"").
			'</nobr>';
			$table_row[]=$account->username;
			$table_row[]=$account->first_name;
			$table_row[]=$account->last_name;
			$table_row[]=mailto($account->email_address);
			
			$this->table->add_row($table_row);
		}
		
		$accounts_table=$this->table->generate();
		$data['title']="Estate: Account Listing";
		$data['headline']="Account Listing";

		$data['data_table']=$accounts_table;
		$data['main_content']='account/account_listing';

		$this->load->view('includes/template4',$data);	

	}
	
	function edit()
	{
	
		$id=$this->uri->segment(3);
		$this->load->model('account_model','',TRUE);
		$data['row']=$this->account_model->getAccounts($id)->result();
		
		$data['title']="Estate: Edit Account";
		$data['headline']="Edit Account Information";
		$data['main_content']='account/account_edit';
		
		$this->load->view('includes/template2',$data);
	}
	
	function update()
	{
		$this->load->model('account_model','',TRUE);
		$this->account_model->updateAccount($_POST['id'],$_POST);
		redirect('account/listing','refresh');
	}
	function delete()
	{
		$id=$this->uri->segment(3);
		
		$this->load->model('account_model','',TRUE);
		$this->account_model->deleteAccount($id);
		redirect('account/listing','refresh');
	}
}
?>