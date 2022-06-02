<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends CI_Controller
{
    public function __construct()
	{
		parent:: __construct();
		$this->load->model("M_setting");
		$this->load->model("M_user");
		$this->load->library('form_validation');
	}

    public function user()
    {
        $this->load->view('user/index');
        if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
    }


}
 ?>