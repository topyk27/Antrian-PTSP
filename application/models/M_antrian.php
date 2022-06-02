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
		$statement = "SELECT no FROM antrian WHERE tanggal = '".$tgl."' && ke LIKE '".$ke."' && status NOT LIKE 'kelar' ORDER BY diperbarui ASC";
		$query = $this->db->query($statement);
		return $query->result();
	}
}
