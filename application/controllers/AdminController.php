<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class AdminController	 extends CI_Controller 
{
	public function profileGuardian()
	{
		if($this->isAdminSession())
		{	
			$this->load->helper('url');
			$id=$this->uri->segment(3);
			$this->load->model('AdminModel');
			$data=$this->AdminModel->editGuardian($id);
			$this->load->view('adminView/guardianProfile',$data);

		}
		else
		{
			redirect('admin/login');
		}
	}
	public function showBirthday()
	{
		if($this->isAdminSession())
		{	
			$this->load->model('AdminModel');
			$credentials['start_date_month']=date('m');
			$credentials['end_date_month']=date('m', strtotime("+30 days"));
			$credentials['start_date_day']=date('d');
			$credentials['end_date_day']=date('d', strtotime("+30 days"));
			$data['inmate']=$this->AdminModel->getInmateBirthday($credentials);
			$data['staff']=$this->AdminModel->getStaffBirthday($credentials);
			$this->load->view('adminView/birth',$data);
			
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function profileInmate()
	{
		if($this->isAdminSession())
		{	
			$this->load->helper('url');
			$id=$this->uri->segment(3);
			$this->load->model('AdminModel');
			$data=$this->AdminModel->editInmate($id);
			$this->load->view('adminView/inmateProfile',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}
	
	public function adminResetCheck($credentials)
	{
		if($this->input->post())
		{
			$credentials['message_new']=$this->input->post('reset');
			$this->load->model('AdminModel');
			if($this->AdminModel->checkReset($credentials))
			{
				echo "hai";
			}
			else
			{
				$this->load->view('adminView/adminReset',$credentials);
			}
		}
		else
		{
			$this->load->view('adminView/adminReset',$credentials);
		}
	}
	public function adminForgotPass()
	{
		if($this->input->post())
		{
			
			$toEmail=$this->input->post('email');
			$this->load->model('AdminModel');
			if($this->AdminModel->notEmailAdmin($toEmail))
			{	
				if($this->AdminModel->alreadySendAdmin($toEmail))
				{
					$this->load->helper('string');
					$message=random_string('alnum',5);
					while($this->AdminModel->notInAdmin($message)) 
					{
     					$message=random_string('alnum',5);
     				}
     				$credentials['message']=$message;
     				$credentials['email']=$toEmail;
     				$this->adminEmailSend($credentials);
     				$this->AdminModel->updatePasswordReset($credentials);
     				$this->adminResetCheck($credentials);
     				$this->load->view('adminView/adminResend',$credentials);

     			}
				else
				{
					$credentials['email']=$toEmail;
					$this->load->view('adminView/adminResend',$credentials);
				}
			}
			else
			{

				$data['message']="Invalid Email Entered";
				redirect('admin/forgot-password');
				
			}
		}
		else
		{
			$this->load->view('adminView/adminForgotPass');
		}
	}
	public function adminPasswordResend()
	{
		$this->load->model('AdminModel');
		if($this->input->post())
		{
			$toEmail=$this->input->post('email');
			$credentials['email']=$toEmail;
			$message=$this->AdminModel->passwordResetMessage($credentials['email']);
			if($message=='FALSE')
			{
			}
			else
			{

				$credentials['message']=$message;
				$this->adminEmailSend($credentials);
				$this->load->view('adminView/adminResend',$credentials);
			}
			

		}
		else
		{
			$this->load->view('adminView/adminResend');
		}
	}
	public function adminEmailSend($credentials)
	{
			$toEmail=$credentials['email'];
			//$toEmail="amaldevastvm@gmail.com";
			
			$message1=$credentials['message'];
			$message2="Your Password Reset Link is : http://localhost:8081/Thanal/index.php/admin/password-change/";
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
	public function staffForgot()
	{
		$this->load->view('staffForgot');	
	}
	public function gaurdianForgot()
	{
		$this->load->view('gaurdianForgot');
	}
	public function inmateForgot()
	{
		$this->load->view('inmateForgot');
	}
	public function adminLogout()
	{
		$data['message']='';
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('type');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('name');
		$this->load->view('adminLogin',$data);
	}
	public function isAdminSession()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='admin')
		{
			$data['name']=$this->session->userdata('name');
			$data['email']=$this->session->userdata('email');
			$credentials['id']=$this->session->userdata('id');
			$credentials['type']=$this->session->userdata('type');
			$this->load->model('AdminModel');
			$data['message_show']=$this->AdminModel->getMessage($credentials);
			$data['message_count']=$this->AdminModel->getMessageCount($credentials);
			$this->load->view('partials/topSide',$data);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	public function saveStaffTypeModify()
	{
		if($this->isAdminSession())
		{
			
			$this->load->model('AdminModel');
			$this->load->helper('url');
			$staff_type_id=$this->uri->segment(3);
			$staff_type = $this->input->post('staff_type');
			$credentials = array('staff_type_id'=>$staff_type_id,'staff_type'=>$staff_type);
			if($this->AdminModel->updateStaffType($credentials))
			{
				$data['message']="Succesfully Updated";
			}
			else
			{
				$data['message']="Updation Failed";
			}
			redirect('admin/staff-type');
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function showStaffTypeEdit()
	{

		if($this->isAdminSession())
		{
			
			$this->load->model('AdminModel');
			$this->load->helper('url');
			$staff_type_id=$this->uri->segment(3);
			$data=$this->AdminModel->editStaffType($staff_type_id);
			$this->load->view('adminView/adminStaffTypeEdit',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function adminLogin()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			$data['message']="Login Successfull";
			
			$data['name']=$this->session->userdata('name');
			$data['email']=$this->session->userdata('email');
			redirect('admin/dashboard');

		}
		elseif($this->input->post())
		{

			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$credentials = array('email'=>$email,'password'=>$password);
			$this->form_validation->set_rules('email', 'Email', 'required|max_length[100]|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[10]');
			if ($this->form_validation->run() == FALSE) 
			{
				echo "hai";
				$data['message'] = "Credentials are not valid";
				$this->load->view('adminLogin', $data);
			}
			else
			{
				$this->load->model('AdminModel');
				$data['result']=$this->AdminModel->isAdminExist($credentials);
				if(empty($data['result']))
				{
					$data['message'] = "Sorry, failed to login";
					$this->load->view('adminLogin', $data);
				}
				else
				{
					$credentials1['id']=$data['result'][0]->id;
					$data=$this->AdminModel->registerSessionForAdmin($credentials1);
					$data['message']="Login Successfull";
					$this->AdminModel->adminPasswordResetNull($credentials);
					redirect('admin/dashboard');

				}
			}

		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function profile()
	{
		if($this->isAdminSession())
		{
			
			$this->load->model('AdminModel');
			$this->load->helper('url');
			//$staff_type_id=$this->uri->segment(3);
			//$data=$this->AdminModel->editStaffType($staff_type_id);
			$this->load->view('profile');
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function gaurdianLogin()
	{
		$this->load->view('gaurdianLogin');
	}
	public function inmateLogin()
	{
		$this->load->view('inmateLogin');
	}
	public function staffLogin()
	{
		$this->load->view('staffLogin');
	}
	public function showSample()
	{
		$this->load->view('orginal');
	}
	
	public function showMedicineScheduleHistory()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			if($this->input->post())
			{
				$credentials['from_date'] = $this->input->post('from');	
				$credentials['to_date'] = $this->input->post('to');
				$data['result']=$this->AdminModel->getMedicineScheduleSearch($credentials);
				$this->load->view('adminView/adminMedicineScheduleHistory',$data);
			}
			else
			{
				date_default_timezone_set('Asia/Calcutta');
				$credentials['date']=date('Y-m-d');
				$credentials['time']=date('H:i:s');
				$data['result']=$this->AdminModel->getMedicineScheduleWithoutTime($credentials);
				$this->load->view('adminView/adminMedicineScheduleHistory',$data);
			}
			
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function adminDash()
	{
		if($this->isAdminSession())
		{
			date_default_timezone_set('Asia/Calcutta');
			$credentials['date']=date('Y-m-d');
			$credentials['time']=date('H:i:s');
			$this->load->model('AdminModel');
			$data['result']=$this->AdminModel->getMedicineSchedule($credentials);
			$this->load->view('adminView/adminDashboard',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function staffList()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			$data['result']=$this->AdminModel->getStaffList();
			$this->load->view('adminView/adminStaffListing',$data);

		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function listDuty()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			$date=date('Y-m-d');

			$data['result']=$this->AdminModel->getStaffDuty($date);
			
			$this->load->view('adminView/adminDutyListing',$data);

		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function showShiftHistory()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			if($this->input->post())
			{
				$credentials['from_date'] = $this->input->post('from');	
				$credentials['to_date'] = $this->input->post('to');
				$data['result']=$this->AdminModel->getStaffDutySearch($credentials);
				$this->load->view('adminView/adminShiftHistory',$data);
			}
			else
			{
				$date=date('Y-m-d');

				$data['result']=$this->AdminModel->getStaffDuty($date);
				
				$this->load->view('adminView/adminShiftHistory',$data);
			}
			
			

		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function dutyAssign()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			if($this->input->post())
			{
				$from_date = $this->input->post('from');	
				$to_date = $this->input->post('to');
				$staff_count = $this->input->post('count_staff');	
				$shift_count = $this->input->post('count_shift');
				
				for($current_date=$from_date;$current_date<=$to_date;$current_date=date('Y-m-d', strtotime($current_date . '+1 days')))
				{

					if($this->AdminModel->isAssigned($current_date))
					{

					}
					else
					{
						$data1=$this->AdminModel->inmateMedicines();	
						if(!empty($data1))
						{
							foreach ($data1 as $row) 
							{
								$data2['medicine_date']=$current_date;
								$data2['inmate_medicine_id']=$row->id;
								$data2['inmate_id']=$row->inmate_id;
								$data2['medicine_id']=$row->medicine_id;
								$this->AdminModel->medicineSchedule($data2);
							}
						}
						$credentials['date']=$current_date;
						$credentials['assigned']="1";
						$this->AdminModel->isDutyDateAssign($credentials);
						for($i=1;$i<$staff_count;$i++)
						{
							$credentials1['staff_id']=$this->input->post('id-'.$i);
							$credentials1['date']=$current_date;
							$credentials1['status']=0;
							$credentials1['no_duty']=0;
							for($j=1;$j<$shift_count;$j++)
							{
								$credentials1['shift_id']=$this->input->post('shift-'.$j);
								$shift=$this->input->post($credentials1['shift_id'].'-'.$i);
								if($shift=="1")
								{
										$this->AdminModel->assignDuty($credentials1);
								}
							}
						}

					}

				}
				for($current_date=$from_date;$current_date<=$to_date;$current_date=date('Y-m-d', strtotime($current_date . '+1 days')))
				{
					$data3=$this->AdminModel->inmateMedicinesDate($current_date);	
					$credentials2['careTakerId']=$this->AdminModel->staffCareTaker("Care Taker");
					$credentials2['date']=$current_date;
					if(!empty($data3))
						{
							foreach ($data3 as $row) 
							{
								$credentials2['time']=$row->time;
								$credentials4=$this->AdminModel->getMinStaff($credentials2);
								$credentials3['staff_id']=$credentials4['staff_id'];
								$credentials3['id']=$row->id;
								$this->AdminModel->updateSchedule($credentials3);
								$this->AdminModel->updateNoDuty($credentials4['id']);
							}
						}
					
				}
				$date=date('Y-m-d');
				$this->AdminModel->checkCurrentDate($date);
				redirect('admin/duty');
			}
			else
			{
				$data['no_shift']=$this->AdminModel->getShiftList();
				$data['no_staff']=$this->AdminModel->getStaffList();
				$this->load->view('adminView/adminDutyAssign',$data);
			}
		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function showStaffProfile()
	{
		if($this->isAdminSession())
		{
			
			$this->load->model('AdminModel');
			$this->load->helper('url');
			$staff_id=$this->uri->segment(3);
			$data=$this->AdminModel->editStaff($staff_id);
			$this->load->view('adminView/staffProfile',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function searchResults()
	{
		if($this->isAdminSession())
		{
			
			$this->load->model('AdminModel');
			$type = $this->input->post('type');
			$search = $this->input->post('search');
			if(strcmp($type,"please")==0)
			{
				redirect('admin/dashboard');
			}
			elseif (strcmp($type,"staff")==0) 
			{
				$data['result']=$this->AdminModel->getSearchStaffList($search);
				$this->load->view('adminView/adminStaffListing',$data);

			}
			elseif (strcmp($type,"guardian")==0) 
			{
				$data['result']=$this->AdminModel->getSearchGuardianList($search);
				$this->load->view('adminView/adminGuardianListing',$data);
			}
			elseif (strcmp($type,"medicine")==0) 
			{
				$data['result']=$this->AdminModel->getSearchMedicineList($search);
				$this->load->view('adminView/adminMedicineList',$data);
			}
			elseif (strcmp($type,"inmate")==0) 
			{
				$data['result']=$this->AdminModel->getSearchInmateList($search);
				$this->load->view('adminView/adminInmateList',$data);
			}
			else
			{
				redirect('admin/dashboard');
			}
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function editAdminStaff()
	{
		if($this->isAdminSession())
		{
			
			$this->load->model('AdminModel');
			$this->load->helper('url');
			$staff_id=$this->uri->segment(3);
			$data=$this->AdminModel->editStaff($staff_id);
			$data['result']=$this->AdminModel->listAllStaffType();
			$this->load->view('adminView/adminStaffEdit',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function deleteStaff()
	{
		if($this->isAdminSession())
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$id =$this->uri->segment(3);
			if($this->AdminModel->deleteStaff($id))
			{
				$data['message']="Succesfully Staff Deleted";
			}
			else
			{
				$data['message']="Staff Type Delete Failed";
			}
			redirect('admin/list-staff');
			//$data=$this->AdminModel->getStaffTypeAdmin();
		}
		else
		{
			redirect('admin/login');
		}
		
	}
	public function staffDetail()
	{
		$this->load->view('adminStaffDetailing');
	}
	public function adminStaffEdit()
	{
		$this->load->view('adminStaffEdit');
	}
	public function repEmail($credentials)
	{
			$toEmail=$credentials['rep_email'];
			//$toEmail="amaldevastvm@gmail.com";
			
			$message2="Hey, ";
			$message3=".This is a mail from Thanal Organization to inform that the organization have placed ";
			$message4=" Units of ";

			$message=$message2.$credentials['medical_rep_name'].$message3.$credentials['order'].$message4.$credentials['medicine_name'].".";
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

			$this->email->from('elixiroflyf123@gmail.com', 'Thanal');
			$this->email->to($toEmail);
			$this->email->cc('');
			$this->email->bcc('');
			$this->email->subject('Medicine Order From Thanal');
			$this->email->message($message);
			if($this->email->send()){
				$data['message']="Email sent successfully";
			}else{
				echo $this->email->print_debugger();die;
				$data['message']="Failed to sent email";
			}

		
		
	}
	public function medicineOrder()
	{
		if($this->isAdminSession())
		{
			if($this->input->post())
			{
				$credentials['id'] = $this->input->post('id');
				$credentials['order'] = $this->input->post('medicine_order');
				
				$credentials=$this->AdminModel->editMedicine($credentials['id']);
				$credentials['id'] = $this->input->post('id');
				$credentials['order'] = $this->input->post('medicine_order');
				$this->repEmail($credentials);
				redirect('admin/medicine-order');
			}
			else
			{

				$this->load->model('AdminModel');
				$data['result']=$this->AdminModel->getMedicineList();
				$this->load->view('adminView/adminMedicineOrder',$data);
			}
			
			//$data=$this->AdminModel->getStaffTypeAdmin();
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function medicineList()
	{
		if($this->isAdminSession())
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$id =$this->uri->segment(3);
			$data['result']=$this->AdminModel->getMedicineList($id);
			$this->load->view('adminView/adminMedicineList',$data);
			//$data=$this->AdminModel->getStaffTypeAdmin();
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function deleteStaffList()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='admin')
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			
			$this->load->model('AdminModel');
			$data['name']=$this->session->userdata('name');
			$data['email']=$this->session->userdata('email');
			$page =$this->uri->segment(3);
			if($this->AdminModel->deleteStaffType($page))
			{
				$data['message']="Succesfully Staff Type Deleted";
			}
			else
			{
				$data['message']="Staff Type Delete Failed";
			}
			$this->staffType();
			//$data=$this->AdminModel->getStaffTypeAdmin();
		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function createStaffType()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='admin')
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			
			$this->load->model('AdminModel');
			$data['name']=$this->session->userdata('name');
			$data['email']=$this->session->userdata('email');
			$staff_type = $this->input->post('staff_type');
			$credentials = array('staff_type'=>$staff_type);
			if($this->AdminModel->createStaffType($credentials))
			{
				$data['message']="Succesfully Staff Type Created";
			}
			else
			{
				$data['message']="Staff Type Creation Failed";
			}
			redirect('admin/staff-type');
			//$data=$this->AdminModel->getStaffTypeAdmin();
		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function showAdminAddStaffType()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='admin')
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$data['message']="Login Successfull";
			//$data=$this->AdminModel->getStaffTypeAdmin();
			$data['name']=$this->session->userdata('name');
			$data['email']=$this->session->userdata('email');
			$this->load->view('adminAddStaffType',$data);

		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function staffType()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='admin')
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$data['message']="Login Successfull";
			
			$this->load->model('AdminModel');
			//$data=$this->AdminModel->getStaffTypeAdmin();
			$data['name']=$this->session->userdata('name');
			$data['email']=$this->session->userdata('email');
			$data['staff_type']= $this->AdminModel->getAllStaffType(20,0);
			$this->load->view('adminStaffTypeList',$data);

		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function updateAdminStaff()
	{
		if($this->isAdminSession())
		{
			
			$this->load->model('AdminModel');
			$this->load->helper('url');
			$staff_id=$this->uri->segment(3);
			$staff_type_id = $this->input->post('staff_type_id');
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$gender  = $this->input->post('gender');
			$can_view_inmate_medicine_schedule  = $this->input->post('can_view_inmate_medicine_schedule');
			if($can_view_inmate_medicine_schedule!="1")
			{
				$can_view_inmate_medicine_schedule  = "0";
			}
			$date_of_birth = $this->input->post('date_of_birth');
			$date_of_joining = $this->input->post('date_of_joining');
			$staff_type_id = $this->input->post('staff_type_id');
			$permanent_address = $this->input->post('permanent_address');
			$present_address = $this->input->post('present_address');
			$credentials = array(
									'id'=>$staff_id,
									'staff_type_id'=>$staff_type_id,
									'name'=>$name,
									'email'=>$email,
									'mobile'=>$mobile,
									'gender'=>$gender,
									'date_of_birth'=>$date_of_birth,
									'date_of_joining'=>$date_of_joining,
									'permanent_address'=>$permanent_address,
									'can_view_inmate_medicine_schedule'=>$can_view_inmate_medicine_schedule,
									'present_address'=>$present_address
								);
			if($this->AdminModel->updateStaff($credentials))
			{
				$data['message']="Succesfully Updated";
			}
			else
			{
				$data['message']="Updation Failed";
			}
			redirect('admin/list-staff');
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function createAdminStaff()
	{
		if($this->isAdminSession())
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$staff_type_id = $this->input->post('staff_type_id');
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$gender  = $this->input->post('gender');
			$date_of_birth = $this->input->post('date_of_birth');
			$date_of_joining = $this->input->post('date_of_joining');
			$staff_type_id = $this->input->post('staff_type_id');
			$password_hash = $this->input->post('password_hash');
			$permanent_address = $this->input->post('permanent_address');
			$present_address = $this->input->post('present_address');
			$credentials = array(
									'staff_type_id'=>$staff_type_id,
									'name'=>$name,
									'email'=>$email,
									'mobile'=>$mobile,
									'gender'=>$gender,
									'date_of_birth'=>$date_of_birth,
									'date_of_joining'=>$date_of_joining,
									'password_hash'=>$password_hash,
									'permanent_address'=>$permanent_address,
									'present_address'=>$present_address
								);
			$this->form_validation->set_rules('email', 'Email', 'required|max_length[100]|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');
			if($this->AdminModel->createStaff($credentials))
			{
				$data['message']="Succesfully Staff Created";
			}
			else
			{
				$data['message']="Staff Creation Failed";
			}
			redirect('admin/list-staff');
		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function showAdminAddStaff()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			$data['message']="Login Successfull";
			$this->load->model('AdminModel');
			$data['result']=$this->AdminModel->listAllStaffType();
			$this->load->view('adminView/adminAddStaff',$data);

		}
		else
		{
			redirect('admin/login');
		}
	}
	public function getShiftDetails()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			$data['result']=$this->AdminModel->getShiftList();
			$this->load->view('adminView/adminShift',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function showInmateList()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			$data['message']="Login Successfull";
			$data['result']=$this->AdminModel->getInmateList();
			$this->load->view('adminView/adminInmateList',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}
	
	public function showAdminAddShift()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			if($this->input->post())
			{
				$credentials['shift_name'] = $this->input->post('shift_name');
				$credentials['shift_start_time'] = $this->input->post('start_time');
				$credentials['shift_end_time'] = $this->input->post('end_time');
				if($this->AdminModel->createShift($credentials))
				{
					$data['message']="Succesfully Shift Created";
					redirect('admin/shift');
				}
				else
				{
					$data['message']="Shift Creation Failed";
					redirect('admin/add-shift');
				}
			}
			else
			{
				$this->load->view('adminView/adminAddShifts');
				
			}
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function showAdminAddInmate()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			$data['message']="Login Successfull";
			$this->load->view('adminView/adminAddInmate',$data);

		}
		else
		{
			redirect('admin/login');
		}
	}
	public function showAdminCreateInmate()
	{
		if($this->isAdminSession())
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$gender  = $this->input->post('gender');
			$date_of_birth = $this->input->post('date_of_birth');
			$date_of_joining = $this->input->post('date_of_joining');
			$payment_per_month  = $this->input->post('payment_per_month');
			$password_hash = $this->input->post('password_hash');
			$permanent_address = $this->input->post('permanent_address');
			$emergency_contact_person = $this->input->post('emergency_contact_person');
			$emergency_contact_number = $this->input->post('emergency_contact_number');
			$present_address = $this->input->post('present_address');
			$credentials = array(
									'name'=>$name,
									'email'=>$email,
									'mobile'=>$mobile,
									'gender'=>$gender,
									'date_of_birth'=>$date_of_birth,
									'date_of_joining'=>$date_of_joining,
									'emergency_contact_person'=>$emergency_contact_person,
									'emergency_contact_number'=>$emergency_contact_number,
									'password_hash'=>$password_hash,
									'payment_per_month'=>$payment_per_month,
									'permanent_address'=>$permanent_address,
									'present_address'=>$present_address
								);
			$this->form_validation->set_rules('email', 'Email', 'required|max_length[100]|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');
			if($this->AdminModel->createInmate($credentials))
			{
				$data['message']="Succesfully Inmate Created";
			}
			else
			{
				$data['message']="Inmate Creation Failed";
			}
			redirect('admin/list-inmate');
		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function deleteInmate()
	{
		if($this->isAdminSession())
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$id =$this->uri->segment(3);
			if($this->AdminModel->deleteInmate($id))
			{
				$data['message']="Succesfully Inmate Deleted";
			}
			else
			{
				$data['message']="Inmate Delete Failed";
			}
			redirect('admin/list-inmate');
			//$data=$this->AdminModel->getStaffTypeAdmin();
		}
		else
		{
			redirect('admin/login');
		}
		
	}
	public function deleteShift()
	{
		if($this->isAdminSession())
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$id =$this->uri->segment(3);
			if($this->AdminModel->deleteShift($id))
			{
				$data['message']="Succesfully Shift Deleted";
			}
			else
			{
				$data['message']="Shift Delete Failed";
			}
			redirect('admin/shift');
			//$data=$this->AdminModel->getStaffTypeAdmin();
		}
		else
		{
			redirect('admin/login');
		}
		
	}
	public function showAdminEditShift()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			$this->load->helper('url');
			$id=$this->uri->segment(3);
			if($this->input->post())
			{
				$credentials['shift_name'] = $this->input->post('shift_name');
				$credentials['shift_start_time'] = $this->input->post('shift_start_time');
				$credentials['shift_end_time'] = $this->input->post('shift_end_time');
				$credentials['id'] = $id;
				if($this->AdminModel->updateShift($credentials))
				{
					redirect('admin/shift');
				}
				else
				{
					$data=$this->AdminModel->editShift($id);
					$this->load->view('adminView/adminEditShifts',$data);
				}
			}	
			else
			{
				$data=$this->AdminModel->editShift($id);
				$this->load->view('adminView/adminEditShifts',$data);
			}
			
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function inmateEdit()
	{
		if($this->isAdminSession())
		{
			
			$this->load->model('AdminModel');
			$this->load->helper('url');
			$id=$this->uri->segment(3);
			$data=$this->AdminModel->editInmate($id);
			$data['result']=$this->AdminModel->medicineInmate($id);
			$this->load->view('adminView/adminInmateEdit',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function updateAdminInmate()
	{
		if($this->isAdminSession())
		{
			
			$this->load->model('AdminModel');
			$this->load->helper('url');
			$id=$this->uri->segment(3);
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$gender  = $this->input->post('gender');
			$payment_per_month  = $this->input->post('payment_per_month');
			$date_of_birth = $this->input->post('date_of_birth');
			$date_of_joining = $this->input->post('date_of_joining');
			$password_hash = $this->input->post('password_hash');
			$permanent_address = $this->input->post('permanent_address');
			$emergency_contact_person = $this->input->post('emergency_contact_person');
			$emergency_contact_number = $this->input->post('emergency_contact_number');
			$present_address = $this->input->post('present_address');
			$credentials = array(
									'id'=>$id,
									'name'=>$name,
									'email'=>$email,
									'mobile'=>$mobile,
									'gender'=>$gender,
									'date_of_birth'=>$date_of_birth,
									'date_of_joining'=>$date_of_joining,
									'emergency_contact_person'=>$emergency_contact_person,
									'emergency_contact_number'=>$emergency_contact_number,
									'password_hash'=>$password_hash,
									'permanent_address'=>$permanent_address,
									'payment_per_month'=>$payment_per_month,
									'present_address'=>$present_address
								);
			if($this->AdminModel->updateInmate($credentials))
			{
				$data['message']="Succesfully Updated";
			}
			else
			{
				$data['message']="Updation Failed";
			}
			redirect('admin/list-inmate');
		}
		else
		{
			redirect('admin/login');
		}
	}

	public function showAdminAddMedicine()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			$data['message']="Login Successfull";
			$this->load->view('adminView/adminAddMedicine');

		}
		else
		{
			redirect('admin/login');
		}
	}
	public function medicineCreate()
	{
		if($this->isAdminSession())
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$medicine_name = $this->input->post('medicine_name');
			$available_medicine_stock_count = $this->input->post('available_medicine_stock_count');
			$medical_rep_name = $this->input->post('medical_rep_name');
			$medical_rep_mobile  = $this->input->post('medical_rep_mobile');
			$credentials = array(
									'medicine_name'=>$medicine_name,
									'available_medicine_stock_count'=>$available_medicine_stock_count,
									'medical_rep_name'=>$medical_rep_name,
									'medical_rep_mobile'=>$medical_rep_mobile
								);
			$this->form_validation->set_rules('medicine_name', 'medicine_name', 'required|trim');
			$this->form_validation->set_rules('available_medicine_stock_count', 'available_medicine_stock_count', 'required|trim');
			$this->form_validation->set_rules('medical_rep_name', 'medical_rep_name', 'required|trim');
			$this->form_validation->set_rules('medical_rep_mobile', 'medical_rep_mobile', 'required|trim');
			if($this->AdminModel->createMedicine($credentials))
			{
				$data['message']="Succesfully Medicine Created";
			}
			else
			{
				$data['message']="Medicine Creation Failed";
			}
			redirect('admin/list-medicine');
		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function deleteMedicine()
	{
		if($this->isAdminSession())
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$id =$this->uri->segment(3);
			if($this->AdminModel->deleteMedicine($id))
			{
				$data['message']="Succesfully Staff Deleted";
			}
			else
			{
				$data['message']="Staff Type Delete Failed";
			}
			redirect('admin/list-medicine');
			//$data=$this->AdminModel->getStaffTypeAdmin();
		}
		else
		{
			redirect('admin/login');
		}
		
	}
	public function medicineEdit()
	{
		if($this->isAdminSession())
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$id =$this->uri->segment(3);
			$data=$this->AdminModel->editMedicine($id);
			$this->load->view('adminView/adminMedicineEdit',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function medicineUpdate()
	{
		if($this->isAdminSession())
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$id =$this->uri->segment(3);
			$medicine_name = $this->input->post('medicine_name');
			$available_medicine_stock_count = $this->input->post('available_medicine_stock_count');
			$new_available_medicine_stock_count = $this->input->post('new_available_medicine_stock_count');
			$total_quantity=$this->input->post('total_quantity');
			$total_quantity=$new_available_medicine_stock_count+$total_quantity;
			$available_medicine_stock_count =$available_medicine_stock_count+$new_available_medicine_stock_count;
			$medical_rep_name = $this->input->post('medical_rep_name');
			$medical_rep_mobile  = $this->input->post('medical_rep_mobile');
			$credentials = array(
									'id'=>$id,
									'medicine_name'=>$medicine_name,
									'available_medicine_stock_count'=>$available_medicine_stock_count,
									'total_quantity'=>$total_quantity,
									'medical_rep_name'=>$medical_rep_name,
									'medical_rep_mobile'=>$medical_rep_mobile
								);
			$this->form_validation->set_rules('medicine_name', 'medicine_name', 'required|trim');
			$this->form_validation->set_rules('available_medicine_stock_count', 'available_medicine_stock_count', 'required|trim');
			$this->form_validation->set_rules('medical_rep_name', 'medical_rep_name', 'required|trim');
			$this->form_validation->set_rules('medical_rep_mobile', 'medical_rep_mobile', 'required|trim');
			if($this->AdminModel->updateMedicine($credentials))
			{
				$data['message']="Succesfully Medicine Updated";
			}
			else
			{
				$data['message']="Updation Creation Failed";
			}
			redirect('admin/list-medicine');
		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function guardianList()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			$data['result']=$this->AdminModel->getGuardianList();
			$this->load->view('adminView/adminGuardianListing',$data);

		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function createAdminGuardian()
	{
		if($this->isAdminSession())
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$inmate_id = $this->input->post('inmate_id');
			$guardian_name = $this->input->post('guardian_name');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$gender  = $this->input->post('gender');
			$date_of_birth = $this->input->post('date_of_birth');
			$password_hash = $this->input->post('password_hash');
			$permanent_address = $this->input->post('permanent_address');
			$present_address = $this->input->post('present_address');
			$credentials = array(
									'inmate_id'=>$inmate_id,
									'guardian_name'=>$guardian_name,
									'email'=>$email,
									'mobile'=>$mobile,
									'gender'=>$gender,
									'date_of_birth'=>$date_of_birth,
									'password_hash'=>$password_hash,
									'permanent_address'=>$permanent_address,
									'present_address'=>$present_address
								);
			$this->form_validation->set_rules('email', 'Email', 'required|max_length[100]|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');
			if($this->AdminModel->createGuardian($credentials))
			{
				$data['message']="Succesfully Guardian Created";
			}
			else
			{
				$data['message']="Guardian Creation Failed";
			}
			redirect('admin/list-guardian');
		}
		else
		{
			$data['message'] = "";
			$this->load->view('adminLogin',$data);
		}
	}
	public function showAdminAddGuardian()
	{
		if($this->isAdminSession())
		{
			$this->load->model('AdminModel');
			$data['message']="Login Successfull";
			$this->load->model('AdminModel');
			$data['result']=$this->AdminModel->getInmateList();

			$this->load->view('adminView/adminAddGuardian',$data);

		}
		else
		{
			redirect('admin/login');
		}
	}
	public function deleteGuardian()
	{
		if($this->isAdminSession())
		{
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$id =$this->uri->segment(3);
			if($this->AdminModel->deleteGuardian($id))
			{
				$data['message']="Succesfully Guardian Deleted";
			}
			else
			{
				$data['message']="Guardian Delete Failed";
			}
			redirect('admin/list-guardian');
			//$data=$this->AdminModel->getStaffTypeAdmin();
		}
		else
		{
			redirect('admin/login');
		}
		
	}
	public function editGuardian()
	{
		if($this->isAdminSession())
		{
			
			$this->load->model('AdminModel');
			$this->load->helper('url');
			$staff_id=$this->uri->segment(3);
			$data=$this->AdminModel->editGuardian($staff_id);
			$data['result']=$this->AdminModel->getInmateList();
			$this->load->view('adminView/adminGuardianEdit',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function guardianUpdate()
	{
		if($this->isAdminSession())
		{
			
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$id=$this->uri->segment(3);
			$inmate_id = $this->input->post('inmate_id');
			$guardian_name = $this->input->post('guardian_name');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$gender  = $this->input->post('gender');
			$date_of_birth = $this->input->post('date_of_birth');
			$permanent_address = $this->input->post('permanent_address');
			$present_address = $this->input->post('present_address');
			$credentials = array(
									'id'=>$id,
									'inmate_id'=>$inmate_id,
									'guardian_name'=>$guardian_name,
									'email'=>$email,
									'mobile'=>$mobile,
									'gender'=>$gender,
									'date_of_birth'=>$date_of_birth,
									'permanent_address'=>$permanent_address,
									'present_address'=>$present_address
								);
			$this->form_validation->set_rules('email', 'Email', 'required|max_length[100]|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');
			if($this->AdminModel->updateGuardian($credentials))
			{
				$data['message']="Succesfully Guardian Updated";
			}
			else
			{
				$data['message']="Guardian Updation Failed";
			}
			redirect('admin/list-guardian');
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function adminPasswordChangeLink()
	{
		$this->load->helper('url');
		$this->load->model('AdminModel');
		$email=$this->uri->segment(3);
		$reset=$this->uri->segment(4);
		$credentials['email']=$email;
		$credentials['reset']=$reset;
		if($this->input->post())
		{
			if($this->AdminModel->isValidReset($credentials))
			{
				$password = $this->input->post('password');
				$credentials['password']=$password;
				if($this->AdminModel->adminChangePasswordLink($credentials))
				{
					$this->AdminModel->adminPasswordResetNull($credentials);
				}
				else
				{

				}		
				redirect('admin/login');		
			}
			else
			{
				redirect('admin/forgot-password');
			}	
		}
		else
		{
			if($this->AdminModel->isValidReset($credentials))
			{
				$this->load->view('adminView/adminPasswordChangeLink');
			}
			else
			{
				redirect('admin/forgot-password');
			}
			
		}
	}
	public function adminPasswordChange()
	{
		if($this->isAdminSessionWithout())
		{
			$this->load->view('adminView/adminPasswordChange');

		}
		else
		{
			redirect('admin/login');
		}
	}
	public function adminPasswordChangeDo()
	{
		if($this->isAdminSessionWithout())
		{
			$password = $this->input->post('password');
			$id=$this->session->userdata('id');
			$this->load->model('AdminModel');
			$credentials = array(
									'id'=>$id,
									'password'=>$password
								);
			$data['result']=$this->AdminModel->adminChangePassword($credentials);
			redirect('admin/dashboard');

			
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function isAdminSessionWithout()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='admin')
		{
			$data['name']=$this->session->userdata('name');
			$data['email']=$this->session->userdata('email');
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	public function getResult()
  	{
  		$this->load->model('AdminModel');
	    if ($this->input->post() && $this->input->is_ajax_request()) 
	    {
	      $type_send = $this->input->post('type_send');
	      if(strcmp($type_send,"staff")==0)
	      {
	      	$data['result'] = $this->AdminModel->getStaffList();
	        echo json_encode($data);
	      }
	      elseif (strcmp($type_send,"guardian")==0) 
	      {
	      	$data['result'] =$this->AdminModel->getGuardianList();
	        echo json_encode($data);
	      }
	      else
	      {
	      	$data['result'] = $this->AdminModel->getInmateList();
	        echo json_encode($data);
	      }
	    } 
	    else 
	    {
	      redirect('admin/login');
	    }

  }
  public function getMessageId()
  	{
  		$this->load->model('AdminModel');
	    if ($this->input->post() && $this->input->is_ajax_request()) 
	    {
	      $messageId = $this->input->post('messageId');
	      $data['result'] = $this->AdminModel->getMessageDetails($messageId);
	      $this->AdminModel->getMessageDetailsStatus($messageId);
	      echo json_encode($data);
	    } 
	    else 
	    {
	      redirect('admin/login');
	    }

  }
  public function createMessage()
	{
		if($this->isAdminSessionWithout())
		{
			
			$this->load->helper('url');
			$this->load->model('AdminModel');
			$to_type = $this->input->post('to_type');
			$to_id = $this->input->post('to_id');
			$status="0";
			$from_id=$this->session->userdata('id');
			$from_type="admin";
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
			if($this->AdminModel->createMessage($credentials))
			{
				$data['message']="Message send Succesfully";
			}
			else
			{
				$data['message']="Message send failed";
			}
			redirect('admin/dashboard');
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function showMessage()
	{
		if($this->isAdminSessionWithout())
		{
			
			
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function sendInmateMedicine()
	{
		if($this->isAdminSessionWithout())
		{
			if ($this->input->post() && $this->input->is_ajax_request()) 
	    	{
	    		$this->load->model('AdminModel');
	    		$inmate_id = $this->input->post('id');
	    		$data['result']=$this->AdminModel->medicineInmate($inmate_id);
	    		echo json_encode($data);
	    	}
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function showInmateAddMedicine()
	{

		if($this->isAdminSessionWithout())
		{
			$this->load->model('AdminModel');
			$this->load->helper('url');
	    	if ($this->input->post() && $this->input->is_ajax_request()) 
	    	{
	     		 $medicine_name = $this->input->post('medicine_name');
	     		 $credentials['quantity'] = $this->input->post('quantity');
	     		 $credentials['time'] = $this->input->post('time');
	     		 $credentials['start_date'] = $this->input->post('starting_date');
	     		 $credentials['inmate_id']=$this->uri->segment(3);
	     		 
	     		if($this->AdminModel->getMedicineSearchExist($medicine_name))
	      		{
	      			$credentials['medicine_id']=$this->AdminModel->getMedicineSearchExist($medicine_name);
	      			if($this->AdminModel->addInmateMedicines($credentials))
	      			{
	      				$data['message']="Sucessfully Medicine Added to Inmate";
	      			}
	      			else
	      			{
	      				$data['message']="Error Occurred While Medicine Added to Inmate";
	      			}
	      		}
	      		else
	      		{
	      			$data['message']="Invalid Medicine You have Entered";
	      		}

	      		echo json_encode($data);
	      	}
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function showInmateSearchMedicine()
	{

		if($this->isAdminSessionWithout())
		{
			$this->load->model('AdminModel');
			$this->load->helper('url');
	    	if ($this->input->post() && $this->input->is_ajax_request()) 
	    	{
	     		 $medicine_name = $this->input->post('medicine_name');
	     		if($this->AdminModel->getMedicineSearch($medicine_name))
	      		{
	      			$data['success']="TRUE";
	      			$data['result'] = $this->AdminModel->getMedicineSearch($medicine_name);	
	      		}
	      		else
	      		{
	      			$data['success']="FALSE";
	      		}

	      		echo json_encode($data);
	      	}
		}
		else
		{
			redirect('admin/login');
		}
	}


}
?>
