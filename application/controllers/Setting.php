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
		if(!$this->M_user->isLogin() || $this->session->userdata('role')!='admin')
		{
			redirect('user/login');
		}
		$this->load->view('user/index');
    }

	public function user_tambah()
	{
		if(!$this->M_user->isLogin() || $this->session->userdata('role')!='admin')
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
		if(!$this->M_user->isLogin() || $this->session->userdata('role')!='admin')
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
		if(!$this->M_user->isLogin() || $this->session->userdata('role')!='admin')
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

	public function data_layanan()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else
		{
			$user = $this->M_user;		
			echo json_encode($user->data_ruang());
		}
	}

	public function sistem()
	{
		if(!$this->M_user->isLogin() || $this->session->userdata('role')!='admin')
		{
			redirect('user/login');
		}
		else
		{
			$setting = $this->M_setting;
			$validation = $this->form_validation;
			$validation->set_rules($setting->logo_rules());
			if($validation->run())
			{
				$respon = $setting->logo_upload();
				if($respon)
				{
					redirect('setting/sistem');
				}
			}
			$data['setting'] = $this->M_setting->getAll();
			$this->load->view("sistem",$data);
		}
	}

	public function save_text($val)
	{
		if(!$this->M_user->isLogin() || $this->session->userdata('role')!='admin')
		{
			redirect('user/login');
		}
		else
		{
			echo $this->M_setting->save_text($val);
		}
	}

}
 ?>