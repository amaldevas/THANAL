<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function sentEmailAction()
	{
		if($this->input->post()){
			$toEmail=$this->input->post('email');
			$message=$this->input->post('message');

			$this->load->library('email');

			$config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.googlemail.com';
            $config['smtp_port'] = '465';
            $config['smtp_user'] = 'elixiroflyf123@gmail.com';
            $config['smtp_pass'] = "abhishek123";

            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;
            $config['newline'] = "\r\n"; 
            $this->email->initialize($config);  

			$this->email->from('elixiroflyf123@gmail.com', 'Amal');
			$this->email->to($toEmail);
			$this->email->cc('');
			$this->email->bcc('');
			$this->email->subject('Email Test');
			$this->email->message($message);
			if($this->email->send()){
				$data['message']="Email sent successfully";
				$this->load->view('sentEmail',$data);
			}else{
				echo $this->email->print_debugger();die;
				$data['message']="Failed to sent email";
				$this->load->view('sentEmail',$data);
			}

		}else{
			$this->load->view('sentEmail');
		}

	}
	public function show_display_ajax()
	{
		$this->load->view('display_ajax');
	}
	public function sent_show_ajax()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model('UserModel');
			$data['result'] = $this->UserModel->showDetails();
			echo json_encode($data);
		}
		else
		{
			$this->load->view('display_ajax');
		}
	}
	public function changePasswordAction()
  {
    if ($this->input->post() && $this->input->is_ajax_request()) {

      $fullname = $this->input->post('fullname');
      $password = $this->input->post('password');

      $credentials = array('fullname'=> $fullname, 'password'=>$password);

      $this->load->model('UserModel');
      if(!$this->UserModel->changePassword($credentials)){
        $data['result'] = "fail";
        echo json_encode($data);
      } else {
        $data['result'] = "Success";
        echo json_encode($data);
      }
    } else {
      $this->load->view('changePassword');
    }

  }
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
		$config['per_page'] = 1;
		$config['uri_segment'] = 2;
		$config['total_rows']  = $data['total_rows'];
		$config["num_links"]   = 1;
		$this->pagination-> initialize($config);
		$data['links']     = $this->pagination->create_links();      

		$data['users']= $this->UserModel->getAllUsers($config["per_page"], $page);
		$this->load->view('searchUsers',$data);		

	}
	public function showHomePage()
	{
		$this->load->view('homepage');
	}
	public function show_logout_session()
	{
		$data['message']='';
		$this->session->unset_userdata('log_cre');
		$this->load->view('login_session',$data);

	}
	public function show_login_session()
	{
		if($this->session->userdata('log_cre'))
		{
			$this->load->model('UserModel');
			$data['message']="Login Successfull";
			$credentials=$this->session->userdata('log_cre');
			$data['fullname']=$credentials['fullname'];
			$this->load->view('sucess', $data);

		}
		elseif($this->input->post())
		{
			$fullname = $this->input->post('fullname');
			$password = $this->input->post('password');
			$credentials = array('fullname'=>$fullname,'password'=>$password);
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[10]|trim');
			if ($this->form_validation->run() == FALSE) 
			{
				$data['message'] = "Credentials are not valid";
				$this->load->view('login_session', $data);
			}
			else
			{
				$this->load->model('UserModel');
				if(!$this->UserModel->isUserExist($credentials))
				{
					$data['message'] = "Sorry, failed to login";
					$this->load->view('login_session', $data);
				}
				else
				{
					$this->UserModel->registerSessionForUser($credentials);
					$data['message']="Login Successfull";
					$data['fullname']=$credentials['fullname'];
					$this->load->view('sucess', $data);

				}
			}

		}
		else
		{
			$data['message'] = "";
			$this->load->view('login_session',$data);
		}
		

	}
	public function show_sucess_session()
	{
		if($this->input->post())
		{
				$this->load->view('sucess');
		}
		else
		{
			$this->load->view('login_session');
		}
	}
	public function show_page()
	{
		$this->load->model('UserModel');
		$data['result'] = $this->UserModel->showDetails();
		$this->load->view('display',$data);
	}
	public function show_reg_Page()
	{

		if($this->input->post()){


		$fullname = $this->input->post('fullname');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$credentials = array('fullname'=>$fullname, 'email'=>$email, 'password'=>$password);

		$this->load->model('UserModel');
		if($fullname=='')
		{
			$data['message'] = "";
			$this->load->view('dblogin',$data);
		}
		elseif(!$this->UserModel->saveUserRegistrationDetails($credentials)){
		$data['error'] = "Sorry, something went wrong!";

		$this->load->view('dblogin', $data);
		} else {
		$data['message'] = "Thank you for signing up.";
		$this->load->view('dblogin', $data);
		}
		} else {
			$data['message'] = "";
		$this->load->view('dblogin',$data);
		}
		}
		public function show_updt_Page()
	{

		if($this->input->post()){


		$fullname = $this->input->post('fullname');
		$password = $this->input->post('password');

		$credentials = array('fullname'=>$fullname,'password'=>$password);

		$this->load->model('UserModel');
		if($fullname=='')
		{
			$data['message'] = "";
			$this->load->view('dbupdate',$data);
		}
		elseif(!$this->UserModel->saveUserUpdateDetails($credentials)){
		$data['error'] = "Sorry, something went wrong!";

		$this->load->view('dbupdate', $data);
		} else {
		$data['message'] = "Thank you for signing up.";
		$this->load->view('dbupdate', $data);
		}
		} else {
			$data['message'] = "";
		$this->load->view('dbupdate',$data);
		}
		}
		public function show_delte_Page()
	{

		if($this->input->post()){


		$fullname = $this->input->post('fullname');

		$credentials = array('fullname'=>$fullname);

		$this->load->model('UserModel');
		if($fullname=='')
		{
			$data['message'] = "";
			$this->load->view('delete',$data);
		}
		elseif(!$this->UserModel->saveUserDeleteDetails($credentials)){
		$data['error'] = "Sorry, something went wrong!";

		$this->load->view('delete', $data);
		} else {
		$data['message'] = "Thank you for signing up.";
		$this->load->view('delete', $data);
		}
		} else {
			$data['message'] = "";
		$this->load->view('delete',$data);
		}
		}
		public function Home(){
			$this->load->view('Home');
		}
		public function Login(){
			$this->load->view('login');
		}
		public function signup(){
			$this->load->view('signup');
		}
		public function HaiUser(){
			$this->load->view('Hai');
		}
	}
