<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pensiun extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('pensiun_model');
		$this->load->model('riwayat_pangkat_model');
		$this->load->model('riwayat_jabatan_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/document/data_pensiun_tabel');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/document/data_pensiun_tabel');
			}
		}
	}

	public function form_tambah() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','2');");
		$data['tambah']	= $this->pensiun_model->cari_semua();
		$data['data_terakhir']	= $this->pensiun_model->data_terakhir();
		$this->load->view( 'admin/document/tambah_data_pensiun', $data );
	}

	public function form_edit($id) {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','2');");
		$data['pegawai']	= $this->pegawai_model->cari_semua();
		$data['pangkat']	= $this->pensiun_model->cari_pangkat($id);
		$data['jabatan']	= $this->pensiun_model->cari_jabatan($id);
		$data['jabatan2']	= $this->pensiun_model->cari_jabatan2($id);
		$data['data_pensiun']	= $this->pensiun_model->cari_edit($id);
		$this->load->view( 'admin/document/edit_data_pensiun', $data );
	}

	public function cetak_pdf($id) {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','2');");
		$data['data_pensiun']	= $this->pensiun_model->cari_cetak($id);
		$this->load->view( 'admin/document/cetak_pensiun', $data );
	}


	public function cetak_prev() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','2');");
		$this->load->view( 'admin/document/cetak_pensiun_prev', $data );
	}


	public function data() {
		$data 					= $this->pensiun_model->cari_semua();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kd_pensiun,
					'surat' 		=> $data->nomor_pensiun,
					'tanggal'		=> $data->tanggal_pensiun,
					'nama' 			=> $data->nm_pegawai .' '. $data->gelar_belakang,
					'nip' 			=> $data->nip_baru,
					'pangkat' 		=> $data->nm_pangkat,
					'jabatan' 		=> $data->nm_jabatan,
					'status' 		=> '',
					'action' 		=> '<div class="btn-group">
								  		 <button id="btn-pdf" type="button" class="btn btn-primary btn-xs" 
														data-kode="' 	. $data->kd_pensiun 	. '" 
														data-nama="' 	. $data->nm_pegawai 	. '" 
														><i class="fa fa-file-pdf-o"></i></button>'.
										'<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-kode="' 		. $data->kd_pensiun 	. '" 
														data-surat="' 		. $data->nomor_pensiun 	. '" 
														data-tanggal="' 	. $data->tanggal_pensiun 	. '" 
														data-nama="' 		. $data->nm_pegawai 	. '" 
														data-nip="' 		. $data->nip_baru 	. '" 
														data-pangkat="' 	. $data->pangkat_pensiun 	. '" 
														data-jabatan="' 	. $data->jabatan_pensiun 	. '" 
														data-status="'	 	. $data->pangkat_pensiun 	. '" 
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-kode="' 	. $data->kd_pensiun 	. '" 
														data-nama="' 	. $data->nm_pegawai 	. '" 
														><i class="fa fa-trash-o"></i></button>
										</div>',
					'action_pimpinan' => '<div class="btn-group">
								  		 <button id="btn-pdf" type="button" class="btn btn-success btn-xs" 
														data-kode="' 	. $data->kd_pensiun 	. '" 
														data-nama="' 	. $data->nm_pegawai 	. '" 
														><i class="fa fa-file-pdf-o"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}


	public function data_prev() {
		$kode = $_POST['id_pegawai'];
		$kode2 = $_POST['penandatangan_pegawai'];
		$data = $this->pensiun_model->cari_prev($kode,$kode2);
		foreach ($data as $data) {
		$data			= array(
				'nomor' 		=> $_POST['nomor_pensiun'],
				'perihal' 		=> $_POST['perihal_pensiun'],
				'tanggal_surat' => $_POST['tanggal_pensiun'],
				'id_pegawai' 	=> $_POST['id_pegawai'],
				'nama' 			=> $_POST['nama_pegawai'],
				'nip'			=> $_POST['nip_pensiun'],
				'nama2'			=> $data->nama,
				'nip2'			=> $data->nip,
				'tempat'		=> $data->tempat_lahir,
				'tanggal'		=> $data->tanggal_lahir,
				'alamat'		=> $data->alamat_jalan,
				'nm_pangkat'		=> $data->nm_pangkat,
				'pangkat' 		=> $_POST['pangkat_pensiun'],
				'nm_jabatan'		=> $data->nm_jabatan,
				'jabatan' 		=> $_POST['jabatan_pensiun'],
				'nm_jabatan2'		=> $data->nm_jabatan2,
				'penandatangan_jabatan' 		=> $_POST['jabatan_penandatangan_pensiun'],
				'penempatan' 	=> $_POST['penempatan_pensiun'],
				'tujuan' 		=> nl2br($_POST['tujuan_pensiun']),
				'pembukaan' 	=> nl2br($_POST['pembukaan_pensiun']),
				'lampiran' 		=> nl2br($_POST['lampiran_pensiun']),
				'penutup' 		=> nl2br($_POST['penutup_pensiun']),
				'tembusan' 		=> nl2br($_POST['tembusan_pensiun'])
			);
		}
		$this->load->view( 'admin/document/cetak_pensiun_prev', $data );
	}


	public function data_pilih() {
		$data 					= $this->pegawai_model->cari_semua();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
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
			$hasil[]			= array(
					'no'			=> $nomor,
					'id' 			=> $data->id_pegawai,
					'nama' 			=> $data->gelar_depan .' '. $data->nm_pegawai .' '. $data->gelar_belakang,
					'nip' 			=> $data->nip_baru,
					'pangkat'		=> 	'<table width="100%" border="0">
											<tr>
												<td>' . $pangkat . '</td>
											</tr>
										</table>',
					'jabatan'		=> 	'<table width="100%" border="0">
											<tr>
												<td>' . $jabatan . '</td>
											</tr>
										</table>',
					'pilih' 		=> '<div class="btn-group">
										<button id="btn-pilih" type="button" class="btn btn-default btn-xs" 
														data-id="' 			. $data->id_pegawai 			. '" 
														data-nama="' 		. $data->nm_pegawai 		. '"
														data-nip="'		. $data->nip_baru		. '"
														>pilih <i class="fa fa-hand-o-right"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function data_pilih2() {
		$data 					= $this->pegawai_model->cari_semua();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
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
			$hasil[]			= array(
					'no'			=> $nomor,
					'id' 			=> $data->id_pegawai,
					'nama' 			=> $data->gelar_depan .' '. $data->nm_pegawai .' '. $data->gelar_belakang,
					'jabatan'		=> 	'<table width="100%" border="0">
											<tr>
												<td>' . $jabatan . '</td>
											</tr>
										</table>',
					'pilih' 		=> '<div class="btn-group">
										<button id="btn-pilih2" type="button" class="btn btn-default btn-xs" 
														data-id="' 			. $data->id_pegawai 			. '" 
														data-nama="' 		. $data->nm_pegawai 		. '"
														>pilih <i class="fa fa-hand-o-right"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function tambah() {
		if (isset($_POST['nomor_pensiun']) && isset($_POST['id_pegawai'])) {
			$kode		= $this->pensiun_model->buat_kode();
			$simpan 	= $this->pensiun_model->tambah(
							$kode,
							$_POST['nomor_pensiun'],
							$_POST['perihal_pensiun'],
							$_POST['tanggal_pensiun'],
							$_POST['id_pegawai'],
							$_POST['pangkat_pensiun'],
							$_POST['jabatan_pensiun'],
							$_POST['penempatan_pensiun'],
							$_POST['penandatangan_pegawai'],
							$_POST['jabatan_penandatangan_pensiun'],
							nl2br($_POST['tujuan_pensiun']),
							nl2br($_POST['pembukaan_pensiun']),
							nl2br($_POST['lampiran_pensiun']),
							nl2br($_POST['penutup_pensiun']),
							nl2br($_POST['tembusan_pensiun'])
						);
				
			if ($simpan) {
				$msg	= true;
			}
		}
		redirect (base_url() . 'pensiun');

	}

	public function edit() {
		if (isset($_POST['nomor_pensiun']) && isset($_POST['id_pegawai'])) {
			$simpan 	= $this->pensiun_model->edit(
							$_POST['kd_pensiun'],
							$_POST['nomor_pensiun'],
							$_POST['perihal_pensiun'],
							$_POST['tanggal_pensiun'],
							$_POST['id_pegawai'],
							$_POST['pangkat_pensiun'],
							$_POST['jabatan_pensiun'],
							$_POST['penempatan_pensiun'],
							$_POST['penandatangan_pegawai'],
							$_POST['jabatan_penandatangan_pensiun'],
							nl2br($_POST['tujuan_pensiun']),
							nl2br($_POST['pembukaan_pensiun']),
							nl2br($_POST['lampiran_pensiun']),
							nl2br($_POST['penutup_pensiun']),
							nl2br($_POST['tembusan_pensiun'])
						);
				
			if ($simpan) {
				$msg	= true;
			}
		}
		redirect (base_url() . 'pensiun');
	}

	public function hapus($kode) {
		$hapus 				= $this->pensiun_model->hapus($kode);
		$msg 	= false;
		if ($hapus) {
			$msg = true;
		}
		echo json_encode($msg);
	}



	public function data_pangkat($kode) {
		$data			= $this->pensiun_model->data_pangkat($kode);		
		$result			= '<option value="">-- Pilih Pangkat --</option>';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->kd_pangkat . '">' . $data->nm_pangkat . '</option>';
		}
		echo json_encode($result);
	}

	public function data_jabatan($kode) {
		$data			= $this->pensiun_model->data_jabatan($kode);		
		$result			= '<option value="">-- Pilih Jabatan --</option>';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->kd_jabatan . '">' . $data->nm_jabatan . '</option>';
		}
		echo json_encode($result);
	}


	public function data_jabatan2($kode) {
		$data			= $this->pensiun_model->data_jabatan2($kode);		
		$result			= '<option value="">-- Pilih Jabatan --</option>';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->kd_jabatan . '">' . $data->nm_jabatan . '</option>';
		}
		echo json_encode($result);
	}
}