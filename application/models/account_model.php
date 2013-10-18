<?php
If(!defined('BASEPATH')) 
exit('No direct script access allowed');

class account_model extends CI_Model
{
	function validate()
	{
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password',md5($this->input->post('password')));
		$query=$this->db->get('account');
		if($query->num_rows==1)
		{
			return true;
		}
	}
	
	function create_account()
	{
		$new_member_insert_data=array(
		'first_name'=>$this->input->post('first_name'),
		'last_name'=>$this->input->post('last_name'),
		'email_address'=>$this->input->post('email_address'),
		'username'=>$this->input->post('username'),
		'password'=>md5($this->input->post('password')),
		'type'=>3
		);
		
		$insert=$this->db->insert('account',$new_member_insert_data);
		return $insert;
	}
	
	function addAccount($data)
	{
		//echo $data;
		$this->db->insert('account',$data);
	}
	
	function listAccounts()
	{
		//return $this->db->get('account');
		return $this->db->get_where('account',array('is_deleted'=>false));
	}
	
	function getAccounts($id)
	{
		return $this->db->get_where('account',array('id'=>$id));
	}
	
	function updateAccount($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('account',$data);
	}
	
	function deleteAccount($id)
	{
		
		$this->db->where('id',$id);
		$data = array(
			'is_deleted' => true
			);
		//$this->db->set('is_deleted', true);
		$this->db->update('account',$data);
	}
}

?>