<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_setting extends CI_Model
{
    private $table = "setting";
    public $token;
    public $nama_pa;
    public $nama_pa_pendek;

    public function logo_rules()
	{
		return [
			['field' => 'logo',
			'label' => 'logo',
			'rules' => 'callback_validate_image'
			]
		];
	}
    public function getAll()
	{
		$this->db->from($this->table);
		return $this->db->get()->row();
	}

	public function get_jam_tutup()
	{
		$this->db->from($this->table);
		return $this->db->get()->row()->jam_tutup;
	}
    public function savetoken()
	{
		$post = $this->input->post();
		$token = $post['token'];
		$nama_pa = $post['nama_pa'];
		$nama_pa_pendek = $post['nama_pa_pendek'];		
		$statement1 = "TRUNCATE setting";
		$this->db->query($statement1);
		$statement = "INSERT INTO setting (token, nama_pa, nama_pa_pendek) VALUES ('$token', '$nama_pa', '$nama_pa_pendek') ";
		$this->db->query($statement);
		return $this->db->affected_rows();
	}
    public function logo_upload()
	{
		// $post = $this->input->post();
		if(!empty($_FILES['logo']['name']))
		{
			return $this->_uploadImage();
		}
	}
    public function _uploadImage()
	{
		$config['upload_path'] = './asset/img/';
		$config['allowed_types'] = 'png';
		$config['file_name'] = 'logo';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		if($this->upload->do_upload('logo'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function save_text($val)
	{
		$post = $this->input->post();
		$data = $post['data'];
		$statement = "UPDATE setting SET $val='$data' ";
		$this->db->query($statement);
		return $this->db->affected_rows();
	}
}
 ?>