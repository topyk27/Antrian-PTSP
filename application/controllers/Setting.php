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

	public function validate_username($str)
	{
		if(!$this->M_user->validate_username($str))
		{
			$this->form_validation->set_message('validate_username', 'Username telah digunakan');
			return false;
		}
		else
		{
			return true;
		}
	}

    public function user()
    {
        $this->load->view('user/index');
        if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
    }

	public function user_tambah()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		$user = $this->M_user;
		$validation = $this->form_validation;
		$validation->set_rules($user->rules());
		if($validation->run())
		{
			$respon = $user->tambah();
			if($respon==1)
			{
				redirect("setting/user");
			}			
		}
		$data['data_ruang'] = $user->data_ruang();
		$this->load->view('user/tambah', $data);
	}

	public function user_ubah($id)
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		if(!isset($id))
		{
			redirect('setting/user');
		}
		else
		{
			$user = $this->M_user;
			$validation = $this->form_validation;
			$validation->set_rules($user->ubah_rules());
			if($validation->run())
			{
				$respon = $user->ubah($id);
				if($respon==1)
				{
					$this->session->set_flashdata('success', 'Data berhasil diubah');
				}
				else
				{
					$this->session->set_flashdata('success', 'Data gagal diubah');
				}
				redirect("setting/user");
			}
			$data['user'] = $user->getById($id);
			$data['data_layanan'] = $user->data_ruang();
			if(!$data['user'])
			{
				$this->session->set_flashdata('success', 'Data yang anda cari tidak ada');
				redirect("setting/user");
			}
			else
			{
				$this->load->view("user/ubah", $data);
			}
		}
	}

	public function user_hapus($id)
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}

		if($this->M_user->hapus($id))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}

}
 ?>