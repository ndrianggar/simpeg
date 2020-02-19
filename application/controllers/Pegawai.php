<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('alamat_model');
		$this->load->model('keluarga_model');
		$this->load->model('pendidikan_model');
		$this->load->model('status_model');
		$this->load->model('jenis_model');
		$this->load->model('jenis_kursus_model');
		$this->load->model('agama_model');
		$this->load->model('jenjang_model');
		$this->load->model('pangkat_model');
		$this->load->model('jabatan_model');
		$this->load->model('prodi_model');
		$this->load->model('jurusan_model');
		$this->load->model('penempatan_model');
		$this->load->model('riwayat_jabatan_model');
		$this->load->model('riwayat_pangkat_model');
		$this->load->model('notice_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/pegawai/data_pegawai_tabel');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/pegawai/data_pegawai_tabel');
			} else {
				redirect (base_url() .'pegawai/detail/'.$this->session->userdata('kode_pegawai_siskap'));
			}
		}
	}

	public function user() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view( 'admin/dashboard' );
			} else if ($this->session->userdata('akses_pegawai_siskap')=='User') {
				$this->load->view( 'user/pegawai/data_pegawai_tabel');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/pegawai/data_pegawai_tabel');
			}
		}
	}

	public function duk_jurusan() {
		$data['jurusan']	= $this->jurusan_model->cari_semua(); 
		$this->load->view( 'admin/document/duk_jurusan', $data );
	}

	public function duk_jenis() {
		$data['jenis']		= $this->jenis_model->cari_semua(); 
		$this->load->view( 'admin/document/duk_jenis', $data );
	}

	public function duk_pensiun() {
		$this->load->view( 'admin/document/duk_pensiun');
	}

	public function cetak_duk_jurusan($jurusan) {
		if ($jurusan=='Semua') {
			$nama_jurusan = 'Semua';
		} else {
			$data_jurusan 			= $this->jurusan_model->cari_kd($jurusan);
			foreach ($data_jurusan as $data_jurusan) {
				$nama_jurusan 		= $data_jurusan->nm_jurusan ;
			}
		}

		$data			= $this->pegawai_model->cari_duk_jurusan($jurusan);
		require(APPPATH .'third_party/PHPExcel/Classes/PHPExcel.php');
		require(APPPATH .'third_party/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');
		$objReader 		= PHPExcel_IOFactory::createReader('Excel5');
		$objPHPExcel 	= $objReader->load(APPPATH .'third_party/PHPExcel/Master/master_duk.xls');
		
		$objPHPExcel->getProperties()->setCreator("Simpeg Polines");
		$objPHPExcel->getProperties()->setLastModifiedBy("Simpeg Polines");
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
		$objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
		$objPHPExcel->getProperties()->setCategory("Test result file");

		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'KEADAAN : ' . strtoupper(date('F-Y',time())));
		$objPHPExcel->getActiveSheet()->setCellValue('M4', 'JURUSAN : ' . strtoupper($nama_jurusan));

		$nomor 		= 8;
		foreach ($data as $data) {
			$tgl_pangkat 		= new DateTime($data->tmt_pangkat);
			$today 				= new DateTime();
			$time_pangkat 		= $today->diff($tgl_pangkat);
			$tahun_pangkat 		= $time_pangkat->y;
			$bulan_pangkat 		= $time_pangkat->m;

			$tgl_polines 		= new DateTime($data->tmt_polines);
			$time_polines 		= $today->diff($tgl_polines);
			$total_bulan 		= ((($time_polines->y)*12)+($time_polines->m))-$data->pmk;
			$tahun_polines 		= ($total_bulan-($total_bulan % 12))/12;
			$bulan_polines 		= $total_bulan % 12;

			$objPHPExcel->getActiveSheet()->setCellValue('A'.$nomor, $nomor-7);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$nomor, $data->gelar_depan . $data->nm_pegawai . $data->gelar_belakang);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$nomor, $data->nip_baru);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$nomor, $data->gol_pangkat);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$nomor, date('d-m-Y',strtotime($data->tmt_pangkat)));
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$nomor, $data->nm_jabatan);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$nomor, date('d-m-Y',strtotime($data->tmt_jabatan)));
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$nomor, $tahun_pangkat);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$nomor, $bulan_pangkat);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$nomor, $tahun_polines);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$nomor, $bulan_polines);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$nomor, '0');
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$nomor, '0');
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$nomor, '0');
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$nomor, $data->nama_pendidikan);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$nomor, $data->tahun_pendidikan);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$nomor, $data->alias_umum);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$nomor, $data->usia);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$nomor, '~');
			$nomor++;
		}

		$thick = array ();
		$thick['borders']=array();
		$thick['borders']['allborders']=array();
		$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
		$objPHPExcel->getActiveSheet()->getStyle ( 'A8:S' . ($nomor-1) )->applyFromArray ($thick);

		$objPHPExcel->getActiveSheet()->setTitle('DUK');
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="duk_' . time() . '.xls"');
		header('Cache-Control: max-age=0'); 

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function cetak_duk_jenis($jenis) {
		if ($jenis=='Semua') {
			$nama_jenis = 'Semua';
		} else {
			$data_jenis 			= $this->jenis_model->cari_kd($jenis);
			foreach ($data_jenis as $data_jenis) {
				$nama_jenis 		= $data_jenis->nm_jenis ;
			}
		}

		$data					= $this->pegawai_model->cari_duk_jenis($jenis);
		require(APPPATH .'third_party/PHPExcel/Classes/PHPExcel.php');
		require(APPPATH .'third_party/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');
		$objReader 		= PHPExcel_IOFactory::createReader('Excel5');
		$objPHPExcel 	= $objReader->load(APPPATH .'third_party/PHPExcel/Master/master_duk.xls');
		
		$objPHPExcel->getProperties()->setCreator("Simpeg Polines");
		$objPHPExcel->getProperties()->setLastModifiedBy("Simpeg Polines");
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
		$objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
		$objPHPExcel->getProperties()->setCategory("Test result file");

		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'KEADAAN : ' . strtoupper(date('F-Y',time())));
		$objPHPExcel->getActiveSheet()->setCellValue('M4', 'JENIS PEGAWAI :' . strtoupper($nama_jenis));

		$nomor 		= 8;
		foreach ($data as $data) {
			$tgl_pangkat 		= new DateTime($data->tmt_pangkat);
			$today 				= new DateTime();
			$time_pangkat 		= $today->diff($tgl_pangkat);
			$tahun_pangkat 		= $time_pangkat->y;
			$bulan_pangkat 		= $time_pangkat->m;

			$tgl_polines 		= new DateTime($data->tmt_polines);
			$time_polines 		= $today->diff($tgl_polines);
			$total_bulan 		= ((($time_polines->y)*12)+($time_polines->m))-$data->pmk;
			$tahun_polines 		= ($total_bulan-($total_bulan % 12))/12;
			$bulan_polines 		= $total_bulan % 12;

			$objPHPExcel->getActiveSheet()->setCellValue('A'.$nomor, $nomor-7);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$nomor, $data->gelar_depan . $data->nm_pegawai . $data->gelar_belakang);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$nomor, $data->nip_baru);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$nomor, $data->gol_pangkat);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$nomor, date('d-m-Y',strtotime($data->tmt_pangkat)));
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$nomor, $data->nm_jabatan);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$nomor, date('d-m-Y',strtotime($data->tmt_jabatan)));
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$nomor, $tahun_pangkat);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$nomor, $bulan_pangkat);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$nomor, $tahun_polines);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$nomor, $bulan_polines);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$nomor, '0');
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$nomor, '0');
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$nomor, '0');
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$nomor, $data->nama_pendidikan);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$nomor, $data->tahun_pendidikan);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$nomor, $data->alias_umum);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$nomor, $data->usia);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$nomor, '~');
			$nomor++;
		}

		$thick = array ();
		$thick['borders']=array();
		$thick['borders']['allborders']=array();
		$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
		$objPHPExcel->getActiveSheet()->getStyle ( 'A8:S' . ($nomor-1) )->applyFromArray ($thick);

		$objPHPExcel->getActiveSheet()->setTitle('DUK');
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="duk_' . time() . '.xls"');
		header('Cache-Control: max-age=0'); 

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function cetak_duk_pensiun() {
		$data					= $this->pegawai_model->cari_duk_pensiun();
		require(APPPATH .'third_party/PHPExcel/Classes/PHPExcel.php');
		require(APPPATH .'third_party/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');
		$objReader 		= PHPExcel_IOFactory::createReader('Excel5');
		$objPHPExcel 	= $objReader->load(APPPATH .'third_party/PHPExcel/Master/master_pensiun.xls');
		
		$objPHPExcel->getProperties()->setCreator("Simpeg Polines");
		$objPHPExcel->getProperties()->setLastModifiedBy("Simpeg Polines");
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
		$objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
		$objPHPExcel->getProperties()->setCategory("Test result file");

		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'KEADAAN : ' . strtoupper(date('F-Y',time())));
		$objPHPExcel->getActiveSheet()->setCellValue('M4', '');

		$nomor 		= 8;
		foreach ($data as $data) {
			$tgl_pangkat 		= new DateTime($data->tmt_pangkat);
			$today 				= new DateTime();
			$time_pangkat 		= $today->diff($tgl_pangkat);
			$tahun_pangkat 		= $time_pangkat->y;
			$bulan_pangkat 		= $time_pangkat->m;

			$tgl_polines 		= new DateTime($data->tmt_polines);
			$time_polines 		= $today->diff($tgl_polines);
			$total_bulan 		= ((($time_polines->y)*12)+($time_polines->m))-$data->pmk;
			$tahun_polines 		= ($total_bulan-($total_bulan % 12))/12;
			$bulan_polines 		= $total_bulan % 12;
			if ($data->sts_kematian=='1'){
				$keterangan		= 'MENINGGAL DUNIA TGL ' . date('d-m-Y',strtotime($data->tgl_kematian));
			} else {
				$keterangan		= 'PENSIUN TGL ' . date('d-m-Y',strtotime($data->tgl_pensiun));
			}

			$objPHPExcel->getActiveSheet()->setCellValue('A'.$nomor, $nomor-7);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$nomor, $data->gelar_depan . $data->nm_pegawai . $data->gelar_belakang);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$nomor, $data->nip_baru);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$nomor, $data->gol_pangkat);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$nomor, date('d-m-Y',strtotime($data->tmt_pangkat)));
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$nomor, $data->nm_jabatan);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$nomor, date('d-m-Y',strtotime($data->tmt_jabatan)));
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$nomor, $tahun_pangkat);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$nomor, $bulan_pangkat);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$nomor, $tahun_polines);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$nomor, $bulan_polines);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$nomor, '0');
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$nomor, '0');
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$nomor, '0');
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$nomor, $data->nama_pendidikan);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$nomor, $data->tahun_pendidikan);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$nomor, $data->alias_umum);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$nomor, $data->usia);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$nomor, $keterangan);
			$nomor++;
		}

		$thick = array ();
		$thick['borders']=array();
		$thick['borders']['allborders']=array();
		$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
		$objPHPExcel->getActiveSheet()->getStyle ( 'A8:S' . ($nomor-1) )->applyFromArray ($thick);

		$objPHPExcel->getActiveSheet()->setTitle('DUK');
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="dukpensiun_' . time() . '.xls"');
		header('Cache-Control: max-age=0'); 

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function data_duk_jurusan($jurusan) {
		$data					= $this->pegawai_model->cari_duk_jurusan($jurusan);		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$tgl_pangkat 		= new DateTime($data->tmt_pangkat);
			$today 				= new DateTime();
			$time_pangkat 		= $today->diff($tgl_pangkat);
			$tahun_pangkat 		= $time_pangkat->y;
			$bulan_pangkat 		= $time_pangkat->m;

			$tgl_polines 		= new DateTime($data->tmt_polines);
			$time_polines 		= $today->diff($tgl_polines);
			$total_bulan 		= ((($time_polines->y)*12)+($time_polines->m))-$data->pmk;
			$tahun_polines 		= ($total_bulan-($total_bulan % 12))/12;
			$bulan_polines 		= $total_bulan % 12;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama'			=> $data->gelar_depan . $data->nm_pegawai . ' ' . $data->gelar_belakang,
					'nip_baru'		=> $data->nip_baru,
					'nama_pangkat'	=> $data->nm_pangkat,
					'gol_pangkat'	=> $data->gol_pangkat,
					'tmt_pangkat'	=> date('d-m-Y',strtotime($data->tmt_pangkat)),
					'nama_jabatan'	=> $data->nm_jabatan,
					'tmt_jabatan'	=> date('d-m-Y',strtotime($data->tmt_jabatan)),
					'tahun_pangkat'	=> $tahun_pangkat,
					'bulan_pangkat'	=> $bulan_pangkat,
					'tahun_mk'		=> $tahun_polines,
					'bulan_mk'		=> $bulan_polines,
					'nama_latihan'	=> '',
					'tahun_latihan'	=> '',
					'jam_latihan'	=> '',
					'nama_pend'		=> $data->nama_pendidikan,
					'tahun_pend'	=> $data->tahun_pendidikan,
					'jenjang_pend'	=> $data->alias_umum,
					'jurusan_pend'	=> $data->jurusan_pendidikan,
					'usia'			=> $data->usia,
					'keterangan'	=> ''
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function data_duk_jenis($jenis) {
		$data					= $this->pegawai_model->cari_duk_jenis($jenis);		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$tgl_pangkat 		= new DateTime($data->tmt_pangkat);
			$today 				= new DateTime();
			$time_pangkat 		= $today->diff($tgl_pangkat);
			$tahun_pangkat 		= $time_pangkat->y;
			$bulan_pangkat 		= $time_pangkat->m;

			$tgl_polines 		= new DateTime($data->tmt_polines);
			$time_polines 		= $today->diff($tgl_polines);
			$total_bulan 		= ((($time_polines->y)*12)+($time_polines->m))-$data->pmk;
			$tahun_polines 		= ($total_bulan-($total_bulan % 12))/12;
			$bulan_polines 		= $total_bulan % 12;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama'			=> $data->gelar_depan . $data->nm_pegawai . ' ' . $data->gelar_belakang,
					'nip_baru'		=> $data->nip_baru,
					'nama_pangkat'	=> $data->nm_pangkat,
					'gol_pangkat'	=> $data->gol_pangkat,
					'tmt_pangkat'	=> date('d-m-Y',strtotime($data->tmt_pangkat)),
					'nama_jabatan'	=> $data->nm_jabatan,
					'tmt_jabatan'	=> date('d-m-Y',strtotime($data->tmt_jabatan)),
					'tahun_pangkat'	=> $tahun_pangkat,
					'bulan_pangkat'	=> $bulan_pangkat,
					'tahun_mk'		=> $tahun_polines,
					'bulan_mk'		=> $bulan_polines,
					'nama_latihan'	=> '',
					'tahun_latihan'	=> '',
					'jam_latihan'	=> '',
					'nama_pend'		=> $data->nama_pendidikan,
					'tahun_pend'	=> $data->tahun_pendidikan,
					'jenjang_pend'	=> $data->alias_umum,
					'jurusan_pend'	=> $data->jurusan_pendidikan,
					'usia'			=> $data->usia,
					'keterangan'	=> ''
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function data_duk_pensiun() {
		$data					= $this->pegawai_model->cari_duk_pensiun();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$tgl_pangkat 		= new DateTime($data->tmt_pangkat);
			$today 				= new DateTime();
			$time_pangkat 		= $today->diff($tgl_pangkat);
			$tahun_pangkat 		= $time_pangkat->y;
			$bulan_pangkat 		= $time_pangkat->m;

			$tgl_polines 		= new DateTime($data->tmt_polines);
			$time_polines 		= $today->diff($tgl_polines);
			$total_bulan 		= ((($time_polines->y)*12)+($time_polines->m))-$data->pmk;
			$tahun_polines 		= ($total_bulan-($total_bulan % 12))/12;
			$bulan_polines 		= $total_bulan % 12;
			if ($data->sts_kematian=='1'){
				$keterangan		= 'MENINGGAL DUNIA TGL ' . date('d-m-Y',strtotime($data->tgl_kematian));
			} else {
				$keterangan		= 'PENSIUN TGL ' . date('d-m-Y',strtotime($data->tgl_pensiun));
			}
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama'			=> $data->gelar_depan . $data->nm_pegawai . ' ' . $data->gelar_belakang,
					'nip_baru'		=> $data->nip_baru,
					'nama_pangkat'	=> $data->nm_pangkat,
					'gol_pangkat'	=> $data->gol_pangkat,
					'tmt_pangkat'	=> date('d-m-Y',strtotime($data->tmt_pangkat)),
					'nama_jabatan'	=> $data->nm_jabatan,
					'tmt_jabatan'	=> date('d-m-Y',strtotime($data->tmt_jabatan)),
					'tahun_pangkat'	=> $tahun_pangkat,
					'bulan_pangkat'	=> $bulan_pangkat,
					'tahun_mk'		=> $tahun_polines,
					'bulan_mk'		=> $bulan_polines,
					'nama_latihan'	=> '',
					'tahun_latihan'	=> '',
					'jam_latihan'	=> '',
					'nama_pend'		=> $data->nama_pendidikan,
					'tahun_pend'	=> $data->tahun_pendidikan,
					'jenjang_pend'	=> $data->alias_umum,
					'jurusan_pend'	=> $data->jurusan_pendidikan,
					'usia'			=> $data->usia,
					'keterangan'	=> $keterangan
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function group($jenis) {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$data['jenis']		= $this->jenis_model->cari_semua();
				$data['agama']		= $this->agama_model->cari_semua();
				$data['propinsi']	= $this->alamat_model->data_propinsi();
				$group				= $this->jenis_model->cari_kd($jenis);
				foreach ($group as $group) {
					$data['group']		= array(
									  'id_group'	=> $group->id_jenis,
									  'nm_group'	=> $group->nm_jenis
									  );
				}
				$this->load->view( 'admin/pegawai/data_pegawai_tabel', $data );
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$data['jenis']		= $this->jenis_model->cari_semua();
				$data['agama']		= $this->agama_model->cari_semua();
				$data['propinsi']	= $this->alamat_model->data_propinsi();
				$group				= $this->jenis_model->cari_kd($jenis);
				foreach ($group as $group) {
					$data['group']		= array(
									  'id_group'	=> $group->id_jenis,
									  'nm_group'	=> $group->nm_jenis
									  );
				}
				$this->load->view( 'pimpinan/pegawai/data_pegawai_tabel', $data );
			}
		}
	}

	public function form_tambah() {
		$data['status']		= $this->status_model->cari_semua();
		$data['jenis']		= $this->jenis_model->cari_semua();
		$data['agama']		= $this->agama_model->cari_semua();
		$data['propinsi']	= $this->alamat_model->data_propinsi();
		$data['jurusan']	= $this->jurusan_model->cari_semua();
		$data['prodi']		= $this->prodi_model->cari_semua();
		$this->load->view( 'admin/pegawai/tambah_data_pegawai', $data );
	}

	public function form_edit($id) {
		$data['status']		= $this->status_model->cari_semua();
		$data['pegawai']	= $this->pegawai_model->cari_kd($id);
		$data['jenis']		= $this->jenis_model->cari_semua();
		$data['agama']		= $this->agama_model->cari_semua();
		$data['propinsi']	= $this->alamat_model->data_propinsi();
		$data['jurusan']	= $this->jurusan_model->cari_semua();
		$data['prodi']		= $this->prodi_model->cari_semua();
		$this->load->view( 'admin/pegawai/edit_data_pegawai', $data );
	}

	public function form_terima_edit($id) {
		$data['status1']		= $this->status_model->cari_semua();
		$data['pegawai']	= $this->pegawai_model->cari_terima($id);
		$data['jenis1']		= $this->jenis_model->cari_semua();
		$data['agama1']		= $this->agama_model->cari_semua();
		$data['propinsi1']	= $this->alamat_model->data_propinsi();
		$data['jurusan1']	= $this->jurusan_model->cari_semua();
		$data['prodi1']		= $this->prodi_model->cari_semua();
		$aaa		= $this->pegawai_model->cari_tmp($id);
		foreach ($aaa as $didik ) {
			$nip 			= $didik->nip_baru;
			$lama 			= $didik->nip_lama;
			$nama 			= $didik->nm_pegawai;
			$depan 			= $didik->gelar_depan;
			$belakang 		= $didik->gelar_belakang;
			$tempat		= $didik->tempat_lahir;
			$tanggal 		= $didik->tanggal_lahir;
			$jk 		= $didik->jenis_kelamin;
			$agama 		= $didik->nm_agama;
			$darah 		= $didik->golongan_darah;
			$perkawinan 		= $didik->status_perkawinan;
			$email 		= $didik->email_pegawai;
			$ektp 		= $didik->ektp_pegawai;
			$npwp 		= $didik->npwp_pegawai;
			$propinsi 		= $didik->nama_propinsi;
			$kota 		= $didik->nama_kota;
			$kecamatan 		= $didik->nama_kecamatan;
			$kelurahan 		= $didik->nama_kelurahan;
			$jalan 		= $didik->alamat_jalan;
			$hp1 		= $didik->hp1_pegawai;
			$hp2 		= $didik->hp2_pegawai;
			$telepon 		= $didik->telepon_pegawai;
			$tinggi		= $didik->tinggi_badan;
			$berat 		= $didik->berat_badan;
			$ram 		= $didik->rambut;
			$muka 		= $didik->bentuk_muka;
			$warna 		= $didik->warna_kulit;
			$ciri 		= $didik->ciri_khas;
			$cacat 		= $didik->cacat_tubuh;
			$hobi 		= $didik->hobi_pegawai;
			$status 		= $didik->nama_status;
			$jenis 		= $didik->nm_jenis;
			$jurusan 		= $didik->nm_jurusan;
			$prodi		= $didik->nm_prodi;
			$polines 		= $didik->tmt_polines;
			$cpns		= $didik->tmt_cpns;
			$pns 		= $didik->tmt_pns;
			$n_sk 		= $didik->no_sk;
			$n_sbakn 		= $didik->no_sbakn;
			$t_sbakn 		= $didik->tgl_sbakn;
			$n_skmpk 		= $didik->no_skmpk;
			$t_skmpk 		= $didik->tgl_skmpk;
			$n_sttpl 		= $didik->no_sttpl;
			$t_sttpl 		= $didik->tgl_sttpl;
			$n_spmt 		= $didik->no_spmt;
			$t_spmt 		= $didik->tgl_spmt;
			$n_spmj 		= $didik->no_spmj;
			$t_spmj 		= $didik->tgl_spmj;
		}

		$pend2		= $this->pegawai_model->cari_tmp2($id);

		foreach ($pend2 as $didik2 ) {
			$nip2 			= $didik2->nip_baru;
			$lama2 			= $didik2->nip_lama;
			$nama2 			= $didik2->nm_pegawai;
			$depan2 			= $didik2->gelar_depan;
			$belakang2 		= $didik2->gelar_belakang;
			$tempat2		= $didik2->tempat_lahir;
			$tanggal2 		= $didik2->tanggal_lahir;
			$jk2 		= $didik2->jenis_kelamin;
			$agama2 		= $didik2->nm_agama;
			$darah2 		= $didik2->golongan_darah;
			$perkawinan2 		= $didik2->status_perkawinan;
			$email2 		= $didik2->email_pegawai;
			$ektp2 		= $didik2->ektp_pegawai;
			$npwp2 		= $didik2->npwp_pegawai;
			$propinsi2 		= $didik2->nama_propinsi;
			$kota2 		= $didik2->nama_kota;
			$kecamatan2 		= $didik2->nama_kecamatan;
			$kelurahan2 		= $didik2->nama_kelurahan;
			$jalan2 		= $didik2->alamat_jalan;
			$hp12 		= $didik2->hp1_pegawai;
			$hp22 		= $didik2->hp2_pegawai;
			$telepon2 		= $didik2->telepon_pegawai;
			$tinggi2		= $didik2->tinggi_badan;
			$berat2 		= $didik2->berat_badan;
			$ram2 		= $didik2->rambut;
			$muka2 		= $didik2->bentuk_muka;
			$warna2 		= $didik2->warna_kulit;
			$ciri2 		= $didik2->ciri_khas;
			$cacat2 		= $didik2->cacat_tubuh;
			$hobi2 		= $didik2->hobi_pegawai;
			$status2 		= $didik2->nama_status;
			$jenis2 		= $didik2->nm_jenis;
			$jurusan2 		= $didik2->nm_jurusan;
			$prodi2		= $didik2->nm_prodi;
			$polines2 		= $didik2->tmt_polines;
			$cpns2		= $didik2->tmt_cpns;
			$pns2 		= $didik2->tmt_pns;
			$n_sk2 		= $didik2->no_sk;
			$n_sbakn2 		= $didik2->no_sbakn;
			$t_sbakn2 		= $didik2->tgl_sbakn;
			$n_skmpk2 		= $didik2->no_skmpk;
			$t_skmpk2 		= $didik2->tgl_skmpk;
			$n_sttpl2 		= $didik2->no_sttpl;
			$t_sttpl2 		= $didik2->tgl_sttpl;
			$n_spmt2 		= $didik2->no_spmt;
			$t_spmt2 		= $didik2->tgl_spmt;
			$n_spmj2 		= $didik2->no_spmj;
			$t_spmj2 		= $didik2->tgl_spmj;
		}

			
		if($nip != $nip2){
			$data['nip'] = 'green';
			$data['a'] 	= 	$nip2 ;
			$data['a2'] 		= '#ff9900';
		}else{
			$data['nip'] = 'black';
			$data['a'] 	= 	'' ;
			$data['a2'] 		= '';
		}

		if($lama != $lama2){
			$data['lama'] = 'green';
			$data['b'] 	= 	$lama2;
			$data['b2'] 		= '#ff9900';
		}else{
			$data['lama'] = 'black';
			$data['b'] 	= 	'' ;
			$data['b2'] 	= 	'' ;
		}

		if($nama != $nama2){
			$data['nama'] = 'green';
			$data['c'] 	= 	$nama2 ;
			$data['c2'] 		= '#ff9900';
		}else{
			$data['nama'] = 'black';
			$data['c'] 	= 	'' ;
			$data['c2'] 	= 	'' ;
		}

		if($depan != $depan2){
			$data['depan'] = 'green';
			$data['d'] 	= 	$depan2 ;
			$data['d2'] 		= '#ff9900';
		}else{
			$data['depan'] = 'black';
			$data['d'] 	= 	'' ;
			$data['d2'] 	= 	'' ;
		}

		if($belakang != $belakang2){
			$data['belakang'] = 'green';
			$data['e'] 	= 	$belakang2 ;
			$data['e2'] 		= '#ff9900';
		}else{
			$data['belakang'] = 'black';
			$data['e'] 	= 	'' ;
			$data['e2'] 	= 	'' ;
		}

		if($tempat != $tempat2){
			$data['tempat'] = 'green';
			$data['f'] 	= 	$tempat2;
			$data['f2'] 		= '#ff9900';
		}else{
			$data['tempat'] = 'black';
			$data['f'] 	= 	'' ;
			$data['f2'] 	= 	'' ;
		}

		if(date('d-m-Y',strtotime($tanggal)) != date('d-m-Y',strtotime($tanggal2))){
			$data['tanggal'] = 'green';
			$data['g'] 	= 	date('d-m-Y',strtotime($tanggal2)); 
			$data['g2'] 		= '#ff9900';
		}else{
			$data['tanggal'] = 'black';
			$data['g'] 	= 	'' ;
			$data['g2'] 	= 	'' ;
		}

		if($jk != $jk2){
			$data['jk'] = 'green';
			$data['h'] 	= 	$jk2 	;
			$data['h2'] 		= '#ff9900';
		}else{
			$data['jk'] = 'black';
			$data['h'] 	= 	'' ;
			$data['h2'] 	= 	'' ;
		}

		if($agama != $agama2){
			$data['agama'] = 'green';
			$data['i'] 	= 	$agama2 ;
			$data['i2'] 		= '#ff9900';
		}else{
			$data['agama'] = 'black';
			$data['i'] 	= 	'' ;
			$data['i2'] 	= 	'' ;
		}

		if($darah != $darah2){
			$data['darah'] = 'green';
			$data['j'] 	= 	$darah2 ;
			$data['j2'] 		= '#ff9900';
		}else{
			$data['darah'] = 'black';
			$data['j'] 	= 	'' ;
			$data['j2'] 	= 	'' ;
		}

		if($perkawinan != $perkawinan2){
			$data['perkawinan'] = 'green';
			$data['k'] 	= 	$perkawinan2 ;
			$data['k2'] 		= '#ff9900';
		}else{
			$data['perkawinan'] = 'black';
			$data['k'] 	= 	'' ;
			$data['k2'] 	= 	'' ;
		}

		if($email != $email2){
			$data['email'] = 'green';
			$data['l'] 	= 	$email2 ;
			$data['l2'] 		= '#ff9900';
		}else{
			$data['email'] = 'black';
			$data['l'] 	= 	'' ;
			$data['l2'] 	= 	'' ;
		}

		if($ektp != $ektp2){
			$data['ektp'] = 'green';
			$data['m'] 	= 	$ektp2 ;
			$data['m2'] 		= '#ff9900';
		}else{
			$data['ektp'] = 'black';
			$data['m'] 	= 	'' ;
			$data['m2'] 	= 	'' ;
		}

		if($npwp != $npwp2){
			$data['npwp'] = 'green';
			$data['n'] 	= 	$npwp2 	;
			$data['n2'] 		= '#ff9900';
		}else{
			$data['npwp'] = 'black';
			$data['n'] 	= 	'' ;
			$data['n2'] 	= 	'' ;
		}

		if($propinsi != $propinsi2){
			$data['propinsi'] = 'green';
			$data['o'] 	= 	$propinsi2 ;
			$data['o2'] 		= '#ff9900';
		}else{
			$data['propinsi'] = 'black';
			$data['o'] 	= 	'' ;
			$data['o2'] 	= 	'' ;
		}

		if($kota != $kota2){
			$data['kota'] = 'green';
			$data['p'] 	= 	$kota2 	;
			$data['p2'] 		= '#ff9900';
		}else{
			$data['kota'] = 'black';
			$data['p'] 	= 	'' ;
			$data['p2'] 	= 	'' ;
		}

		if($kecamatan != $kecamatan2){
			$data['kecamatan'] = 'green';
			$data['q'] 	= 	$kecamatan2 ;
			$data['q2'] 		= '#ff9900';
		}else{
			$data['kecamatan'] = 'black';
			$data['q'] 	= 	'' ;
			$data['q2'] 	= 	'' ;
		}

		if($kelurahan != $kelurahan2){
			$data['kelurahan'] = 'green';
			$data['r'] 	= 	$kelurahan2 ;
			$data['r2'] 		= '#ff9900';
		}else{
			$data['kelurahan'] = 'black';
			$data['r'] 	= 	'' ;
			$data['r2'] 	= 	'' ;
		}

		if($jalan != $jalan2){
			$data['jalan'] = 'green';
			$data['s'] 	= 	$jalan2 ;
			$data['s2'] 		= '#ff9900';
		}else{
			$data['jalan'] = 'black';
			$data['s'] 	= 	'' ;
			$data['s2'] 	= 	'' ;
		}

		if($hp1 != $hp12){
			$data['hp1'] = 'green';
			$data['t'] 	= 	$hp12 	;
			$data['t2'] 		= '#ff9900';
		}else{
			$data['hp1'] = 'black';
			$data['t'] 	= 	'' ;
			$data['t2'] 	= 	'' ;
		}

		if($hp2 != $hp22){
			$data['hp2'] = 'green';
			$data['u'] 	= 	$hp22 	;
			$data['u2'] 		= '#ff9900';
		}else{
			$data['hp2'] = 'black';
			$data['u'] 	= 	'' ;
			$data['u2'] 	= 	'' ;
		}

		if($telepon != $telepon2){
			$data['telepon'] = 'green';
			$data['v'] 	= 	$telepon2; 
			$data['v2'] 		= '#ff9900';
		}else{
			$data['telepon'] = 'black';
			$data['v'] 	= 	'' ;
			$data['v2'] 	= 	'' ;
		}

		if($tinggi != $tinggi2){
			$data['tinggi'] = 'green';
			$data['w'] 	= 	$tinggi2;
			$data['w2'] 		= '#ff9900';
		}else{
			$data['tinggi'] = 'black';
			$data['w'] 	= 	'' ;
			$data['w2'] 	= 	'' ;
		}

		if($berat != $berat2){
			$data['berat'] = 'green';
			$data['x'] 	= 	$berat2 ;
			$data['x2'] 		= '#ff9900';
		}else{
			$data['berat'] = 'black';
			$data['x'] 	= 	'' ;
			$data['x2'] 	= 	'' ;
		}

		if($ram != $ram2){
			$data['ram'] = 'green';
			$data['y'] 	= 	$ram2 	;
			$data['y2'] 		= '#ff9900';
		}else{
			$data['ram'] = 'black';
			$data['y'] 	= 	'' ;
			$data['y2'] 	= 	'' ;
		}

		if($muka != $muka2){
			$data['muka'] = 'green';
			$data['z'] 	= 	$muka2 ;
			$data['z2'] 		= '#ff9900';
		}else{
			$data['muka'] = 'black';
			$data['z'] 	= 	'' ;
			$data['z2'] 	= 	'' ;
		}

		if($warna != $warna2){
			$data['warna'] = 'green';
			$data['aa'] 	= 	$warna2 ;
			$data['aa2'] 		= '#ff9900';
		}else{
			$data['warna'] = 'black';
			$data['aa'] 	= 	'' ;
			$data['aa2'] 	= 	'' ;
		}

		if($ciri != $ciri2){
			$data['ciri'] = 'green';
			$data['bb'] 	= 	$ciri2 ;
			$data['bb2'] 		= '#ff9900';
		}else{
			$data['ciri'] = 'black';
			$data['bb'] 	= 	'' ;
			$data['bb2'] 	= 	'' ;
		}

		if($cacat != $cacat2){
			$data['cacat'] = 'green';
			$data['cc'] 	= 	$cacat2 ;
			$data['cc2'] 		= '#ff9900';
		}else{
			$data['cacat'] = 'black';
			$data['cc'] 	= 	'' ;
			$data['cc2'] 	= 	'' ;
		}

		if($hobi != $hobi2){
			$data['hobi'] = 'green';
			$data['dd'] 	= 	$hobi2 ;
			$data['dd2'] 		= '#ff9900';
		}else{
			$data['hobi'] = 'black';
			$data['dd'] 	= 	'' ;
			$data['dd2'] 	= 	'' ;
		}

		if($status != $status2){
			$data['status'] = 'green';
			$data['ee'] 	= 	$status2; 
			$data['ee2'] 		= '#ff9900';
		}else{
			$data['status'] = 'black';
			$data['ee'] 	= 	'' ;
			$data['ee2'] 	= 	'' ;
		}

		if($jenis != $jenis2){
			$data['jenis'] = 'green';
			$data['ff'] 	= 	$jenis2 ;
			$data['ff2'] 		= '#ff9900';
		}else{
			$data['jenis'] = 'black';
			$data['ff'] 	= 	'' ;
			$data['ff2'] 	= 	'' ;
		}

		if($jurusan != $jurusan2){
			$data['jurusan'] = 'green';
			$data['gg'] 	= 	$jurusan2;
			$data['gg2'] 		= '#ff9900';
		}else{
			$data['jurusan'] = 'black';
			$data['gg'] 	= 	'' ;
			$data['gg2'] 	= 	'' ;
		}

		if($prodi != $prodi2){
			$data['prodi'] = 'green';
			$data['hh'] 	= 	$prodi2	;
			$data['hh2'] 		= '#ff9900';
		}else{
			$data['prodi'] = 'black';
			$data['hh'] 	= 	'' ;
			$data['hh2'] 	= 	'' ;
		}

		if(date('d-m-Y',strtotime($polines)) != date('d-m-Y',strtotime($polines2))){
			$data['polines'] = 'green';
			$data['ii'] 	= 	date('d-m-Y',strtotime($polines2));
			$data['ii2'] 		= '#ff9900';
		}else{
			$data['polines'] = 'black';
			$data['ii'] 	= '' ;
			$data['ii2'] 	= 	'' ;
		}

		if(date('d-m-Y',strtotime($cpns)) != date('d-m-Y',strtotime($cpns2))){
			$data['cpns'] = 'green';
			$data['jj'] 	= 	date('d-m-Y',strtotime($cpns2))	;
			$data['jj2'] 		= '#ff9900';
		}else{
			$data['cpns'] = 'black';
			$data['jj'] 	= 	'' ;
			$data['jj2'] 	= 	'' ;
		}

		if(date('d-m-Y',strtotime($pns)) != date('d-m-Y',strtotime($pns2))){
			$data['pns'] = 'green';
			$data['kk'] 	= 	date('d-m-Y',strtotime($pns2)) 	;
			$data['kk2'] 		= '#ff9900';
		}else{
			$data['pns'] = 'black';
			$data['kk'] 	= 	'' ;
			$data['kk2'] 	= 	'' ;
		}

		if($n_sk != $n_sk2){
			$data['n_sk'] = 'green';
			$data['ll'] 	= 	$n_sk2 	;
			$data['ll2'] 		= '#ff9900';
		}else{
			$data['n_sk'] = 'black';
			$data['ll'] 	= 	'' ;
			$data['ll2'] 	= 	'' ;
		}

		if($n_sbakn != $n_sbakn2){
			$data['n_sbakn'] = 'green';
			$data['mm'] 	= 	$n_sbakn2; 
			$data['mm2'] 		= '#ff9900';
		}else{
			$data['n_sbakn'] = 'black';
			$data['mm'] 	= 	'' ;
			$data['mm2'] 	= 	'' ;
		}

		if(date('d-m-Y',strtotime($t_sbakn)) != date('d-m-Y',strtotime($t_sbakn2))){
			$data['t_sbakn'] = 'green';
			$data['nn'] 	= 	date('d-m-Y',strtotime($t_sbakn2)) ;
			$data['nn2'] 		= '#ff9900';
		}else{
			$data['t_sbakn'] = 'black';
			$data['nn'] 	= 	'' ;
			$data['nn2'] 	= 	'' ;
		}

		if($n_skmpk != $n_skmpk2){
			$data['n_skmpk'] = 'green';
			$data['oo'] 	= 	$n_skmpk2 ;
			$data['oo2'] 		= '#ff9900';
		}else{
			$data['n_skmpk'] = 'black';
			$data['oo'] 	= 	'' ;
			$data['oo2'] 	= 	'' ;
		}

		if(date('d-m-Y',strtotime($t_skmpk)) != date('d-m-Y',strtotime($t_skmpk2))){
			$data['t_skmpk'] = 'green';
			$data['pp'] 	= 	date('d-m-Y',strtotime($t_skmpk2)) ;
			$data['pp2'] 		= '#ff9900';
		}else{
			$data['t_skmpk'] = 'black';
			$data['pp'] 	= 	'' ;
			$data['pp2'] 	= 	'' ;
		}

		if($n_sttpl != $n_sttpl2){
			$data['n_sttpl'] = 'green';
			$data['qq'] 	= 	$n_sttpl2 ;
			$data['qq2'] 		= '#ff9900';
		}else{
			$data['n_sttpl'] = 'black';
			$data['qq'] 	= 	'' ;
			$data['qq2'] 	= 	'' ;
		}

		if(date('d-m-Y',strtotime($t_sttpl)) != date('d-m-Y',strtotime($t_sttpl2))){
			$data['t_sttpl'] = 'green';
			$data['rr'] 	= 	date('d-m-Y',strtotime($t_sttpl2));
			$data['rr2'] 		= '#ff9900';
		}else{
			$data['t_sttpl'] = 'black';
			$data['rr'] 	= 	'' ;
			$data['rr2'] 	= 	'' ;
		}

		if($n_spmt != $n_spmt2){
			$data['n_spmt'] = 'green';
			$data['ss'] 	= 	$n_spmt2 ;
			$data['ss2'] 		= '#ff9900';
		}else{
			$data['n_spmt'] = 'black';
			$data['ss'] 	= 	'' ;
			$data['ss2'] 	= 	'' ;
		}

		if(date('d-m-Y',strtotime($t_spmt)) != date('d-m-Y',strtotime($t_spmt2))){
			$data['t_spmt'] = 'green';
			$data['tt'] 	= 	date('d-m-Y',strtotime($t_spmt2)) ;
			$data['tt2'] 		= '#ff9900';
		}else{
			$data['t_spmt'] = 'black';
			$data['tt'] 	= 	'' ;
			$data['tt2'] 	= 	'' ;
		}

		if($n_spmj != $n_spmj2){
			$data['n_spmj'] = 'green';
			$data['uu'] 	= 	$n_spmj2 ;
			$data['uu2'] 		= '#ff9900';
		}else{
			$data['n_spmj'] = 'black';
			$data['uu'] 	= 	'' ;
			$data['uu2'] 	= 	'' ;
		}

		if(date('d-m-Y',strtotime($t_spmj)) != date('d-m-Y',strtotime($t_spmj2))){
			$data['t_spmj'] = 'green';
			$data['vv'] 	= 	date('d-m-Y',strtotime($t_spmj2)) ;
			$data['vv2'] 		= '#ff9900';
		}else{
			$data['t_spmj'] = 'black';
			$data['vv'] 	= 	'' ;
			$data['vv2'] 	= 	'' ;
		}
		$this->load->view( 'admin/pegawai/terima_edit', $data );
	}

	public function form_edit_user($id) {
		$data['status']		= $this->status_model->cari_semua();
		$data['pegawai']	= $this->pegawai_model->cari_kd($id);
		$data['jenis']		= $this->jenis_model->cari_semua();
		$data['agama']		= $this->agama_model->cari_semua();
		$data['propinsi']	= $this->alamat_model->data_propinsi();
		$data['jurusan']	= $this->jurusan_model->cari_semua();
		$data['prodi']		= $this->prodi_model->cari_semua();
		$this->load->view( 'user/pegawai/edit_data_pegawai', $data );
	}

	public function form_edit_profil($id) {
		$data['status']		= $this->status_model->cari_semua();
		$data['pegawai']	= $this->pegawai_model->cari_kd($id);
		$data['jenis']		= $this->jenis_model->cari_semua();
		$data['agama']		= $this->agama_model->cari_semua();
		$data['propinsi']	= $this->alamat_model->data_propinsi();
		$data['jurusan']	= $this->jurusan_model->cari_semua();
		$data['prodi']		= $this->prodi_model->cari_semua();
		$this->load->view( 'pimpinan/pegawai/profil/edit_data_pegawai', $data );
	}

	public function data($jenis) {
		if ($jenis=='0') {
			$data				= $this->pegawai_model->cari_semua();
		} else {
			$data				= $this->pegawai_model->cari_group($jenis);
		}	
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			if ($data->sts_pegawai=='0') {
				$btn_status		=	'';
				$btn_action 		= 	'<div class="btn-group">
											<button id="btn-edit" type="button" class="btn btn-warning btn-xs" 
												data-id="' 			. $data->id_pegawai 		. '" 
												data-kode="' 		. $data->kd_pegawai 		. '" 
												data-jenis="' 		. $data->kd_pegawai 		. '" 
												data-nip_lama="' 	. $data->nip_baru 			. '" 
												data-nip_baru="' 	. $data->kd_pegawai 		. '" 
												data-kode="' 		. $data->kd_pegawai 		. '" 
												data-nama="' 		. $data->nm_pegawai 		. '" 
												data-gelar_depan="' . $data->gelar_depan 		. '" 
												data-gelar_blkg="' 	. $data->gelar_belakang		. '" 
												data-ktp="' 		. $data->ektp_pegawai		. '" 
												data-tmt_polines="' . $data->tmt_polines 		. '" 
												data-tmt_cpns="' 	. $data->tmt_cpns 			. '" 
												data-tmt_pns="' 	. $data->tmt_pns			. '" 
												data-no_sk="' 		. $data->no_sk 				. '" 
												data-jk="' 			. $data->jenis_kelamin 		. '" 
												data-tempat="' 		. $data->tempat_lahir 		. '" 
												data-tanggal="' 	. $data->tanggal_lahir 		. '" 
												data-agama="' 		. $data->nm_agama			. '" 
												data-status="' 		. $data->status_perkawinan 	. '" 
												data-jalan="' 		. $data->alamat_jalan 		. '" 
												data-kd_kelurahan="'. $data->id_kelurahan 		. '" 
												data-kelurahan="' 	. $data->nama_kelurahan 		. '" 
												data-kd_kecamatan="'. $data->id_kecamatan 		. '" 
												data-kecamatan="' 	. $data->nama_kecamatan 		. '" 
												data-kd_kota="' 	. $data->id_kota 			. '" 
												data-kota="' 		. $data->nama_kota 			. '" 
												data-kd_propinsi="' . $data->id_propinsi 		. '" 
												data-propinsi="' 	. $data->nama_propinsi 		. '" 
												data-tinggi="' 		. $data->tinggi_badan 		. '" 
												data-berat="' 		. $data->berat_badan 		. '" 
												data-rambut="' 		. $data->rambut 			. '" 
												data-muka="' 		. $data->bentuk_muka 		. '" 
												data-kulit="' 		. $data->warna_kulit 		. '" 
												data-ciri="' 		. $data->ciri_khas 			. '" 
												data-cacat="' 		. $data->cacat_tubuh 		. '" 
												data-foto1="' 		. $data->foto_pegawai 		. '" 
												data-foto2="' 		. base_url() . 'assets/foto/' 
																	. $data->foto_pegawai 		. '"
												><i class="fa fa-edit"></i>
											</button>
									  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 

												><i class="fa fa-trash-o"></i>
											</button>
										</div>';
				$btn_action_user	=	$btn_action;
			} elseif ($data->sts_pegawai=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah" type="button" class="btn btn-success btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-tambah" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->sts_pegawai=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit" type="button" class="btn btn-success btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-edit" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->sts_pegawai=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus" type="button" class="btn btn-success btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-hapus" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
										><i class="fa fa-times"></i>
									</button>';
			}


			$hasil[]			= array(
					'no'			=>	$nomor,
					'foto' 			=> 	'<a href="pegawai/detail/' . $data->id_pegawai . '">
											<img src="' . base_url() . 'assets/foto/' . $data->foto_pegawai . '" style="height: auto;width: 120px;">
										</a>',
					'nama' 			=> 	'<a href="'	. base_url() .'pegawai/detail/' . $data->id_pegawai . '">
											<b>' 	. $data->gelar_depan 	. 
											' '		. $data->nm_pegawai 	.
											' '		. $data->gelar_belakang	. 
											'</b> <i>(' 	. $data->usia 	. ' Tahun)</i> 
										</a>
										<br><b>NIP</b> : ' 				. $data->nip_baru 			. 
										'<br>' 							. $data->tempat_lahir 		. 
										', ' 							. date('d-m-Y',strtotime($data->tanggal_lahir)) . 
										'<br>' 							. $data->status_perkawinan 	. 
										'<br><br><b>Alamat</b> :<br>' 	. $data->alamat_jalan 		.
										'<br>Kelurahan ' 				. $data->nama_kelurahan 		.
										' Kecamatan ' 					. $data->nama_kecamatan 		.
										'<br>' 							. $data->nama_kota 			.
										' - ' 							. $data->nama_propinsi 		,
					'jabatan'		=> 	'<table width="100%" border="0">
											<tr>
												<td width="35%"><b>Status Pegawai</b></td>
												<td width="5%">:</td>
												<td width="60%">' . $data->nama_status . '</td>
											</tr>
											<tr>
												<td width="35%"><b>Jenis Pegawai</b></td>
												<td width="5%">:</td>
												<td width="60%">' . $data->nm_jenis . '</td>
											</tr>
											<tr>
												<td width="35%"><b>JurBagSatPusNit</b></td>
												<td width="5%">:</td>
												<td width="60%">' . $data->nm_jurusan . '</td>
											</tr>
											<tr>
												<td width="35%"><b>ProdiSubDiv</b></td>
												<td width="5%">:</td>
												<td width="60%">' . $data->nm_prodi . '</td>
											</tr>
											<tr>
												<td colspan="3" width="60%"><br></td>
											</tr>
											<tr>
												<td><b>Golongan</b></td>
												<td>:</td>
												<td>' . $data->gol_pangkat . '</td>
											</tr>
											<tr>
												<td style="vertical-align: top;"><b>Pangkat</b></td>
												<td style="vertical-align: top;">:</td>
												<td>' . $data->nm_pangkat . '</td>
											</tr>
											<tr>
												<td style="vertical-align: top;"><b>Jabatan</b></td>
												<td style="vertical-align: top;">:</td>
												<td>' . $data->nm_jabatan . '</td>
											</tr>
											<tr>
												<td style="vertical-align: top;"><b>Penempatan</b></td>
												<td style="vertical-align: top;">:</td>
												<td>' . $data->nm_penempatan . '</td>
											</tr>
										</table>',
					'status' 			=> $btn_status,
					'action' 			=> $btn_action,
					'action_user' 		=> $btn_action_user
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function data_user() {
		$id 					= $this->session->userdata('kode_pegawai_siskap');
		$data					= $this->pegawai_model->cari_kd($id);
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$pangkat 			= '';
			$eselon 			= '';
			$penempatan 		= '';
			$golongan 			= '';
			$data_pangkat 		= $this->riwayat_pangkat_model->cari_pegawai($data->id_pegawai);
			foreach ($data_pangkat as $data_pangkat) {
				if ($data_pangkat->status_riwayat_pangkat=='A') {
					$pangkat 	.= $data_pangkat->nm_pangkat . '<br>';
					$golongan 	= $data_pangkat->gol_pangkat;
				}
			}
			$jabatan 			= '';
			$data_jabatan 		= $this->riwayat_jabatan_model->cari_pegawai($data->id_pegawai);
			foreach ($data_jabatan as $data_jabatan) {
				if ($data_jabatan->status_riwayat_jabatan=='A') {
					$jabatan 	.= $data_jabatan->nm_jabatan . '<br>';
					$penempatan = $data_jabatan->nm_penempatan;
					$eselon 	= $data_jabatan->eselon;
				}
			}


			if ($data->sts_pegawai=='0') {
				$btn_status		=	'';
				$btn_action 		= 	'<div class="btn-group">
											<button id="btn-edit" type="button" class="btn btn-warning btn-xs" 
												data-id="' 			. $data->id_pegawai 		. '" 
												data-kode="' 		. $data->kd_pegawai 		. '" 
												data-jenis="' 		. $data->kd_pegawai 		. '" 
												data-nip_lama="' 	. $data->nip_baru 			. '" 
												data-nip_baru="' 	. $data->kd_pegawai 		. '" 
												data-kode="' 		. $data->kd_pegawai 		. '" 
												data-nama="' 		. $data->nm_pegawai 		. '" 
												data-gelar_depan="' . $data->gelar_depan 		. '" 
												data-gelar_blkg="' 	. $data->gelar_belakang		. '" 
												data-ktp="' 		. $data->ektp_pegawai		. '" 
												data-tmt_polines="' . $data->tmt_polines 		. '" 
												data-tmt_cpns="' 	. $data->tmt_cpns 			. '" 
												data-tmt_pns="' 	. $data->tmt_pns			. '" 
												data-no_sk="' 		. $data->no_sk 				. '" 
												data-jk="' 			. $data->jenis_kelamin 		. '" 
												data-tempat="' 		. $data->tempat_lahir 		. '" 
												data-tanggal="' 	. $data->tanggal_lahir 		. '" 
												data-agama="' 		. $data->nm_agama			. '" 
												data-status="' 		. $data->status_perkawinan 	. '" 
												data-jalan="' 		. $data->alamat_jalan 		. '" 
												data-kd_kelurahan="'. $data->id_kelurahan 		. '" 
												data-kelurahan="' 	. $data->nama_kelurahan 		. '" 
												data-kd_kecamatan="'. $data->id_kecamatan 		. '" 
												data-kecamatan="' 	. $data->nama_kecamatan 		. '" 
												data-kd_kota="' 	. $data->id_kota 			. '" 
												data-kota="' 		. $data->nama_kota 			. '" 
												data-kd_propinsi="' . $data->id_propinsi 		. '" 
												data-propinsi="' 	. $data->nama_propinsi 		. '" 
												data-tinggi="' 		. $data->tinggi_badan 		. '" 
												data-berat="' 		. $data->berat_badan 		. '" 
												data-rambut="' 		. $data->rambut 			. '" 
												data-muka="' 		. $data->bentuk_muka 		. '" 
												data-kulit="' 		. $data->warna_kulit 		. '" 
												data-ciri="' 		. $data->ciri_khas 			. '" 
												data-cacat="' 		. $data->cacat_tubuh 		. '" 
												data-foto1="' 		. $data->foto_pegawai 		. '" 
												data-foto2="' 		. base_url() . 'assets/foto/' 
																	. $data->foto_pegawai 		. '"
												><i class="fa fa-edit"></i>
											</button>
										</div>';
				$btn_action_user	=	$btn_action;
			} elseif ($data->sts_pegawai=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah" type="button" class="btn btn-success btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-tambah" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->sts_pegawai=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit" type="button" class="btn btn-success btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-edit" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->sts_pegawai=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus" type="button" class="btn btn-success btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-hapus" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
										><i class="fa fa-times"></i>
									</button>';
			}


			$hasil[]			= array(
					'no'			=>	$nomor,
					'foto' 			=> 	'<a href="pegawai/detail/' . $data->id_pegawai . '">
											<img src="' . base_url() . 'assets/foto/' . $data->foto_pegawai . '" style="height: auto;width: 120px;">
										</a>',
					'nama' 			=> 	'<a href="'	. base_url() .'pegawai/detail/' . $data->id_pegawai . '">
											<b>' 	. $data->gelar_depan 	. 
											' '		. $data->nm_pegawai 	.
											' '		. $data->gelar_belakang	. 
											'</b> <i>(' 	. $data->usia 	. ' Tahun)</i> 
										</a>
										<br><b>NIP</b> : ' 				. $data->nip_baru 			. 
										'<br>' 							. $data->tempat_lahir 		. 
										', ' 							. date('d-m-Y',strtotime($data->tanggal_lahir)) . 
										'<br>' 							. $data->status_perkawinan 	. 
										'<br><br><b>Alamat</b> :<br>' 	. $data->alamat_jalan 		.
										'<br>Kelurahan ' 				. $data->nama_kelurahan 		.
										' Kecamatan ' 					. $data->nama_kecamatan 		.
										'<br>' 							. $data->nama_kota 			.
										' - ' 							. $data->nama_propinsi 		,
					'jabatan'		=> 	'<table width="100%" border="0">
											<tr>
												<td width="35%"><b>Status Pegawai</b></td>
												<td width="5%">:</td>
												<td width="60%">' . $data->nama_status . '</td>
											</tr>
											<tr>
												<td width="35%"><b>Jenis Pegawai</b></td>
												<td width="5%">:</td>
												<td width="60%">' . $data->nm_jenis . '</td>
											</tr>
											<tr>
												<td width="35%"><b>JurBagSatPusNit</b></td>
												<td width="5%">:</td>
												<td width="60%">' . $data->nm_jurusan . '</td>
											</tr>
											<tr>
												<td width="35%"><b>ProdiSubDiv</b></td>
												<td width="5%">:</td>
												<td width="60%">' . $data->nm_prodi . '</td>
											</tr>
											<tr>
												<td colspan="3" width="60%"><br></td>
											</tr>
											<tr>
												<td><b>Golongan</b></td>
												<td>:</td>
												<td>' . $golongan . '</td>
											</tr>
											<tr>
												<td style="vertical-align: top;"><b>Pangkat</b></td>
												<td style="vertical-align: top;">:</td>
												<td>' . $pangkat . '</td>
											</tr>
											<tr>
												<td style="vertical-align: top;"><b>Jabatan</b></td>
												<td style="vertical-align: top;">:</td>
												<td>' . $jabatan . '</td>
											</tr>
										</table>',
					'status' 			=> $btn_status,
					'action' 			=> $btn_action,
					'action_user' 		=> $btn_action_user
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function detail($kode) {
		$data['pegawai']		= $this->pegawai_model->cari_kd($kode);
		$data['hubungan']		= $this->keluarga_model->hubungan();
		$data['jenjang']		= $this->jenjang_model->cari_semua();
		$data['jenis_kursus']	= $this->jenis_kursus_model->cari_semua();
		$data['pangkat']		= $this->pangkat_model->cari_semua();
		$data['jenis']			= $this->jabatan_model->cari_jenis();
		$data['jabatan']		= $this->jabatan_model->cari_semua();
		$data['penempatan']		= $this->penempatan_model->cari_semua();
		$data['agama']			= $this->agama_model->cari_semua();

		foreach ($data['pegawai'] as $data_edit) {
			if ($data_edit->sts_pegawai=='0') {
				$btn_status		=	'';
				$btn_action 		= 	'<div class="btn-group">
											<button id="btn-edit-pegawai" type="button" class="btn btn-warning btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 		. '" 
												data-kode="' 		. $data_edit->kd_pegawai 		. '" 
												data-jenis="' 		. $data_edit->kd_pegawai 		. '" 
												data-nip_lama="' 	. $data_edit->nip_baru 			. '" 
												data-nip_baru="' 	. $data_edit->kd_pegawai 		. '" 
												data-kode="' 		. $data_edit->kd_pegawai 		. '" 
												data-nama="' 		. $data_edit->nm_pegawai 		. '" 
												data-gelar_depan="' . $data_edit->gelar_depan 		. '" 
												data-gelar_blkg="' 	. $data_edit->gelar_belakang	. '" 
												data-ktp="' 		. $data_edit->ektp_pegawai		. '" 
												data-tmt_polines="' . $data_edit->tmt_polines 		. '" 
												data-tmt_cpns="' 	. $data_edit->tmt_cpns 			. '" 
												data-tmt_pns="' 	. $data_edit->tmt_pns			. '" 
												data-no_sk="' 		. $data_edit->no_sk 			. '" 
												data-jk="' 			. $data_edit->jenis_kelamin 	. '" 
												data-tempat="' 		. $data_edit->tempat_lahir 		. '" 
												data-tanggal="' 	. $data_edit->tanggal_lahir 	. '" 
												data-agama="' 		. $data_edit->nm_agama			. '" 
												data-status="' 		. $data_edit->status_perkawinan	. '" 
												data-jalan="' 		. $data_edit->alamat_jalan 		. '" 
												data-kd_kelurahan="'. $data_edit->id_kelurahan 		. '" 
												data-kelurahan="' 	. $data_edit->nama_kelurahan 	. '" 
												data-kd_kecamatan="'. $data_edit->id_kecamatan 		. '" 
												data-kecamatan="' 	. $data_edit->nama_kecamatan 	. '" 
												data-kd_kota="' 	. $data_edit->id_kota 			. '" 
												data-kota="' 		. $data_edit->nama_kota 		. '" 
												data-kd_propinsi="' . $data_edit->id_propinsi 		. '" 
												data-propinsi="' 	. $data_edit->nama_propinsi 	. '" 
												data-tinggi="' 		. $data_edit->tinggi_badan 		. '" 
												data-berat="' 		. $data_edit->berat_badan 		. '" 
												data-rambut="' 		. $data_edit->rambut 			. '" 
												data-muka="' 		. $data_edit->bentuk_muka 		. '" 
												data-kulit="' 		. $data_edit->warna_kulit 		. '" 
												data-ciri="' 		. $data_edit->ciri_khas 		. '" 
												data-cacat="' 		. $data_edit->cacat_tubuh 		. '" 
												data-foto1="' 		. $data_edit->foto_pegawai 		. '" 
												data-foto2="' 		. base_url() 					. '
												assets/foto/' 		. $data_edit->foto_pegawai 		. '"
												><i class="fa fa-edit"> Edit Data Pegawai</i>
											</button>
										</div>';
				$btn_action_user	=	$btn_action;
			} elseif ($data_edit->sts_pegawai=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah-pegawai" type="button" class="btn btn-success btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
											><i class="fa fa-check"> Terima</i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
											><i class="fa fa-times"> Tolak</i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-tambah-pegawai" type="button" class="btn btn-danger btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
										><i class="fa fa-times"> Batalkan</i>
									</button>';
			} elseif ($data_edit->sts_pegawai=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit-pegawai" type="button" class="btn btn-success btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
											><i class="fa fa-check"> Terima</i>
										</button>
								  		<button id="btn-tolak-edit-pegawai" type="button" class="btn btn-danger btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
											><i class="fa fa-times"> Tolak</i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit-pegawai" type="button" class="btn btn-danger btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
										><i class="fa fa-times"> Batalkan</i>
									</button>';
			} elseif ($data_edit->sts_pegawai=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus-pegawai" type="button" class="btn btn-success btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
											><i class="fa fa-check"> Terima</i>
										</button>
								  		<button id="btn-tolak-hapus-pegawai" type="button" class="btn btn-danger btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
											><i class="fa fa-times"> Tolak</i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus-pegawai" type="button" class="btn btn-danger btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
										><i class="fa fa-times"> Batalkan</i>
									</button>';
			} else {
				$btn_status		=	'';
				$btn_action 		= 	'<div class="btn-group">
											<button id="btn-edit-pegawai" type="button" class="btn btn-warning btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 		. '" 
												data-kode="' 		. $data_edit->kd_pegawai 		. '" 
												data-jenis="' 		. $data_edit->kd_pegawai 		. '" 
												data-nip_lama="' 	. $data_edit->nip_baru 			. '" 
												data-nip_baru="' 	. $data_edit->kd_pegawai 		. '" 
												data-kode="' 		. $data_edit->kd_pegawai 		. '" 
												data-nama="' 		. $data_edit->nm_pegawai 		. '" 
												data-gelar_depan="' . $data_edit->gelar_depan 		. '" 
												data-gelar_blkg="' 	. $data_edit->gelar_belakang	. '" 
												data-ktp="' 		. $data_edit->ektp_pegawai		. '" 
												data-tmt_polines="' . $data_edit->tmt_polines 		. '" 
												data-tmt_cpns="' 	. $data_edit->tmt_cpns 			. '" 
												data-tmt_pns="' 	. $data_edit->tmt_pns			. '" 
												data-no_sk="' 		. $data_edit->no_sk 			. '" 
												data-jk="' 			. $data_edit->jenis_kelamin 	. '" 
												data-tempat="' 		. $data_edit->tempat_lahir 		. '" 
												data-tanggal="' 	. $data_edit->tanggal_lahir 	. '" 
												data-agama="' 		. $data_edit->nm_agama			. '" 
												data-status="' 		. $data_edit->status_perkawinan . '" 
												data-jalan="' 		. $data_edit->alamat_jalan 		. '" 
												data-kd_kelurahan="'. $data_edit->id_kelurahan 		. '" 
												data-kelurahan="' 	. $data_edit->nama_kelurahan 	. '" 
												data-kd_kecamatan="'. $data_edit->id_kecamatan 		. '" 
												data-kecamatan="' 	. $data_edit->nama_kecamatan 	. '" 
												data-kd_kota="' 	. $data_edit->id_kota 			. '" 
												data-kota="' 		. $data_edit->nama_kota 		. '" 
												data-kd_propinsi="' . $data_edit->id_propinsi 		. '" 
												data-propinsi="' 	. $data_edit->nama_propinsi 	. '" 
												data-tinggi="' 		. $data_edit->tinggi_badan 		. '" 
												data-berat="' 		. $data_edit->berat_badan 		. '" 
												data-rambut="' 		. $data_edit->rambut 			. '" 
												data-muka="' 		. $data_edit->bentuk_muka 		. '" 
												data-kulit="' 		. $data_edit->warna_kulit 		. '" 
												data-ciri="' 		. $data_edit->ciri_khas 		. '" 
												data-cacat="' 		. $data_edit->cacat_tubuh 		. '" 
												data-foto1="' 		. $data_edit->foto_pegawai 		. '" 
												data-foto2="' 		. base_url() 					. 'assets/foto/' 
																	. $data_edit->foto_pegawai 		. '"
												><i class="fa fa-edit"> Edit Data Pegawai</i>
											</button>
										</div>';
				$btn_action_user	=	$btn_action;
			}
			$data['status']		= array(
									'status' 			=> $btn_status,
									'action' 			=> $btn_action,
									'action_user' 		=> $btn_action_user
							  );
		}
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/pegawai/data_pegawai_detail', $data );
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/pegawai/data_pegawai_detail', $data );
			} else {
				$this->load->view('user/pegawai/data_pegawai_detail', $data );
			}
		}
	}

	public function detail_profil($kode) {
		$data['pegawai']		= $this->pegawai_model->cari_kd($kode);
		$data['hubungan']		= $this->keluarga_model->hubungan();
		$data['jenjang']		= $this->jenjang_model->cari_semua();
		$data['jenis_kursus']	= $this->jenis_kursus_model->cari_semua();
		$data['pangkat']		= $this->pangkat_model->cari_semua();
		$data['jenis']			= $this->jabatan_model->cari_jenis();
		$data['jabatan']		= $this->jabatan_model->cari_semua();
		$data['penempatan']		= $this->penempatan_model->cari_semua();
		$data['agama']			= $this->agama_model->cari_semua();

		foreach ($data['pegawai'] as $data_edit) {
			if ($data_edit->sts_pegawai=='0') {
				$btn_status		=	'';
				$btn_action 		= 	'<div class="btn-group">
											<button id="btn-edit-pegawai" type="button" class="btn btn-warning btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 		. '" 
												data-kode="' 		. $data_edit->kd_pegawai 		. '" 
												data-jenis="' 		. $data_edit->kd_pegawai 		. '" 
												data-nip_lama="' 	. $data_edit->nip_baru 			. '" 
												data-nip_baru="' 	. $data_edit->kd_pegawai 		. '" 
												data-kode="' 		. $data_edit->kd_pegawai 		. '" 
												data-nama="' 		. $data_edit->nm_pegawai 		. '" 
												data-gelar_depan="' . $data_edit->gelar_depan 		. '" 
												data-gelar_blkg="' 	. $data_edit->gelar_belakang	. '" 
												data-ktp="' 		. $data_edit->ektp_pegawai		. '" 
												data-tmt_polines="' . $data_edit->tmt_polines 		. '" 
												data-tmt_cpns="' 	. $data_edit->tmt_cpns 			. '" 
												data-tmt_pns="' 	. $data_edit->tmt_pns			. '" 
												data-no_sk="' 		. $data_edit->no_sk 			. '" 
												data-jk="' 			. $data_edit->jenis_kelamin 	. '" 
												data-tempat="' 		. $data_edit->tempat_lahir 		. '" 
												data-tanggal="' 	. $data_edit->tanggal_lahir 	. '" 
												data-agama="' 		. $data_edit->nm_agama			. '" 
												data-status="' 		. $data_edit->status_perkawinan	. '" 
												data-jalan="' 		. $data_edit->alamat_jalan 		. '" 
												data-kd_kelurahan="'. $data_edit->id_kelurahan 		. '" 
												data-kelurahan="' 	. $data_edit->nama_kelurahan 	. '" 
												data-kd_kecamatan="'. $data_edit->id_kecamatan 		. '" 
												data-kecamatan="' 	. $data_edit->nama_kecamatan 	. '" 
												data-kd_kota="' 	. $data_edit->id_kota 			. '" 
												data-kota="' 		. $data_edit->nama_kota 		. '" 
												data-kd_propinsi="' . $data_edit->id_propinsi 		. '" 
												data-propinsi="' 	. $data_edit->nama_propinsi 	. '" 
												data-tinggi="' 		. $data_edit->tinggi_badan 		. '" 
												data-berat="' 		. $data_edit->berat_badan 		. '" 
												data-rambut="' 		. $data_edit->rambut 			. '" 
												data-muka="' 		. $data_edit->bentuk_muka 		. '" 
												data-kulit="' 		. $data_edit->warna_kulit 		. '" 
												data-ciri="' 		. $data_edit->ciri_khas 		. '" 
												data-cacat="' 		. $data_edit->cacat_tubuh 		. '" 
												data-foto1="' 		. $data_edit->foto_pegawai 		. '" 
												data-foto2="' 		. base_url() 					. '
												assets/foto/' 		. $data_edit->foto_pegawai 		. '"
												><i class="fa fa-edit"> Edit Data Pegawai</i>
											</button>
										</div>';
				$btn_action_user	=	$btn_action;
			} elseif ($data_edit->sts_pegawai=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah-pegawai" type="button" class="btn btn-success btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
											><i class="fa fa-check"> Terima</i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
											><i class="fa fa-times"> Tolak</i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-tambah-pegawai" type="button" class="btn btn-danger btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
										><i class="fa fa-times"> Batalkan</i>
									</button>';
			} elseif ($data_edit->sts_pegawai=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit-pegawai" type="button" class="btn btn-success btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
											><i class="fa fa-check"> Terima</i>
										</button>
								  		<button id="btn-tolak-edit-pegawai" type="button" class="btn btn-danger btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
											><i class="fa fa-times"> Tolak</i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit-pegawai" type="button" class="btn btn-danger btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
										><i class="fa fa-times"> Batalkan</i>
									</button>';
			} elseif ($data_edit->sts_pegawai=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus-pegawai" type="button" class="btn btn-success btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
											><i class="fa fa-check"> Terima</i>
										</button>
								  		<button id="btn-tolak-hapus-pegawai" type="button" class="btn btn-danger btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
											><i class="fa fa-times"> Tolak</i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus-pegawai" type="button" class="btn btn-danger btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 	. '" 
												data-nama="' 		. $data_edit->nm_pegawai 	. '" 
										><i class="fa fa-times"> Batalkan</i>
									</button>';
			} else {
				$btn_status		=	'';
				$btn_action 		= 	'<div class="btn-group">
											<button id="btn-edit-pegawai" type="button" class="btn btn-warning btn-xs" 
												data-id="' 			. $data_edit->id_pegawai 		. '" 
												data-kode="' 		. $data_edit->kd_pegawai 		. '" 
												data-jenis="' 		. $data_edit->kd_pegawai 		. '" 
												data-nip_lama="' 	. $data_edit->nip_baru 			. '" 
												data-nip_baru="' 	. $data_edit->kd_pegawai 		. '" 
												data-kode="' 		. $data_edit->kd_pegawai 		. '" 
												data-nama="' 		. $data_edit->nm_pegawai 		. '" 
												data-gelar_depan="' . $data_edit->gelar_depan 		. '" 
												data-gelar_blkg="' 	. $data_edit->gelar_belakang	. '" 
												data-ktp="' 		. $data_edit->ektp_pegawai		. '" 
												data-tmt_polines="' . $data_edit->tmt_polines 		. '" 
												data-tmt_cpns="' 	. $data_edit->tmt_cpns 			. '" 
												data-tmt_pns="' 	. $data_edit->tmt_pns			. '" 
												data-no_sk="' 		. $data_edit->no_sk 			. '" 
												data-jk="' 			. $data_edit->jenis_kelamin 	. '" 
												data-tempat="' 		. $data_edit->tempat_lahir 		. '" 
												data-tanggal="' 	. $data_edit->tanggal_lahir 	. '" 
												data-agama="' 		. $data_edit->nm_agama			. '" 
												data-status="' 		. $data_edit->status_perkawinan . '" 
												data-jalan="' 		. $data_edit->alamat_jalan 		. '" 
												data-kd_kelurahan="'. $data_edit->id_kelurahan 		. '" 
												data-kelurahan="' 	. $data_edit->nama_kelurahan 	. '" 
												data-kd_kecamatan="'. $data_edit->id_kecamatan 		. '" 
												data-kecamatan="' 	. $data_edit->nama_kecamatan 	. '" 
												data-kd_kota="' 	. $data_edit->id_kota 			. '" 
												data-kota="' 		. $data_edit->nama_kota 		. '" 
												data-kd_propinsi="' . $data_edit->id_propinsi 		. '" 
												data-propinsi="' 	. $data_edit->nama_propinsi 	. '" 
												data-tinggi="' 		. $data_edit->tinggi_badan 		. '" 
												data-berat="' 		. $data_edit->berat_badan 		. '" 
												data-rambut="' 		. $data_edit->rambut 			. '" 
												data-muka="' 		. $data_edit->bentuk_muka 		. '" 
												data-kulit="' 		. $data_edit->warna_kulit 		. '" 
												data-ciri="' 		. $data_edit->ciri_khas 		. '" 
												data-cacat="' 		. $data_edit->cacat_tubuh 		. '" 
												data-foto1="' 		. $data_edit->foto_pegawai 		. '" 
												data-foto2="' 		. base_url() 					. 'assets/foto/' 
																	. $data_edit->foto_pegawai 		. '"
												><i class="fa fa-edit"> Edit Data Pegawai</i>
											</button>
										</div>';
				$btn_action_user	=	$btn_action;
			}
			$data['status']		= array(
									'status' 			=> $btn_status,
									'action' 			=> $btn_action,
									'action_user' 		=> $btn_action_user
							  );
		}
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/pegawai/data_pegawai_detail', $data );
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/pegawai/profil/data_pegawai_detail', $data );
			} else {
				$this->load->view('user/pegawai/data_pegawai_detail', $data );
			}
		}
	}

	public function tambah() {
		$kode_baru 	= $this->pegawai_model->buat_kode();
		$msg		= false;
		$pass_ready	= $this->bcrypt->hash_password('123456');
		$simpan 	= $this->pegawai_model->tambah(
					$kode_baru,
					$_POST['nip_baru'],
					$_POST['jenis_pegawai'],
					$_POST['nip_lama'],
					$_POST['nip_baru'],
					$_POST['nama_pegawai'],
					$_POST['gelar_depan'],
					$_POST['gelar_belakang'],
					$_POST['ektp'],
					$_POST['npwp'],
					tgl_sql($_POST['tmt_polines']),
					tgl_sql($_POST['tmt_cpns']),
					tgl_sql($_POST['tmt_pns']),
					$_POST['no_sk'],
					$_POST['jenis_kelamin'],
					$_POST['tempat_lahir'],
					tgl_sql($_POST['tanggal_lahir']),
					$_POST['golongan_darah'],
					$_POST['agama'],
					$_POST['status_pernikahan'],
					$_POST['no_hp1'],
					$_POST['no_hp2'],
					$_POST['telepon'],
					$_POST['email'],
					$_POST['jalan'],
					$_POST['kelurahan'],
					$_POST['kecamatan'],
					$_POST['kota'],
					$_POST['propinsi'],
					$_POST['tinggi'],
					$_POST['berat'],
					$_POST['rambut'],
					$_POST['muka'],
					$_POST['kulit'],
					$_POST['ciri'],
					$_POST['cacat'],
					$_POST['hobi'],
					$_POST['no_sbakn'],
					tgl_sql($_POST['tgl_sbakn']),
					$_POST['no_skmpk'],
					tgl_sql($_POST['tgl_skmpk']),
					$_POST['no_sttpl'],
					tgl_sql($_POST['tgl_sttpl']),
					$_POST['no_spmt'],
					tgl_sql($_POST['tgl_spmt']),
					$_POST['no_spmj'],
					tgl_sql($_POST['tgl_spmj']),
					$_POST['status_pegawai'],
					$_POST['jurusan'],
					$_POST['prodi'],
					$pass_ready
					);
		if ($simpan) {
			$msg 				= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/foto/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
		
		$this->load->library('upload', $config);
		if (!empty($_FILES['foto']['name'])) {
			if ($this->upload->do_upload('foto')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET foto_pegawai='$nama_foto' 
									WHERE id_pegawai='$kode_baru';"
									); 
			}
		}

		if (!empty($_FILES['file_sbakn']['name'])) {
			if ($this->upload->do_upload('file_sbakn')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET file_sbakn='$nama_foto' 
									WHERE id_pegawai='$kode_baru';"
									); 
			}
		}

		if (!empty($_FILES['file_skmpk']['name'])) {
			if ($this->upload->do_upload('file_skmpk')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET file_skmpk='$nama_foto' 
									WHERE id_pegawai='$kode_baru';"
									); 
			}
		}

		if (!empty($_FILES['file_sttpl']['name'])) {
			if ($this->upload->do_upload('file_sttpl')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET file_sttpl='$nama_foto' 
									WHERE id_pegawai='$kode_baru';"
									); 
			}
		}

		if (!empty($_FILES['file_spmt']['name'])) {
			if ($this->upload->do_upload('file_spmt')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET file_spmt='$nama_foto' 
									WHERE id_pegawai='$kode_baru';"
									); 
			}
		}

		if (!empty($_FILES['file_spmj']['name'])) {
			if ($this->upload->do_upload('file_spmj')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET file_spmt='$nama_foto' 
									WHERE id_pegawai='$kode_baru';"
									); 
			}
		}

		redirect (base_url() . 'pegawai');
	}

	public function edit() {
		$msg		= false;
		$kode_baru 	= $_POST['id_pegawai'];

		if($_POST['propinsi'] == '' && $_POST['kota'] == '' && $_POST['kecamatan'] == '' && $_POST['kelurahan'] == '' ){
			$simpan 	= $this->pegawai_model->edit4(
					$_POST['id_pegawai'],
					$_POST['nip_baru'],
					$_POST['jenis_pegawai'],
					$_POST['nip_lama'],
					$_POST['nip_baru'],
					$_POST['nama_pegawai'],
					$_POST['gelar_depan'],
					$_POST['gelar_belakang'],
					$_POST['ektp'],
					$_POST['npwp'],
					tgl_sql($_POST['tmt_polines']),
					tgl_sql($_POST['tmt_cpns']),
					tgl_sql($_POST['tmt_pns']),
					$_POST['no_sk'],
					$_POST['jenis_kelamin'],
					$_POST['tempat_lahir'],
					tgl_sql($_POST['tanggal_lahir']),
					$_POST['golongan_darah'],
					$_POST['agama'],
					$_POST['status_pernikahan'],
					$_POST['no_hp1'],
					$_POST['no_hp2'],
					$_POST['telepon'],
					$_POST['email'],
					$_POST['jalan'],
					$_POST['kelurahan'],
					$_POST['Kecamatan'],
					$_POST['tinggi'],
					$_POST['berat'],
					$_POST['rambut'],
					$_POST['muka'],
					$_POST['kulit'],
					$_POST['ciri'],
					$_POST['cacat'],
					$_POST['hobi'],
					$_POST['no_sbakn'],
					tgl_sql($_POST['tgl_sbakn']),
					$_POST['no_skmpk'],
					tgl_sql($_POST['tgl_skmpk']),
					$_POST['no_sttpl'],
					tgl_sql($_POST['tgl_sttpl']),
					$_POST['no_spmt'],
					tgl_sql($_POST['tgl_spmt']),
					$_POST['no_spmj'],
					tgl_sql($_POST['tgl_spmj']),
					$_POST['status_pegawai'],
					$_POST['jurusan'],
					$_POST['prodi']
					);
		}else{
			$simpan 	= $this->pegawai_model->edit3(
					$_POST['id_pegawai'],
					$_POST['nip_baru'],
					$_POST['jenis_pegawai'],
					$_POST['nip_lama'],
					$_POST['nip_baru'],
					$_POST['nama_pegawai'],
					$_POST['gelar_depan'],
					$_POST['gelar_belakang'],
					$_POST['ektp'],
					$_POST['npwp'],
					tgl_sql($_POST['tmt_polines']),
					tgl_sql($_POST['tmt_cpns']),
					tgl_sql($_POST['tmt_pns']),
					$_POST['no_sk'],
					$_POST['jenis_kelamin'],
					$_POST['tempat_lahir'],
					tgl_sql($_POST['tanggal_lahir']),
					$_POST['golongan_darah'],
					$_POST['agama'],
					$_POST['status_pernikahan'],
					$_POST['no_hp1'],
					$_POST['no_hp2'],
					$_POST['telepon'],
					$_POST['email'],
					$_POST['jalan'],
					$_POST['kelurahan'],
					$_POST['kecamatan'],
					$_POST['kota'],
					$_POST['propinsi'],
					$_POST['tinggi'],
					$_POST['berat'],
					$_POST['rambut'],
					$_POST['muka'],
					$_POST['kulit'],
					$_POST['ciri'],
					$_POST['cacat'],
					$_POST['hobi'],
					$_POST['no_sbakn'],
					tgl_sql($_POST['tgl_sbakn']),
					$_POST['no_skmpk'],
					tgl_sql($_POST['tgl_skmpk']),
					$_POST['no_sttpl'],
					tgl_sql($_POST['tgl_sttpl']),
					$_POST['no_spmt'],
					tgl_sql($_POST['tgl_spmt']),
					$_POST['no_spmj'],
					tgl_sql($_POST['tgl_spmj']),
					$_POST['status_pegawai'],
					$_POST['jurusan'],
					$_POST['prodi']
					);
		}
		if ($simpan) {
			$msg 				= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/foto/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
		
		$this->load->library('upload', $config);
		if (!empty($_FILES['foto']['name'])) {
			if ($this->upload->do_upload('foto')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET foto_pegawai='$nama_foto' 
									WHERE id_pegawai='$kode_baru';"
									); 
			}
		}

		if (!empty($_FILES['file_sbakn']['name'])) {
			if ($this->upload->do_upload('file_sbakn')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET file_sbakn='$nama_foto' 
									WHERE id_pegawai='$kode_baru';"
									); 
			}
		}

		if (!empty($_FILES['file_skmpk']['name'])) {
			if ($this->upload->do_upload('file_skmpk')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET file_skmpk='$nama_foto' 
									WHERE id_pegawai='$kode_baru';"
									); 
			}
		}

		if (!empty($_FILES['file_sttpl']['name'])) {
			if ($this->upload->do_upload('file_sttpl')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET file_sttpl='$nama_foto' 
									WHERE id_pegawai='$kode_baru';"
									); 
			}
		}

		if (!empty($_FILES['file_spmt']['name'])) {
			if ($this->upload->do_upload('file_spmt')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET file_spmt='$nama_foto' 
									WHERE id_pegawai='$kode_baru';"
									); 
			}
		}

		if (!empty($_FILES['file_spmj']['name'])) {
			if ($this->upload->do_upload('file_spmj')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET file_spmt='$nama_foto' 
									WHERE id_pegawai='$kode_baru';"
									); 
			}
		}

		redirect (base_url() . 'pegawai');
	}

	public function edit_user() {
		$tmp 							= $this->pegawai_model->buat_kode_tmp();
		$kode 							= $_POST['id_pegawai'];
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya
		$pass_ready	= $this->bcrypt->hash_password('123456');

		$msg							= false;
		$config['upload_path']			= './assets/foto/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_pegawai'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->pegawai_model->tambah_tmp(
					$tmp,
					$_POST['id_pegawai'],
					$_POST['nip_baru'],
					$_POST['jenis_pegawai'],
					$_POST['nip_lama'],
					$_POST['nip_baru'],
					$_POST['nama_pegawai'],
					$_POST['gelar_depan'],
					$_POST['gelar_belakang'],
					$_POST['ektp'],
					$_POST['npwp'],
					tgl_sql($_POST['tmt_polines']),
					tgl_sql($_POST['tmt_cpns']),
					tgl_sql($_POST['tmt_pns']),
					$_POST['no_sk'],
					$_POST['jenis_kelamin'],
					$_POST['tempat_lahir'],
					tgl_sql($_POST['tanggal_lahir']),
					$_POST['golongan_darah'],
					$_POST['agama'],
					$_POST['status_pernikahan'],
					$_POST['no_hp1'],
					$_POST['no_hp2'],
					$_POST['telepon'],
					$_POST['email'],
					$_POST['jalan'],
					$_POST['kelurahan'],
					$_POST['kecamatan'],
					$_POST['kota'],
					$_POST['propinsi'],
					$_POST['tinggi'],
					$_POST['berat'],
					$_POST['rambut'],
					$_POST['muka'],
					$_POST['kulit'],
					$_POST['ciri'],
					$_POST['cacat'],
					$_POST['hobi'],
					$_POST['no_sbakn'],
					tgl_sql($_POST['tgl_sbakn']),
					$_POST['no_skmpk'],
					tgl_sql($_POST['tgl_skmpk']),
					$_POST['no_sttpl'],
					tgl_sql($_POST['tgl_sttpl']),
					$_POST['no_spmt'],
					tgl_sql($_POST['tgl_spmt']),
					$_POST['no_spmj'],
					tgl_sql($_POST['tgl_spmj']),
					$_POST['status_pegawai'],
					$_POST['jurusan'],
					$_POST['prodi'],
					$pass_ready
				);
			$simpan 	=	$this->db->query(
								"UPDATE t_pegawai 
								SET sts_pegawai='3'
								WHERE id_pegawai='$kode';"
							);
			if ($simpan) {
				$msg	= true;

			}

			if (!empty($_FILES['foto']['name'])) {
				if ($this->upload->do_upload('foto')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE tmp_pegawai 
										SET foto_pegawai='$nama_foto' 
										WHERE id_tmp='$tmp';"
										); 
				}
			}

			if (!empty($_FILES['file_sbakn']['name'])) {
				if ($this->upload->do_upload('file_sbakn')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE tmp_pegawai 
										SET file_sbakn='$nama_foto' 
										WHERE id_tmp='$tmp';"
										); 
				}
			}

			if (!empty($_FILES['file_skmpk']['name'])) {
				if ($this->upload->do_upload('file_skmpk')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE tmp_pegawai 
										SET file_skmpk='$nama_foto' 
										WHERE id_tmp='$tmp';"
										); 
				}
			}

			if (!empty($_FILES['file_sttpl']['name'])) {
				if ($this->upload->do_upload('file_sttpl')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE tmp_pegawai 
										SET file_sttpl='$nama_foto' 
										WHERE id_tmp='$tmp';"
										); 
				}
			}

			if (!empty($_FILES['file_spmt']['name'])) {
				if ($this->upload->do_upload('file_spmt')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE tmp_pegawai 
										SET file_spmt='$nama_foto' 
										WHERE id_tmp='$tmp';"
										); 
				}
			}

			if (!empty($_FILES['file_spmj']['name'])) {
				if ($this->upload->do_upload('file_spmj')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE tmp_pegawai 
										SET file_spmt='$nama_foto' 
										WHERE id_tmp='$tmp';"
										); 
				}
			}
		}

		//-- Start Notice --//
		if ($this->session->userdata('akses_pegawai_siskap')=='Admin'){
			if ($_POST['id_pegawai']==$this->session->userdata('kode_pegawai_siskap')){
				$user_read	= 1;
			} else {
				$user_read 	= 0;
			}
			$admin_read = 1;
		} else {
			$user_read 	= 1;
			$admin_read = 0;
		}
		$input_notice 	= $this->notice_model->tambah(
				$this->notice_model->buat_id(),
				$_POST['id_pegawai'],
				'Pengajuan Edit Data',
				date('Y-m-d H:i:s'),
				'#',
				'Pengajuan Edit Data Pegawai',
				$user_read,
				$admin_read,
				'0',
				$this->session->userdata('kode_pegawai_siskap'),
				date('Y-m-d H:i:s'),
				$_SERVER['REMOTE_ADDR']
		);
		//-- End Notice --//

		redirect (base_url() . 'pegawai/detail/' .$kode);
	}
	public function edit_profil() {
		$tmp 							= $this->pegawai_model->buat_kode_tmp();
		$kode 							= $_POST['id_pegawai'];
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya
		$pass_ready	= $this->bcrypt->hash_password('123456');

		$msg							= false;
		$config['upload_path']			= './assets/foto/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_pegawai'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->pegawai_model->tambah_tmp(
					$tmp,
					$_POST['id_pegawai'],
					$_POST['nip_baru'],
					$_POST['jenis_pegawai'],
					$_POST['nip_lama'],
					$_POST['nip_baru'],
					$_POST['nama_pegawai'],
					$_POST['gelar_depan'],
					$_POST['gelar_belakang'],
					$_POST['ektp'],
					$_POST['npwp'],
					tgl_sql($_POST['tmt_polines']),
					tgl_sql($_POST['tmt_cpns']),
					tgl_sql($_POST['tmt_pns']),
					$_POST['no_sk'],
					$_POST['jenis_kelamin'],
					$_POST['tempat_lahir'],
					tgl_sql($_POST['tanggal_lahir']),
					$_POST['golongan_darah'],
					$_POST['agama'],
					$_POST['status_pernikahan'],
					$_POST['no_hp1'],
					$_POST['no_hp2'],
					$_POST['telepon'],
					$_POST['email'],
					$_POST['jalan'],
					$_POST['kelurahan'],
					$_POST['kecamatan'],
					$_POST['kota'],
					$_POST['propinsi'],
					$_POST['tinggi'],
					$_POST['berat'],
					$_POST['rambut'],
					$_POST['muka'],
					$_POST['kulit'],
					$_POST['ciri'],
					$_POST['cacat'],
					$_POST['hobi'],
					$_POST['no_sbakn'],
					tgl_sql($_POST['tgl_sbakn']),
					$_POST['no_skmpk'],
					tgl_sql($_POST['tgl_skmpk']),
					$_POST['no_sttpl'],
					tgl_sql($_POST['tgl_sttpl']),
					$_POST['no_spmt'],
					tgl_sql($_POST['tgl_spmt']),
					$_POST['no_spmj'],
					tgl_sql($_POST['tgl_spmj']),
					$_POST['status_pegawai'],
					$_POST['jurusan'],
					$_POST['prodi'],
					$pass_ready
				);
			$simpan 	=	$this->db->query(
								"UPDATE t_pegawai 
								SET sts_pegawai='3'
								WHERE id_pegawai='$kode';"
							);
			if ($simpan) {
				$msg	= true;

			}

			if (!empty($_FILES['foto']['name'])) {
				if ($this->upload->do_upload('foto')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE tmp_pegawai 
										SET foto_pegawai='$nama_foto' 
										WHERE id_tmp='$tmp';"
										); 
				}
			}

			if (!empty($_FILES['file_sbakn']['name'])) {
				if ($this->upload->do_upload('file_sbakn')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE tmp_pegawai 
										SET file_sbakn='$nama_foto' 
										WHERE id_tmp='$tmp';"
										); 
				}
			}

			if (!empty($_FILES['file_skmpk']['name'])) {
				if ($this->upload->do_upload('file_skmpk')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE tmp_pegawai 
										SET file_skmpk='$nama_foto' 
										WHERE id_tmp='$tmp';"
										); 
				}
			}

			if (!empty($_FILES['file_sttpl']['name'])) {
				if ($this->upload->do_upload('file_sttpl')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE tmp_pegawai 
										SET file_sttpl='$nama_foto' 
										WHERE id_tmp='$tmp';"
										); 
				}
			}

			if (!empty($_FILES['file_spmt']['name'])) {
				if ($this->upload->do_upload('file_spmt')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE tmp_pegawai 
										SET file_spmt='$nama_foto' 
										WHERE id_tmp='$tmp';"
										); 
				}
			}

			if (!empty($_FILES['file_spmj']['name'])) {
				if ($this->upload->do_upload('file_spmj')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE tmp_pegawai 
										SET file_spmt='$nama_foto' 
										WHERE id_tmp='$tmp';"
										); 
				}
			}
		}

		//-- Start Notice --//
		if ($this->session->userdata('akses_pegawai_siskap')=='Admin'){
			if ($_POST['id_pegawai']==$this->session->userdata('kode_pegawai_siskap')){
				$user_read	= 1;
			} else {
				$user_read 	= 0;
			}
			$admin_read = 1;
		} else {
			$user_read 	= 1;
			$admin_read = 0;
		}
		$input_notice 	= $this->notice_model->tambah(
				$this->notice_model->buat_id(),
				$_POST['id_pegawai'],
				'Pengajuan Edit Data',
				date('Y-m-d H:i:s'),
				'#',
				'Pengajuan Edit Data Pegawai',
				$user_read,
				$admin_read,
				'0',
				$this->session->userdata('kode_pegawai_siskap'),
				date('Y-m-d H:i:s'),
				$_SERVER['REMOTE_ADDR']
		);
		//-- End Notice --//

		redirect (base_url() . 'pegawai/detail_profil/' .$kode);
	}

	public function data_tmp($kode) {
		$data		= $this->pegawai_model->cari_tmp($kode);
		foreach ($data as $didik ) {
			$nip 			= $didik->nip_baru;
			$lama 			= $didik->nip_lama;
			$nama 			= $didik->nm_pegawai;
			$depan 			= $didik->gelar_depan;
			$belakang 		= $didik->gelar_belakang;
			$tempat		= $didik->tempat_lahir;
			$tanggal 		= $didik->tanggal_lahir;
			$jk 		= $didik->jenis_kelamin;
			$agama 		= $didik->nm_agama;
			$darah 		= $didik->golongan_darah;
			$perkawinan 		= $didik->status_perkawinan;
			$email 		= $didik->email_pegawai;
			$ektp 		= $didik->ektp_pegawai;
			$npwp 		= $didik->npwp_pegawai;
			$propinsi 		= $didik->nama_propinsi;
			$kota 		= $didik->nama_kota;
			$kecamatan 		= $didik->nama_kecamatan;
			$kelurahan 		= $didik->nama_kelurahan;
			$jalan 		= $didik->alamat_jalan;
			$hp1 		= $didik->hp1_pegawai;
			$hp2 		= $didik->hp2_pegawai;
			$telepon 		= $didik->telepon_pegawai;
			$tinggi		= $didik->tinggi_badan;
			$berat 		= $didik->berat_badan;
			$rambut 		= $didik->rambut;
			$muka 		= $didik->bentuk_muka;
			$warna 		= $didik->warna_kulit;
			$ciri 		= $didik->ciri_khas;
			$cacat 		= $didik->cacat_tubuh;
			$hobi 		= $didik->hobi_pegawai;
			$status 		= $didik->nama_status;
			$jenis 		= $didik->nm_jenis;
			$jurusan 		= $didik->nm_jurusan;
			$prodi		= $didik->nm_prodi;
			$polines 		= $didik->tmt_polines;
			$cpns		= $didik->tmt_cpns;
			$pns 		= $didik->tmt_pns;
			$n_sk 		= $didik->no_sk;
			$n_sbakn 		= $didik->no_sbakn;
			$t_sbakn 		= $didik->tgl_sbakn;
			$n_skmpk 		= $didik->no_skmpk;
			$t_skmpk 		= $didik->tgl_skmpk;
			$n_sttpl 		= $didik->no_sttpl;
			$t_sttpl 		= $didik->tgl_sttpl;
			$n_spmt 		= $didik->no_spmt;
			$t_spmt 		= $didik->tgl_spmt;
			$n_spmj 		= $didik->no_spmj;
			$t_spmj 		= $didik->tgl_spmj;
		}

		$pend2		= $this->pegawai_model->cari_tmp2($kode);

		foreach ($pend2 as $didik2 ) {
			$nip2 			= $didik2->nip_baru;
			$lama2 			= $didik2->nip_lama;
			$nama2 			= $didik2->nm_pegawai;
			$depan2 			= $didik2->gelar_depan;
			$belakang2 		= $didik2->gelar_belakang;
			$tempat2		= $didik2->tempat_lahir;
			$tanggal2 		= $didik2->tanggal_lahir;
			$jk2 		= $didik2->jenis_kelamin;
			$agama2 		= $didik2->nm_agama;
			$darah2 		= $didik2->golongan_darah;
			$perkawinan2 		= $didik2->status_perkawinan;
			$email2 		= $didik2->email_pegawai;
			$ektp2 		= $didik2->ektp_pegawai;
			$npwp2 		= $didik2->npwp_pegawai;
			$propinsi2 		= $didik2->nama_propinsi;
			$kota2 		= $didik2->nama_kota;
			$kecamatan2 		= $didik2->nama_kecamatan;
			$kelurahan2 		= $didik2->nama_kelurahan;
			$jalan2 		= $didik2->alamat_jalan;
			$hp12 		= $didik2->hp1_pegawai;
			$hp22 		= $didik2->hp2_pegawai;
			$telepon2 		= $didik2->telepon_pegawai;
			$tinggi2		= $didik2->tinggi_badan;
			$berat2 		= $didik2->berat_badan;
			$rambut2 		= $didik2->rambut;
			$muka2 		= $didik2->bentuk_muka;
			$warna2 		= $didik2->warna_kulit;
			$ciri2 		= $didik2->ciri_khas;
			$cacat2 		= $didik2->cacat_tubuh;
			$hobi2 		= $didik2->hobi_pegawai;
			$status2 		= $didik2->nama_status;
			$jenis2 		= $didik2->nm_jenis;
			$jurusan2 		= $didik2->nm_jurusan;
			$prodi2		= $didik2->nm_prodi;
			$polines2 		= $didik2->tmt_polines;
			$cpns2		= $didik2->tmt_cpns;
			$pns2 		= $didik2->tmt_pns;
			$n_sk2 		= $didik2->no_sk;
			$n_sbakn2 		= $didik2->no_sbakn;
			$t_sbakn2 		= $didik2->tgl_sbakn;
			$n_skmpk2 		= $didik2->no_skmpk;
			$t_skmpk2 		= $didik2->tgl_skmpk;
			$n_sttpl2 		= $didik2->no_sttpl;
			$t_sttpl2 		= $didik2->tgl_sttpl;
			$n_spmt2 		= $didik2->no_spmt;
			$t_spmt2 		= $didik2->tgl_spmt;
			$n_spmj2 		= $didik2->no_spmj;
			$t_spmj2 		= $didik2->tgl_spmj;
		}

		if($nip != $nip2){
			$data['nip'] = 'green';
		}else{
			$data['nip'] = 'black';
		}

		if($lama != $lama2){
			$data['lama'] = 'green';
		}else{
			$data['lama'] = 'black';
		}

		if($nama != $nama2){
			$data['nama_k'] = 'green';
		}else{
			$data['nama_k'] = 'black';
		}

		if($depan != $depan2){
			$data['depan'] = 'green';
		}else{
			$data['depan'] = 'black';
		}

		if($blekang != $blekang2){
			$data['blekang'] = 'green';
		}else{
			$data['blekang'] = 'black';
		}

		if($tempat != $tempat2){
			$data['tempat'] = 'green';
		}else{
			$data['tempat'] = 'black';
		}

		if($tanggal != $tanggal2){
			$data['tanggal'] = 'green';
		}else{
			$data['tanggal'] = 'black';
		}

		if($jk != $jk2){
			$data['jk'] = 'green';
		}else{
			$data['jk'] = 'black';
		}

		if($agama != $agama2){
			$data['agama'] = 'green';
		}else{
			$data['agama'] = 'black';
		}

		if($darah != $darah2){
			$data['darah'] = 'green';
		}else{
			$data['darah'] = 'black';
		}

		if($perkawinan != $perkawinan2){
			$data['perkawinan'] = 'green';
		}else{
			$data['perkawinan'] = 'black';
		}

		if($email != $email2){
			$data['email'] = 'green';
		}else{
			$data['email'] = 'black';
		}

		if($ektp != $ektp2){
			$data['ektp'] = 'green';
		}else{
			$data['ektp'] = 'black';
		}

		if($npwp != $npwp2){
			$data['npwp'] = 'green';
		}else{
			$data['npwp'] = 'black';
		}

		if($propinsi != $propinsi2){
			$data['propinsi'] = 'green';
		}else{
			$data['propinsi'] = 'black';
		}

		if($kota != $kota2){
			$data['kota'] = 'green';
		}else{
			$data['kota'] = 'black';
		}

		if($kecamatan != $kecamatan2){
			$data['kecamatan'] = 'green';
		}else{
			$data['kecamatan'] = 'black';
		}

		if($kelurahan != $kelurahan2){
			$data['kelurahan'] = 'green';
		}else{
			$data['kelurahan'] = 'black';
		}

		if($jalan != $jalan2){
			$data['jalan'] = 'green';
		}else{
			$data['jalan'] = 'black';
		}

		if($hp1 != $hp12){
			$data['hp1'] = 'green';
		}else{
			$data['hp1'] = 'black';
		}

		if($hp2 != $hp22){
			$data['hp2'] = 'green';
		}else{
			$data['hp2'] = 'black';
		}

		if($telepon != $telepon2){
			$data['telepon'] = 'green';
		}else{
			$data['telepon'] = 'black';
		}

		if($tinggi != $tinggi2){
			$data['tinggi'] = 'green';
		}else{
			$data['tinggi'] = 'black';
		}

		if($berat != $berat2){
			$data['berat'] = 'green';
		}else{
			$data['berat'] = 'black';
		}

		if($rambut != $rambut2){
			$data['rambut'] = 'green';
		}else{
			$data['rambut'] = 'black';
		}

		if($muka != $muka2){
			$data['muka'] = 'green';
		}else{
			$data['muka'] = 'black';
		}

		if($warna != $warna2){
			$data['warna'] = 'green';
		}else{
			$data['warna'] = 'black';
		}

		if($ciri != $ciri2){
			$data['ciri'] = 'green';
		}else{
			$data['ciri'] = 'black';
		}

		if($cacat != $cacat2){
			$data['cacat'] = 'green';
		}else{
			$data['cacat'] = 'black';
		}

		if($hobi != $hobi2){
			$data['hobi'] = 'green';
		}else{
			$data['hobi'] = 'black';
		}

		if($status != $status2){
			$data['status'] = 'green';
		}else{
			$data['status'] = 'black';
		}

		if($jenis != $jenis2){
			$data['jenis'] = 'green';
		}else{
			$data['jenis'] = 'black';
		}

		if($jurusan != $jurusan2){
			$data['jurusan'] = 'green';
		}else{
			$data['jurusan'] = 'black';
		}

		if($prodi != $prodi2){
			$data['prodi'] = 'green';
		}else{
			$data['prodi'] = 'black';
		}

		if($polines != $polines2){
			$data['polines'] = 'green';
		}else{
			$data['polines'] = 'black';
		}

		if($cpns != $cpns2){
			$data['cpns'] = 'green';
		}else{
			$data['cpns'] = 'black';
		}

		if($pns != $pns2){
			$data['pns'] = 'green';
		}else{
			$data['pns'] = 'black';
		}

		if($n_sk != $n_sk2){
			$data['n_sk'] = 'green';
		}else{
			$data['n_sk'] = 'black';
		}

		if($n_sbakn != $n_sbakn2){
			$data['n_sbakn'] = 'green';
		}else{
			$data['n_sbakn'] = 'black';
		}

		if($t_sbakn != $t_sbakn2){
			$data['t_sbakn'] = 'green';
		}else{
			$data['t_sbakn'] = 'black';
		}

		if($n_skmpk != $n_skmpk2){
			$data['n_skmpk'] = 'green';
		}else{
			$data['n_skmpk'] = 'black';
		}

		if($t_skmpk != $t_skmpk2){
			$data['t_skmpk'] = 'green';
		}else{
			$data['t_skmpk'] = 'black';
		}

		if($n_sttpl != $n_sttpl2){
			$data['n_sttpl'] = 'green';
		}else{
			$data['n_sttpl'] = 'black';
		}

		if($t_sttpl != $t_sttpl2){
			$data['t_sttpl'] = 'green';
		}else{
			$data['t_sttpl'] = 'black';
		}

		if($n_spmt != $n_spmt2){
			$data['n_spmt'] = 'green';
		}else{
			$data['n_spmt'] = 'black';
		}

		if($t_spmt != $t_spmt2){
			$data['t_spmt'] = 'green';
		}else{
			$data['t_spmt'] = 'black';
		}

		if($n_stmj != $n_stmj2){
			$data['n_stmj'] = 'green';
		}else{
			$data['n_stmj'] = 'black';
		}

		if($t_stmj != $t_stmj2){
			$data['t_stmj'] = 'green';
		}else{
			$data['t_stmj'] = 'black';
		}

		// if (count($data)>0){
			echo json_encode($data);
		// } else {
		// 	echo json_encode('false');
		// }
	}


	public function terima_edit() {
		$kode 		= $_POST['id_pegawai'];
		$pegawai 		= $_POST['id_pegawai'];
		$msg		= false;
		$edit 		= $this->pegawai_model->terima_edit(
						$kode
					);
		if ($edit){
			$msg 	= true;
		}

		//-- Start Notice --//
		if ($this->session->userdata('akses_pegawai_siskap')=='Admin'){
			if ($pegawai==$this->session->userdata('kode_pegawai_siskap')){
				$user_read	= 1;
			} else {
				$user_read 	= 0;
			}
			$admin_read = 1;
		} else {
			$user_read 	= 1;
			$admin_read = 0;
		}
		$input_notice 	= $this->notice_model->tambah(
				$this->notice_model->buat_id(),
				$pegawai,
				'Terima Pengajuan Edit',
				date('Y-m-d H:i:s'),
				'#',
				'Terima Pengajuan Edit Data Pegawai',
				$user_read,
				$admin_read,
				'0',
				$this->session->userdata('kode_pegawai_siskap'),
				date('Y-m-d H:i:s'),
				$_SERVER['REMOTE_ADDR']
		);
		//-- End Notice --//

		redirect (base_url() . 'pegawai/detail/' . $kode);
	}

	public function tolak_edit($kode, $pegawai) {
		$msg		= false;
		$edit 		= $this->db->query(
						"UPDATE t_pegawai SET sts_pegawai='0' 
						WHERE id_pegawai='$kode';"
		);
		$edit 		= $this->db->query(
						"UPDATE tmp_pegawai SET sts_pegawai='1' 
						WHERE id_pegawai='$kode';"
		);
		if ($edit){
			$msg 	= true;
		}

		//-- Start Notice --//
		if ($this->session->userdata('akses_pegawai_siskap')=='Admin'){
			if ($pegawai==$this->session->userdata('kode_pegawai_siskap')){
				$user_read	= 1;
			} else {
				$user_read 	= 0;
			}
			$admin_read = 1;
		} else {
			$user_read 	= 1;
			$admin_read = 0;
		}
		$input_notice 	= $this->notice_model->tambah(
				$this->notice_model->buat_id(),
				$pegawai,
				'Tolak Pengajuan Edit',
				date('Y-m-d H:i:s'),
				'#',
				'Tolak Pengajuan Edit Data Pegawai',
				$user_read,
				$admin_read,
				'0',
				$this->session->userdata('kode_pegawai_siskap'),
				date('Y-m-d H:i:s'),
				$_SERVER['REMOTE_ADDR']
		);
		//-- End Notice --//

		echo json_encode($msg);
	}

	public function hapus($kode) {
		$hapus 				= $this->pegawai_model->hapus($kode);
		$msg['success'] 	= false;
		if ($hapus) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
}
