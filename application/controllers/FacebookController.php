<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class FacebookController extends CI_Controller 
{
	public function facebook()
	{
		$this->load->view('facebook');
	}
}