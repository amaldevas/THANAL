<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elixir_control extends CI_Controller 
{
	public function adminForgot()
	{
		$this->load->view('adminForgotPass');
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
	public function adminLogin()
	{
		$this->load->view('adminLogin');
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
	public function adminPasswordChange()
	{
		$this->load->view('admin/password-change');
	}
	public function adminDash()
	{
		$this->load->view('adminDashboard');
	}
	public function staffList()
	{
		$this->load->view('adminStaffListing');
	}
	public function staffDetail()
	{
		$this->load->view('adminStaffDetailing');
	}
	public function staffEdit()
	{
		$this->load->view('adminStaffEdit');
	}
	public function inmateEdit()
	{
		$this->load->view('adminInmateEdit');
	}
	public function medicineEdit()
	{
		$this->load->view('adminMedicineEdit');
	}
	public function inmateList()
	{
		$this->load->view('adminInmateList');
	}
	public function medicineList()
	{
		$this->load->view('adminMedicineList');
	}
	public function showAdminAddMedicine()
	{
		$this->load->view('adminAddMedicine');
	}
	public function showAdminAddStaff()
	{
		$this->load->view('adminAddStaff');
	}
	public function showAdminAddInmate()
	{
		$this->load->view('adminAddInmate');
	}
}
?>
