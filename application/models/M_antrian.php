<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_antrian extends CI_Model
{
    private $_table = "antrian";
	public $id;
	public $layanan;
	public $no;
	public $ke;
	public $status;
	public $tanggal;
	public $diperbarui;

    public function getNO($layanan)
    {
        $tgl = date("Y/m/d");
        $statement = "SELECT MAX(no) AS no FROM antrian WHERE tanggal = '".$tgl."'";
        $query = $this->db->query($statement);
        $a = $query->row();
		if (empty($a->no))
		{
			$no = 1;
		}
		else
		{
			$no = $a->no+1;
		}
        $layanan = str_replace("%20"," ",$layanan);
		$statement1 = "INSERT INTO antrian VALUES ('', '".$layanan."','".$no."','".$layanan."','menunggu','".$tgl."', CURRENT_TIMESTAMP)";
		$query1 = $this->db->query($statement1);
		$efek = $this->db->affected_rows();		
		if($efek !=1)
		{
			$respon['success'] = 0;
		}
		else
		{
			$respon['success'] = 1;
			$respon['no'] = $no;			
		}
		echo json_encode($respon);
    }

	public function getAntrian($ke)
	{
		$tgl = date("Y/m/d");
		$statement = "SELECT * FROM antrian WHERE tanggal = '".$tgl."' && ke LIKE '".$ke."' && status NOT LIKE 'kelar' ORDER BY diperbarui ASC";
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function panggil_antrian()
	{
		$statement = "SELECT * FROM panggil ORDER BY created_at ASC LIMIT 1";
		$query = $this->db->query($statement);
		if(empty($query->result()))
		{
			$respon['success'] = 0;
		}
		else
		{
			$respon['success'] = 1;
			foreach($query->result() as $row)
			{
				$respon['id'] = $row->id;
				$respon['no'] = $row->no;
				$respon['layanan'] = $row->layanan;
				$respon['pengumuman'] = $row->pengumuman;
			}
		}
		echo json_encode($respon);
	}

	public function hapus_panggil_antrian($id)
	{
		$this->db->delete("panggil", ["id" => $id]);
		$respon['success'] = ($this->db->affected_rows() != 1) ? 0 : 1; 
		echo json_encode($respon);
	}

	public function insertPanggilan($no,$layanan)
	{
		if($this->input->post('pengumuman'))
		{
			$pengumuman = $this->input->post('pengumuman');
		}
		$this->db->where('id', $no.$layanan);
		$q = $this->db->get("panggil");
		if(empty($q->result()))
		{
			$data = array(
				'id' => $no . $layanan,
				'no' => $no,
				'layanan' => $layanan,
			);
			if($layanan=="pengumuman")
			{
				$data['pengumuman'] = $pengumuman;
			}
			else
			{
				$data['pengumuman'] = null;
			}
			$this->db->insert('panggil', $data);
			$respon['success'] = ($this->db->affected_rows() != 1) ? 0 : 1; //kalo berhasil return 1 kalo gagal return 0
		}
		else
		{
			$respon['success'] = 1;
		}
		$respon['id'] = $no . $layanan;
		echo json_encode($respon);
	}

	public function cek_panggilan($id)
	{
		$this->db->where('id', $id);
		$q = $this->db->get('panggil');
		if(empty($q->result()))
		{
			$respon['efek'] = 0;
		}
		else
		{
			$respon['efek'] = 1;
		}
		echo json_encode($respon);
	}

	public function update($id,$ke)
	{
		if($ke=="tunda")
		{
			$this->db->set("status","tunda");
		}
		else
		{
			$this->db->set("ke", $ke);
			$this->db->set("status", "menunggu");
		}
		$this->db->set("diperbarui", 'NOW()', FALSE);
		$this->db->where("id", $id);
		$query = $this->db->update('antrian');
		$efek = $this->db->affected_rows();
		$response['success'] = $efek;
		echo json_encode($response);
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table,['id' => $id]);
	}
}
