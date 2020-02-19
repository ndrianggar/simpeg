<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('naik_gaji_model');
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
				$this->load->view('admin/document/naik_gaji');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/document/naik_gaji');
			}
		}
	}

	public function form_tambah() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','2');");
		$data['tambah']		= $this->naik_gaji_model->cari_semua();
		$data['pangkat']	= $this->pangkat_model->cari_semua();
		$data['jabatan']	= $this->jabatan_model->cari_semua();
		$data['data_terakhir']	= $this->naik_gaji_model->data_terakhir();
		$this->load->view( 'admin/document/tambah_naik_gaji', $data );
	}

	public function form_edit($id) {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','2');");
		$data['pegawai']	= $this->pegawai_model->cari_semua();
		$data['pangkat']	= $this->naik_gaji_model->cari_pangkat($id);
		$data['jabatan']	= $this->naik_gaji_model->cari_jabatan($id);
		$data['jabatan2']	= $this->naik_gaji_model->cari_jabatan2($id);
		$data['d_pangkat']	= $this->pangkat_model->cari_semua();
		$data['d_jabatan']	= $this->jabatan_model->cari_semua();
		$data['data_naik_gaji']	= $this->naik_gaji_model->cari_edit($id);
		$this->load->view( 'admin/document/edit_naik_gaji', $data );
	}

	public function cetak_pdf($id) {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','2');");
		$data['data_naik_gaji']	= $this->naik_gaji_model->cari_cetak($id);
		$this->load->view( 'admin/document/cetak_kenaikan_gaji', $data );
	}


	// public function cetak_prev() {
	// 	$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
	// 	$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','2');");
	// 	$this->load->view( 'admin/master/document/cetak_pensiun_prev', $data );
	// }

	public function data() {
		$data 					= $this->naik_gaji_model->cari_semua();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kd_naik_gaji,
					'nomor_surat' 		=> $data->nomor_surat,
					'nama' 			=>  $data->gelar_depan .' '. $data->nm_pegawai .' '. $data->gelar_belakang,
					'tanggal' 			=> $data->tanggal_gaji,
					'gaji_pokok' 			=> $data->gaji,
					'pangkat' 		=> $data->nm_pangkat,
					'jabatan' 		=> $data->nm_jabatan,
					'gaji_baru' 		=> $data->gaji_baru,
					'action' 		=> '<div class="btn-group">
								  		 <button id="btn-pdf" type="button" class="btn btn-primary btn-xs" 
														data-kode="' 	. $data->kd_naik_gaji 	. '" 
														data-nama="' 	. $data->nm_pegawai 	. '" 
														><i class="fa fa-file-pdf-o"></i></button>'.
										'<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-kode="' 		. $data->kd_naik_gaji 	. '" 
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-kode="' 	. $data->kd_naik_gaji 	. '" 
														data-nama="' 	. $data->nm_pegawai 	. '" 
														><i class="fa fa-trash-o"></i></button>
										</div>',
					'action_pimpinan' => '<div class="btn-group">
								  		 <button id="btn-pdf" type="button" class="btn btn-success btn-xs" 
														data-kode="' 	. $data->kd_naik_gaji 	. '" 
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
		$data = $this->naik_gaji_model->cari_prev($kode, $kode2);
		foreach ($data as $data) {
		$data			= array(
				'nomor_surat'	=>			$_POST['nomor_surat'],
				'tanggal_surat'	=>			$_POST['tanggal_surat'],
				'id_pegawai'	=>			$_POST['id_pegawai'],
				'pangkat_pegawai'	=>			$_POST['pangkat_pegawai'],
				'jabatan_pegawai'	=>			$_POST['jabatan_pegawai'],
				'kantor'	=>			$_POST['kantor'],
				'gaji'	=>			$_POST['gaji_pokok'],
				'pejabat'	=>			$_POST['oleh_pejabat'],
				'tanggal_pejabat'	=>			$_POST['tanggal_skp'],
				'nomor_pejabat'	=>			$_POST['nomor_pejabat'],
				'tanggal_berlaku'	=>			$_POST['tanggal_berlaku'],
				'masa_kerja'	=>			$_POST['masa_kerja'],
				'gaji_baru'	=>			$_POST['gaji_baru'],
				'tunjangan_jabatan'	=>			$_POST['tunjangan_jabatan'],
				'masa_kerja_baru'	=>			$_POST['masa_kerja_baru'],
				'golongan'	=>			$_POST['golongan'],
				'mulai_tanggal'	=>			$_POST['tanggal_mulai'],
				'penandatangan_pegawai'	=>			$_POST['penandatangan_pegawai'],
				'penandatangan_jabatan'	=>			$_POST['penandatangan_jabatan'],
				'hal_surat'	=>			nl2br($_POST['hal_surat']),
				'catatan_surat'	=>			nl2br($_POST['catatan_surat']),
				'tujuan_surat'	=>			nl2br($_POST['tujuan_surat']),
				'pembukaan_surat'	=>			nl2br($_POST['pembukaan_surat']),
				'dasar_surat'	=>			nl2br($_POST['dasar_surat']),
				'hingga_memperoleh'	=>			nl2br($_POST['hingga_memperoleh']),
				'penutup_surat'	=>			nl2br($_POST['penutup_surat']),
				'salinan'	=>			nl2br($_POST['salinan']),
				'nm_pegawai'			=>  $data->gelar_depan .' '. $data->nm_pegawai .' '. $data->gelar_belakang,
				'nip_baru'			=> $data->nip_baru,
				'nama'			=> $data->nama,
				'nip'			=> $data->nip,
				'nm_jabatan2'		=> $data->nm_jabatan2,
				'nm_jabatan'		=> $data->nm_jabatan,
				'nm_pangkat'		=> $data->nm_pangkat,
				'gol'		=> $data->gol_pangkat,
				'ruang'		=> $data->ruang_pangkat,

			);
		}
		$this->load->view( 'admin/document/cetak_naik_gaji_prev', $data );
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
		if (isset($_POST['nomor_surat']) && isset($_POST['id_pegawai'])) {
			$kode		= $this->naik_gaji_model->buat_kode();
			$simpan 	= $this->naik_gaji_model->tambah(
							$kode,
							$_POST['nomor_surat'],
							$_POST['tanggal_surat'],
							$_POST['id_pegawai'],
							$_POST['pangkat_pegawai'],
							$_POST['jabatan_pegawai'],
							$_POST['kantor'],
							$_POST['gaji_pokok'],
							$_POST['oleh_pejabat'],
							$_POST['tanggal_skp'],
							$_POST['nomor_pejabat'],
							$_POST['tanggal_berlaku'],
							$_POST['masa_kerja'],
							$_POST['gaji_baru'],
							$_POST['tunjangan_jabatan'],
							$_POST['masa_kerja_baru'],
							$_POST['golongan'],
							$_POST['tanggal_mulai'],
							$_POST['penandatangan_pegawai'],
							$_POST['penandatangan_jabatan'],
							nl2br($_POST['hal_surat']),
							nl2br($_POST['catatan_surat']),
							nl2br($_POST['tujuan_surat']),
							nl2br($_POST['pembukaan_surat']),
							nl2br($_POST['dasar_surat']),
							nl2br($_POST['hingga_memperoleh']),
							nl2br($_POST['penutup_surat']),
							nl2br($_POST['salinan'])
						);
				
			if ($simpan) {
				$msg	= true;
			}
		}
		redirect (base_url() . 'gaji');

	}

	public function edit() {
		if (isset($_POST['nomor_surat']) && isset($_POST['id_pegawai'])) {
			$simpan 	= $this->naik_gaji_model->edit(
							$_POST['kd_naik_gaji'],
							$_POST['nomor_surat'],
							$_POST['tanggal_surat'],
							$_POST['id_pegawai'],
							$_POST['pangkat_pegawai'],
							$_POST['jabatan_pegawai'],
							$_POST['kantor'],
							$_POST['gaji_pokok'],
							$_POST['oleh_pejabat'],
							$_POST['tanggal_skp'],
							$_POST['nomor_pejabat'],
							$_POST['tanggal_berlaku'],
							$_POST['masa_kerja'],
							$_POST['gaji_baru'],
							$_POST['tunjangan_jabatan'],
							$_POST['masa_kerja_baru'],
							$_POST['golongan'],
							$_POST['tanggal_mulai'],
							$_POST['penandatangan_pegawai'],
							$_POST['penandatangan_jabatan'],
							nl2br($_POST['hal_surat']),
							nl2br($_POST['catatan_surat']),
							nl2br($_POST['tujuan_surat']),
							nl2br($_POST['pembukaan_surat']),
							nl2br($_POST['dasar_surat']),
							nl2br($_POST['hingga_memperoleh']),
							nl2br($_POST['penutup_surat']),
							nl2br($_POST['salinan'])
						);
				
			if ($simpan) {
				$msg	= true;
			}
		}
		redirect (base_url() . 'gaji');
	}

	public function hapus($kode) {
		$hapus 				= $this->naik_gaji_model->hapus($kode);
		$msg 	= false;
		if ($hapus) {
			$msg = true;
		}
		echo json_encode($msg);
	}

	public function data_pangkat($kode) {
		$data			= $this->naik_gaji_model->data_pangkat($kode);		
		$result			= '<option value="">-- Pilih Pangkat --</option>';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->kd_pangkat . '">' . $data->nm_pangkat . '</option>';
		}
		echo json_encode($result);
	}

	public function data_jabatan($kode) {
		$data			= $this->naik_gaji_model->data_jabatan($kode);		
		$result			= '<option value="">-- Pilih Jabatan --</option>';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->kd_jabatan . '">' . $data->nm_jabatan . '</option>';
		}
		echo json_encode($result);
	}

	public function data_jabatan2($kode) {
		$data			= $this->naik_gaji_model->data_jabatan2($kode);		
		$result			= '<option value="">-- Pilih Jabatan --</option>';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->kd_jabatan . '">' . $data->nm_jabatan . '</option>';
		}
		echo json_encode($result);
	}

	public function data_jabatan_tmt($kode, $tmt) {
		$data 					= $this->naik_gaji_model->data_jabatan_tmt($kode, $tmt);
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