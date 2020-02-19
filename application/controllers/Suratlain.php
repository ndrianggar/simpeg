<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suratlain extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('suratlain_model');
		$this->load->model('notice_model');
	}

	public function data($kode) {
		$data 					= $this->suratlain_model->cari_pegawai($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$link_file 			= '';
			$btn_status 		= '';
			$btn_action 		= '';

			if ($data->file_surat_lain=='') {
				$link_file		= $data->nama_surat_lain;
			} else {
				$link_file		= '<a href="' 			. base_url() 				. 
								  'assets/pdf/' 		. $data->file_surat_lain 	. 
								  '" target="_Blank" style="color:blue;" 
								  data-toggle="tooltip" data-placement="left" 
								  title="Klik untuk melihat File"><b>' 	
								  . $data->nama_surat_lain 	.  '</b></a>';
			}

			if ($data->file_surat_lain=='') {
				$btn_file		= '';
			} else {
				$btn_file		=  base_url() . 'assets/pdf/' . $data->file_surat_lain ;
			}

			if ($data->status_surat_lain=='0') {
	
				$btn_action 		= 	'<div class="btn-group">
											<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-kd="' 			. $data->id_surat_lain 			. '" 
														data-pegawai="' 	. $data->id_pegawai 			. '" 
														data-nama="' 		. $data->nama_surat_lain 		. '"
														data-tanggal="' 	. date('d-m-Y', strtotime($data->tanggal_surat_lain))	. '"
														data-tempat="' 		. $data->tempat_surat_lain 		. '"
														data-keterangan="' 	. $data->keterangan_surat_lain 	. '"
														data-btn_file="' 	. $btn_file 	. '"
														><i class="fa fa-edit"></i></button>
								  			<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-pegawai="' . $data->id_pegawai 		. '"
														data-kode="' 	. $data->id_surat_lain		. '"
														data-nama="' 	. $data->nama_surat_lain 	. '"
														><i class="fa fa-trash-o"></i></button>
										</div>';
				$btn_action_user	=	$btn_action;
			} elseif ($data->status_surat_lain=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah" type="button" class="btn btn-success btn-xs" 
											data-pegawai="' . $data->id_pegawai 		. '"
											data-kode="' 	. $data->id_surat_lain		. '"
											data-nama="' 	. $data->nama_surat_lain 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->id_surat_lain 		. '" 
											data-pegawai="' . $data->id_pegawai 		. '" 
											data-nama="' 	. $data->nama_surat_lain 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-tambah" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 	. $data->id_surat_lain 		. '" 
										data-pegawai="' . $data->id_pegawai 		. '" 
										data-nama="' 	. $data->nama_surat_lain 	. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->status_surat_lain=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit" type="button" class="btn btn-success btn-xs" 
											data-pegawai="' . $data->id_pegawai 		. '"
											data-kode="' 	. $data->id_surat_lain		. '"
											data-nama="' 	. $data->nama_surat_lain 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-edit" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->id_surat_lain 		. '" 
											data-pegawai="' . $data->id_pegawai 		. '" 
											data-nama="' 	. $data->nama_surat_lain 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 	. $data->id_surat_lain 		. '" 
										data-pegawai="' . $data->id_pegawai 		. '" 
										data-nama="' 	. $data->nama_surat_lain 	. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->status_surat_lain=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus" type="button" class="btn btn-success btn-xs" 
											data-pegawai="' . $data->id_pegawai 		. '"
											data-kode="' 	. $data->id_surat_lain		. '"
											data-nama="' 	. $data->nama_surat_lain 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-hapus" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->id_surat_lain 		. '" 
											data-pegawai="' . $data->id_pegawai 		. '" 
											data-nama="' 	. $data->nama_surat_lain 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 	. $data->id_surat_lain 		. '" 
										data-pegawai="' . $data->id_pegawai 		. '" 
										data-nama="' 	. $data->nama_surat_lain 	. '"
										><i class="fa fa-times"></i>
									</button>';
			}
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama'			=> $link_file,
					'tanggal'		=> date('d F Y', strtotime($data->tanggal_surat_lain)),
					'tempat'		=> $data->tempat_surat_lain,
					'keterangan'	=> $data->keterangan_surat_lain,
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

	// public function data_riwayat($id) {
	// 	$data 					= $this->suratlain_model->cari_pegawai($id);
	// 	$hasil 					= array();
	// 	$result 				= array();
	// 	$no 					=1;
	// 	foreach ($data as $data) {
	// 		$hasil[]			= array(
	// 				'no'			=> $no,
	// 				'nama'			=> $data->nama_surat_lain,
	// 				'tanggal'		=> $data->tanggal_surat_lain,
	// 				'tempat'		=> $data->tempat_surat_lain,
	// 				'keterangan'	=> $data->keterangan_surat_lain,
	// 				'action' 		=> '<div class="btn-group">
	// 										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
	// 													data-id="' 			. $data->id_surat_lain 			. '" 
	// 													data-pegawai="' 	. $data->id_pegawai 			. '" 
	// 													data-nama="' 		. $data->nama_surat_lain 		. '"
	// 													data-tanggal="' 	. $data->tanggal_surat_lain		. '"
	// 													data-tempat="' 		. $data->tempat_surat_lain 		. '"
	// 													data-keterangan="' 	. $data->keterangan_surat_lain 	. '"
	// 													><i class="fa fa-edit"></i></button>
	// 							  			<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
	// 													data-id="' 			. $data->id_surat_lain 			. '" 
	// 													data-nama="' 		. $data->nama_surat_lain 		. '"
	// 													><i class="fa fa-trash-o"></i></button>
	// 							  			<button id="btn-pdf" type="button" class="btn btn-success btn-xs" 
	// 													data-id="' 			. $data->id_surat_lain 			. '" 
	// 													data-pdf="' 		. $data->file_surat_lain 		. '"
	// 													><i class="fa fa-file-pdf-o"></i></button>
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
		$data		= $this->suratlain_model->cari_tmp($kode);
		foreach ($data as $didik ) {
			$nama 		= $didik->nama_surat_lain;
			$tanggal 		= $didik->tgl_surat_lain;
			$tempat 		= $didik->tempat_surat_lain;
			$keterangan 		= $didik->keterangan_surat_lain;
		}
		$pend2		= $this->suratlain_model->cari_tmp2($kode);

		foreach ($pend2 as $didik2 ) {
			$nama2 		= $didik2->nama_surat_lain;
			$tanggal2 		= $didik2->tgl_surat_lain;
			$tempat2 		= $didik2->tempat_surat_lain;
			$keterangan2 		= $didik2->keterangan_surat_lain;
		}



		if($nama != $nama2){
			$data['nama'] = 'green';
			$data['a'] 		= $nama2;
			$data['a2'] 		= '#ff9900';
		}else{
			$data['nama'] = 'black';
			$data['a'] 		= '';
		}

		if($tanggal != $tanggal2){
			$data['tanggal'] = 'green';
			$data['b'] 		= $tanggal2;
			$data['b2'] 		= '#ff9900';
		}else{
			$data['tanggal'] = 'black';
			$data['b'] 		= '';
		}

		if($tempat != $tempat2){
			$data['tempat'] = 'green';
			$data['c'] 		= $tempat2;
			$data['c2'] 		= '#ff9900';
		}else{
			$data['tempat'] = 'black';
			$data['c'] 		= '';
		}

		if($keterangan != $keterangan2){
			$data['keterangan'] = 'green';
			$data['d'] 		= $keterangan2;
			$data['d2'] 		= '#ff9900';
		}else{
			$data['keterangan'] = 'black';
			$data['d'] 		= '';
		}
		// if (count($data)>0){
			echo json_encode($data);
		// } else {
		// 	echo json_encode('false');
		// }
	}

	public function tambah() {
		$msg 		= false;
		$id			= $this->suratlain_model->buat_id();
		$simpan 	= $this->suratlain_model->tambah(
						$id,
						$_POST['id_pegawai'],
						$_POST['nama_suratlain'],
						tgl_sql($_POST['tanggal_suratlain']),
						$_POST['tempat_suratlain'],
						$_POST['keterangan_suratlain'],
						'0'
					);
			
		if ($simpan) {
			$msg	= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
		$nmfile 						= $id . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya
		
		$this->load->library('upload', $config);
		if (!empty($_FILES['file_suratlain']['name'])) {
			if ($this->upload->do_upload('file_suratlain')) {
				$upload_file 	= $this->upload->data();
				$nama_file 		= $upload_file['file_name'];
				$update_file 	= $this->db->query(
									"UPDATE t_surat_lain 
									SET file_surat_lain='$nama_file' 
									WHERE id_surat_lain='$id';"
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
				'Tambah Data Surat Lain-Lain',
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
		$kode							= $this->suratlain_model->buat_id();
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_suratlain'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->suratlain_model->tambah(
							$kode,
							$_POST['id_pegawai'],
							$_POST['nama_suratlain'],
							tgl_sql($_POST['tanggal_suratlain']),
							$_POST['tempat_suratlain'],
							$_POST['keterangan_suratlain'],
							'2'
						);
				
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['file_suratlain']['name'])) {

				} else {
					$upload 		= $this->upload->do_upload('file_suratlain');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE t_surat_lain SET 
									  file_surat_lain='$nama_upload' 
									  WHERE id_surat_lain='$kode';");
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
				'Pengajuan Tambah Data Surat Lain',
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
		$msg		= false;
		$id 		= $_POST['id_suratlain'];
		$simpan 	= $this->suratlain_model->edit(
						$id,
						$_POST['nama_suratlain'],
						tgl_sql($_POST['tanggal_suratlain']),
						$_POST['tempat_suratlain'],
						$_POST['keterangan_suratlain']
					);
			
		if ($simpan) {
			$msg	= true;
		}
		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
		$nmfile 						= $id . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya
		
		$this->load->library('upload', $config);
		if (!empty($_FILES['file_suratlain']['name'])) {
			if ($this->upload->do_upload('file_suratlain')) {
				$upload_file 	= $this->upload->data();
				$nama_file 		= $upload_file['file_name'];
				$update_file 	= $this->db->query(
									"UPDATE t_surat_lain 
									SET file_surat_lain='$nama_file' 
									WHERE id_surat_lain='$id';"
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
				'Edit Data Surat Lain-Lain',
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
		$tmp 							= $this->suratlain_model->buat_kode_tmp();
		$kode 							= $_POST['id_suratlain'];
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_suratlain'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->suratlain_model->tambah_tmp(
							$tmp,
							$kode,
							$_POST['id_pegawai'],
							$_POST['nama_suratlain'],
							tgl_sql($_POST['tanggal_suratlain']),
							$_POST['tempat_suratlain'],
							$_POST['keterangan_suratlain'],
							'0'
						);
			$simpan 	=	$this->db->query(
								"UPDATE t_surat_lain 
								SET status_surat_lain='3'
								WHERE id_surat_lain='$kode';"
							);
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['file_suratlain']['name'])) {
					$simpan 	=	$this->db->query(
								"UPDATE tmp_surat_lain A RIGHT JOIN t_surat_lain B 
								ON A.id_surat_lain=B.id_surat_lain 
								SET A.file_surat_lain=B.file_surat_lain
								WHERE A.id_tmp='$tmp';"
							);

				} else {
					$upload 		= $this->upload->do_upload('file_suratlain');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE tmp_surat_lain SET 
									  file_surat_lain='$nama_upload' 
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
				'Pengajuan Edit Data Surat Lain',
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

	public function hapus($id) {
		$hapus 				= $this->suratlain_model->hapus($id);
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
		// 		'Hapus Data Surat Lain-Lain',
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
						"UPDATE t_surat_lain SET status_surat_lain='0' 
						WHERE id_surat_lain='$kode';"
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
				'Terima Pengajuan Tambah Data Surat Lain',
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
						"UPDATE t_surat_lain SET status_surat_lain='1' 
						WHERE id_surat_lain='$kode';"
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
				'Tolak Pengajuan Tambah Data Surat Lain',
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
		$kode 		= $_POST['id_suratlain'];
		$pegawai 	= $_POST['id_pegawai'];
		$msg		= false;
		$edit 		= $this->suratlain_model->terima_edit(
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
				'Terima Pengajuan Edit Data Surat Lain',
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
						"UPDATE t_surat_lain SET status_surat_lain='0' 
						WHERE id_surat_lain='$kode';"
		);
		$edit 		= $this->db->query(
						"UPDATE tmp_surat_lain SET status_surat_lain='1' 
						WHERE id_surat_lain='$kode';"
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
				'Tolak Pengajuan Edit Data Surat Lain',
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
						"UPDATE t_surat_lain SET status_surat_lain='1' 
						WHERE id_surat_lain='$kode';"
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
				'Terima Pengajuan Hapus Data Surat Lain',
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
						"UPDATE t_surat_lain SET status_surat_lain='0' 
						WHERE id_surat_lain='$kode';"
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
				'Tolak Pengajuan Hapus Data Surat Lain',
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
								"UPDATE t_surat_lain 
								SET status_surat_lain='4'
								WHERE id_surat_lain='$kode';"
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
				'Pengajuan Hapus Data Surat Lain',
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
