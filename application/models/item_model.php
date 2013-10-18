<?php
If(!defined('BASEPATH')) 
exit('No direct script access allowed');

class item_model extends CI_Model
{

	private $tbl_parent= 'item';
	
	private $main_query=''; 
	private $both_p_query='(business_or_residence = 2)';
	private $both_t_query='( sale_or_rent=2)';
	private $only_business_query='business_or_residence=0';
	private $only_residence_query='business_or_residence=1';
	private $only_sales_query='sale_or_rent=0';
	private $only_rent_query='sale_or_rent=1';
	
	
	function addItem($data)
	{
		//echo $data;
		$this->db->insert('item',$data);
	}
	
	function listItems()
	{
		//return $this->db->get_where('item',array('is_deleted'=>false));
		
		$this->db->select('item.id,order_no,eng_title,mya_title,type_name,type_name,location,description,photo,business_or_residence,sale_or_rent,remark,item.is_active,item.is_deleted');		
		//$this->db->where('item.is_deleted',false);
		$this->db->from('item');
		//$this->db->join('type', 'item.type_id = type.id');
		$this->db->order_by("item.is_deleted,item.is_active",'asc');
		$query=$this->db->get();
		return $query;
	}
	
	function getItems($id)
	{
		return $this->db->get_where('item',array('id'=>$id));
	}
	
	function updateItem($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('item',$data);
	}
	
	function deleteItem($id)
	{
		
		$this->db->where('id',$id);
		$data = array(
			'is_deleted' => true
			);

		$this->db->update('item',$data);
	}
	
	//---------------- Extended Function --------------------
	
	function count_all(){
		return $this->db->count_all($this->tbl_parent);
	}	

	function count_by($purpose,$trans,$type){
		//return $this->db->count_all($this->tbl_parent);
		$this->main_query='';
		switch($purpose)
		{
			case 0: $this->main_query.='('.$this->both_p_query.' OR '.$this->only_business_query.')'; break;
			case 1: $this->main_query.='('.$this->both_p_query.' OR '.$this->only_residence_query.')'; break;
			case 2: $this->main_query.='('.$this->both_p_query.' OR '.$this->only_business_query.' OR '.$this->only_residence_query.')'; break;
		}
		
		switch($trans)
		{
			case 0: $this->main_query.=' AND ('.$this->both_t_query.' OR '.$this->only_sales_query.')'; break;
			case 1: $this->main_query.=' AND ('.$this->both_t_query.' OR '.$this->only_rent_query.')'; break;
			case 2: $this->main_query.=' AND ('.$this->both_t_query.' OR '.$this->only_sales_query.' OR '.$this->only_rent_query.')'; break;
		}
		
		$this->main_query=''.$this->main_query.' AND type_name LIKE "'.$type.'"';
		
		//return $this->db->query('Select * from '.$this->tbl_parent.' WHERE '.$this->main_query.' limit '.$limit.' offset '.$offset);
		//echo $offset;
		
		$query= $this->db->query('Select * from '.$this->tbl_parent.' WHERE '.$this->main_query);
		
	//	echo 'Select * from '.$this->tbl_parent.' WHERE '.$this->main_query;
	//	exit();
		return $query->num_rows();
		//exit();
	}	
	
	function count_all_search($searchparams){		
		$this->db->like($searchparams,'','after');		
		$this->db->from($this->tbl_parent);		
		return $this->db->count_all_results();		
	}
 
 
	function get_paged_list_2($limit = 10, $offset = 0,$purpose,$trans,$type){
		
		$this->main_query='';
		switch($purpose)
		{
			case 0: $this->main_query.='('.$this->both_p_query.' OR '.$this->only_business_query.')'; break;
			case 1: $this->main_query.='('.$this->both_p_query.' OR '.$this->only_residence_query.')'; break;
			case 2: $this->main_query.='('.$this->both_p_query.' OR '.$this->only_business_query.' OR '.$this->only_residence_query.')'; break;
		}
		
		switch($trans)
		{
			case 0: $this->main_query.=' AND ('.$this->both_t_query.' OR '.$this->only_sales_query.')'; break;
			case 1: $this->main_query.=' AND ('.$this->both_t_query.' OR '.$this->only_rent_query.')'; break;
			case 2: $this->main_query.=' AND ('.$this->both_t_query.' OR '.$this->only_sales_query.' OR '.$this->only_rent_query.')'; break;
		}
		
		$this->main_query=''.$this->main_query.' AND type_name LIKE "'.$type.'"';
		
		//return $this->db->query('Select * from '.$this->tbl_parent.' WHERE '.$this->main_query.' limit '.$limit.' offset '.$offset);
		//exit();
		//echo $offset;
		

		
		$limiter='';
		if($offset=='') $limiter='limit '.$limit;
		else $limiter='limit '.$limit.' offset '.$offset;
		
		/*
		if($type=='Land')
		{
		echo 'Select * from '.$this->tbl_parent.' WHERE '.$this->main_query.' order by is_deleted,is_active,business_or_residence,sale_or_rent '.$limiter;
		exit();
		}
		*/
		
		return $this->db->query('Select * from '.$this->tbl_parent.' WHERE '.$this->main_query.' order by is_deleted,is_active,business_or_residence,sale_or_rent '.$limiter);
		
		//$this->db->order_by('is_deleted','is_active','order_no','asc');
		//return $this->db->get($this->tbl_parent, $limit, $offset);
	}
	
	function get_paged_list($limit = 10, $offset = 0,$order_column='', $order_type='asc'){
	
		if(empty($order_column)||empty($order_type)){
			$this->db->order_by('is_deleted','is_active','order_no','asc');
			//$this->db->order_by($this->primary_key,'asc');	
		}
		else{
			//$this->db->order_by($order_column,$order_type);
			$this->db->order_by($order_column,$order_type);
			//return $this->db->get($this->table_name, $limit, $offset);
			
		}
		/*
		if($order_type="asc" and $order_column!="id")
		{
		If($order_column<>'type_name')
		{
		echo $order_column.' '.$order_type;
		exit();
		}
		}
		*/
		return $this->db->get($this->tbl_parent, $limit, $offset);
	}
 
	function get_search_pagedlist($searchparams,$limit = 10, $offset = 0){
 
		$this->db->like($searchparams,'','after');		
 
		return $this->db->get($this->tbl_parent, $limit, $offset);
	}
 

	
	function getEmptyRecordAsObject()
	{
		$tblRecord=array(
		'id'=>'',
		'name'=>'',
		'cost'=>'',
		'progress'=>'',
		'isstarted'=>'',
		'issuspended'=>''
		);
		return (object)$tblRecord;
	}
	
	//----------------------------------------------------------
	

}

?>