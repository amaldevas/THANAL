<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InmateController extends CI_Controller {
	/**
	* Controller Function to handle inmate login 
  	*/
  	public function scheduleHistory()
	{
		if($this->isInmateLoggedIn())
		{
			$this->load->model('InmateModel');
			$credentials['id']=$this->session->userdata('id');
			if($this->input->post())
			{
				$credentials['from_date'] = $this->input->post('from');	
				$credentials['to_date'] = $this->input->post('to');
				$data['result']=$this->InmateModel->getMedicineScheduleSearch($credentials);
				$this->load->view('inmate/InmateMedicineScheduleHistory',$data);
			}
			else
			{
				date_default_timezone_set('Asia/Calcutta');
				$credentials['date']=date('Y-m-d');
				$credentials['time']=date('H:i:s');
				$data['result']=$this->InmateModel->getMedicineScheduleWithoutTime($credentials);
				$this->load->view('inmate/InmateMedicineScheduleHistory',$data);
			}
			
		}
		else
		{
			redirect('admin/login');
		}
	}
    public function loginInmate()
	{   
		if($this->isInmateLoggedIn()){
			redirect('inmate/dashboard');
		}else {
              $this->load->view('inmate/inmate-login');
			if ($this->input->post()){
	        
		        $email = $this->input->post('email');
		        $password = $this->input->post('password');

	          	$credentials = array(
		          	'email'=>$email,
		          	'password'=>$password
	            );

		        $this->form_validation->set_rules('email', 'Email', 'required|max_length[50]|trim');
		        $this->form_validation->set_rules('password', 'Password', 'required|max_length[100]|trim');
	            
	            if ($this->form_validation->run() == FALSE){
	            	$this->load->view('inmate/inmate-login');
	            }else{  
	                $this->load->model('InmateModel');
	                if(!$this->InmateModel->isInmateExist($credentials)){
	                    $data['error'] = "Sorry, incorrect email or password";
	                  
	                }else {
	                	$this->registerSessionForInmate($credentials);
	                	redirect('inmate/dashboard');
	                } 
	            }
	        }
		}
	}
	public function registerSessionForInmate($credentials)
	{   
		$this->load->model('InmateModel');
		$result = $this->InmateModel->getInmateDetails($credentials);
		$inmate['id'] = $result[0]->id;
		$inmate['name'] = $result[0]->name;
		$inmate['payment_per_month'] = $result[0]->payment_per_month;
		$credentials2 = array(
			'id' => $inmate['id'],
			'payment_per_month' => $inmate['payment_per_month'], 
			'loggedIn' => true,
			'type' => "inmate",
			'email' => $credentials['email'],
			'name' => $inmate['name']  
		);
       
        $this->session->set_userdata($credentials2);
    }
     /** 
	* Function to check if the staff is loggedin or not
	*/
	  public function getMessageId()
  	{
  		$this->load->model('InmateModel');
	    if ($this->input->post() && $this->input->is_ajax_request()) 
	    {
	      $messageId = $this->input->post('messageId');
	      $data['result'] = $this->InmateModel->getMessageDetails($messageId);
	      $this->InmateModel->getMessageDetailsStatus($messageId);
	      echo json_encode($data);
	    } 
	    else 
	    {
	      redirect('admin/login');
	    }

  }
  public function getResult()
  	{
  		$this->load->model('InmateModel');
	    if ($this->input->post() && $this->input->is_ajax_request()) 
	    {
	      $type_send = $this->input->post('type_send');
	      if(strcmp($type_send,"staff")==0)
	      {
	      	$data['result'] = $this->InmateModel->getStaffList();
	        echo json_encode($data);
	      }
	      elseif (strcmp($type_send,"guardian")==0) 
	      {
	      	$data['result'] =$this->InmateModel->getGuardianList();
	        echo json_encode($data);
	      }
	      else
	      {
	      	$data['result'] = $this->InmateModel->getInmateList();
	        echo json_encode($data);
	      }
	    } 
	    else 
	    {
	      redirect('inmate/login');
	    }

  }
  public function createMessage()
	{
		if($this->isInmateSessionWithout())
		{
			
			$this->load->helper('url');
			$this->load->model('InmateModel');
			$to_type = $this->input->post('to_type');
			$to_id = $this->input->post('to_id');
			$status="0";
			$from_id=$this->session->userdata('id');
			$from_type="inmate";
			$date_created = date('Y-m-d H:i:s');
			$subject = $this->input->post('subject');
			$message = $this->input->post('message');
			$credentials = array(
									'to_type'=>$to_type,
									'to_id'=>$to_id,
									'status'=>$status,
									'subject'=>$subject,
									'from_type'=>$from_type,
									'from_id'=>$from_id,
									'message'=>$message,
									'date_created'=>$date_created
								);
			if($this->InmateModel->createMessage($credentials))
			{
				$data['message']="Message send Succesfully";
			}
			else
			{
				$data['message']="Message send failed";
			}
			redirect('inmate/dashboard');
		}
		else
		{
			redirect('inmate/login');
		}
	}
	public function isInmateLoggedIn()
	{
		if($this->session->userdata('email') && $this->session->userdata('type') == "inmate"){
			$data['name'] = $this->session->userdata('name');
			$data['id'] = $this->session->userdata('id');
			$data['name']=$this->session->userdata('name');
			$data['email']=$this->session->userdata('email');
			$credentials['id']=$this->session->userdata('id');
			$credentials['type']=$this->session->userdata('type');
			
			$this->load->model('InmateModel');
			$data['message_show']=$this->InmateModel->getMessage($credentials);
			$data['message_count']=$this->InmateModel->getMessageCount($credentials);
			$this->load->view('partials/inmate-header',$data);
			return true;
		} else {
			return false;
		}
	}
	public function isInmateSessionWithout()
	{
		if($this->session->userdata('email') && $this->session->userdata('type') == "inmate"){
			$data['name'] = $this->session->userdata('name');
			$data['id'] = $this->session->userdata('id');
			$data['name']=$this->session->userdata('name');
			$data['email']=$this->session->userdata('email');
			$credentials['id']=$this->session->userdata('id');
			$credentials['type']=$this->session->userdata('type');
			$this->load->model('InmateModel');
			$data['message_show']=$this->InmateModel->getMessage($credentials);
			$data['message_count']=$this->InmateModel->getMessageCount($credentials);
			
			return true;
		} else {
			return false;
		}
	}

    /** 
    * Controller function to logout staff
    */
    public function logoutInmatesession()
 	{
    	$this->session->unset_userdata('email');
    	$this->session->unset_userdata('id');
    	$this->session->unset_userdata('name');
    	$this->session->unset_userdata('loggedIn');
    	$this->session->unset_userdata('type');
     	redirect('inmate/login');
 	}
 	/** 
	* Controller function to show the dasahboard
	*/
	public function dashboardInmate()
	{    
		if($this->isInmateLoggedIn()) {
			date_default_timezone_set('Asia/Calcutta');
			$credentials['date']=date('Y-m-d');
			$credentials['time']=date('H:i:s');
			$credentials['id'] = $this->session->userdata('id');
			$this->load->model('InmateModel');
			$data['result'] = $this->InmateModel->getInmateDashboardDetails($credentials);
			
			$this->load->view('inmate/inmate-dashboard',$data);
		} else {
			redirect('inmate/login');
		}
	}
	/** 
	* Controller function to show the profile page
	*/
	public function medicineList()
	{
		if($this->isInmateLoggedIn())
		{
			$id=$this->session->userdata('id');
			$this->load->model('GuardianModel');
			$data['result']=$this->GuardianModel->getMedicineList($id);
			$this->load->view('inmate/inmateMedicineList',$data);
			//$data=$this->AdminModel->getStaffTypeAdmin();
		}
		else
		{
			redirct('inmate/login');
		}
	}
	public function profileInmate()
	{   if($this->isInmateLoggedIn()){
		    $credentials['id'] = $this->session->userdata('id');
			    $this->load->model('InmateModel');
				$data = $this->InmateModel->getInmateProfileDetails($credentials);
				
				$this->load->view('inmate/inmate-profile', $data);
        }else{
	            redirct('inmate/login');
	    }
	}
	/** 
	* Controller function to handle edit profile page 
	*/
	public function editInmateprofile()
	{
		if($this->isInmateLoggedIn()){
			$credentials['id'] = $this->session->userdata('id');
				$this->load->model('InmateModel');
				$data = $this->InmateModel->editProileDetails($credentials);
				
				$this->load->view('inmate/inmate-edit',$data);
		}else{
			redirect('inmate/login');
		}
	}
	/** 
	* Controller function to update staff profile page 
	*/
    public function updateInmateProfile()
    {
        if($this->isInmateLoggedIn()){

		    if($this->input->post()){

	            $fullname = $this->input->post('fullname');
	            $mobile = $this->input->post('mobile');
				$email = $this->input->post('email');
				$gender = $this->input->post('select');
				$permanentAddress = $this->input->post('permanentaddress');
				$presentAddress = $this->input->post('presentaddress');
				$dateOfBirth = $this->input->post('date_of_birth');

	        	$credentials = array(
	        		'name'=>$fullname,
	        		'mobile'=>$mobile,
	        		'email'=>$email,
	        		'permanent_address'=>$permanentAddress,
	        		'present_address'=>$presentAddress,
	        		'gender'=>$gender,
	        		'date_of_birth'=>$dateOfBirth
	        	);

                $this->form_validation->set_rules('fullname', 'Fullname', 'required|max_length[100]|trim');
                $this->form_validation->set_rules('mobile', 'Mobile', 'required|max_length[10]|trim');
        	    $this->form_validation->set_rules('email', 'Email', 'required|max_length[50]|trim');
                $this->form_validation->set_rules('permanentaddress', 'Permanent', 'required|max_length[500]');
                $this->form_validation->set_rules('presentaddress', 'PresentAddress', 'required|max_length[500]');

                if ($this->form_validation->run() == FALSE){
                  	$data['error'] = "Sorry enter the  detais correctly";
                }else{  

					$this->load->model('InmateModel');
					if(!$this->InmateModel->updateInmateProfileDetails($credentials)){
						$data['error'] = "Sorry, something went wrong!";
                  	}else{
						$data['message'] = "Thank you for updating.......";
						
                  	}
                }
			}
	        redirect('inmate/profile');	
	    }else{
	   		redirct('inmate/login');
	    }
    }

}