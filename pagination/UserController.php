<?php

class UserController extends CI_Controller {

	public function listAllUsers()
	{		

		$this->load->library('pagination');
		$this->load->model('UserModel');
		$page =$this->uri->segment(2);
		if(empty($page)){
			$page=0;
		}   
		$data['total_rows']=$this->UserModel->getAllUsersCount();
		$config['base_url']    = base_url() . "show-all-users";
		$config['per_page'] = 4;
		$config['uri_segment'] = 2;
		$config['total_rows']  = $data['total_rows'];
		$config["num_links"]   = 1;
		$this->pagination-> initialize($config);
		$data['links']     = $this->pagination->create_links();      

		$data['users']= $this->UserModel->getAllUsers($config["per_page"], $page);
		$this->load->view('searchUsers',$data);		

	}
}
