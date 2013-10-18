<?php
If(!defined('BASEPATH')) 
exit('No direct script access allowed');

class type_model extends CI_Model
{

private $tableName = 'type';
	
	function __construct()
	{
	parent::__construct();
	}

	function validate()
	{
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password',md5($this->input->post('password')));
		$query=$this->db->get('type');
		if($query->num_rows==1)
		{
			return true;
		}
	}
	

	
	function addtype($data)
	{
		//echo $data;
		$this->db->insert('type',$data);
	}
	
	function listTypes()
	{
		//return $this->db->get('type');
		return $this->db->get_where('type',array('is_deleted'=>false));
	}
	
		function get_type_list()
{
  $this->db->select('*');
  $this->db->from('type');
  $this->db->where('type.is_deleted',false);
  $this->db->order_by('name');
  $result = $this->db->get();
  $return = array();
  if($result->num_rows() > 0) {
    foreach($result->result_array() as $row) {
      $return[$row['id']] = $row['name'];
    }
  }

  return $return;
}
	
	
	
	function getTypes($id)
	{
		return $this->db->get_where('type',array('id'=>$id));
	}
	
	function updateType($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('type',$data);
	}
	
	function deleteType($id)
	{
		
		$this->db->where('id',$id);
		$data = array(
			'is_deleted' => true
			);

		$this->db->update('type',$data);
	}
	
	//------------------ Extendended Functions ----------------------------
	
function get_all(){
$sql = 'SELECT id, name ';
$sql .= ' FROM ' . $this->tableName;
$sql .= ' WHERE is_deleted=false';
$sql .= ' order by id ';
return $this->db->query($sql, array()); 
}

// Get all, as a clean array:
function get_all_clean_array()
{
$recordSet = $this->get_all()->result();


$array = array();
foreach($recordSet as $row) {

$array[$row->id] = $row->name;
}


return $array;

	}
	
	}
	
?>