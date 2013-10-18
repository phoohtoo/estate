<?php
class item extends CI_Controller
{

	
	// num of records per page
	private $limit = 5;
 
	// empty array for search terms
	var $terms     = array();
	var $upload_status=false;
	
	function __construct()
	{
		parent::__construct();
		
		// load model
		$this->load->model('item_model','',TRUE);
		$this->load->model('type_model','',TRUE);
		
	}
	
	function index()
	{
		
	}
	
	function add()
	{

		$data['title']="Estate: Add Property Item";
		$data['headline']="Add a New Property Item";
		
		$data['main_content']='item/item_add';
		
		
		$type_array =$this->type_model->get_all_clean_array();	
	// Construct the progress drop down list.
	// We use the form_dropdown helper:
		$indice = 0;
		$data['typeList']=form_dropdown('type_name', $type_array, $indice); 	
		$this->load->view('includes/template2',$data);
	}
	

	
	function listing($offset = 0, $order_column = 'id', $order_type = 'asc')
	{
		//$trim_size=$config['trim_size'];
		$item_qty;
		// offset
		$uri_segment = 3;
		
		//$purpose=2;
		//$trans=0;
		//$type='သူေဌးအိမ္';
		
		// return third URI segment, if no third segment returns '' 
		$offset = $this->uri->segment($uri_segment,'');	
			
		// assign posted valued
		$data['eng_title'] = $this->input->post('eng_title');
		$data['mya_title'] = $this->input->post('mya_title');	
		$data['type_name'] = $this->input->post('type_name');
		$data['location'] = $this->input->post('location');
		$data['description'] = $this->input->post('description');
		$data['remark'] = $this->input->post('remark');
		
		// gets total URI segments
		$total_seg = $this->uri->total_segments();	
		
		if (empty($offset)) $offset = 0;
		if (empty($order_column)) $order_column = 'id';
		if (empty($order_type)) $order_type = 'asc';
		
		// set search params
		// enters here only when 'Search' button is pressed or through 'Paging'
		if(isset($_POST['search']) && $total_seg>3)
		{			
 
			//$default = array('clientname', 'group', 'remarks');
			$default = array('eng_title', 'mya_title','type_name','location','description','remark');
			if($total_seg > 3){
 			// navigation from paging									
 
				/**
				 *
				 * Convert URI segments into an associative array of key/value pairs
				 * But this array also contains the last redundant key value pair taking the page number as key.
				 * So, the last key value pair must be removed.				 
				 *
				*/
 
				$this->terms = $this->uri->uri_to_assoc(3,$default); 
 
				/**
				 * Replacing all the 'unset' values in the associative array (with keys as in $default array) to null value
				 * and create a new array '$this->terms_uri' taking only the database keys we need to query, 				
				**/
 
				for($i=0;$i<count($default);$i++){										
					if($this->terms[$default[$i]] == 'unset'){
						$this->terms[$default[$i]] = '';						
						$this->terms_uri[$default[$i]] = 'unset';
 
					}else{
						$this->terms_uri[$default[$i]] = $this->terms[$default[$i]];		
					}									
				}				
 
				// When the page is navigated through paging, it enters the condition below
				if(($total_seg % 2) > 0){					 		 
					// exclude the last array item (i.e. the array key for page number), prepare array for database query
					$this->terms = array_slice($this->terms, 0 , (floor($total_seg/2)-1));					
 
					$offset = $this->uri->segment($total_seg, '');		
					$uri_segment = $total_seg;
				}
 
				// Convert associative array $this->terms_uri to segments to append to base_url
				$keys = $this->uri->assoc_to_uri($this->terms_uri);		
 
				$item_qty = $this->item_model->get_search_pagedlist($this->terms,$this->limit, $offset)->result();
 
				// set total_rows config data for pagination			
				$config['total_rows'] = $this->item_model->count_all_search($this->terms);		
 
				$this->terms = array();								// resetting terms array
				$this->terms_uri = array();							// resetting terms_uri array
			}
			else
			{
			// navigation through POST search button
 
				$searchparams_uri = array();
 
				for($i=0;$i<count($default);$i++){
					if($this->input->post($default[$i]) != ''){						
						$searchparams_uri[$default[$i]] = $this->input->post($default[$i]);
						$data[$default[$i]] = $this->input->post($default[$i]);						
					}else{										
						$searchparams_uri[$default[$i]] = 'unset';
						$data[$default[$i]] = '';						
					}
				}			
 
				// Replace all the 'unset' values in an associative array to null value and create a new array '$searchparams' for database processing
				foreach($searchparams_uri as $k=>$v){
					if($v != 'unset'){
						$searchparams[$k] = $v;
					}else{
						$searchparams[$k] = '';
					}					
				}					
 
				$item_qty = $this->item_model->get_search_pagedlist($searchparams,$this->limit, $offset)->result();
 
				// turn associative array to segments to append to base_url
				$keys = $this->uri->assoc_to_uri($searchparams_uri);	
 
				// set total_rows config data for pagination			
				$config['total_rows'] = $this->item_model->count_all_search($searchparams);
			}
		}
		else
		{
		// load data
			//$parents = $this->parentmodel->get_paged_list($this->limit, $offset)->result();
			$item_qty=$this->item_model->get_paged_list($this->limit,$offset,$order_column, $order_type)->result();
			//echo $offset.' offset';
			//exit();
		//	echo $offset;
		//	exit();
		//	$item_qty=$this->item_model->get_paged_list_2($this->limit,$offset,$purpose,$trans,$type)->result();
			// set total_rows config data for pagination
			$config['total_rows'] = $this->item_model->count_all();
			//$total_rows=$this->item_model->count_by($purpose,$trans,$type);
			//echo $total_rows;
			//exit();
			//$config['total_rows'] = $this->item_model->count_by($purpose,$trans,$type);
			$searchparams = "";
			$keys = "";
		}
		
		$config['base_url'] = site_url('item/listing/').'/'.$keys.'/';
  		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
 
		$this->table->set_empty("&nbsp;");
		
		$new_order = ($order_type == 'asc' ? 'desc' : 'asc');
		//anchor('item/listing/'.$offset.'/mya_title/'.$new_order, 'Title in Myanmar'),
		//$heading=array('','Order No','Title in English','Title in Myanmar','Property Type'','Location','Description','Photo','Business/Residence','Sales/Rent','Remark','Status','Action');
		$heading=array('No.',
		anchor('item/listing/'.$offset.'/eng_title/'.$new_order, 'Title in English'),
		anchor('item/listing/'.$offset.'/mya_title/'.$new_order, 'Title in Myanmar'),
		anchor('item/listing/'.$offset.'/type_name/'.$new_order, 'Property Type'),
		anchor('item/listing/'.$offset.'/location/'.$new_order, 'Location'),
		anchor('item/listing/'.$offset.'/description/'.$new_order, 'Description'),
		'photo',
		anchor('item/listing/'.$offset.'/business_or_residence/'.$new_order, 'Business/Residence'),
		anchor('item/listing/'.$offset.'/sale_or_rent/'.$new_order, 'Sale/Rent'),
		anchor('item/listing/'.$offset.'/remark/'.$new_order, 'Remark')
		,'Status','State','Action');
		
		$this->table->set_heading($heading);
		
		$i = 0 + $offset;
		
		$table_row=array();
		
		foreach($item_qty as $item)
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

			$table_row[]=ellipsize($item->remark,25,1);
			if($item->is_active) $table_row[]='Inactive';
			else $table_row[]=' Active';
			if($item->is_deleted) $table_row[]='Deleted';
			else $table_row[]='';
			
			
			$table_row[]='<nobr>'.
			anchor('item/view/'.$item->id,'view').' | '.
			anchor('item/edit/'.$item->id,'edit').' | '.
			anchor('item/delete/'.$item->id,'delete',
			"onClick=\" return confirm('Are you sure you want to ' +
			'delete the record for $item->eng_title?')\"").
			'</nobr>';
			
			$this->table->add_row($table_row);
			//$this->table->add_row(++$i, $parent->eng_title, $parent->mya_title);
		}
		
		$items_table=$this->table->generate();
		
		$data['title']="Estate: Property Item Listing";
		$data['headline']="Property Item Listing";

		$data['data_table']=$items_table;
		$data['main_content']='item/item_listing';		
		
		$this->load->view('includes/template4',$data);	

	}
	
	
	public function do_upload()
	{
		$config['upload_path'] = './assets/uploads/original/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '100000';
		$config['max_width']  = '2024';
		$config['max_height']  = '868';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			
			echo 'sorry';
			//$this->load->view('upload_form', $error);
			$upload_status=false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			echo 'got it';
			$upload_status=true;
			//$this->load->view('upload_success', $data);
		}
		return $upload_status;
	}
	
	function create()
	{
		
		//echo  $this->input->post('photo');
		//exit();
		
		


		
		$config['upload_path'] = './assets/uploads/original/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '100000';
		$config['max_width']  = '2024';
		$config['max_height']  = '868';

		//$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		
		if ( ! $this->upload->do_upload('photo'))
		{
			$error = array('error' => $this->upload->display_errors());
			
			echo 'sorry';
			//$this->load->view('item/add', 'refresh');
			redirect('item/add');
			$upload_status=false;
			
			
		}
		else
		{
			//$img = array('upload_data' => $this->upload->data());
			$img=$this->upload->data();
			// create thumbnail
            $new_image = 'assets/uploads/thumbs/'.'thumb_'.$img['file_name'];
            
            $c_img_lib = array(
                'image_library'     => 'gd2',
                'source_image'      => $img['full_path'],
                'maintain_ratio'    => TRUE,
                'width'             => 100,
                'height'            => 100,
                'new_image'         => $new_image
            );
            
            $this->load->library('image_lib', $c_img_lib);
            $this->image_lib->resize();
			
			//$this->load->view('upload_success', $data);
		}
		
		
		$type_id=$this->input->post('type_name');
		$type_result=$this->type_model->getTypes($type_id)->row();
		$type_name=$type_result->name;
		$arrNewRecord = array(
		'eng_title' => $this->input->post('eng_title'),
		'mya_title'=> $this->input->post('mya_title'),
		'type_name'=>$type_name,
		'location'=> $this->input->post('location'),
		'description' => $this->input->post('description'),
		'photo' => $img['file_name'],
		'business_or_residence' => $this->input->post('business_or_residence'),
		'sale_or_rent' => $this->input->post('sale_or_rent'),
		'remark' => $this->input->post('remark'),
		'is_active' => $this->input->post('is_active'),
		'is_deleted' => $this->input->post('is_deleted'),
);

		

		$this->item_model->addItem($arrNewRecord);
		
		redirect('item/listing','refresh');
		
	}
	
	
	function view($id)
	{	
	
		//$items_table=$this->table->generate();
		
		$data['title']="Estate: Property Item Details";
		$data['headline']="Property Item Details";

		$data['row']=$item_qty=$this->item_model->getItems($id)->row();
		$data['main_content']='item/item_view';		
		
		$this->load->view('includes/template2',$data);		
		
	}
	

	
	
	function edit()
	{
	
		$id=$this->uri->segment(3);
		$this->load->model('item_model','',TRUE);
		$query=$this->item_model->getItems($id)->row();
		$data['row']=$query;
		
		$data['title']="Estate: Edit Property Item";
		$data['headline']="Edit Property Item Information";
		$data['main_content']='item/item_edit';
		
		$type_array=$this->type_model->get_all_clean_array();	
	// Construct the progress drop down list.
	// We use the form_dropdown helper:
	 $indice = $query->type_name;
	$data['typeList']=form_dropdown('type_name', $type_array, $indice); 
		
		$this->load->view('includes/template2',$data);
	}
	
	function update()
	{
		$this->load->model('item_model','',TRUE);
		
		
		$type_id=$this->input->post('type_name');
		$type_result=$this->type_model->getTypes($type_id)->row();
		$type_name=$type_result->name;
		$arrRecord = array(
		'id'=>$this->input->post('id'),
		'eng_title' => $this->input->post('eng_title'),
		'mya_title'=> $this->input->post('mya_title'),
		'type_name'=>$type_name,
		'location'=> $this->input->post('location'),
		'description' => $this->input->post('description'),
		'photo' => $this->input->post('photo'),
		'business_or_residence' => $this->input->post('business_or_residence'),
		'sale_or_rent' => $this->input->post('sale_or_rent'),
		'remark' => $this->input->post('remark'),
		'is_active' => $this->input->post('is_active'),
		'is_deleted' => $this->input->post('is_deleted'),
);


		$this->item_model->updateItem($_POST['id'],$arrRecord);
		
		//echo $_POST['type_id'];
		redirect('item/listing','refresh');
	}
	function delete()
	{
		$id=$this->uri->segment(3);
		
		$this->load->model('item_model','',TRUE);
		$this->item_model->deleteItem($id);
		redirect('item/listing','refresh');
	}
	
	
}
?>