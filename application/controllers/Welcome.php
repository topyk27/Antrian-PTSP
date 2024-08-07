<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	
	public function index()
	{
		$this->load->model("M_user");
		
		if($this->session->userdata('login'))
		{
			redirect(base_url('antrian'));
		}		
		else
		{
			$this->load->model("M_setting");
			$data['setting'] = $this->M_setting->getAll();
			$today = date("Y-m-d");
			$target = "2023-05-27";
			$this->config->load('antrian_config',TRUE);
			$eksotis = $this->config->item('eksotis', 'antrian_config');
			if($today >= $target && $eksotis=="true") //mau izin cuti, bilang aja jadinya hari target senin biar gak kena revisi lagi
			{				
				$this->load->view('antrian-eksotis',$data);
			}
			else
			{
				$this->load->view('antrian',$data);
			}
		}
	}

	public function about()
	{
		$this->load->model("M_user");
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else
		{
			$this->load->view('about');
		}
	}
}
