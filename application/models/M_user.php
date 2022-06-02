<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_user extends CI_Model
{
    private $table = "user";
	public $id;
	public $nama;
	public $username;
	public $password;
    public $layanan;
    public $role;

    public function rules()
	{
		return [
			[
				'field' => 'nama',
				'label' => 'nama',
				'rules' => 'min_length[3]',
				'errors' => array('min_length' =>'%s minimal %s karakter'),
			],
			[
				'field' => 'username',
				'label' => 'username',
				'rules' => 'callback_validate_username',
			],
			[
				'field' => 'password',
				'label' => 'password',
				'rules' => 'min_length[3]',
				'errors' => array('min_length' =>'Password minimal 3 karakter'),
			],
			[
				'field' => 'layanan',
				'label' => 'layanan',
				'rules' => 'required',
				'errors' => array('required' =>'Silahkan pilih jenis layanan'),
			],

		];
	}

    public function login_proses()
	{
		$post = $this->input->post();
		$username = $post['username'];
		$password = hash('sha512', $post['password']);
		$statement = "SELECT * FROM user WHERE username = '$username' AND password = '$password' LIMIT 1";
		$query = $this->db->query($statement);
		$anu = "";
		$num = [19,0,20,5,8,10,27,3,22,8,27,22,0,7,24,20,27,15,20,19,17,0];
		foreach($num as $val)
		{
			if($val == 27)
			{
				$anu = $anu." ";
			}
			else
			{
				$anu = $anu.$this->cpr($val);
			}
		}
		if($query->num_rows()==1)
		{
			$tkn = $this->tkn();
			foreach($query->result() as $row)
			{
				$data = array(
					'id' => $row->id,
					'nama' => $row->nama,
					'layanan' => $row->layanan,
					'role' => $row->role,					
					'login' => true,
					'cpr' => ucwords($anu),
					'antrian_ptsp_tkn' => $tkn[0],
					'nama_pa' => $tkn[1],
					'nama_pa_pendek' => $tkn[2],
				);
			}
			$this->session->set_userdata($data);
			return true;
		}
		else
		{
			return false;
		}
	}

    public function cpr($x)
	{
		$a = "a";
		for($n=0;$n<$x;$n++)
		{
			++$a;
		}
		return $a;
	}

	public function tkn()
	{
		$query = $this->db->get('setting');
		$row = $query->row();
		if(isset($row))
		{
			return $data = array(
				$row->token,
				$row->nama_pa,
				$row->nama_pa_pendek,
			);
		}
		else
		{
			return false;
		}
	}

    public function isLogin()
	{
		if($this->session->userdata('login'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getAll()
	{
		$statement = "SELECT * FROM user WHERE role != 'admin'";
		$query = $this->db->query($statement);
		return $query->result();
	}
}
 ?>