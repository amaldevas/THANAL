<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
	public function changePassword($credentials)
	{
		$this->db->set('password', $credentials['password']);
		$this->db->where('fullname', $credentials['fullname']);
		if($this->db->update('user'))
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}
	public function getAllUsersCount()
	{
		$query=$this->db->get('user');
		if(!empty($query->num_rows())){
			return $query->num_rows(); 
		}else{
			return 0;
		}
	}

	public function getAllUsers($limit,$start)
	{
		$this->db->select('fullname');
		$this->db->limit($limit,$start);
		$query=$this->db->get('user');
		if(!empty($query->result())){
            return $query->result();
        } else{
            return false;
        }
	}
	public function saveUserRegistrationDetails($credentials)
	{
		if($this->db->insert('user',$credentials)){
			return true;
		} else {
			return false;
		}

	}
	public function saveUserUpdateDetails($credentials)
	{
		$this->db->set('password',$credentials['password']);
		$this->db->where('fullname', $credentials['fullname']);
		$this->db->update('user'); 
	}
	public function saveUserDeleteDetails($credentials)
	{
		$this->db->where('fullname', $credentials['fullname']);
		$this->db->delete('user'); 
	}
	public function showDetails()
	{
		$query = $this->db->get('user');
		return $query->result();
	}

	public function isUserExist($credentials)
	{
		$this->db->select('*');
		$this->db->where('fullname' , $credentials['fullname']);
		$this->db->where('password' , $credentials['password']);
		$query=$this->db->get('user');
		if($query->num_rows()==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function registerSessionForUser($credentials)
	{
		$this->session->set_userdata('log',$credentials);
	}
}
?>
