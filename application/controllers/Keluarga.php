<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluarga extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('keluarga_model');
		$this->load->model('notice_model');
	}

	public function index() {
		$data['hubungan']	= $this->keluarga_model->hubungan();
		$this->load->view('admin/master/pegawai/data_pegawai_keluarga', $data );
	}

	public function data() {
		$data					= $this->pegawai_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		foreach ($data as $data) {
			$data_pasangan			= $this->keluarga_model->cari_pasangan( $data->kode );
			$pasangan 				= '';
			if (count($data_pasangan)!==0){
				$urut 				= 	1;
				foreach ($data_pasangan as $data_pasangan) {
					$jenis 			= '<b>' . $data_pasangan->nm_hubungan . '</b><br>';
					$pasangan 		= $pasangan . $urut  . 
									  '. <a data-toggle="modal" id ="keluarga" href="#modal-tambah" 
									  data-kode="' 			. $data_pasangan->kd_keluarga 			. '" 
									  data-nama="' 			. $data_pasangan->nama 		. '" 
									  data-ktp="' 			. $data_pasangan->ektp_keluarga 		. '" 
									  data-hubungan="' 		. $data_pasangan->kd_hubungan	 		. '" 
									  data-nikah="' 		. $data_pasangan->tanggal_menikah		. '" 
									  data-kelamin="' 		. $data_pasangan->jenis_kelamin 		. '" 
									  data-tempat="' 		. $data_pasangan->tempat_lahir 			. '" 
									  data-tanggal="' 		. $data_pasangan->tanggal_lahir 		. '" 
									  data-status="' 		. $data_pasangan->status_perkawinan 	. '"
									  data-pekerjaan="' 	. $data_pasangan->pekerjaan 			. '"
									  data-alamat="' 		. $data_pasangan->alamat_keluarga 		. '"
									  data-keterangan="' 	. $data_pasangan->keterangan_keluarga 	. '"
									  >' .$data_pasangan->nama . '</a><br>';
					$urut 			= $urut + 1;
				}
				$pasangan 			= $jenis . $pasangan;
			}

			$data_anak 				= $this->keluarga_model->cari_anak( $data->kode );
			$anak 					= 	'';
			if (count($data_anak)!==0){
				$urut 				= 	1;
				foreach ($data_anak as $data_anak) {
					$jenis 			= '<b>' . $data_anak->nm_hubungan . '</b><br>';
					$anak 	 		= $anak . $urut  . 
									  '. <a data-toggle="modal" id ="keluarga" href="#modal-tambah" 
									  data-kode="' 			. $data_anak->kd_keluarga 			. '" 
									  data-nama="' 			. $data_anak->nama 		. '" 
									  data-ktp="' 			. $data_anak->ektp_keluarga 		. '" 
									  data-hubungan="' 		. $data_anak->kd_hubungan	 		. '" 
									  data-nikah="' 		. $data_anak->tanggal_menikah		. '" 
									  data-kelamin="' 		. $data_anak->jenis_kelamin 		. '" 
									  data-tempat="' 		. $data_anak->tempat_lahir 			. '" 
									  data-tanggal="' 		. $data_anak->tanggal_lahir 		. '" 
									  data-status="' 		. $data_anak->status_perkawinan 	. '"
									  data-pekerjaan="' 	. $data_anak->pekerjaan 			. '"
									  data-alamat="' 		. $data_anak->alamat_keluarga 		. '"
									  data-keterangan="' 	. $data_anak->keterangan_keluarga 	. '"
									  >' .  $data_anak->nama . '</a><br>';
					$urut 			= $urut + 1;
				}
				$anak 				= $jenis . $anak;
			}

			$data_ortu 				= $this->keluarga_model->cari_ortu( $data->kode );
			$ortu 					= 	'';
			if (count($data_ortu)!==0){
				$urut 				= 	1;
				foreach ($data_ortu as $data_ortu) {
					$jenis 			= '<b>' . $data_ortu->nm_hubungan . '</b><br>';
					$ortu 	 		= $ortu . $urut . 
									  '. <a data-toggle="modal" id ="keluarga" href="#modal-tambah" 
									  data-kode="' 			. $data_ortu->kd_keluarga 			. '" 
									  data-nama="' 			. $data_ortu->nama 		. '" 
									  data-ktp="' 			. $data_ortu->ektp_keluarga 		. '"
									  data-hubungan="' 		. $data_ortu->kd_hubungan	 		. '" 
									  data-nikah="' 		. $data_ortu->tanggal_menikah		. '" 
									  data-kelamin="' 		. $data_ortu->jenis_kelamin 		. '" 
									  data-tempat="' 		. $data_ortu->tempat_lahir 			. '" 
									  data-tanggal="' 		. $data_ortu->tanggal_lahir 		. '" 
									  data-status="' 		. $data_ortu->status_perkawinan 	. '"
									  data-pekerjaan="' 	. $data_ortu->pekerjaan 			. '"
									  data-alamat="' 		. $data_ortu->alamat_keluarga 		. '"
									  data-keterangan="' 	. $data_ortu->keterangan_keluarga 	. '"
									  >' . $data_ortu->nama . '</a><br>';
					$urut 			= $urut + 1;
				}
				$ortu 				= $jenis . $ortu;
			}

			$data_mertua 			= $this->keluarga_model->cari_mertua( $data->kode );
			$mertua 				= 	'';
			if (count($data_mertua)!==0){
				$urut 				= 	1;
				foreach ($data_mertua as $data_mertua) {
					$jenis 			= '<b>' . $data_mertua->nm_hubungan . '</b><br>';
					$mertua 	 	= $mertua . $urut  . 
									  '. <a data-toggle="modal" id ="keluarga" href="#modal-tambah" 
									  data-kode="' 			. $data_mertua->kd_keluarga 		. '" 
									  data-nama="' 			. $data_mertua->nama 		. '" 
									  data-ktp="' 			. $data_mertua->ektp_keluarga 		. '" 
									  data-hubungan="' 		. $data_mertua->kd_hubungan 		. '" 
									  data-nikah="' 		. $data_mertua->tanggal_menikah		. '" 
									  data-kelamin="' 		. $data_mertua->jenis_kelamin 		. '" 
									  data-tempat="' 		. $data_mertua->tempat_lahir 		. '" 
									  data-tanggal="' 		. $data_mertua->tanggal_lahir 		. '" 
									  data-status="' 		. $data_mertua->status_perkawinan 	. '"
									  data-pekerjaan="' 	. $data_mertua->pekerjaan 			. '"
									  data-alamat="' 		. $data_mertua->alamat_keluarga 	. '"
									  data-keterangan="' 	. $data_mertua->keterangan_keluarga . '"
									  >' .  $data_mertua->nama . '</a><br>';
					$urut 			= $urut + 1;
				}
				$mertua 			= $jenis . $mertua;
			}

			$data_saudarakandung 	= $this->keluarga_model->cari_saudarakandung( $data->kode );
			$saudarakandung 		= 	'';
			if (count($data_saudarakandung)!==0){
				$urut 				= 	1;
				foreach ($data_saudarakandung as $data_saudarakandung) {
					$jenis 			= '<b>' . $data_saudarakandung->nm_hubungan . '</b><br>';
					$saudarakandung = $saudarakandung . $urut  . 
									  '. <a data-toggle="modal" id ="keluarga" href="#modal-tambah" 
									  data-kode="' 			. $data_saudarakandung->kd_keluarga 		. '" 
									  data-nama="' 			. $data_saudarakandung->nama 		. '" 
									  data-ktp="' 			. $data_saudarakandung->ektp_keluarga 		. '" 
									  data-hubungan="' 		. $data_saudarakandung->kd_hubungan 		. '" 
									  data-nikah="' 		. $data_saudarakandung->tanggal_menikah		. '" 
									  data-kelamin="' 		. $data_saudarakandung->jenis_kelamin 		. '" 
									  data-tempat="' 		. $data_saudarakandung->tempat_lahir 		. '" 
									  data-tanggal="' 		. $data_saudarakandung->tanggal_lahir 		. '" 
									  data-status="' 		. $data_saudarakandung->status_perkawinan 	. '"
									  data-pekerjaan="' 	. $data_saudarakandung->pekerjaan 			. '"
									  data-alamat="' 		. $data_saudarakandung->alamat_keluarga 	. '"
									  data-keterangan="' 	. $data_saudarakandung->keterangan_keluarga . '"
									  >' .  $data_saudarakandung->nama . '</a><br>';
					$urut 			= $urut + 1;
				}
				$saudarakandung 	= $jenis . $saudarakandung;
			}

			$data_saudaraipar 		= $this->keluarga_model->cari_saudaraipar( $data->kode );
			$saudaraipar 			= 	'';
			if (count($data_saudaraipar)!==0){
				$urut 				= 	1;
				foreach ($data_saudaraipar as $data_saudaraipar) {
					$jenis 			= '<b>' . $data_saudaraipar->nm_hubungan . '</b><br>';
					$saudaraipar 	= $saudaraipar . $urut  . 
									  '. <a data-toggle="modal" id ="keluarga" href="#modal-tambah" 
									  data-kode="' 			. $data_saudaraipar->kd_keluarga 		. '" 
									  data-nama="' 			. $data_saudaraipar->nama 		. '" 
									  data-ktp="' 			. $data_saudaraipar->ektp_keluarga 		. '" 
									  data-hubungan="' 		. $data_saudaraipar->kd_hubungan 		. '" 
									  data-nikah="' 		. $data_saudaraipar->tanggal_menikah	. '" 
									  data-kelamin="' 		. $data_saudaraipar->jenis_kelamin 		. '" 
									  data-tempat="' 		. $data_saudaraipar->tempat_lahir 		. '" 
									  data-tanggal="' 		. $data_saudaraipar->tanggal_lahir 		. '" 
									  data-status="' 		. $data_saudaraipar->status_perkawinan 	. '"
									  data-pekerjaan="' 	. $data_saudaraipar->pekerjaan 			. '"
									  data-alamat="' 		. $data_saudaraipar->alamat_keluarga 	. '"
									  data-keterangan="' 	. $data_saudaraipar->keterangan_keluarga. '"
									  >' .  $data_saudaraipar->nama . '</a><br>';
					$urut 			= $urut + 1;
				}
				$saudaraipar 		= $jenis . $saudaraipar;
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
					'inti' 			=> 	$pasangan 			. $anak,
					'orangtua'		=> 	$ortu 				. $mertua,
					'saudara'		=> 	$saudarakandung 	. $saudaraipar
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}
	
	public function data_keluarga($kode) {
		$data 					= $this->keluarga_model->cari_semua($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$link_file 			= '';
			$btn_status 		= '';
			$btn_action 		= '';

			if ($data->sts_keluarga=='0') {
	
				$btn_action 		= 	'<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-kd="' 			. $data->kd_keluarga 		. '" 
														data-pegawai="' 	. $data->kd_pegawai 		. '" 
														data-kd_hubungan="' 		. $data->kd_hubungan 	. '"
														data-nama="' 	. $data->nama_keluarga . '"
														data-gelar_depan="' 	. $data->gelar_depan . '"
														data-gelar_belakang="' 	. $data->gelar_belakang . '"
														data-jenis_keluarga="' 	. $data->jenis_keluarga . '"
														data-ektp_keluarga="' 	. $data->ektp_keluarga . '"
														data-jenis_kelamin="' 	. $data->jenis_kelamin . '"
														data-kd_agama="' 	. $data->kd_agama . '"
														data-tempat_lahir="' 	. $data->tempat_lahir . '"
														data-tanggal_lahir="' 		. date('d-m-Y', strtotime($data->tanggal_lahir)) 	. '"
														data-akte_kelahiran="' 	. $data->akte_kelahiran . '"
														data-tanggal_nikah="' 		. date('d-m-Y', strtotime($data->tanggal_nikah)) 	. '"
														data-akte_nikah="' 	. $data->akte_nikah . '"
														data-status_cerai="' 	. $data->status_cerai . '"
														data-tanggal_cerai="' 		. date('d-m-Y', strtotime($data->tanggal_cerai)) 	. '"
														data-akte_cerai="' 	. $data->akte_cerai . '"
														data-status_hidup="' 	. $data->status_hidup . '"
														data-tanggal_meninggal="' 		. date('d-m-Y', strtotime($data->tanggal_meninggal)) 	. '"
														data-akte_meninggal="' 	. $data->akte_meninggal . '"
														data-hp_keluarga="' 	. $data->hp_keluarga . '"
														data-telp_keluarga="' 	. $data->telp_keluarga . '"
														data-email_keluarga="' 	. $data->email_keluarga . '"
														data-pekerjaan_keluarga="' 	. $data->pekerjaan_keluarga . '"
														data-status_perkawinan="' 	. $data->status_perkawinan . '"
														data-alamat_keluarga="' 		. $data->alamat_keluarga 	. '"
														data-keterangan_keluarga="' 		. $data->keterangan_keluarga 	. '"
														data-foto_keluarga="' 	. base_url() . $data->foto_keluarga 		. '"
														><i class="fa fa-edit"></i></button>
								  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-pegawai="' . $data->kd_pegawai 		. '"
														data-kode="' 			. $data->kd_keluarga 		. '" 
														data-nama="' 		. $data->nama_keluarga 	. '"
														><i class="fa fa-trash-o"></i></button>
										</div>';
				$btn_action_user	=	$btn_action;
			} elseif ($data->sts_keluarga=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah" type="button" class="btn btn-success btn-xs" 
											data-pegawai="' . $data->kd_pegawai 		. '"
											data-kode="' 	. $data->kd_keluarga		. '"
											data-nama="' 	. $data->nama_keluarga 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
											data-pegawai="' . $data->kd_pegawai 		. '"
											data-kode="' 	. $data->kd_keluarga		. '"
											data-nama="' 	. $data->nama_keluarga 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-tambah" type="button" class="btn btn-danger btn-xs" 
											data-pegawai="' . $data->kd_pegawai 		. '"
											data-kode="' 	. $data->kd_keluarga		. '"
											data-nama="' 	. $data->nama_keluarga 	. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->sts_keluarga=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit" type="button" class="btn btn-success btn-xs" 
											data-pegawai="' . $data->kd_pegawai 		. '"
											data-kode="' 	. $data->kd_keluarga		. '"
											data-nama="' 	. $data->nama_keluarga 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-edit" type="button" class="btn btn-danger btn-xs" 
											data-pegawai="' . $data->kd_pegawai 		. '"
											data-kode="' 	. $data->kd_keluarga		. '"
											data-nama="' 	. $data->nama_keluarga 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit" type="button" class="btn btn-danger btn-xs" 
											data-pegawai="' . $data->kd_pegawai 		. '"
											data-kode="' 	. $data->kd_keluarga		. '"
											data-nama="' 	. $data->nama_keluarga 	. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->sts_keluarga=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus" type="button" class="btn btn-success btn-xs" 
											data-pegawai="' . $data->kd_pegawai 		. '"
											data-kode="' 	. $data->kd_keluarga		. '"
											data-nama="' 	. $data->nama_keluarga 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-hapus" type="button" class="btn btn-danger btn-xs" 
											data-pegawai="' . $data->kd_pegawai 		. '"
											data-kode="' 	. $data->kd_keluarga		. '"
											data-nama="' 	. $data->nama_keluarga 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus" type="button" class="btn btn-danger btn-xs" 
											data-pegawai="' . $data->kd_pegawai 		. '"
											data-kode="' 	. $data->kd_keluarga		. '"
											data-nama="' 	. $data->nama_keluarga 	. '"
										><i class="fa fa-times"></i>
									</button>';
			}
			if ($data->kd_hubungan=='01' or $data->kd_hubungan=='02') {
				$nikah 			= date('d-m-Y',strtotime($data->tanggal_nikah));
			} else {
				$nikah 			= '~';
			}
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama'			=> '<img src="'. base_url() . 'assets/foto/' . $data->foto_keluarga . '" style="width:70px;"><br>' .
										$data->nama_keluarga,
					'hubungan'		=> $data->nm_hubungan,
					'jk'			=> $data->jenis_kelamin,
					'tempat'		=> $data->tempat_lahir,
					'tanggal'		=> date('d F Y',strtotime($data->tanggal_lahir)),
					'nikah'			=> $nikah,
					'pekerjaan'		=> $data->pekerjaan_keluarga,
					'alamat'		=> $data->alamat_keluarga,
					'status' 		=> $btn_status,
					'action' 		=> $btn_action,
					'action_user'	=> $btn_action_user
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	// public function data_riwayat($kode) {
	// 	$data 					= $this->keluarga_model->cari_semua($kode);
	// 	$hasil 					= array();
	// 	$result 				= array();
	// 	$no 					=1;
	// 	foreach ($data as $data) {
	// 		if ($data->kd_hubungan=='01' or $data->kd_hubungan=='02') {
	// 			$nikah 			= date('d-m-Y',strtotime($data->tanggal_nikah));
	// 		} else {
	// 			$nikah 			= '~';
	// 		}
	// 		$hasil[]			= array(
	// 				'no'			=> $no,
	// 				'nama'			=> '<img src="'. base_url() . 'assets/foto/' . $data->foto_keluarga . '" style="width:70px;"><br>' .
	// 									$data->nama,
	// 				'hubungan'		=> $data->nm_hubungan,
	// 				'jk'			=> $data->jenis_kelamin,
	// 				'tempat'		=> $data->tempat_lahir,
	// 				'tanggal'		=> date('d-m-Y',strtotime($data->tanggal_lahir)),
	// 				'nikah'			=> $nikah,
	// 				'pekerjaan'		=> $data->pekerjaan_keluarga,
	// 				'alamat'		=> $data->alamat_keluarga,
	// 				'action' 		=> '<div class="btn-group">										
	// 										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
	// 											data-pegawai="' . $data->kd_pegawai 	. '"
	// 											><i class="fa fa-edit"></i></button>
	// 							  			<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
	// 											data-kode="' 	. $data->kd_keluarga 	. '" 
	// 											data-nama="' 	. $data->nama 	. '" 
	// 											><i class="fa fa-trash-o"></i></button>
	// 									</div>'
	// 			);
	// 		$no 				= $no + 1;
	// 	}
	// 	$result 				= array (
	// 			'aaData' 			=> $hasil
	// 		);
	// 	echo json_encode($result);
	// }

	public function data_tmp($kode) {
		$data		= $this->keluarga_model->cari_tmp($kode);
		foreach ($data as $didik ) {
			$hubungan 		= $didik->nm_hubungan;
			$nama 		= $didik->nama_keluarga;
			$depan 		= $didik->gelar_depan;
			$belakang 		= $didik->gelar_belakang;
			$jenis 		= $didik->jenis_keluarga;
			$ektp 		= $didik->ektp_keluarga;
			$jk 		= $didik->jenis_kelamin;
			$tempat_l 		= $didik->tempat_lahir;
			$tanggal_l 		= $didik->tgl_lahir;
			$akte_l 		= $didik->akte_kelahiran;
			$tanggal_n 		= $didik->tgl_nikah;
			$akte_n 		= $didik->akte_nikah;
			$status_c 		= $didik->status_cerai;
			$tanggal_c 		= $didik->tgl_cerai;
			$akte_c 		= $didik->akte_cerai;
			$status_h 		= $didik->status_hidup;
			$tanggal_m 		= $didik->tgl_meninggal;
			$akte_m 		= $didik->akte_meninggal;
			$hp 		= $didik->hp_keluarga;
			$telp 		= $didik->telp_keluarga;
			$email 		= $didik->email_keluarga;
			$pekerjaan 		= $didik->pekerjaan_keluarga;
			$status_p 		= $didik->status_perkawinan;
			$alamat 		= $didik->alamat_keluarga;
			$keterangan 		= $didik->keterangan_keluarga;
			$agama 		= $didik->nm_agama;
		}
		$pend2		= $this->keluarga_model->cari_tmp2($kode);

		foreach ($pend2 as $didik2 ) {
			$hubungan2 		= $didik2->nm_hubungan;
			$nama2 		= $didik2->nama_keluarga;
			$depan2 		= $didik2->gelar_depan;
			$belakang2 		= $didik2->gelar_belakang;
			$jenis2 		= $didik2->jenis_keluarga;
			$ektp2 		= $didik2->ektp_keluarga;
			$jk2 		= $didik2->jenis_kelamin;
			$tempat_l2 		= $didik2->tempat_lahir;
			$tanggal_l2 		= $didik2->tgl_lahir;
			$akte_l2 		= $didik2->akte_kelahiran;
			$tanggal_n2 		= $didik2->tgl_nikah;
			$akte_n2 		= $didik2->akte_nikah;
			$status_c2 		= $didik2->status_cerai;
			$tanggal_c2 		= $didik2->tgl_cerai;
			$akte_c2 		= $didik2->akte_cerai;
			$status_h2 		= $didik2->status_hidup;
			$tanggal_m2 		= $didik2->tgl_meninggal;
			$akte_m2 		= $didik2->akte_meninggal;
			$hp2 		= $didik2->hp_keluarga;
			$telp2 		= $didik2->telp_keluarga;
			$email2 		= $didik2->email_keluarga;
			$pekerjaan2 		= $didik2->pekerjaan_keluarga;
			$status_p2 		= $didik2->status_perkawinan;
			$alamat2 		= $didik2->alamat_keluarga;
			$keterangan2 		= $didik2->keterangan_keluarga;
			$agama2 		= $didik2->nm_agama;
		}


		if($hubungan != $hubungan2){
			$data['hubungan'] = 'green';
			$data['a'] 		= $hubungan2;
			$data['a2'] 		= '#ff9900';
		}else{
			$data['hubungan'] = 'black';
			$data['a'] 		= '';
		}

		if($nama != $nama2){
			$data['nama'] = 'green';
			$data['b']		= $nama2;
			$data['b2'] 		= '#ff9900';
		}else{
			$data['nama'] = 'black';
			$data['b'] 		= '';
		}

		if($depan != $depan2){
			$data['depan'] = 'green';
			$data['c'] 		= $depan2;
			$data['c2'] 		= '#ff9900';
		}else{
			$data['depan'] = 'black';
			$data['c'] 		= '';
		}

		if($belakang != $belakang2){
			$data['belakang'] = 'green';
			$data['d'] 		= $belakang2;
			$data['d2'] 		= '#ff9900';
		}else{
			$data['belakang'] = 'black';
			$data['d'] 		= '';
		}

		if($jenis != $jenis2){
			$data['jenis'] = 'green';
			$data['e'] 		= $jenis2;
			$data['e2'] 		= '#ff9900';
		}else{
			$data['jenis'] = 'black';
			$data['e'] 		= '';
		}

		if($ektp != $ektp2){
			$data['ektp'] = 'green';
			$data['f'] 		= $ektp2;
			$data['f2'] 		= '#ff9900';
		}else{
			$data['ektp'] = 'black';
			$data['f'] 		= '';
		}

		if($jk != $jk2){
			$data['jk'] = 'green';
			$data['g'] 		= $jk2;
			$data['g2'] 		= '#ff9900';
		}else{
			$data['jk'] = 'black';
			$data['g'] 		= '';
		}

		if($tempat_l != $tempat_l2){
			$data['tempat_l'] = 'green';
			$data['h'] 		= $tempat_l2;
			$data['h2'] 		= '#ff9900';
		}else{
			$data['tempat_l'] = 'black';
			$data['h'] 		= '';
		}

		if($tanggal_l != $tanggal_l2){
			$data['tanggal_l'] = 'green';
			$data['i'] 		= $tanggal_l2;
			$data['i2'] 		= '#ff9900';
		}else{
			$data['tanggal_l'] = 'black';
			$data['i'] 		= '';
		}

		if($akte_l != $akte_l2){
			$data['akte_l'] = 'green';
			$data['j'] 		= $akte_l2;
			$data['j2'] 		= '#ff9900';
		}else{
			$data['akte_l'] = 'black';
			$data['j'] 		= '';
		}

		if($tanggal_n != $tanggal_n2){
			$data['tanggal_n'] = 'green';
			$data['k'] 		= $tanggal_n2;
			$data['k2'] 		= '#ff9900';
		}else{
			$data['tanggal_n'] = 'black';
			$data['k'] 		= '';
		}

		if($akte_n != $akte_n2){
			$data['akte_n'] = 'green';
			$data['l'] 		= $akte_n2;
			$data['l2'] 		= '#ff9900';
		}else{
			$data['akte_n'] = 'black';
			$data['l'] 		= '';
		}

		if($status_c != $status_c2){
			$data['status_c'] = 'green';
			$data['m'] 		= $status_c2;
			$data['m2'] 		= '#ff9900';
		}else{
			$data['status_c'] = 'black';
			$data['m'] 		= '';
		}

		if($tanggal_c != $tanggal_c2){
			$data['tanggal_c'] = 'green';
			$data['n'] 		= $tanggal_c2;
			$data['n2'] 		= '#ff9900';
		}else{
			$data['tanggal_c'] = 'black';
			$data['n'] 		= '';
		}

		if($akte_c != $akte_c2){
			$data['akte_c'] = 'green';
			$data['o'] 		= $akte_c2;
			$data['o2'] 		= '#ff9900';
		}else{
			$data['akte_c'] = 'black';
			$data['o'] 		= '';
		}

		if($status_h != $status_h2){
			$data['status_h'] = 'green';
			$data['p'] 		= $status_h2;
			$data['p2'] 		= '#ff9900';
		}else{
			$data['status_h'] = 'black';
			$data['p'] 		= '';
		}

		if($tanggal_m != $tanggal_m2){
			$data['tanggal_m'] = 'green';
			$data['q'] 		= $tanggal_m2;
			$data['q2'] 		= '#ff9900';
		}else{
			$data['tanggal_m'] = 'black';
			$data['q'] 		= '';
		}

		if($akte_m != $akte_m2){
			$data['akte_m'] = 'green';
			$data['r'] 		= $akte_m2;
			$data['r2'] 		= '#ff9900';
		}else{
			$data['akte_m'] = 'black';
			$data['r'] 		= '';
		}

		if($hp != $hp2){
			$data['hp'] = 'green';
			$data['s'] 		= $hp2;
			$data['s2'] 		= '#ff9900';
		}else{
			$data['hp'] = 'black';
			$data['s'] 		= '';
		}

		if($telp != $telp2){
			$data['telp'] = 'green';
			$data['t'] 		= $telp2;
			$data['t2'] 		= '#ff9900';
		}else{
			$data['telp'] = 'black';
			$data['t'] 		= '';
		}

		if($email != $email2){
			$data['email'] = 'green';
			$data['u'] 		= $email2;
			$data['u2'] 		= '#ff9900';
		}else{
			$data['email'] = 'black';
			$data['u'] 		= '';
		}

		if($pekerjaan != $pekerjaan2){
			$data['pekerjaan'] = 'green';
			$data['v'] 		= $pekerjaan2;
			$data['v2'] 		= '#ff9900';
		}else{
			$data['pekerjaan'] = 'black';
			$data['v'] 		= '';
		}

		if($status_p != $status_p2){
			$data['status_p'] = 'green';
			$data['w'] 		= $status_p2;
			$data['w2'] 		= '#ff9900';
		}else{
			$data['status_p'] = 'black';
			$data['w'] 		= '';
		}

		if($alamat != $alamat2){
			$data['alamat'] = 'green';
			$data['x'] 		= $alamat2;
			$data['x2'] 		= '#ff9900';
		}else{
			$data['alamat'] = 'black';
			$data['x'] 		= '';
		}

		if($keterangan != $keterangan2){
			$data['keterangan'] = 'green';
			$data['y'] 		= $keterangan2;
			$data['y2'] 		= '#ff9900';
		}else{
			$data['keterangan'] = 'black';
			$data['y'] 		= '';
		}

		if($agama != $agama2){
			$data['agama'] = 'green';
			$data['z'] 		= $agama2;
			$data['z2'] 		= '#ff9900';
		}else{
			$data['agama'] = 'black';
			$data['z'] 		= '';
		}

		// if (count($data)>0){
			echo json_encode($data);
		// } else {
		// 	echo json_encode('false');
		// }
	}
 
	public function tambah() {
		$msg		= false;
		$kode		= $this->keluarga_model->buat_kode();		
		$simpan 	= $this->keluarga_model->tambah(
						$kode,
						$_POST['id_pegawai'],
						$_POST['hubungan'],
						$_POST['nama'],
						$_POST['gelar_depan'],
						$_POST['gelar_belakang'],
						$_POST['jenis_dokumen'],
						$_POST['nomor_dokumen'],
						$_POST['jenis_kelamin'],
						$_POST['agama'],
						$_POST['tempat_lahir'],
						tgl_sql($_POST['tanggal_lahir']),
						$_POST['akte_lahir'],
						tgl_sql($_POST['tanggal_nikah']),
						$_POST['akte_nikah'],
						$_POST['status_cerai'],
						tgl_sql($_POST['tanggal_cerai']),
						$_POST['akte_cerai'],
						$_POST['status_hidup'],
						tgl_sql($_POST['tanggal_meninggal']),
						$_POST['akte_meninggal'],
						$_POST['handphone'],
						$_POST['telepon'],
						$_POST['email'],
						$_POST['pekerjaan'],
						$_POST['status_perkawinan'],
						$_POST['alamat'],
						$_POST['keterangan'],
						'0'
					);
		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/foto/';
		$config['allowed_types']		= 'jpg|png';
		$config['max_size']				= 10000;
		
		$this->load->library('upload', $config);
		if ($_FILES['foto_keluarga']['name']!=='') {
			if ($this->upload->do_upload('foto_keluarga')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_keluarga 
									SET foto_keluarga='$nama_foto' 
									WHERE kd_keluarga='$kode';"
								); 
			}
		}	
		if ($simpan) {
			$msg	= true;
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
				'Tambah Data',
				date('Y-m-d H:i:s'),
				'#',
				'Tambah Data Keluarga',
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
	
	public function tambah_user() {
		$kode							= $this->keluarga_model->buat_kode();
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/foto/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->keluarga_model->tambah(
							$kode,
							$_POST['id_pegawai'],
							$_POST['hubungan'],
							$_POST['nama'],
							$_POST['gelar_depan'],
							$_POST['gelar_belakang'],
							$_POST['jenis_dokumen'],
							$_POST['nomor_dokumen'],
							$_POST['jenis_kelamin'],
							$_POST['agama'],
							$_POST['tempat_lahir'],
							tgl_sql($_POST['tanggal_lahir']),
							$_POST['akte_lahir'],
							tgl_sql($_POST['tanggal_nikah']),
							$_POST['akte_nikah'],
							$_POST['status_cerai'],
							tgl_sql($_POST['tanggal_cerai']),
							$_POST['akte_cerai'],
							$_POST['status_hidup'],
							tgl_sql($_POST['tanggal_meninggal']),
							$_POST['akte_meninggal'],
							$_POST['handphone'],
							$_POST['telepon'],
							$_POST['email'],
							$_POST['pekerjaan'],
							$_POST['status_perkawinan'],
							$_POST['alamat'],
							$_POST['keterangan'],
							'2'
						);
				
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['foto_keluarga']['name'])) {

				} else {
					$upload 		= $this->upload->do_upload('foto_keluarga');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE t_keluarga SET 
									  foto_keluarga='$nama_upload' 
									  WHERE kd_keluarga='$kode';");
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
				'Pengajuan Tambah Data',
				date('Y-m-d H:i:s'),
				'#',
				'Pengajuan Tambah Data Keluarga',
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

	public function edit() {
		$kode 		= $_POST['kode'];
		$msg			= false;
		$simpan 	= $this->keluarga_model->edit(
						$_POST['kode'],
						$_POST['id_pegawai'],
						$_POST['hubungan'],
						$_POST['nama'],
						$_POST['gelar_depan'],
						$_POST['gelar_belakang'],
						$_POST['jenis_dokumen'],
						$_POST['nomor_dokumen'],
						$_POST['jenis_kelamin'],
						$_POST['agama'],
						$_POST['tempat_lahir'],
						tgl_sql($_POST['tanggal_lahir']),
						$_POST['akte_lahir'],
						tgl_sql($_POST['tanggal_nikah']),
						$_POST['akte_nikah'],
						$_POST['status_cerai'],
						tgl_sql($_POST['tanggal_cerai']),
						$_POST['akte_cerai'],
						$_POST['status_hidup'],
						tgl_sql($_POST['tanggal_meninggal']),
						$_POST['akte_meninggal'],
						$_POST['handphone'],
						$_POST['telepon'],
						$_POST['email'],
						$_POST['pekerjaan'],
						$_POST['status_perkawinan'],
						$_POST['alamat'],
						$_POST['keterangan']
					);
			
		if ($simpan) {
			$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
			$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

			$msg							= false;
			$config['upload_path']			= './assets/foto/';
			$config['allowed_types']		= 'jpg|png|pdf';
			$config['max_size']				= 10000;

			$this->load->library('upload', $config);
			if (!empty($_FILES['foto_keluarga']['name'])) {
				if ($this->upload->do_upload('foto_keluarga')) {
					$upload_foto 	= $this->upload->data();
					$nama_foto 		= $upload_foto['file_name'];
					$update_foto 	= $this->db->query(
										"UPDATE t_keluarga SET 
								  		foto_keluarga='$nama_foto' 
								  		WHERE kd_keluarga='$kode';"
										); 
				}
			}
			$msg	= true;
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
				'Edit Data',
				date('Y-m-d H:i:s'),
				'#',
				'Edit Data Keluarga',
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
	
	public function edit_user() {
		$tmp 							= $this->keluarga_model->buat_kode_tmp();
		$kode 							= $_POST['kode'];
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/foto/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->keluarga_model->tambah_tmp(
							$tmp,
							$_POST['kode'],
							$_POST['id_pegawai'],
							$_POST['hubungan'],
							$_POST['nama'],
							$_POST['gelar_depan'],
							$_POST['gelar_belakang'],
							$_POST['jenis_dokumen'],
							$_POST['nomor_dokumen'],
							$_POST['jenis_kelamin'],
							$_POST['agama'],
							$_POST['tempat_lahir'],
							tgl_sql($_POST['tanggal_lahir']),
							$_POST['akte_lahir'],
							tgl_sql($_POST['tanggal_nikah']),
							$_POST['akte_nikah'],
							$_POST['status_cerai'],
							tgl_sql($_POST['tanggal_cerai']),
							$_POST['akte_cerai'],
							$_POST['status_hidup'],
							tgl_sql($_POST['tanggal_meninggal']),
							$_POST['akte_meninggal'],
							$_POST['handphone'],
							$_POST['telepon'],
							$_POST['email'],
							$_POST['pekerjaan'],
							$_POST['status_perkawinan'],
							$_POST['alamat'],
							$_POST['keterangan'],
							'0'
						);
			$simpan 	=	$this->db->query(
								"UPDATE t_keluarga 
								SET sts_keluarga='3'
								WHERE kd_keluarga='$kode';"
							);
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['foto_keluarga']['name'])) {
					$simpan 	=	$this->db->query(
								"UPDATE tmp_keluarga A RIGHT JOIN t_keluarga B 
								ON A.kd_keluarga=B.kd_keluarga 
								SET A.foto_keluarga=B.foto_keluarga
								WHERE A.id_tmp='$tmp';"
							);

				} else {
					$upload 		= $this->upload->do_upload('foto_keluarga');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE tmp_keluarga SET 
									  foto_keluarga='$nama_upload' 
									  WHERE id_tmp='$tmp';");
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
				'Pengajuan Edit Data Keluarga',
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
		$hapus 				= $this->keluarga_model->hapus($kode);
		$msg['success'] 	= false;
		if ($hapus) {
			$msg['success'] = true;
		}

		//-- Start Notice --//
		// if ($this->session->userdata('akses_pegawai_siskap')=='Admin'){
		// 	if ($_POST['id_pegawai']==$this->session->userdata('kode_pegawai_siskap')){
		// 		$user_read	= 1;
		// 	} else {
		// 		$user_read 	= 0;
		// 	}
		// 	$admin_read = 1;
		// } else {
		// 	$user_read 	= 1;
		// 	$admin_read = 0;
		// }
		// $input_notice 	= $this->notice_model->tambah(
		// 		$this->notice_model->buat_id(),
		// 		$_POST['id_pegawai'],
		// 		'Hapus Data',
		// 		date('Y-m-d H:i:s'),
		// 		'#',
		// 		'Hapus Data Keluarga',
		// 		$user_read,
		// 		$admin_read,
		// 		'0',
		// 		$this->session->userdata('kode_pegawai_siskap'),
		// 		date('Y-m-d H:i:s'),
		// 		$_SERVER['REMOTE_ADDR']
		// );
		//-- End Notice --//

		echo json_encode($msg);
	}

	public function terima_tambah($kode, $pegawai) {
		$msg		= false;
		$edit 		= $this->db->query(
						"UPDATE t_keluarga SET sts_keluarga='0' 
						WHERE kd_keluarga='$kode';"
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
				'Terima Pengajuan Tambah',
				date('Y-m-d H:i:s'),
				'#',
				'Terima Pengajuan Tambah Data Keluarga',
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

	public function tolak_tambah($kode, $pegawai) {
		$msg		= false;
		$edit 		= $this->db->query(
						"UPDATE t_keluarga SET sts_keluarga='1' 
						WHERE kd_keluarga='$kode';"
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
				'Tolak Pengajuan Tambah',
				date('Y-m-d H:i:s'),
				'#',
				'Tolak Pengajuan Tambah Data Keluarga',
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

	public function terima_edit() {
		$kode 		= $_POST['kode'];
		$pegawai 	= $_POST['id_pegawai'];
		$msg		= false;
		$edit 		= $this->keluarga_model->terima_edit(
						$kode,
						$pegawai
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
				'Terima Pengajuan Edit Data Keluarga',
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

	public function tolak_edit($kode, $pegawai) {
		$msg		= false;
		$edit 		= $this->db->query(
						"UPDATE t_keluarga SET sts_keluarga='0' 
						WHERE kd_keluarga='$kode';"
		);
		$edit 		= $this->db->query(
						"UPDATE tmp_keluarga SET sts_keluarga='1' 
						WHERE kd_keluarga='$kode';"
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
				'Tolak Pengajuan Edit Data Keluarga',
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

	public function terima_hapus($kode, $pegawai) {
		$msg		= false;
		$edit 		= $this->db->query(
						"UPDATE t_keluarga SET sts_keluarga='1' 
						WHERE kd_keluarga='$kode';"
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
				'Terima Pengajuan Hapus',
				date('Y-m-d H:i:s'),
				'#',
				'Terima Pengajuan Hapus Data Keluarga',
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

	public function tolak_hapus($kode, $pegawai) {
		$msg		= false;
		$edit 		= $this->db->query(
						"UPDATE t_keluarga SET sts_keluarga='0' 
						WHERE kd_keluarga='$kode';"
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
				'Tolak Pengajuan Hapus',
				date('Y-m-d H:i:s'),
				'#',
				'Tolak Pengajuan Hapus Data Keluarga',
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

	public function hapus_user( $kode, $pegawai ) {
		$hapus 				= $this->db->query(
								"UPDATE t_keluarga 
								SET sts_keluarga='4'
								WHERE kd_keluarga='$kode';"
							);
		$msg				= false;
		if ($hapus) {
			$msg 			= true;
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
				'Pengajuan Hapus Data',
				date('Y-m-d H:i:s'),
				'#',
				'Pengajuan Hapus Data Keluarga',
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
}
