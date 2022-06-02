<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_user extends CI_Model
{
    private $table = "user";
	public $id;
	public $nama;
	public $username;
	public $password;
    public $role;
    public $ruang_id;

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

	public function ubah_rules()
	{
		return [
			[
				'field' => 'nama',
				'label' => 'nama',
				'rules' => 'min_length[3]',
				'errors' => array('min_length' =>'%s minimal %s karakter'),
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
		// $statement = "SELECT * FROM user WHERE username = '$username' AND password = '$password' LIMIT 1";
		$statement = "SELECT u.id id, u.nama nama, r.nama_layanan nama_layanan, u.role role, r.layanan layanan FROM user u, ruang r WHERE u.username = '$username' AND u.password = '$password' AND u.ruang_id = r.id LIMIT 1";
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
					'nama_layanan' => $row->nama_layanan,
					'role' => $row->role,
					'layanan' => $row->layanan,
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

	public function validate_username($val)
	{
		$statement = "SELECT username FROM user WHERE username = '$val' LIMIT 1 ";
		$query = $this->db->query($statement);
		if($query->num_rows()==1)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function tambah()
	{
		$post = $this->input->post();
		$this->username = $post['username'];
		$this->password = hash('sha512', $post['password']);
		$this->nama = $post['nama'];
		$this->role = "operator";
		$this->ruang_id = $post['layanan'];
		$this->db->insert($this->table, $this);
		return $this->db->affected_rows();

	}

	public function ubah($id)
	{
		$post = $this->input->post();
		$id = $post['akmj'];
		$nama = $post['nama'];
		$ruang_id = $post['layanan'];
		$this->db->set('nama',$nama);
		$this->db->set('ruang_id',$ruang_id);
		if(!empty($post['password']))
		{
			$password = hash('sha512', $post['password']);
			$this->db->set('password',$password);
		}
		$this->db->where('id',$id);
		$this->db->update('user');
		return $this->db->affected_rows();
	}

	public function hapus($id)
	{
		return $this->db->delete($this->table,['id' => $id]);
	}

	public function data_ruang()
	{
		$statement = "SELECT * FROM ruang WHERE id != 9 ORDER BY nama_layanan";
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function getAll()
	{
		$statement = "SELECT u.id id, u.username username, u.nama nama, r.nama_layanan nama_layanan FROM user u, ruang r WHERE u.role != 'admin' AND u.ruang_id = r.id ";
		$query = $this->db->query($statement);
		return $query->result();
	}
	public function getById($id)
	{
		return $this->db->get_where($this->table, ["id" => $id])->row();
	}
}
 ?>