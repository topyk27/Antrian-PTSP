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
	public $loket;
	public $eksotis;

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
		$this->config->load('antrian_config',TRUE);
		$eksotis = $this->config->item('eksotis', 'antrian_config');
		if($username=='admin')
		{
			$statement = "SELECT u.id id, u.nama nama, r.nama_layanan nama_layanan, u.role role, u.loket loket, u.eksotis eksotis, r.layanan layanan, r.kode FROM user u, ruang r WHERE u.username = '$username' AND u.password = '$password' AND u.ruang_id = r.id LIMIT 1";
		}
		else if($eksotis=='false')
		{
			$statement = "SELECT u.id id, u.nama nama, r.nama_layanan nama_layanan, u.role role, u.loket loket, u.eksotis eksotis, r.layanan layanan, r.kode FROM user u, ruang r WHERE u.username = '$username' AND u.password = '$password' AND u.ruang_id = r.id AND eksotis = 0 LIMIT 1";
		}
		else
		{
			$statement = "SELECT u.id id, u.nama nama, r.nama_layanan nama_layanan, u.role role, u.loket loket, u.eksotis eksotis, r.layanan layanan, r.kode FROM user u, ruang r WHERE u.username = '$username' AND u.password = '$password' AND u.ruang_id = r.id AND eksotis = 1 LIMIT 1";
		}
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
					'kode' => $row->kode,
					'role' => $row->role,
					'layanan' => $row->layanan,
					'login' => true,
					'cpr' => ucwords($anu),
					'antrian_ptsp_tkn' => $tkn[0],
					'nama_pa' => $tkn[1],
					'nama_pa_pendek' => $tkn[2],
					'loket' => $row->loket
				);
				if($row->role != 'admin')
				{
					if($eksotis == 'true' && $row->eksotis == 0)
					{
						return false;
					}
				}
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
		$this->config->load('antrian_config',TRUE);
		$eksotis = $this->config->item('eksotis', 'antrian_config');
		if($eksotis=='false')
		{
			$statement = "SELECT username FROM user WHERE username = '$val' AND eksotis=0 LIMIT 1 ";
		}
		else
		{
			$statement = "SELECT username FROM user WHERE username = '$val' AND eksotis=1 LIMIT 1 ";
		}
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
		$this->config->load('antrian_config',TRUE);
		$eksotis = $this->config->item('eksotis', 'antrian_config');
		$post = $this->input->post();
		$this->username = $post['username'];
		$this->password = hash('sha512', $post['password']);
		$this->nama = $post['nama'];
		$this->role = "operator";
		if($eksotis=='false')
		{
			$this->ruang_id = $post['layanan'];
		}
		else
		{
			$this->ruang_id = 1;
			$this->loket = $post['layanan'];
			$this->eksotis = 1;
		}
		$this->db->insert($this->table, $this);
		return $this->db->affected_rows();

	}

	public function ubah($id)
	{
		$this->config->load('antrian_config',TRUE);
		$eksotis = $this->config->item('eksotis', 'antrian_config');
		$post = $this->input->post();
		$id = $post['akmj'];
		$nama = $post['nama'];
		if($eksotis=='false')
		{
			$ruang_id = $post['layanan'];
		}
		else
		{			
			$ruang_id = 1;
			$this->db->set('loket',$post['layanan']);
		}
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
		$this->config->load('antrian_config',TRUE);
		$eksotis = $this->config->item('eksotis', 'antrian_config');		
		if($eksotis == 'false')
		{
			$statement = "SELECT * FROM ruang WHERE id != 9 ORDER BY nama_layanan";
		}
		else
		{
			$post = $this->input->post();
			$loket = $post['loket']; // kalo true berarti loket posbakum kasir bank pos
			if($loket == 'true')
			{
				//kalo yang memanggil posbakum kasir bank pos berarti tampilkan juga loket 1 2 3 4
				$statement = "SELECT * FROM ruang WHERE id NOT IN (9,10) ORDER BY nama_layanan ASC";
			}
			else
			{
				$where = "layanan = 'posbakum' OR layanan = 'kasir' OR layanan = 'bank' OR layanan = 'pos'";
				$statement = "SELECT * FROM ruang WHERE ".$where." ORDER BY CASE  WHEN layanan = 'posbakum' THEN 1 WHEN layanan = 'kasir' THEN 2 ELSE 3 END, layanan asc";
			}
		}
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function getAll()
	{
		$this->config->load('antrian_config',TRUE);
		$eksotis = $this->config->item('eksotis', 'antrian_config');
		if($eksotis=='false')
		{
			$statement = "SELECT u.id id, u.username username, u.nama nama, r.nama_layanan nama_layanan FROM user u, ruang r WHERE u.role != 'admin' AND u.ruang_id = r.id ";
		}
		else
		{
			$statement = "SELECT u.id id, u.username username, u.nama nama, r.nama_layanan nama_layanan FROM user u, ruang r WHERE u.role != 'admin' AND u.ruang_id = r.id AND eksotis = 1";
		}
		$query = $this->db->query($statement);
		return $query->result();
	}
	public function getById($id)
	{
		return $this->db->get_where($this->table, ["id" => $id])->row();
	}
}
 ?>