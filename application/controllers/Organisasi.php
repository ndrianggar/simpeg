<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organisasi extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('organisasi_model');
		$this->load->model('notice_model');
	}

	public function index() {
	
	}

	public function data($kode) {
		$data 					= $this->organisasi_model->cari_pegawai($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$link_file 			= '';
			$btn_status 		= '';
			$btn_action 		= '';

			if ($data->file_organisasi=='') {
				$link_file		= $data->nama_organisasi;
			} else {
				$link_file		= '<a href="' 			. base_url() 				. 
								  'assets/pdf/' 		. $data->file_organisasi 	. 
								  '" target="_Blank" style="color:blue;" 
								  data-toggle="tooltip" data-placement="left" 
								  title="Klik untuk melihat File"><b>' 	
								  . $data->nama_organisasi 	.  '</b></a>';
			}

			if ($data->file_organisasi=='') {
				$btn_file		= '';
			} else {
				$btn_file		=  base_url() . 'assets/pdf/' . $data->file_organisasi ;
			}

			if ($data->status_organisasi=='0') {
	
				$btn_action 		= 	'<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-kd="' 			. $data->kd_organisasi 		. '" 
														data-pegawai="' 	. $data->id_pegawai 		. '" 
														data-nama="' 		. $data->nama_organisasi 	. '"
														data-jabatan="' 	. $data->jabatan_organisasi . '"
														data-awal="' 		. date('d-m-Y', strtotime($data->awal_organisasi)) 	. '"
														data-akhir="' 		. date('d-m-Y', strtotime($data->akhir_organisasi)) 	. '"
														data-tempat="' 		. $data->tempat_organisasi 	. '"
														data-ketua="' 		. $data->ketua_organisasi 	. '"
														data-file="' 	. base_url() . $data->file_organisasi 		. '"
														data-btn_file="' 	. $btn_file 	. '"
														><i class="fa fa-edit"></i></button>
								  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-pegawai="' . $data->id_pegawai 		. '"
														data-kode="' 			. $data->kd_organisasi 		. '" 
														data-nama="' 		. $data->nama_organisasi 	. '"
														><i class="fa fa-trash-o"></i></button>
										</div>';
				$btn_action_user	=	$btn_action;
			} elseif ($data->status_organisasi=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah" type="button" class="btn btn-success btn-xs" 
											data-pegawai="' . $data->id_pegawai 		. '"
											data-kode="' 	. $data->kd_organisasi		. '"
											data-nama="' 	. $data->nama_organisasi 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_organisasi 		. '" 
											data-pegawai="' . $data->id_pegawai 		. '" 
											data-nama="' 	. $data->nama_organisasi 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-tambah" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 	. $data->kd_organisasi 		. '" 
										data-pegawai="' . $data->id_pegawai 		. '" 
										data-nama="' 	. $data->nama_organisasi 	. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->status_organisasi=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit" type="button" class="btn btn-success btn-xs" 
											data-pegawai="' . $data->id_pegawai 		. '"
											data-kode="' 	. $data->kd_organisasi		. '"
											data-nama="' 	. $data->nama_organisasi 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-edit" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_organisasi 		. '" 
											data-pegawai="' . $data->id_pegawai 		. '" 
											data-nama="' 	. $data->nama_organisasi 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 	. $data->kd_organisasi 		. '" 
										data-pegawai="' . $data->id_pegawai 		. '" 
										data-nama="' 	. $data->nama_organisasi 	. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->status_organisasi=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus" type="button" class="btn btn-success btn-xs" 
											data-pegawai="' . $data->id_pegawai 		. '"
											data-kode="' 	. $data->kd_organisasi		. '"
											data-nama="' 	. $data->nama_organisasi 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-hapus" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_organisasi 		. '" 
											data-pegawai="' . $data->id_pegawai 		. '" 
											data-nama="' 	. $data->nama_organisasi 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 	. $data->kd_organisasi 		. '" 
										data-pegawai="' . $data->id_pegawai 		. '" 
										data-nama="' 	. $data->nama_organisasi 	. '"
										><i class="fa fa-times"></i>
									</button>';
			}
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama'			=> $link_file,
					'jabatan'		=> $data->jabatan_organisasi,
					'lama'			=> date('d F Y', strtotime($data->awal_organisasi)) ."  s/d  ". date('d F Y', strtotime($data->akhir_organisasi)) ,
					'tempat'		=> $data->tempat_organisasi,
					'ketua'			=> $data->ketua_organisasi,
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
	// 	$data 					= $this->organisasi_model->cari_pegawai($kode);
	// 	$hasil 					= array();
	// 	$result 				= array();
	// 	$no 					=1;
	// 	foreach ($data as $data) {
	// 		$hasil[]			= array(
	// 				'no'			=> $no,
	// 				'nama'			=> $data->nama_organisasi,
	// 				'jabatan'		=> $data->jabatan_organisasi,
	// 				'lama'			=> $data->awal_organisasi ."  s/d  ". $data->akhir_organisasi,
	// 				'tempat'		=> $data->tempat_organisasi,
	// 				'ketua'			=> $data->ketua_organisasi,
	// 				'action' 		=> '<div class="btn-group">
	// 									<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
	// 													data-kd="' 			. $data->kd_organisasi 		. '" 
	// 													data-pegawai="' 	. $data->id_pegawai 		. '" 
	// 													data-nama="' 		. $data->nama_organisasi 	. '"
	// 													data-jabatan="' 	. $data->jabatan_organisasi . '"
	// 													data-awal="' 		. $data->awal_organisasi 	. '"
	// 													data-akhir="' 		. $data->akhir_organisasi 	. '"
	// 													data-tempat="' 		. $data->tempat_organisasi 	. '"
	// 													data-ketua="' 		. $data->ketua_organisasi 	. '"
	// 													><i class="fa fa-edit"></i></button>
	// 							  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
	// 													data-kd="' 			. $data->kd_organisasi 		. '" 
	// 													data-nama="' 		. $data->nama_organisasi 	. '"
	// 													><i class="fa fa-trash-o"></i></button>
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
		$data		= $this->organisasi_model->cari_tmp($kode);
		foreach ($data as $didik ) {
			$nama 		= $didik->nama_organisasi;
			$jabatan 		= $didik->jabatan_organisasi;
			$awal 		= $didik->awal;
			$akhir 		= $didik->akhir;
			$tempat 		= $didik->tempat_organisasi;
			$ketua 		= $didik->ketua_organisasi;
		}
		$pend2		= $this->organisasi_model->cari_tmp2($kode);

		foreach ($pend2 as $didik2 ) {
			$nama2 		= $didik2->nama_organisasi;
			$jabatan2 		= $didik2->jabatan_organisasi;
			$awal2 		= $didik2->awal;
			$akhir2 		= $didik2->akhir;
			$tempat2 		= $didik2->tempat_organisasi;
			$ketua2 		= $didik2->ketua_organisasi;
		}



		if($nama != $nama2){
			$data['nama'] = 'green';
			$data['a'] 		= $nama2;
			$data['a2'] 		= '#ff9900';
		}else{
			$data['nama'] = 'black';
			$data['a'] 		= '';
		}

		if($jabatan != $jabatan2){
			$data['jabatan'] = 'green';
			$data['b'] 		= $jabatan2;
			$data['b2'] 		= '#ff9900';
		}else{
			$data['jabatan'] = 'black';
			$data['b'] 		= '';
		}

		if($awal != $awal2){
			$data['awala'] = 'green';
			$data['c'] 		= $awal2;
			$data['c2'] 		= '#ff9900';
		}else{
			$data['awala'] = 'black';
			$data['c'] 		= '';
		}

		if($akhir != $akhir2){
			$data['akhira'] = 'green';
			$data['d'] 		= $akhir2;
			$data['d2'] 		= '#ff9900';
		}else{
			$data['akhira'] = 'black';
			$data['d'] 		= '';
		}

		if($tempat != $tempat2){
			$data['tempat'] = 'green';
			$data['e'] 		= $tempat2;
			$data['e2'] 		= '#ff9900';
		}else{
			$data['tempat'] = 'black';
			$data['e'] 		= '';
		}

		if($ketua != $ketua2){
			$data['ketua'] = 'green';
			$data['f'] 		= $ketua2;
			$data['f2'] 		= '#ff9900';
		}else{
			$data['ketua'] = 'black';
			$data['f'] 		= '';
		}
		// if (count($data)>0){
			echo json_encode($data);
		// } else {
		// 	echo json_encode('false');
		// }
	}


	public function tambah() {
		$kode		= $this->organisasi_model->buat_kode();
		$simpan 	= $this->organisasi_model->tambah(
						$kode,
						$_POST['id_pegawai'],
						$_POST['nama_organisasi'],
						$_POST['jabatan_organisasi'],
						tgl_sql($_POST['awal_organisasi']),
						tgl_sql($_POST['akhir_organisasi']),
						$_POST['tempat_organisasi'],
						$_POST['ketua_organisasi'],
						'0'
					);
				
		if ($simpan) {
			$msg	= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
			
		$this->load->library('upload', $config);
		if (!empty($_FILES['file_organisasi']['name'])) {
			if ($this->upload->do_upload('file_organisasi')) {
				$upload_file 	= $this->upload->data();
				$nama_file 		= $upload_file['file_name'];
				$update_file 	= $this->db->query(
									"UPDATE t_organisasi 
									SET file_organisasi='$nama_file' 
									WHERE kd_organisasi='$kode';"
									); 
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
				'Tambah Data',
				date('Y-m-d H:i:s'),
				'#',
				'Tambah Data Organisasi',
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
		$kode							= $this->organisasi_model->buat_kode();
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_organisasi'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->organisasi_model->tambah(
							$kode,
							$_POST['id_pegawai'],
							$_POST['nama_organisasi'],
							$_POST['jabatan_organisasi'],
							tgl_sql($_POST['awal_organisasi']),
							tgl_sql($_POST['akhir_organisasi']),
							$_POST['tempat_organisasi'],
							$_POST['ketua_organisasi'],
							'2'
						);
				
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['file_organisasi']['name'])) {

				} else {
					$upload 		= $this->upload->do_upload('file_organisasi');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE t_organisasi SET 
									  file_organisasi='$nama_upload' 
									  WHERE kd_organisasi='$kode';");
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
				'Pengajuan Tambah Data Organisasi',
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

	public function edit(){
		$kode 		= $_POST['kd_organisasi'];
		$simpan 	= $this->organisasi_model->edit1(
						$kode,
						$_POST['id_pegawai'],
						$_POST['nama_organisasi'],
						$_POST['jabatan_organisasi'],
						tgl_sql($_POST['awal_organisasi']),
						tgl_sql($_POST['akhir_organisasi']),
						$_POST['tempat_organisasi'],
						$_POST['ketua_organisasi']
					);
				
		if ($simpan) {
			$msg	= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
			
		$this->load->library('upload', $config);
		if (!empty($_FILES['file_organisasi']['name'])) {
			if ($this->upload->do_upload('file_organisasi')) {
				$upload_file 	= $this->upload->data();
				$nama_file 		= $upload_file['file_name'];
				$update_file 	= $this->db->query(
									"UPDATE t_organisasi
									SET file_organisasi='$nama_file' 
									WHERE kd_organisasi='$kode';"
									); 
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
				'Edit Data',
				date('Y-m-d H:i:s'),
				'#',
				'Edit Data Organisasi',
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
		$tmp 							= $this->organisasi_model->buat_kode_tmp();
		$kode 							= $_POST['kd_organisasi'];
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_organisasi'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->organisasi_model->tambah_tmp(
							$tmp,
							$kode,
							$_POST['id_pegawai'],
							$_POST['nama_organisasi'],
							$_POST['jabatan_organisasi'],
							tgl_sql($_POST['awal_organisasi']),
							tgl_sql($_POST['akhir_organisasi']),
							$_POST['tempat_organisasi'],
							$_POST['ketua_organisasi'],
							'0'
						);
			$simpan 	=	$this->db->query(
								"UPDATE t_organisasi 
								SET status_organisasi='3'
								WHERE kd_organisasi='$kode';"
							);
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['file_organisasi']['name'])) {
					$simpan 	=	$this->db->query(
								"UPDATE tmp_organisasi A RIGHT JOIN t_organisasi B 
								ON A.kd_organisasi=B.kd_organisasi 
								SET A.file_organisasi=B.file_organisasi
								WHERE A.id_tmp='$tmp';"
							);

				} else {
					$upload 		= $this->upload->do_upload('file_organisasi');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE tmp_organisasi SET 
									  file_organisasi='$nama_upload' 
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
				'Pengajuan Edit Data Organisasi',
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
		$hapus 				= $this->organisasi_model->hapus($kode);
		$msg 	= false;
		if ($hapus) {
			$msg = true;
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
		// 		'Hapus Data Organisasi',
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
						"UPDATE t_organisasi SET status_organisasi='0' 
						WHERE kd_organisasi='$kode';"
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
				'Terima Pengajuan Tambah Data Organisasi',
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
						"UPDATE t_organisasi SET status_organisasi='1' 
						WHERE kd_organisasi='$kode';"
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
				'Tolak Pengajuan Tambah Data Organisasi',
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
		$kode 		= $_POST['kd_organisasi'];
		$pegawai 	= $_POST['id_pegawai'];
		$msg		= false;
		$edit 		= $this->organisasi_model->terima_edit(
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
				'Terima Pengajuan Edit Data Organisasi',
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
						"UPDATE t_organisasi SET status_organisasi='0' 
						WHERE kd_organisasi='$kode';"
		);
		$edit 		= $this->db->query(
						"UPDATE tmp_organisasi SET status_organisasi='1' 
						WHERE kd_organisasi='$kode';"
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
				'Tolak Pengajuan Edit Data Organisasi',
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
						"UPDATE t_organisasi SET status_organisasi='1' 
						WHERE kd_organisasi='$kode';"
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
				'Terima Pengajuan Hapus Data Organisasi',
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
						"UPDATE t_organisasi SET status_organisasi='0' 
						WHERE kd_organisasi='$kode';"
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
				'Tolak Pengajuan Hapus Data Organisasi',
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
								"UPDATE t_organisasi 
								SET status_organisasi='4'
								WHERE kd_organisasi='$kode';"
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
				'Pengajuan Hapus Data Organisasi',
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
