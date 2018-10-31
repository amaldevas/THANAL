<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
  class StaffController extends CI_Controller 
{
  /**
	* Controller Function to handle staff login 
  	*/
    public function loginStaff()
	{   
		if($this->isStaffLoggedIn()){
			redirect('staff/dashboard');
		}else {
             
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
	            		$data['error'] = "Sorry enter the  detais correctly";
	            		$this->load->view('staff/staff-login');
	            }else{  
	                $this->load->model('StaffModel');
	                if(!$this->StaffModel->isStaffExist($credentials)){
	                    $data['error'] = "Sorry, incorrect email or password";
	                    $this->load->view('staff/staff-login');
	                  
	                }else {
	                	$this->registerSessionForStaff($credentials);
	                	redirect('staff/dashboard');
	                } 
	            }
	        }
	        else
	        {
	        	$this->load->view('staff/staff-login');
	        }
		}
	}


	public function registerSessionForStaff($credentials)
	{   
		$this->load->model('StaffModel');
		$result = $this->StaffModel->getStaffDetails($credentials);
		//var_dump($result);die;
		$staff['id'] = $result[0]->id;
		$staff['name'] = $result[0]->name;
		$staff['access']=$result[0]->can_view_inmate_medicine_schedule;

		$credentials2 = array(
			'id' => $staff['id'], 
			'loggedIn' => true,
			'type' => "staff",
			'email' => $credentials['email'],
			'name' => $staff['name'],
			'access'=>$staff['access']
		);
        //var_dump($credentials2);die;
        $this->session->set_userdata($credentials2);
    }
    /** 
	* Function to check if the staff is loggedin or not
	*/
	public function isStaffLoggedIn()
	{
		$this->load->model('StaffModel');
		if($this->session->userdata('email') && $this->session->userdata('type') == "staff"){
			$data['email']=$this->session->userdata('email');
			$data['name']=$this->session->userdata('name');
			$credentials['id']=$this->session->userdata('id');
			$credentials['type']=$this->session->userdata('type');
			$data['message_show']=$this->StaffModel->getMessage($credentials);
			$data['message_count']=$this->StaffModel->getMessageCount($credentials);
			if($this->hasStaffAccess()){
                $this->load->view('partials/staff-header',$data);
				return true;
			}else{
				$this->load->view('partials/staff-notaccessheader',$data);
                return true;
			}
        }else{
			return false;
		}
	}
     /*
	* Function to check if the staff has the access to edit or not
	*/
	public function hasStaffAccess()
    {
       if($this->session->userdata('access')){
			return true;
		}else {
			return false;
		}
	}
	 /** 
    * Controller function to logout staff
    */
    public function logoutStaffsession()
 	{
    	$this->session->unset_userdata('email');
    	$this->session->unset_userdata('id');
    	$this->session->unset_userdata('name');
    	$this->session->unset_userdata('loggedIn');
    	$this->session->unset_userdata('access');
    	$this->session->unset_userdata('type');
     	redirect('staff/login');
 	}
 	/*
 	Controller Function for Forgot Password 
 	*/
 	public function forgotpasswordStaff()
 	{ 
 		 if($this->input->post())
		{
			
			$toEmail=$this->input->post('email');
			$this->load->model('StaffModel');
			if($this->StaffModel->notEmailStaff($toEmail))
			{	
				if($this->StaffModel->alreadySendStaff($toEmail))
				{
					$this->load->helper('string');
					$message=random_string('alnum',5);
					while($this->StaffModel->notInStaff($message)) 
					{
     					$message=random_string('alnum',5);
     				}
     				$credentials['message']=$message;
     				$credentials['email']=$toEmail;
     				$this->StaffEmailSend($credentials);
     				$this->StaffModel->updatePasswordReset($credentials);
     				$this->StaffResetCheck($credentials);
     				$this->load->view('Staff/Staff-Resend',$credentials);

     			}
				else
				{
					$credentials['email']=$toEmail;
					$this->load->view('staff/Staff-Resend',$credentials);
				}
			}
			else
			{

				$data['message']="Invalid Email Entered";
				redirect('staff/forgot-password');
				
			}
		}
		else
		{
			$this->load->view('staff/staff-ForgotPass');
		}
	}
	public function staffPasswordResend()
	{
		$this->load->model('StaffModel');
		if($this->input->post())
		{
			$toEmail=$this->input->post('email');
			$credentials['email']=$toEmail;
			$message=$this->StaffModel->passwordResetMessage($credentials['email']);
			if($message=='FALSE')
			{
			}
			else
			{

				$credentials['message']=$message;
				$this->StaffEmailSend($credentials);
				$this->load->view('staff/staff-Resend',$credentials);
			}
			

		}
		else
		{
			$this->load->view('staff/staff-Resend');
		}
	}

	/*
 	Controller Function for Email Sending for Forgot Password 
 	*/
    public function StaffEmailSend($credentials)
	{
			$toEmail=$credentials['email'];
			$message1=$credentials['message'];
			$message2="Your Password Reset Link is : http://localhost:8081/Thanal/index.php/staff/password-change/";
			$message=$message2.$toEmail."/".$message1;
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

			$this->email->from('elixiroflyf123@gmail.com', 'Elixir Of Lyf');
			$this->email->to($toEmail);
			$this->email->cc('');
			$this->email->bcc('');
			$this->email->subject('Password Reset Link');
			$this->email->message($message);
			if($this->email->send()){
				$data['message']="Email sent successfully";
			}else{
				echo $this->email->print_debugger();die;
				$data['message']="Failed to sent email";
			}		
	}
	/*
 	Controller Function for Reset
 	*/
	public function StaffResetCheck($credentials)
	{
		if($this->input->post())
		{
			$credentials['message_new']=$this->input->post('reset');
			$this->load->model('StaffModel');
			if($this->StaffModel->checkReset($credentials))
			{
				echo "hai";
			}
			else
			{
				$this->load->view('staff/staff-Reset',$credentials);
			}
		}
		else
		{
			$this->load->view('staff/staff-Reset',$credentials);
		}
	}

	public function staffPasswordChangeLink()
	{
		$this->load->helper('url');
		$this->load->model('StaffModel');
		$email=$this->uri->segment(3);
		$reset=$this->uri->segment(4);
		$credentials['email']=$email;
		$credentials['reset']=$reset;
		if($this->input->post())
		{
			if($this->StaffModel->isValidReset($credentials))
			{
				$password = $this->input->post('password');
				$credentials['password']=$password;
				if($this->StaffModel->staffChangePasswordLink($credentials))
				{
					$this->StaffModel->staffPasswordResetNull($credentials);
				}
				else
				{

				}		
				redirect('staff/login');		
			}
			else
			{
				redirect('staff/forgot-password');
			}	
		}
		else
		{
			if($this->StaffModel->isValidReset($credentials))
			{
				$this->load->view('staff/staff-passwordchangelinl');
			}
			else
			{
				redirect('staff/forgot-password');
			}
			
		}
	}
	/*
 	Controller Function for Changing Password
 	
 	*/
    public function changePasswordStaff()
    { 
    	if($this->isStaffLoggedIn()){
            $this->load->view('staff/staff-changePassword');
            }else{
	   		redirct('staff/login');
	    }		      
    }
    public function staffPasswordChangeDo()
    {    
         if($this->isStaffLoggedIn())
         {
         	 if($this->input->post())
         	 {
				$password = $this->input->post('confirmpassword');
				$id=$this->session->userdata('id');
				$this->load->model('StaffModel');
				$credentials = array(
				'id'=>$id,
				'password'=>$password
				);
				$this->form_validation->set_rules('confirmpassword', 'Password', 'required|max_length[25]|trim');
				$data['result']=$this->StaffModel->staffChangePassword($credentials);
				redirect('staff/dashboard');

			
			}
			else
		{
			redirect('staff/login');
		}
    }
}
	/*
	* Controller function to show the dasahboard
	*/
	public function dashboardStaff()
	{    
		if($this->isStaffLoggedIn()){
			$credentials['name'] = $this->session->userdata('name');
			date_default_timezone_set('Asia/Calcutta');
			$credentials['date']=date('Y-m-d');
			$credentials['time']=date('H:i:s');
			$credentials['id']=$this->session->userdata('id');
			$this->load->model('StaffModel');
			
           if($this->hasStaffAccess()){
				$this->load->model('StaffModel');
				$data['result']=$this->StaffModel->getMedicineSchedule($credentials);
				//$data['result'] = $this->StaffModel->getStaffDashboardDetails($credentials);
				$this->load->view('staff/staff-dashboard', $data);
		    }else{
				$this->load->model('StaffModel');
				$data['result']=$this->StaffModel->getStaffDuty($credentials['id']);
				//$data['result'] = $this->StaffModel->getStaffDashboardDetails($credentials);
				$this->load->view('staff/staff-dashboard1', $data);
            }
		}else{
			   redirect('staff/login');
	    }	
	}
	/** 
	* Controller function to show the profile page
	*/
	public function profileStaff()
	{   if($this->isStaffLoggedIn()){
		    $credentials['id'] = $this->session->userdata('id');
		    if($this->hasStaffAccess()){
			    $this->load->model('StaffModel');
				$data = $this->StaffModel->getStaffProfileDetails($credentials);
				$this->load->view('staff/staff-profile', $data);

			}else{
			    $this->load->model('StaffModel');
				$data = $this->StaffModel->getStaffProfileDetails($credentials);
				$this->load->view('staff/staff-profile', $data);
			}
        }else{
	            redirct('staff/login');
	    }
	}
	/** 
	* Controller function to handle edit profile page 
	*/
	public function editStaffProfile()
	{
		if($this->isStaffLoggedIn()){
			$credentials['id'] = $this->session->userdata('id');
			if($this->hasStaffAccess()){
				$this->load->model('StaffModel');
				$data = $this->StaffModel->geteditProileDetails($credentials);
				$this->load->view('staff/staff-edit',$data);
		    }else{
		    	$this->load->model('StaffModel');
				$data = $this->StaffModel->geteditProileDetails($credentials);
				$this->load->view('staff/staff-edit',$data);
		    }
		}else{
			redirect('staff/login');
		}
	}
	/** 
	* Controller function to update staff profile page 
	*/
    public function updateStaffProfile()
    {
        if($this->isStaffLoggedIn()){

		    if($this->input->post()){

	            $fullname = $this->input->post('fullname');
	            $mobile = $this->input->post('mobile');
				$email = $this->input->post('email');
				$gender = $this->input->post('select');
				$permanentAddress = $this->input->post('permanentaddress');
				$presentAddress = $this->input->post('presentaddress');
				$dateOfJoinig = $this->input->post('date_of_joining');
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

					$this->load->model('StaffModel');
					if(!$this->StaffModel->updateStaffProfileDetails($credentials)){
						$data['error'] = "Sorry, something went wrong!";
                  	}else{
						$data['message'] = "Thank you for updating.......";
						
                  	}
                }
			}
	        redirect('staff/profile');	
	    }else{
	   		redirct('staff/login');
	    }
    }
     /*
     For uploading picture
     */
    public function uploadPhotoAction()
	{   if($this->isStaffLoggedIn()){

			if($this->input->post()){
				$config['upload_path'] = './assets/images/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '100';
				$config['max_width']  = '1024';
				$config['max_height']  = '1024';

				//$data['date']=(date('Y-m-d H:i:s'));
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('image')){
					$data['error'] = $this->upload->display_errors();
					$this->load->view('staff/staff-profile',$data);
				}else{
					$upload_data =  $this->upload->data();
					$this->load->model('StaffModel');
					$data['image']= $upload_data['file_name'];
					$this->StaffModel->uploadUserPhoto($data);
					$data['message']="Successfully Added";
					$this->load->view('staff/staff-profile',$data);
				}
			}else{
				redirect('staff/staff-dashboard');
			}
		}
	}
    /** 
	* Controller function to show the profile of inmate
	*/
	public function loginProfileInmate()
	{   if($this->isStaffLoggedIn()){
		    $id =$this->uri->segment(4);
			$this->load->model('StaffModel');
			$data = $this->StaffModel->getInmateProfileDetails($id);
			$this->load->view('staff/staff-viewinmateprofile', $data);
        }else{
	            redirct('staff/login');
	    }
	}
	/**
	*Controller functio to handle search result
	**/
	public function searchResults()
	{
		if($this->isStaffLoggedIn())
		{
			$this->load->model('StaffModel');
			$type = $this->input->post('type');
			$search = $this->input->post('search');
			if(strcmp($type,"please")==0){
				redirect('staff/dashboard');
			}
			elseif (strcmp($type,"guardian")==0) {
				$data['result']=$this->StaffModel->getSearchGuardianList($search);
				$this->load->view('staff/staff-guardianlist',$data);
			}
			elseif (strcmp($type,"medicine")==0) {
				$data['result']=$this->StaffModel->getSearchMedicineList($search);
				$this->load->view('staff/staff-medicinelist',$data);
			}
			elseif (strcmp($type,"inmate")==0) {
				$data['result']=$this->StaffModel->getSearchInmateList($search);
				$this->load->view('staff/staff-inmatelist',$data);
			}
			else{
				redirect('staff/dashboard');
			}
		}else{
			redirect('staff/login');
		}
	}
    /** 
	* Controller function to handle list inmate
	*/
	public function listInmate()
	{
		if($this->isStaffLoggedIn()){
			if($this->hasStaffAccess()){
				$this->load->model('StaffModel');
				$data['result'] = $this->StaffModel->getInmateDetailsAll();
				$this->load->view('staff/staff-inmatelist',$data);
		    }else{
				$this->load->view('staff/staff-dashboard');
		    }
		}else{
			redirect('staff/login');
		}
	}
	/**
     Controller Function to handle staff adding inmate     

    **/
     public function addInmateDo()
     {
     	if($this->input->post()){

		            $fullname = $this->input->post('fullname');
		            $mobile = $this->input->post('mobile');
					$email = $this->input->post('email');
					$password = $this->input->post('temporarypassword');
					$gender = $this->input->post('select');
					$permanentAddress = $this->input->post('permanentaddress');
					$presentAddress = $this->input->post('presentaddress');
					$payment = $this->input->post('payment');
					$emergencyNumber = $this->input->post('emergencycontactnumber');
					$emergencyPerson = $this->input->post('emergencycontactperson');
					$dateOfJoinig = $this->input->post('date_of_joining');
					$dateOfBirth = $this->input->post('date_of_birth');

		        	$credentials = array(
		        		'name'=>$fullname,
		        		'mobile'=>$mobile,
		        		'email'=>$email,
		        		'password_hash'=>$password,
		        		'emergency_contact_person'=>$emergencyPerson,
		        		'emergency_contact_number'=>$emergencyNumber,
		        		'permanent_address'=>$permanentAddress,
		        		'present_address'=>$presentAddress,
		        		'gender'=>$gender,
		        		'payment_per_month'=>$payment,
		        		'date_of_joining'=>$dateOfJoinig,
		        		'date_of_birth'=>$dateOfBirth
		        	);
		        	

	                $this->form_validation->set_rules('fullname', 'Fullname', 'required|max_length[100]|trim');
	                $this->form_validation->set_rules('mobile', 'Mobile', 'required|max_length[10]|trim');
	        	    $this->form_validation->set_rules('email', 'Email', 'required|max_length[50]|trim');
	                $this->form_validation->set_rules('temporarypassword', 'Password', 'required|max_length[25]|trim');
	                $this->form_validation->set_rules('emergencycontactperson', 'ContactPerson', 'required|max_length[100]trim');
	                $this->form_validation->set_rules('emergencycontactnumber', 'Mobile', 'required|max_length[10]|trim');
	                $this->form_validation->set_rules('permanentaddress', 'Permanent', 'required|max_length[500]trim');
	                $this->form_validation->set_rules('presentaddress', 'PresentAddress', 'required|max_length[500]trim');
	                $this->form_validation->set_rules('payment', 'Payment', 'required|max_length[20]trim');

	                if ($this->form_validation->run() == FALSE){

	                  	$data['error'] = "Sorry enter the  detais correctly";
	                }else{  
						$this->load->model('StaffModel');
						if(!$this->StaffModel->saveInmateRegistrationDetails($credentials)){
							$data['error'] = "Sorry, something went wrong!";	
	                  	}else{
							$data['message'] = "Thank you for adding.";
	                  	}
	                  	redirect('staff/list-inmate');
	                }
				}
				else
				{
					redirect('staff/list-inmate');
				}
     }
	public function addInmate()
	{   
		if($this->isStaffLoggedIn()){

			if($this->hasStaffAccess()){

				$this->load->view('staff/staff-addinmate');	
	        }else{
				$this->load->view('staff/staff-dashboard');
	        }
	    }else{
	   		redirect('staff/login');
	   }
    }
    /**
     Controller Function to handle deleting an inmate by staff    

    **/
   public function deleteInmateDetails()
   {
   		if($this->isStaffLoggedIn()){

   			if($this->hasStaffAccess()){
	   			
				$this->load->model('StaffModel');
				$id =$this->uri->segment(3);
	            if(!$this->StaffModel->deleteInmateRegistrationDetails($id)){
				  $data['error'] = "Sorry, something went wrong!";	      
	            }else{      
				  
				}
				 redirect('staff/list-inmate');
	        }
	       
	    }else{
			redirect('staff/login');
		}
   
   }
   /**
     Controller Function to handle staff editing  inmate     

    **/
    public function editInmateDetails()
    {
    	if($this->isStaffLoggedIn()){

    		if($this->hasStaffAccess()){
	   			
				$this->load->model('StaffModel');
				$id =$this->uri->segment(3);
				$data = $this->StaffModel->getInmateEditDetails($id);
				$this->load->view('staff/staff-editinmate',$data);
			}else{
				$this->load->view('staff/staff-dashboard');
		    }
		}else{
			redirect('staff/login');
		}
    }
    /**
     Controller Function to handle staff update  inmate     

    **/
    public function updateInmateDetails()
    {    
    	if($this->isStaffLoggedIn()){
    		if($this->hasStaffAccess()){

			    if($this->input->post()){
			    	$id =$this->uri->segment(3);
		            $fullname = $this->input->post('fullname');
		            $mobile = $this->input->post('mobile');
					$email = $this->input->post('email');
					$gender = $this->input->post('select');
					$permanentAddress = $this->input->post('permanentaddress');
					$presentAddress = $this->input->post('presentaddress');
					$payment = $this->input->post('payment');
					$emergencyNumber = $this->input->post('emergencycontactnumber');
					$emergencyPerson = $this->input->post('emergencycontactperson');
					$dateOfJoinig = $this->input->post('date_of_joining');
					$dateOfBirth = $this->input->post('date_of_birth');

		        	$credentials = array(
	                     'id'=>$id,
		        		'name'=>$fullname,
		        		'mobile'=>$mobile,
		        		'email'=>$email,
		        		'emergency_contact_person'=>$emergencyPerson,
		        		'emergency_contact_number'=>$emergencyNumber,
		        		'permanent_address'=>$permanentAddress,
		        		'present_address'=>$presentAddress,
		        		'gender'=>$gender,
		        		'payment_per_month'=>$payment,
		        		'date_of_joining'=>$dateOfJoinig,
		        		'date_of_birth'=>$dateOfBirth
		        	);
		        	
	                $this->form_validation->set_rules('fullname', 'Fullname', 'required|max_length[100]|trim');
	                $this->form_validation->set_rules('mobile', 'Mobile', 'required|max_length[10]|trim');
	        	    $this->form_validation->set_rules('email', 'Email', 'required|max_length[50]|trim');
	                $this->form_validation->set_rules('emergencycontactperson', 'ContactPerson', 'required|max_length[100]|trim');
	                $this->form_validation->set_rules('emergencycontactnumber', 'Mobile', 'required|max_length[10]|trim');
	                $this->form_validation->set_rules('permanentaddress', 'Permanent', 'required|max_length[500]');
	                $this->form_validation->set_rules('presentaddress', 'PresentAddress', 'required|max_length[500]');
	                $this->form_validation->set_rules('payment', 'Payment', 'required|max_length[20]|trim');

	                if ($this->form_validation->run() == FALSE){

	                  	$data['error'] = "Sorry enter the  detais correctly";
	                }else{  

						$this->load->model('StaffModel');
						if(!$this->StaffModel->updateInmateRegistrationDetails($credentials)){

							$data['error'] = "Sorry, something went wrong!";
	                  	}else{
							$data['message'] = "Thank you for updating.......";
							
	                  	}
	                }
			    }
	          redirect('staff/list-inmate');	
	        }

	        }else{
	   		   redirct('staff/login');
	   		}
    }
    /** 
	* Controller function to handle list guardian
	*/
	public function listGuardian()
	{
		if($this->isStaffLoggedIn()){
			if($this->hasStaffAccess()){
				$this->load->model('StaffModel');
				$data['result'] = $this->StaffModel->getGuardianDetails();
				$this->load->view('staff/staff-guardianlist',$data);
			}else{
				$this->load->view('staff/staff-dashboard');
			}
		}else{
			redirect('staff/login');
		}
	}
	/** 
	* Controller function to handle add guardian
	*/
	public function addGuardian()
	{   
		if($this->isStaffLoggedIn()){

			if($this->hasStaffAccess()){
			 $this->load->model('StaffModel');
			 $data['result']=$this->StaffModel->getGuardianInmateDetails();
              $this->load->view('staff/staff-addGuardian',$data);	
	        }else{
				$this->load->view('staff/staff-dashboard');
	        }
	    }else{
	   		redirect('staff/login');
	   }
		
	}
	public function addGuardianDo()
	{   
		  if($this->input->post()){

		            $fullname = $this->input->post('fullname');
		            $mobile = $this->input->post('mobile');
					$email = $this->input->post('email');
					$password = $this->input->post('temporarypassword');
					$gender = $this->input->post('select');
					$permanentAddress = $this->input->post('permanentaddress');
					$presentAddress = $this->input->post('presentaddress');
					$inmateid=$this->input->post('selectname');

		        	$credentials = array(
		        		'guardian_name'=>$fullname,
		        		'mobile'=>$mobile,
		        		'email'=>$email,
		        		'password_hash'=>$password,
		        		'permanent_address'=>$permanentAddress,
		        		'present_address'=>$presentAddress,
		        		'gender'=>$gender,
		        		'inmate_id'=>$inmateid
		        	);
		        	

	                $this->form_validation->set_rules('fullname', 'Fullname', 'required|max_length[100]|trim');
	                $this->form_validation->set_rules('mobile', 'Mobile', 'required|max_length[10]|trim');
	        	    $this->form_validation->set_rules('email', 'Email', 'required|max_length[50]|trim');
	                $this->form_validation->set_rules('temporarypassword', 'Password', 'required|max_length[25]|trim');
	                $this->form_validation->set_rules('permanentaddress', 'Permanent', 'required|max_length[500]trim');
	                $this->form_validation->set_rules('presentaddress', 'PresentAddress', 'required|max_length[500]trim');
	                

	                if ($this->form_validation->run() == FALSE){

	                  	$data['error'] = "Sorry enter the  detais correctly";
	                }else{  
						$this->load->model('StaffModel');
						if(!$this->StaffModel->saveGuardianRegistrationDetails($credentials)){
							$data['error'] = "Sorry, something went wrong!";
	                  	}else{
							$data['message'] = "Thank you for adding.";
	                  	}
	                  	redirect('staff/list-guardian');
	                }
			}else{
				redirect('staff/login');
			}
	}
     /**
     Controller Function to handle staff editing  guardian     

    **/
    public function editGuardianDetails()
    {
    	if($this->isStaffLoggedIn()){

    		if($this->hasStaffAccess()){
	   			
				$this->load->model('StaffModel');
				$id =$this->uri->segment(3);
				$data = $this->StaffModel->getGuardianEditDetails($id);
				$this->load->view('staff/staff-editguardian',$data);
			}else{
				$this->load->view('staff/staff-dashboard');
		    }
		}else{
			redirect('staff/login');
		}
    }
    /**
     Controller Function to handle staff update  guardian     

    **/
    public function updateGuardianDetails()
    {
    	if($this->isStaffLoggedIn()){
    		if($this->hasStaffAccess()){

			    if($this->input->post()){
			    	$id =$this->uri->segment(3);
		            $fullname = $this->input->post('fullname');
		            $mobile = $this->input->post('mobile');
					$email = $this->input->post('email');
					$gender = $this->input->post('select');
					$permanentAddress = $this->input->post('permanentaddress');
					$presentAddress = $this->input->post('presentaddress');

		        	$credentials = array(
	                     'id'=>$id,
		        		'guardian_name'=>$fullname,
		        		'mobile'=>$mobile,
		        		'email'=>$email,
		        		'permanent_address'=>$permanentAddress,
		        		'present_address'=>$presentAddress,
		        		'gender'=>$gender
		        	);
		        	

	                $this->form_validation->set_rules('fullname', 'Fullname', 'required|max_length[100]|trim');
	                $this->form_validation->set_rules('mobile', 'Mobile', 'required|max_length[10]|trim');
	        	    $this->form_validation->set_rules('email', 'Email', 'required|max_length[50]|trim');
	                $this->form_validation->set_rules('permanentaddress', 'Permanent', 'required|max_length[500]');
	                $this->form_validation->set_rules('presentaddress', 'PresentAddress', 'required|max_length[500]');

	                if ($this->form_validation->run() == FALSE){

	                  	$data['error'] = "Sorry enter the  detais correctly";
	                }else{  

						$this->load->model('StaffModel');
						if(!$this->StaffModel->updateGuardianRegistrationDetails($credentials)){
							$data['error'] = "Sorry, something went wrong!";
	                  	}else{
							$data['message'] = "Thank you for updating.......";
							
	                  	}
	                }
			    }
	          redirect('staff/list-guardian');	
	        }

	        }else{
	   		   redirect('staff/login');
	   		}
    }
    /**
     Controller Function to handle deleting guardian by staff    

    **/
   public function deleteGuardianDetails()
   {
   		if($this->isStaffLoggedIn()){

   			if($this->hasStaffAccess()){
	   			
				$this->load->model('StaffModel');
				$id =$this->uri->segment(3);
	            if(!$this->StaffModel->deleteGuardianRegistrationDetails($id)){
				  $data['error'] = "Sorry, something went wrong!";	      
	            }else{      
				  
				}
	        } redirect('staff/list-guardian');
	        
	    }else{
			redirect('staff/login');
	    }
	}
	  /** 
	* Controller function to handle list medicine
	*/
	public function listMedicine()
	{
		if($this->isStaffLoggedIn()){
			if($this->hasStaffAccess()){
				$this->load->model('StaffModel');
				$data['result'] = $this->StaffModel->getMedicineDetails();
				$this->load->view('staff/staff-medicinelist',$data);
			}else{
				$this->load->view('staff/staff-dashboard');
			}
		}else{
			redirect('staff/login');
		}
	}
	/** 
	* Controller function to handle add medicine
	*/
	public function addMedicine()
	{   
		if($this->isStaffLoggedIn()){

			if($this->hasStaffAccess()){

					$this->load->view('staff/staff-addmedicinelist');	
			}else{
				$this->load->view('staff/staff-dashboard');
	        }
	    }else{
	   		redirect('staff/login');
	   }       
	}
	public function addMedicineDo()
	{
         if($this->input->post()){

		            $fullname = $this->input->post('medicine_name');
		            $medicine_stock = $this->input->post('medicine_stock');
		            $medicine_rep_name = $this->input->post('medicine_rep_name');
		            $rep_mobile = $this->input->post('rep_mobile');
		            
		        	$credentials = array(
		        		'medicine_name'=>$fullname,
		        		'available_medicine_stock_count'=>$medicine_stock,
		        		'medical_rep_name'=>$medicine_rep_name,
		        		'medical_rep_mobile'=> $rep_mobile
		        	);
		        	

	                $this->form_validation->set_rules('medicine_name', 'Fullname', 'required|max_length[100]|trim');
	        	    $this->form_validation->set_rules('medicine_stock', 'MedicineStock', 'required|max_length[500]|trim');
	        	    $this->form_validation->set_rules('medicine_rep_name', 'MedicineRep', 'required|max_length[100]|trim');
	        	    $this->form_validation->set_rules('rep_mobile', 'RepMobile', 'required|max_length[10]|trim');

	                

	                if ($this->form_validation->run() == FALSE){

	                  	$data['error'] = "Sorry enter the  detais correctly";
	                }else{  
						$this->load->model('StaffModel');
						if(!$this->StaffModel->saveMedicineRegistrationDetails($credentials)){
							$data['error'] = "Sorry, something went wrong!";
	                  	}else{
							$data['message'] = "Thank you for adding.";
	                  	}redirect('staff/list-medicine');
	                }
		}else{
			redirect('staff/login');
		}
		   
	}
	 /**
     Controller Function to handle staff editing  medicine details    

    **/
    public function editMedicineDetails()
    {
    	if($this->isStaffLoggedIn()){

    		if($this->hasStaffAccess()){
	   			
				$this->load->model('StaffModel');
				$id =$this->uri->segment(3);
				$data = $this->StaffModel->getMedicineEditDetails($id);
				$this->load->view('staff/staff-editmedicine',$data);
			}else{
				$this->load->view('staff/staff-dashboard');
		    }
		}else{
			redirect('staff/login');
		}
    }
    /**
     Controller Function to handle staff update  medicine     

    **/
    public function updateMedicineDetails()
    {
    	if($this->isStaffLoggedIn()){
    		if($this->hasStaffAccess()){

			    if($this->input->post()){
			    	$id =$this->uri->segment(3);
		            $fullname = $this->input->post('medicine_name');
		            $medicine_stock = $this->input->post('medicine_stock');
		            $medicine_rep_name = $this->input->post('medicine_rep_name');
		            $rep_mobile = $this->input->post('rep_mobile');
		            
		        	$credentials = array(
		        		'id'=>$id,
		        		'medicine_name'=>$fullname,
		        		'available_medicine_stock_count'=>$medicine_stock,
		        		'medical_rep_name'=>$medicine_rep_name,
		        		'medical_rep_mobile'=> $rep_mobile
		        	);
		        
	                $this->form_validation->set_rules('medicine_name', 'Fullname', 'required|max_length[100]|trim');
	        	    $this->form_validation->set_rules('medicine_stock', 'MedicineStock', 'required|max_length[500]|trim');
	        	    $this->form_validation->set_rules('medicine_rep_name', 'MedicineRep', 'required|max_length[100]|trim');
	        	    $this->form_validation->set_rules('rep_mobile', 'RepMobile', 'required|max_length[10]|trim');


	                if ($this->form_validation->run() == FALSE){
	                  	$data['error'] = "Sorry enter the  detais correctly";
	                }else{  

						$this->load->model('StaffModel');
						if(!$this->StaffModel->updateMedicineRegistrationDetails($credentials)){
							$data['error'] = "Sorry, something went wrong!";
	                  	}else{
	     
							$data['message'] = "Thank you for updating.......";
							
	                  	}
	                }
			    }
	          redirect('staff/list-medicine');	
	        }

	        }else{
	   		   redirct('staff/login');
	   		}
    }
    /**
    Controller Function to handle deleting guardian by staff    

    **/
      public function getMessageId()
  	{
  		$this->load->model('StaffModel');
	    if ($this->input->post() && $this->input->is_ajax_request()) 
	    {
	      $messageId = $this->input->post('messageId');
	      $data['result'] = $this->StaffModel->getMessageDetails($messageId);
	      $this->StaffModel->getMessageDetailsStatus($messageId);
	      echo json_encode($data);
	    } 
	    else 
	    {
	      redirect('staff/dashboard');
	    }

  }
  public function getResult()
  	{
  		$this->load->model('StaffModel');
	    if ($this->input->post() && $this->input->is_ajax_request()) 
	    {
	      $type_send = $this->input->post('type_send');
	      if(strcmp($type_send,"staff")==0)
	      {
	      	$data['result'] = $this->StaffModel->getStaffList();
	        echo json_encode($data);
	      }
	      elseif(strcmp($type_send,"admin")==0)
	      {
	      	$data['result'] = $this->StaffModel->getAdminList();
	        echo json_encode($data);
	      }
	      elseif (strcmp($type_send,"guardian")==0) 
	      {
	      	$data['result'] =$this->StaffModel->getGuardianList();
	        echo json_encode($data);
	      }
	      else
	      {
	      	$data['result'] = $this->StaffModel->getInmateList();
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
		if($this->isStaffLoggedIn())
		{
			
			$this->load->helper('url');
			$this->load->model('InmateModel');
			$to_type = $this->input->post('to_type');
			$to_id = $this->input->post('to_id');
			$status="0";
			$from_id=$this->session->userdata('id');
			$from_type="staff";
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
			redirect('staff/dashboard');
		}
		else
		{
			redirect('inmate/login');
		}
	}
   public function deleteMedicineDetails()
   {
   		if($this->isStaffLoggedIn()){

   			if($this->hasStaffAccess()){
	   			
				$this->load->model('StaffModel');
				$id =$this->uri->segment(3);
	            if(!$this->StaffModel->deleteMedicineRegistrationDetails($id)){
				  $data['error'] = "Sorry, something went wrong!";	      
	            }else{      
				}
				 redirect('staff/list-medicine');
	        }
	    }else{
			redirect('staff/login');
	    }
    }
}