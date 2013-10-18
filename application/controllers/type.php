<?php
class type extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
	}
	
	function create()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
			$data['title']="Estate: Add Property Type";
			$data['headline']="Add a New Property Type";		
			$data['main_content']='type/type_add';
			$this->load->view('includes/template2',$data);
		}
		else
		{
		$this->load->model('type_model','',TRUE);
		$this->type_model->addtype($_POST);
		redirect('type/listing','refresh');
		}
	}
	

	
	function add()
	{

		$data['title']="Estate: Add Property Type";
		$data['headline']="Add a New Property Type";
		
		$data['main_content']='type/type_add';
		$this->load->view('includes/template2',$data);
	}
	

	
	function listing()
	{
		$this->load->model('type_model','',TRUE);
		$type_qty=$this->type_model->listTypes();
		
		$this->table->set_heading('','Type Name');
		
		$table_row=array();
		foreach($type_qty->result() as $type)
		{
			$table_row=null;

			$table_row[]='<nobr>'.
			anchor('type/edit/'.$type->id,'edit').' | '.
			anchor('type/delete/'.$type->id,'delete',
			"onClick=\" return confirm('Are you sure you want to ' +
			'delete the record for $type->name?')\"").
			'</nobr>';
			$table_row[]=$type->name;

			
			$this->table->add_row($table_row);
		}
		
		$types_table=$this->table->generate();
		$data['title']="Estate: Property Type Listing";
		$data['headline']="Property Type Listing";

		$data['data_table']=$types_table;
		$data['main_content']='type/type_listing';

		$this->load->view('includes/template4',$data);	

	}
	
	function edit()
	{
	
		$id=$this->uri->segment(3);
		$this->load->model('type_model','',TRUE);
		$data['row']=$this->type_model->getTypes($id)->result();
		
		$data['title']="Estate: Edit Property Type";
		$data['headline']="Edit Property Type Information";
		$data['main_content']='type/type_edit';
		
		$this->load->view('includes/template2',$data);
	}
	
	function update()
	{
		$this->load->model('type_model','',TRUE);
		$this->type_model->updateType($_POST['id'],$_POST);
		redirect('type/listing','refresh');
	}
	function delete()
	{
		$id=$this->uri->segment(3);
		
		$this->load->model('type_model','',TRUE);
		$this->type_model->deleteType($id);
		redirect('type/listing','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
//		$this->form_data->id = '';
		//$this->form_data->name = '';
		
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Type Name', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>