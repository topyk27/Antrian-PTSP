<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model("M_antrian");
		$this->load->model("M_user");
		$this->load->library('form_validation');
	}

    public function index()
    {
        if($this->M_user->isLogin())
        {
                redirect(base_url('antrian'));
        }        
        else
        {
            redirect(base_url('user/login'));
        }
    }

    public function login()
    {
        $this->load->view('user/login');
        if($this->M_user->isLogin())
		{
			redirect(base_url('antrian'));
		}
    }
    
    public function login_proses()
    {
        if($this->M_user->login_proses())
        {
            redirect(base_url('user'));
        }
        else
        {
            $this->session->set_flashdata('login_proses', 'Username atau password salah.');
            redirect(base_url('user/login'));
        }
    }

    public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('user/login'));
	}

    public function data_user()
	{
		if($this->M_user->isLogin())
        {
            $data = $this->M_user->getAll();
            echo json_encode($data);
        }
	}
}
 ?>