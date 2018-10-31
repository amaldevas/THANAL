<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

	public function getAllUsersCount()
	{
		$query=$this->db->get('users');
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
		$query=$this->db->get('users');
		if(!empty($query->result())){
            return $query->result();
        } else{
            return false;
        }
	}
}