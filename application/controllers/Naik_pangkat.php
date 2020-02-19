<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Naik_pangkat extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('naik_pangkat_model');
		$this->load->model('pangkat_model');
		$this->load->model('jabatan_model');
		$this->load->model('riwayat_pangkat_model');
		$this->load->model('riwayat_jabatan_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/document/data_naik_pangkat_tabel');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/document/data_naik_pangkat_tabel');
			}
		}
	}

	public function form_tambah() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','2');");
		$data['tambah']	= $this->naik_pangkat_model->cari_semua();
		$data['pangkat']	= $this->pangkat_model->cari_semua();
		$data['jabatan']	= $this->jabatan_model->cari_semua();
		$data['data_terakhir']	= $this->naik_pangkat_model->data_terakhir();
		$this->load->view( 'admin/document/tambah_data_naik_pangkat', $data );
	}

	public function form_edit($id) {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','2');");
		$data['pegawai']	= $this->pegawai_model->cari_semua();
		$data['pangkat']	= $this->naik_pangkat_model->cari_pangkat($id);
		$data['jabatan']	= $this->naik_pangkat_model->cari_jabatan($id);
		$data['jabatan2']	= $this->naik_pangkat_model->cari_jabatan2($id);
		$data['d_pangkat']	= $this->pangkat_model->cari_semua();
		$data['d_jabatan']	= $this->jabatan_model->cari_semua();
		$data['data_naik_pangkat']	= $this->naik_pangkat_model->cari_edit($id);
		$this->load->view( 'admin/document/edit_data_naik_pangkat', $data );
	}

	public function cetak_pdf($id) {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','2');");
		$data['data_naik_pangkat']	= $this->naik_pangkat_model->cari_cetak($id);
		$this->load->view( 'admin/document/cetak_naik_pangkat', $data );
	}


	// public function cetak_prev() {
	// 	$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
	// 	$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','2');");
	// 	$this->load->view( 'admin/master/document/cetak_pensiun_prev', $data );
	// }

	public function data() {
		$data 					= $this->naik_pangkat_model->cari_semua();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kd_naik_pangkat,
					'surat' 		=> $data->nomor_pangkat,
					'nama' 			=> $data->gelar_depan .' '. $data->nm_pegawai .' '. $data->gelar_belakang ,
					'nip' 			=> $data->nip_baru,
					'nidn' 			=> $data->nidn_pangkat,
					'pangkat' 		=> $data->nm_pangkat . ", " . $data->tmt_pgrt_lama_pangkat ."<br><h4>Menjadi</h4>". 
										$data->nama_pangkat . ", " . $data->tmt_pgrt_baru_pangkat,
					'jabatan' 		=> $data->nm_jabatan . ", " . $data->tmt_jabatan_lama_pangkat ."<br><h4>Menjadi</h4>". 
										$data->nama_jabatan . ", " . $data->tmt_jabatan_baru_pangkat,
					'status' 		=> '',
					'action' 		=> '<div class="btn-group">
								  		 <button id="btn-pdf" type="button" class="btn btn-primary btn-xs" 
														data-kode="' 	. $data->kd_naik_pangkat 	. '" 
														data-nama="' 	. $data->nm_pegawai 	. '" 
														><i class="fa fa-file-pdf-o"></i></button>'.
										'<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-kode="' 		. $data->kd_naik_pangkat 	. '" 
														data-surat="' 		. $data->nomor_pangkat 	. '" 
														data-nama="' 		. $data->nm_pegawai 	. '" 
														data-nip="' 		. $data->nip_baru 	. '" 
														data-nidn="' 		. $data->nidn_pangkat 	. '" 
														data-pangkat="' 	. $data->nm_pangkat 	. '" 
														data-jabatan="' 	. $data->nm_jabatan 	. '" 
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-kode="' 	. $data->kd_naik_pangkat 	. '" 
														data-nama="' 	. $data->nm_pegawai 	. '" 
														><i class="fa fa-trash-o"></i></button>
										</div>',
					'action_pimpinan' => '<div class="btn-group">
								  		 <button id="btn-pdf" type="button" class="btn btn-success btn-xs" 
														data-kode="' 	. $data->kd_naik_pangkat 	. '" 
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
		$data = $this->naik_pangkat_model->cari_prev($kode, $kode2);
		foreach ($data as $data) {
		$data			= array(
				'nomor_pangkat'					=>					$_POST['nomor_pangkat'],
				'id_pegawai'					=>					$_POST['id_pegawai'],
				'nidn_pangkat'					=>					$_POST['nidn_pangkat'],
				'pgrt_lama_pangkat'				=>					$_POST['pgrt_lama_pangkat'],
				'tmt_pgrt_lama_pangkat'			=>					$_POST['tmt_pgrt_lama_pangkat'],
				'jabatan_lama_pangkat'			=>					$_POST['jabatan_lama_pangkat'],
				'tmt_jabatan_lama_pangkat'		=>					$_POST['tmt_jabatan_lama_pangkat'],
				'unit_kerja_pangkat'			=>					$_POST['unit_kerja_pangkat'],
				'usulan_angka_kredit_pangkat'	=>					$_POST['usulan_angka_kredit_pangkat'],
				'nama'				 			=> 					$_POST['nama_pegawai'],
				'nip'							=> 					$_POST['nip_pangkat'],
				'tempat'						=> 					$data->tempat_lahir,
				'tanggal'						=> 					$data->tanggal_lahir,
				'nama2'			=> $data->nama,
				'nip2'			=> $data->nip,
				'nm_jabatan2'		=> $data->nm_jabatan2,
				'nm_jabatan'		=> $data->nm_jabatan,
				'nm_pangkat'		=> $data->nm_pangkat,
				'gol'		=> $data->gol_pangkat,
				'ruang'		=> $data->ruang_pangkat,
				'jabatan_baru_pangkat'			=>					$data->nama_jabatan,
				'tmt_jabatan_baru_pangkat'		=>					$_POST['tmt_jabatan_baru_pangkat'],
				'mata_kuliah_pangkat'			=>					$_POST['mata_kuliah_pangkat'],
				'pgrt_baru_pangkat'				=>					$data->nama_pangkat,
				'tmt_pgrt_baru_pangkat'			=>					$_POST['tmt_pgrt_baru_pangkat'],
				'hal_pangkat'					=>					nl2br($_POST['hal_pangkat']),
				'penandatangan_pegawai'			=>					$_POST['penandatangan_pegawai'],
				'penandatangan_jabatan'			=>					$_POST['penandatangan_jabatan'],
				'nip_penandatangan'				=>					$_POST['nip_penandatangan'],
				'tujuan_pangkat'				=>					nl2br($_POST['tujuan_pangkat']),
				'pembukaan_pangkat'				=>					nl2br($_POST['pembukaan_pangkat']),
				'salam_persetujuan_pangkat'		=>					nl2br($_POST['salam_persetujuan_pangkat']),
				'persetujuan_pangkat'			=>					nl2br($_POST['persetujuan_pangkat']),
				'salam_pertimbangan_pangkat'	=>					nl2br($_POST['salam_pertimbangan_pangkat']),
				'pertimbangan_pangkat'			=>					nl2br($_POST['pertimbangan_pangkat']),
				'penutup_pangkat'				=>					nl2br($_POST['penutup_pangkat']),
				'tembusan_pangkat'				=>					nl2br($_POST['tembusan_pangkat'])
			);
		}
		$this->load->view( 'admin/document/cetak_naik_pangkat_prev', $data );
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
					'nama' 			=>  $data->gelar_depan .' '. $data->nm_pegawai .' '. $data->gelar_belakang,
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
					'nama' 			=>  $data->gelar_depan .' '. $data->nm_pegawai .' '. $data->gelar_belakang,
					'jabatan'		=> 	'<table width="100%" border="0">
											<tr>
												<td>' . $jabatan . '</td>
											</tr>
										</table>',
					'pilih' 		=> '<div class="btn-group">
										<button id="btn-pilih2" type="button" class="btn btn-default btn-xs" 
														data-id="' 			. $data->id_pegawai 			. '" 
														data-nama="' 		. $data->nm_pegawai 		. '"
														data-nip="' 		. $data->nip_baru 		. '"
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
		if (isset($_POST['nomor_pangkat']) && isset($_POST['id_pegawai'])) {
			$kode		= $this->naik_pangkat_model->buat_kode();
			$simpan 	= $this->naik_pangkat_model->tambah(
							$kode,
							$_POST['nomor_pangkat'],
							$_POST['id_pegawai'],
							$_POST['nidn_pangkat'],
							$_POST['pgrt_lama_pangkat'],
							$_POST['tmt_pgrt_lama_pangkat'],
							$_POST['jabatan_lama_pangkat'],
							$_POST['tmt_jabatan_lama_pangkat'],
							$_POST['unit_kerja_pangkat'],
							$_POST['usulan_angka_kredit_pangkat'],
							$_POST['jabatan_baru_pangkat'],
							$_POST['tmt_jabatan_baru_pangkat'],
							$_POST['mata_kuliah_pangkat'],
							$_POST['pgrt_baru_pangkat'],
							$_POST['tmt_pgrt_baru_pangkat'],
							nl2br($_POST['hal_pangkat']),
							$_POST['penandatangan_pegawai'],
							$_POST['penandatangan_jabatan'],
							nl2br($_POST['tujuan_pangkat']),
							nl2br($_POST['pembukaan_pangkat']),
							nl2br($_POST['salam_persetujuan_pangkat']),
							nl2br($_POST['persetujuan_pangkat']),
							nl2br($_POST['salam_pertimbangan_pangkat']),
							nl2br($_POST['pertimbangan_pangkat']),
							nl2br($_POST['penutup_pangkat']),
							nl2br($_POST['tembusan_pangkat'])
						);
				
			if ($simpan) {
				$msg	= true;
			}
		}
		redirect (base_url() . 'naik_pangkat');

	}

	public function edit() {
		if (isset($_POST['nomor_pangkat']) && isset($_POST['id_pegawai'])) {
			$simpan 	= $this->naik_pangkat_model->edit(
							$_POST['kd_naik_pangkat'],
							$_POST['nomor_pangkat'],
							$_POST['id_pegawai'],
							$_POST['nidn_pangkat'],
							$_POST['pgrt_lama_pangkat'],
							$_POST['tmt_pgrt_lama_pangkat'],
							$_POST['jabatan_lama_pangkat'],
							$_POST['tmt_jabatan_lama_pangkat'],
							$_POST['unit_kerja_pangkat'],
							$_POST['usulan_angka_kredit_pangkat'],
							$_POST['jabatan_baru_pangkat'],
							$_POST['tmt_jabatan_baru_pangkat'],
							$_POST['mata_kuliah_pangkat'],
							$_POST['pgrt_baru_pangkat'],
							$_POST['tmt_pgrt_baru_pangkat'],
							nl2br($_POST['hal_pangkat']),
							$_POST['penandatangan_pegawai'],
							$_POST['penandatangan_jabatan'],
							nl2br($_POST['tujuan_pangkat']),
							nl2br($_POST['pembukaan_pangkat']),
							nl2br($_POST['salam_persetujuan_pangkat']),
							nl2br($_POST['persetujuan_pangkat']),
							nl2br($_POST['salam_pertimbangan_pangkat']),
							nl2br($_POST['pertimbangan_pangkat']),
							nl2br($_POST['penutup_pangkat']),
							nl2br($_POST['tembusan_pangkat'])
						);
				
			if ($simpan) {
				$msg	= true;
			}
		}
		redirect (base_url() . 'naik_pangkat');
	}

	public function hapus($kode) {
		$hapus 				= $this->naik_pangkat_model->hapus($kode);
		$msg 	= false;
		if ($hapus) {
			$msg = true;
		}
		echo json_encode($msg);
	}

	public function data_pangkat($kode) {
		$data			= $this->naik_pangkat_model->data_pangkat($kode);		
		$result			= '<option value="">-- Pilih Pangkat --</option>';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->kd_pangkat . '">' . $data->nm_pangkat . '</option>';
		}
		echo json_encode($result);
	}

	public function data_jabatan($kode) {
		$data			= $this->naik_pangkat_model->data_jabatan($kode);		
		$result			= '<option value="">-- Pilih Jabatan --</option>';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->kd_jabatan . '">' . $data->nm_jabatan . '</option>';
		}
		echo json_encode($result);
	}

	public function data_jabatan2($kode) {
		$data			= $this->naik_pangkat_model->data_jabatan2($kode);		
		$result			= '<option value="">-- Pilih Jabatan --</option>';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->kd_jabatan . '">' . $data->nm_jabatan . '</option>';
		}
		echo json_encode($result);
	}

	public function data_jabatan_tmt($kode, $tmt) {
		$data 					= $this->naik_pangkat_model->data_jabatan_tmt($kode, $tmt);
		$result 				= array();
		foreach ($data as $data) {
			$result[]			= array(
					'jabatan' 			=> $data->tmt_jabatan
				);
		}
		echo json_encode($result);
		// $result			= '<input value="">-- TMT Jabatan --</input>';
		// foreach ($data as $data) {
		// 	$result		= $result . '<input value="' . $data->tmt_jabatan . '"></input>';
		// }
		// echo json_encode($result);
	}

}