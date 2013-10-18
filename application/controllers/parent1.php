<?php
class Parent1 extends CI_Controller {
 
	// num of records per page
	private $limit = 5;
 
	// empty array for search terms
	var $terms     = array();		
 
	function __construct()
	{
		parent::__construct();
 
		// load model
		$this->load->model('parentmodel','',TRUE);
 
		// load helper
		$this->load->helper('url');
	}
 
	function index()
	{		
		// offset
		$uri_segment = 3;
 
		// return third URI segment, if no third segment returns '' 
		$offset = $this->uri->segment($uri_segment,'');			
 
		// assign posted valued
		$data['eng_title'] = $this->input->post('eng_title');
		$data['mya_title']      = $this->input->post('mya_title');		
		//$data['remarks']    = $this->input->post('remarks');
 
		// gets total URI segments
		$total_seg          = $this->uri->total_segments();			 
 
		// set search params
		// enters here only when 'Search' button is pressed or through 'Paging'
		if(isset($_POST['search']) || $total_seg>3)
		{			
 
			//$default = array('clientname', 'group', 'remarks');
				$default = array('eng_title', 'mya_title');
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
 
				$parents = $this->parentmodel->get_search_pagedlist($this->terms,$this->limit, $offset)->result();
 
				// set total_rows config data for pagination			
				$config['total_rows'] = $this->parentmodel->count_all_search($this->terms);		
 
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
 
				$parents = $this->parentmodel->get_search_pagedlist($searchparams,$this->limit, $offset)->result();
 
				// turn associative array to segments to append to base_url
				$keys = $this->uri->assoc_to_uri($searchparams_uri);	
 
				// set total_rows config data for pagination			
				$config['total_rows'] = $this->parentmodel->count_all_search($searchparams);
			}
		}
		else{
			// load data
			$parents = $this->parentmodel->get_paged_list($this->limit, $offset)->result();
 
			// set total_rows config data for pagination
			$config['total_rows'] = $this->parentmodel->count_all();
			$searchparams = "";
			$keys = "";
		}			
 
	
 
		$config['base_url'] = site_url('parent1/index/').'/'.$keys.'/';
  		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
 
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
 
		//$heading = array('No','Clientname', 'Group', 'Remarks');				
		$heading = array('No','English Title', 'Myanmar Title');
		
		$this->table->set_heading($heading);
		
		$i = 0 + $offset;
		foreach ($parents as $parent){			
			$this->table->add_row(++$i, $parent->eng_title, $parent->mya_title);
		}
		$data['table'] = $this->table->generate();		
 
		// load view
		$this->load->view('parent/parentList', $data);		
	}
}

?>