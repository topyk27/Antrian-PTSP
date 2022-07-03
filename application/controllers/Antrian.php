<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Antrian extends CI_Controller 
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model("M_antrian");
	}

	public function index()
	{
		$this->load->view('welcome');
	}

	public function monitor()
	{
		$this->load->model("M_setting");
		$data['setting'] = $this->M_setting->getAll();		
		$this->load->view('monitor',$data);		
	}

    public function tambah($layanan)
    {
        echo $this->M_antrian->getNO($layanan);
    }

	public function antrian($layanan)
	{
		$data = $this->M_antrian->getAntrian($layanan);
		echo json_encode($data);
	}

	public function layanan($layanan)
	{
		if($this->session->userdata('role')!='admin')
		{
			$this->load->view('list');
		}
		else
		{
			redirect('user/login');
		}
	}

	public function panggil_antrian()
	{
		return $this->M_antrian->panggil_antrian();
	}

	public function hapus_panggil_antrian()
	{
		$id = $this->input->post('id');
		return $this->M_antrian->hapus_panggil_antrian($id);
	}

	public function panggil()
	{
		$no = $this->input->post('no');
		$layanan = $this->input->post('layanan');
		return $this->M_antrian->insertPanggilan($no,$layanan);
	}

	public function cek_panggilan()
	{
		$id = $this->input->post('id');
		return $this->M_antrian->cek_panggilan($id);
	}

	public function ubah()
	{
		$id = $this->input->post('id');
		$ke = $this->input->post('ke');
		return $this->M_antrian->update($id,$ke);
	}

	public function hapus()
	{
		$id = $this->input->post('id');
		if($this->M_antrian->delete($id))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}

	public function statistik()
	{
		if($this->session->userdata('login'))
		{
			$data['antrian'] = $this->M_antrian->getStatistik();
			echo json_encode($data);
		}
		else
		{
			redirect('user/login');
		}
	}

	public function tutup()
	{
		$this->load->view('tutup');
	}

    public function cetak()
    {
		$this->load->model("M_setting");
		$data = $this->M_setting->getAll();
		$nama_pa = $data->nama_pa;
        $tanggal = date("d-m-Y");
		$jam = date("H:i:s");
		$var_magin_left = 0;
		$antrian = $this->input->post('no');
		$p = printer_open('\\\192.168.2.187\pos58c');
		printer_set_option($p, PRINTER_MODE, "RAW"); // mode disobek (gak ngegulung kertas)


		//then the width
		printer_set_option( $p,PRINTER_RESOLUTION_X, 231);
		printer_start_doc($p);
		printer_start_page($p);

		$font = printer_create_font("Arial", 38, 10, PRINTER_FW_BOLD, false, false, false, 0);
		printer_select_font($p, $font);
		printer_draw_text($p, "Pengadilan Agama Tenggarong",50,50);
		
		// Header Bon
		$font = printer_create_font("Arial", 38, 10, PRINTER_FW_NORMAL, false, false, false, 0);
		printer_select_font($p, $font);
		$pen = printer_create_pen(PRINTER_PEN_SOLID, 1, "000000");
		printer_select_pen($p, $pen);
		printer_draw_text($p, "No Antrian PTSP", 10, 100);

		$font = printer_create_font("Arial", 136, 95, PRINTER_FW_BOLD, false, false, false, 0);
		printer_select_font($p, $font);
		printer_draw_text($p, "$antrian", 100, 140);

		$font = printer_create_font("Arial", 20, 17, PRINTER_FW_NORMAL, false, false, false, 0);
		printer_select_font($p, $font);
		printer_draw_text($p, date("d/m/Y"),$var_magin_left, 310);
		printer_draw_line($p, $var_magin_left, 330, 400, 330);
		
		$font = printer_create_font("Arial", 15, 12, PRINTER_FW_NORMAL, false, false, false, 0);
		printer_select_font($p, $font);
		printer_draw_text($p, "Silahkan menunggu Nomor antrian", $var_magin_left, 340);
		printer_draw_text($p, "Anda dipanggil dan menuju", 50, 360);
		printer_draw_text($p, "ke bagian layanan", 90, 380);

		printer_draw_text($p, "  ", $var_magin_left, 420);
		$row = 450;
		printer_draw_text($p, "- ", 0, $row);
								
		printer_delete_font($font);
		
		printer_end_page($p);
		printer_end_doc($p);

		printer_close($p);

		$respon['success'] = 1;
		
		echo json_encode($respon);
    }
}
 ?>