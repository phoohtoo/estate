<?php 
If(!defined('BASEPATH')) 
exit('No direct script access allowed');

class estate extends CI_Controller
{

	var $terms     = array();
	var $purpose_str="";
	var $trans_str="";
	private $limit = 5;
	//var $business_or_residence = array(0,1,2);
//	var $sales_or_rent = array(0,1,2);
	public function index()
	{
		$this->load->view('header');
		$this->load->view('estate');
		$this->load->view('footer');
	}
	
	function preview()
	{
		$keys = "";
		$uri_segment = 5;
		$offset = $this->uri->segment($uri_segment,'');	
		

		//$this->load->model('item_model','',TRUE);
		//$item_qty=$this->item_model->listItems();
	//$items_table=$this->table->generate();
		//$data['data_table']=$item_qty;
		//$offset = $this->uri->segment(3,0);	
		
		// gets total URI segments
		

		$total_seg = $this->uri->total_segments();	
		
		//Loop each tables
		$this->load->model('type_model');
		$type_list=$this->type_model->listTypes()->result();

		 if($total_seg==4)
		 {

			$business_or_residence = $this->uri->segment(3,0);	
			$sales_or_rents = $this->uri->segment(4,0);	
			switch($business_or_residence)
			{
				case 0: $purpose_str="Business Only"; break;
				case 1: $purpose_str="Residence Only"; break;
				case 2: $purpose_str="Both Business And Residence"; break;
			}
			
			switch($sales_or_rents)
			{
				case 0: $trans_str="Sales Only"; break;
				case 1: $trans_str="Rent Only"; break;
				case 2: $trans_str="Both Sales And Rent"; break;
			}
			//echo $business_or_residence.' ';
			//echo $sales_or_rents.' ';
			//if first value is 1 ,  business type and both type items are showed
			//if first value is 2, residence type and both type items are showed
			//if second value is 1 , sales type items are showed.
			//if second value is 2 , rent type items are showed.		
		//$this->load->model('item_model');
		//$item_list=$this->item_model->get_paged_list(5,0)->result();
		 }
		
		$dataArray=array();
		$pagArray=array();
		//echo $business_or_residence;
		//echo $sales_or_rents;
		$arrayIndex=0;
		foreach($type_list as $type)
		{
		//echo $type->name;
		
		$this->load->model('item_model');
		$item_list=$this->item_model->get_paged_list_2($this->limit,$offset,$business_or_residence,$sales_or_rents,$type->name)->result();
		$total_count = $this->item_model->count_by($business_or_residence,$sales_or_rents,$type->name);

		
		
		if ($total_count>0)
		{

		$config['base_url'] = site_url('/estate/preview').'/0/2';
  		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		
		$config['total_rows']=$total_count;
		
		$this->pagination->initialize($config);
		$links = $this->pagination->create_links();
		$this->table->set_empty("&nbsp;");
		
		
		$heading=array($type->name);
		
		$this->table->set_heading($heading);

		
		$i=0;
		$table_row=array();
		
		foreach($item_list as $item)
		{		
			$table_row=null;
			$table_row[]=++$i;
			//$table_row[]=$item->order_no;
			$table_row[]=ellipsize($item->eng_title,15,1);
			$table_row[]=ellipsize($item->mya_title,25,1);
			$table_row[]=ellipsize($item->type_name,20,1);
			//$table_row[]=$item->name;
			$table_row[]=ellipsize($item->location,25,1);	
			$table_row[]=ellipsize($item->description,25,1);
			$table_row[]='<a href="'.base_url().'assets/uploads/original/'.$item->photo.'" target="_blank"><img src="'.base_url().'assets/uploads/thumbs/thumb_'.$item->photo.'"/></a>';
			$temp=$item->business_or_residence;
			if($temp==0)  $table_row[]='Business';
			else if($temp==1) $table_row[]='Residence';
			else if($temp==2) $table_row[]='Any';
			
			$temp=$item->sale_or_rent;
			if($temp==0)  $table_row[]='Sales';
			else if($temp==1) $table_row[]='Rent';
			else if($temp==2) $table_row[]='Any';
			/*
			$table_row[]=ellipsize($item->remark,25,1);
			if($item->is_active) $table_row[]='Inactive';
			else $table_row[]=' Active';
			if($item->is_deleted) $table_row[]='Deleted';
			else $table_row[]='';
			
			*/
			$table_row[]='<nobr>'.
			anchor('item/view/'.$item->id,'view details')
			;
			
			$this->table->add_row($table_row);
			//$this->table->add_row($table_row);
			//$this->table->add_row(++$i, $parent->eng_title, $parent->mya_title);
		}
		$items_table=$this->table->generate();		
		$dataArray[]=$items_table;
		$pagArray[]=$links;
	
		}
		
	}
	//exit();
		
		$data['data_Array']=$dataArray;
		$data['pag_Array']=$pagArray;
		$data['title']="Estate: Property Item Listing";
		$data['headline']="Property Item Listing - ".$purpose_str.",".$trans_str;
		$data['main_content']='estate/index';			
		$this->load->view('includes/template2',$data);	
	}
		
	
	
	
	

}

?>