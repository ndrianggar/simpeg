<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('keluarga_model');
		$this->load->model('pendidikan_model');
	}

	public function index() {
	
	}

	public function data() {
		$data					= $this->pegawai_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		foreach ($data as $data) {
			$data_pendidikan		= $this->pendidikan_model->cari_pegawai( $data->kode );
			$pendidikan 				= '';
			if (count($data_pendidikan)!==0){
				$urut 				= 	1;
				foreach ($data_pendidikan as $data_pendidikan) {
					$pendidikan 	= $pendidikan . $urut  . 
									  '. <a data-toggle="modal" id="pendidikan" href="#modal-tambah" 
									  data-kode="' 		. $data_pendidikan->kd_pendidikan 		. '" 
									  data-nama="' 		. $data_pendidikan->nama_pendidikan 	. '" 
									  data-tingkat="' 	. $data_pendidikan->tingkat_pendidikan 	. '" 
									  data-jurusan="' 	. $data_pendidikan->jurusan_pendidikan 	. '" 
									  data-awal="' 		. $data_pendidikan->awal_pendidikan 	. '" 
									  data-akhir="' 	. $data_pendidikan->akhir_pendidikan	. '" 
									  data-ijazah="' 	. $data_pendidikan->ijazah_pendidikan 	. '" 
									  data-tempat="' 	. $data_pendidikan->tempat_pendidikan 	. '" 
									  data-kepala="' 	. $data_pendidikan->kepala_pendidikan 	. '" 
									  ><b>' . $data_pendidikan->tingkat_pendidikan 	. '</b> - ' 
									  . $data_pendidikan->nama_pendidikan ;
					if ($data_pendidikan->jurusan_pendidikan!=="") {
						$pendidikan = $pendidikan . 
									  ' jurusan ' 		. $data_pendidikan->jurusan_pendidikan . 
									  ' (' 				. date('Y',strtotime($data_pendidikan->awal_pendidikan)) 	. 
									  '-' 				. date('Y',strtotime($data_pendidikan->akhir_pendidikan)) 	. ')</a>';
					} else {
						$pendidikan = $pendidikan . 
									  ' (' 				. date('Y',strtotime($data_pendidikan->awal_pendidikan)) 	. 
									  '-' 				. date('Y',strtotime($data_pendidikan->akhir_pendidikan)) 	. ')</a>';
					}
					if ($data_pendidikan->pdf_pendidikan!=="") {
						$pendidikan = $pendidikan .
									  '<a href="' 		. base_url() . 'assets/pdf/' . $data_pendidikan->pdf_pendidikan . '" target="_blank">
									  <img src="' 		. base_url() . 'assets/img/pdf.png" width="15px" height="15px"></a>';
					}

					if ($data_pendidikan->foto_pendidikan!=="") {
						$pendidikan = $pendidikan .
									  '<a href="' 		. base_url() . 'assets/pdf/' . $data_pendidikan->foto_pendidikan . '" target="_blank">
									  <img src="' 		. base_url() . 'assets/img/picture.png" width="15px" height="15px"></a>';
					}
					$pendidikan 	= $pendidikan . '<br>';
					$urut 			= $urut + 1;						
				}
			}

			$hasil[]			= array(
					'action' 		=> 	'<div class="btn-row">
											<div class="btn-group-vertical">
												<button class="btn btn-xs btn-success" type="button" id="btn-tambah" 
													data-kode="' 		. $data->kode 				. '" 
													data-nama="' 		. $data->nama 				. '" 
													><i class="fa fa-plus"></i>
												</button>
											</div>
										</div>',
					'foto' 			=> 	'<img class="datafoto" src="' . base_url() . 'assets/foto/' . $data->foto_pegawai . '">',
					'nama' 			=> 	'<b>' 		. $data->nama 				. '</b>
										<br>NIP : ' . $data->nip 				. 
										'<br>' 		. $data->tempat_lahir 		. 
										', ' 		. $data->tanggal_lahir 		. 
										'<br>' 		. $data->status_perkawinan 	. 
										'<br><br><b>Alamat</b> :<br>' . $data->alamat_jalan ,
					'pendidikan' 			=> 	$pendidikan
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}
	
	public function daftar_riwayat_hidup() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('16','17');");
		// ob_start();
		$data['pegawai']	= $this->pegawai_model->cari_kd('000000000001');
		$data['pendidikan']	= $this->pendidikan_model->cari_pegawai('000000000001');
		$data['keluarga']	= $this->keluarga_model->cari_semua('000000000001');
		$this->load->view('laporan/daftar_riwayat_hidup2.php', $data );
		// $html = ob_get_contents();
		// ob_end_clean();
		//require('./assets/html2pdf/html2fpdf.php');
		// require_once(dirname(__FILE__).'/../../assets/html2pdf/html2pdf.class.php');
		// try
		// {
		// 	$html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));
		// 	$html2pdf->setDefaultFont('Arial');
		// 	//$html2pdf->setTestTdInOnePage(false);
		// 	$html2pdf->writeHTML($html, isset($_GET['vuehtml']));
		// 	$html2pdf->Output("Daftar.pdf");
		// }
		// catch(HTML2PDF_exception $e) { echo $e; }
	}

	public function cetak_riwayat() {
		ob_start();
		$data['pegawai']	= $this->pegawai_model->cari_kd('000000000001');
		$this->load->view('laporan/daftar_riwayat_hidup.php', $data );
		$html = ob_get_contents();
		ob_end_clean();

		require('./assets/html2pdf/html2fpdf.php');
		$pdf=new HTML2FPDF();
		$pdf->AddPage();
		// $fp = fopen("sample.html","r");
		// $strContent = fread($fp, filesize("sample.html"));
		// fclose($fp);
		$pdf->WriteHTML($html);
		$pdf->Output("sample.pdf","I");
	}
}
