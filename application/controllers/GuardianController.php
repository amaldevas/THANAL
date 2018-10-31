<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuardianController extends CI_Controller 
{
	public function guardianPasswordChange()
	{
		if($this->isGuardianSessionWithout())
		{
			$this->load->view('guardianView/guardianPasswordChange');

		}
		else
		{
			redirect('guardian/login');
		}
	}
	public function medicineList()
	{
		if($this->isGuardianSession())
		{
			$id=$this->session->userdata('inmate_id');
			$this->load->model('GuardianModel');
			$data['result']=$this->GuardianModel->getMedicineList($id);
			$this->load->view('guardianView/guardianMedicineList',$data);
			//$data=$this->AdminModel->getStaffTypeAdmin();
		}
		else
		{
			redirect('guardian/login');
		}
	}
	public function createMessage()
	{
		if($this->isGuardianSessionWithout())
		{
			
			$this->load->helper('url');
			$this->load->model('GuardianModel');
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
			if($this->GuardianModel->createMessage($credentials))
			{
				$data['message']="Message send Succesfully";
			}
			else
			{
				$data['message']="Message send failed";
			}
			redirect('guardian/dashboard');
		}
		else
		{
			redirect('guardian/login');
		}
	}
	public function guardianPasswordChangeDo()
	{
		if($this->isGuardianSessionWithout())
		{
			$password = $this->input->post('password');
			$id=$this->session->userdata('id');
			$this->load->model('GuardianModel');
			$credentials = array(
									'id'=>$id,
									'password'=>$password
								);
			$data['result']=$this->GuardianModel->guardianChangePassword($credentials);
			redirect('guardian/dashboard');

			
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function guardianUpdate()
	{
		if($this->isGuardianSession())
		{	
			
			$this->load->helper('url');
			$this->load->model('GuardianModel');
			$id=$this->session->userdata('id');
			$guardian_name = $this->input->post('guardian_name');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$gender  = $this->input->post('gender');
			$date_of_birth = $this->input->post('date_of_birth');
			$permanent_address = $this->input->post('permanent_address');
			$present_address = $this->input->post('present_address');
			$credentials = array(
									'id'=>$id,
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
			if($this->GuardianModel->updateGuardian($credentials))
			{
				$data['message']="Succesfully Guardian Update";
			}
			else
			{
				$data['message']="Guardian Updation Failed";
			}
			//var_dump($data);
			//die;
			redirect('guardian/profile');
		}
		else
		{
			redirect('guardian/login');
		}
	}
	public function isGuardianSession()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='guardian')
		{
			$data['name']=$this->session->userdata('name');
			$data['email']=$this->session->userdata('email');
			$credentials['id']=$this->session->userdata('id');
			$credentials['type']=$this->session->userdata('type');
			$this->load->model('GuardianModel');
			$data['message_show']=$this->GuardianModel->getMessage($credentials);
			$data['message_count']=$this->GuardianModel->getMessageCount($credentials);
			$this->load->view('partials/guardianTopSide',$data);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	public function isGuardianSessionWithout()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='guardian')
		{
			$data['name']=$this->session->userdata('name');
			$data['email']=$this->session->userdata('email');
			$credentials['id']=$this->session->userdata('id');
			$credentials['type']=$this->session->userdata('type');
			$this->load->model('GuardianModel');
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	public function showGuardianProfile()
	{
		if($this->isGuardianSession())
		{	
			$id=$this->session->userdata('id');
			$this->load->model('GuardianModel');
			$data=$this->GuardianModel->editGuardian($id);
			$this->load->view('guardianView/guardianProfile',$data);
		}
		else
		{
			redirect('guardian/login');
		}
	}
	public function guardianLogout()
	{
		$data['message']='';
		$this->session->unset_userdata('type');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('inmate_id');
		redirect('guardian/login');
	}
	public function editGuardian()
	{
		if($this->isGuardianSession())
		{
			$this->load->model('GuardianModel');

			$staff_id=$this->session->userdata('id');
			$data=$this->GuardianModel->editGuardian($staff_id);
			$data['result']=$this->GuardianModel->getInmateList();
			$this->load->view('guardianView/guardianEdit',$data);
		}
		else
		{
			redirect('guardian/login');
		}
	}
	public function showInmateProfile()
	{
		if($this->isGuardianSession())
		{
			
			$id=$this->session->userdata('inmate_id');
			$this->load->model('GuardianModel');
			$data=$this->GuardianModel->editInmate($id);
			$this->load->view('guardianView/inmateProfile',$data);
		}
		else
		{
			redirect('guardian/login');
		}
	}
	public function getMessageId()
  	{
  		$this->load->model('GuardianModel');
	    if ($this->input->post() && $this->input->is_ajax_request()) 
	    {
	      $messageId = $this->input->post('messageId');
	      $data['result'] = $this->GuardianModel->getMessageDetails($messageId);
	      $this->GuardianModel->getMessageDetailsStatus($messageId);
	      echo json_encode($data);
	    } 
	    else 
	    {
	      redirect('guardian/login');
	    }

  }
	public function loginGuardian()
	{
		if($this->isGuardianSession())
		{
			$this->load->model('GuardianModel');
			$data['message']="Login Successfull";
			
			$data['name']=$this->session->userdata('name');
			$data['email']=$this->session->userdata('email');
			$data['id']=$this->session->userdata('id');
			$data['type']=$this->session->userdata('email');

			redirect('guardian/dashboard');

		}
		elseif($this->input->post())
		{

			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$credentials = array('email'=>$email,'password_hash'=>$password);
			$this->form_validation->set_rules('email', 'Email', 'required|max_length[100]|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');
			if ($this->form_validation->run() == FALSE) 
			{
				echo "hai";
				$data['message'] = "Credentials are not valid";
				redirect('guardian/login');
			}
			else
			{
				//var_dump($credentials);
				//die;
				$this->load->model('GuardianModel');
				$data['result']=$this->GuardianModel->isGuardianExist($credentials);
				if(empty($data['result']))
				{
					$data['message'] = "Sorry, failed to login";
					$this->load->view('guardianView/loginGuardian', $data);
				}
				else
				{
					$credentials1['id']=$data['result'][0]->id;
					$data=$this->GuardianModel->registerSessionForGuardian($credentials1);
					$data['message']="Login Successfull";
					redirect('guardian/dashboard');

				}
			}

		}
		else
		{
			$this->load->view('guardianView/loginGuardian');
		}
	}
	public function dashboardGuardian()
	{
		if($this->isGuardianSession())
		{
			date_default_timezone_set('Asia/Calcutta');
			$credentials['date']=date('Y-m-d');
			$credentials['time']=date('H:i:s');
			$credentials['id']=$this->session->userdata('inmate_id');
			$this->load->model('AdminModel');
			$data['result']=$this->GuardianModel->getMedicineSchedule($credentials);
			$this->load->view('guardianView/dashboardGuardian',$data);
		}
		else
		{
			redirect('guardian/login');
		}
	}
	public function forgotPasswordGuardian()
	{
		$this->load->view('forgotPasswordGuardian');
	}
}

