<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghargaan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('penghargaan_model');
		$this->load->model('notice_model');
	}

	public function index() {
		$this->load->view('admin/master/pegawai/data_pegawai_penghargaan');
	}

	public function data( $kode ) {
		$data 					= $this->penghargaan_model->cari_pegawai($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1 ;
			$link_file 			= '';
			$btn_status 		= '';
			$btn_action 		= '';

			if ($data->file_penghargaan=='') {
				$link_file		= $data->nama_penghargaan;
			} else {
				$link_file		= '<a href="' 			. base_url() 			. 
								  'assets/pdf/' 		. $data->file_penghargaan 	. 
								  '" target="_Blank" style="color:blue;" 
								  data-toggle="tooltip" data-placement="left" 
								  title="Klik untuk melihat File"><b>' 	
								  . $data->nama_penghargaan 	.  '</b></a>';
			}

			if ($data->file_penghargaan=='') {
				$btn_file		= '';
			} else {
				$btn_file		=  base_url() . 'assets/pdf/' . $data->file_penghargaan ;
			}

			if ($data->status_penghargaan=='0') {
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
												data-kd="' 		. $data->kd_penghargaan 		. '" 
												data-pegawai="' . $data->id_pegawai 			. '" 
												data-nama="' 	. $data->nama_penghargaan 		. '"
												data-tahun="' 	. $data->tahun_penghargaan 		. '"
												data-pemberi="' . $data->pemberi_penghargaan 	. '"
												data-btn_file="' 	. $btn_file 	. '"
												><i class="fa fa-edit"></i>
										</button>
										<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
												data-kd="' 		. $data->kd_penghargaan 	. '" 
												data-pegawai="' . $data->id_pegawai 		. '" 
												data-nama="' 	. $data->nama_penghargaan 	. '"
												><i class="fa fa-trash-o"></i>
										</button>
									</div>';
				$btn_action_user=	$btn_action;
			} elseif ($data->status_penghargaan=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah" type="button" class="btn btn-success btn-xs" 
											data-kode="' 	. $data->kd_penghargaan		. '"
											data-pegawai="' . $data->id_pegawai 	. '"
											data-nama="' 	. $data->nama_penghargaan 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_penghargaan 		. '" 
											data-pegawai="' . $data->id_pegawai 	. '" 
											data-nama="' 	. $data->nama_penghargaan 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user= 	'<button id="btn-batal-tambah" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 		. $data->kd_penghargaan 		. '" 
										data-pegawai="' 	. $data->id_pegawai 	. '" 
										data-nama="' 		. $data->nama_penghargaan 	. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->status_penghargaan=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit" type="button" class="btn btn-success btn-xs" 
											data-kode="' 	. $data->kd_penghargaan		. '"
											data-pegawai="' . $data->id_pegawai 	. '"
											data-nama="' 	. $data->nama_penghargaan 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-edit" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_penghargaan 		. '" 
											data-pegawai="' . $data->id_pegawai 	. '" 
											data-nama="' 	. $data->nama_penghargaan 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 		. $data->kd_penghargaan 		. '" 
										data-pegawai="' 	. $data->id_pegawai 	. '" 
										data-nama="' 		. $data->nama_penghargaan 	. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->status_penghargaan=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus" type="button" class="btn btn-success btn-xs" 
											data-kode="' 	. $data->kd_penghargaan		. '"
											data-pegawai="' . $data->id_pegawai 	. '"
											data-nama="' 	. $data->nama_penghargaan 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-hapus" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_penghargaan 		. '" 
											data-pegawai="' . $data->id_pegawai 	. '" 
											data-nama="' 	. $data->nama_penghargaan 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 	. $data->kd_penghargaan 			. '" 
										data-pegawai="' . $data->id_pegawai 		. '" 
										data-nama="' 	. $data->nama_penghargaan 		. '"
										><i class="fa fa-times"></i>
									</button>';
			}

			$hasil[]			= array(
					'no'			=> $nomor,
					'nama'			=> $link_file,
					'tahun'			=> $data->tahun_penghargaan,
					'pemberi'		=> $data->pemberi_penghargaan,
					'status'		=> $btn_status,
					'action' 		=> $btn_action,
					'action_user'	=> $btn_action_user
			);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function data_tmp($kode) {
		$data		= $this->penghargaan_model->cari_tmp($kode);
		foreach ($data as $didik ) {
			$nama 		= $didik->nama_penghargaan;
			$tahun 		= $didik->tahun_penghargaan;
			$pemberi 		= $didik->pemberi_penghargaan;
		}
		$pend2		= $this->penghargaan_model->cari_tmp2($kode);

		foreach ($pend2 as $didik2 ) {
			$nama2 		= $didik2->nama_penghargaan;
			$tahun2 		= $didik2->tahun_penghargaan;
			$pemberi2 		= $didik2->pemberi_penghargaan;
		}


		if($nama != $nama2){
			$data['nama'] = 'green';
			$data['a'] 		= $nama2;
			$data['a2'] 		= '#ff9900';
		}else{
			$data['nama'] = 'black';
			$data['a'] 		= '';
		}

		if($tahun != $tahun2){
			$data['tahun'] = 'green';
			$data['b'] 		= $tahun2;
			$data['b2'] 		= '#ff9900';
		}else{
			$data['tahun'] = 'black';
			$data['b'] 		= '';
		}

		if($pemberi != $pemberi2){
			$data['pemberi'] = 'green';
			$data['c'] 		= $pemberi2;
			$data['c2'] 		= '#ff9900';
		}else{
			$data['pemberi'] = 'black';
			$data['c'] 		= '';
		}
		// if (count($data)>0){
			echo json_encode($data);
		// } else {
		// 	echo json_encode('false');
		// }
	}
	
	public function tambah() {
		$kode		= $this->penghargaan_model->buat_kode();
		$simpan 	= $this->penghargaan_model->tambah(
						$kode,
						$_POST['id_pegawai'],
						$_POST['nama_penghargaan'],
						$_POST['tahun_penghargaan'],
						$_POST['pemberi_penghargaan'],
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
		if (!empty($_FILES['file_penghargaan']['name'])) {
			if ($this->upload->do_upload('file_penghargaan')) {
				$upload_file 	= $this->upload->data();
				$nama_file 		= $upload_file['file_name'];
				$update_file 	= $this->db->query(
									"UPDATE t_penghargaan 
									SET file_penghargaan='$nama_file' 
									WHERE kd_penghargaan='$kode';"
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
				'Tambah Data Penghargaan',
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
		$kode		= $this->penghargaan_model->buat_kode();
		$simpan 	= $this->penghargaan_model->tambah(
						$kode,
						$_POST['id_pegawai'],
						$_POST['nama_penghargaan'],
						$_POST['tahun_penghargaan'],
						$_POST['pemberi_penghargaan'],
						'2'
					);
			
		if ($simpan) {
			$msg	= true;
		}
		
		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
		
		$this->load->library('upload', $config);
		if (!empty($_FILES['file_penghargaan']['name'])) {
			if ($this->upload->do_upload('file_penghargaan')) {
				$upload_file 	= $this->upload->data();
				$nama_file 		= $upload_file['file_name'];
				$update_file 	= $this->db->query(
									"UPDATE t_penghargaan 
									SET file_penghargaan='$nama_file' 
									WHERE kd_penghargaan='$kode';"
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
				'Pengajuan Tambah Data',
				date('Y-m-d H:i:s'),
				'#',
				'Pengajuan Tambah Data Penghargaan',
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
		$kode 		= $_POST['kd_penghargaan'];
		$simpan 	= $this->penghargaan_model->edit(
						$kode,
						$_POST['nama_penghargaan'],
						$_POST['tahun_penghargaan'],
						$_POST['pemberi_penghargaan']
					);
				
		if ($simpan) {
			$msg	= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
			
		$this->load->library('upload', $config);
		if (!empty($_FILES['file_penghargaan']['name'])) {
			if ($this->upload->do_upload('file_penghargaan')) {
				$upload_file 	= $this->upload->data();
				$nama_file 		= $upload_file['file_name'];
				$update_file 	= $this->db->query(
									"UPDATE t_penghargaan 
									SET file_penghargaan='$nama_file' 
									WHERE kd_penghargaan='$kode';"
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
				'Edit Data Penghargaan',
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

	public function edit_user(){
		$tmp 		= $this->penghargaan_model->buat_kode_tmp();
		$kode 		= $_POST['kd_penghargaan'];
		$simpan 	= $this->penghargaan_model->tambah_tmp(
						$tmp,
						$_POST['kd_penghargaan'],
						$_POST['id_pegawai'],
						$_POST['nama_penghargaan'],
						$_POST['tahun_penghargaan'],
						$_POST['pemberi_penghargaan'],
						'0'
					);
		$simpan 	=	$this->db->query(
							"UPDATE t_penghargaan 
							SET status_penghargaan='3'
							WHERE kd_penghargaan='$kode';"
						);
				
		if ($simpan) {
			$msg	= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
			
		$this->load->library('upload', $config);
		if (empty($_FILES['file_penghargaan']['name'])) {
			$simpan 	=	$this->db->query(
						"UPDATE tmp_penghargaan A RIGHT JOIN t_penghargaan B 
						ON A.kd_penghargaan=B.kd_penghargaan 
						SET A.file_penghargaan=B.file_penghargaan
						WHERE A.id_tmp='$tmp';"
					);
		} else {
			$upload 		= $this->upload->do_upload('file_penghargaan');
			$data			= $this->upload->data();
			$nama_upload 	= $data['file_name'];

			$simpan			= $this->db->query("UPDATE tmp_penghargaan 
									SET file_penghargaan='$nama_file' 
									WHERE kd_penghargaan='$kode';");
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
				'Pengajuan Edit Data Penghargaan',
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

	public function hapus( $kode, $pegawai ) {
		$hapus 				= $this->db->query(
								"UPDATE t_penghargaan 
								SET status_penghargaan='1'
								WHERE kd_penghargaan='$kode';"
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
				'Hapus Data',
				date('Y-m-d H:i:s'),
				'#',
				'Hapus Data Penghargaan',
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
								"UPDATE t_penghargaan 
								SET status_penghargaan='4'
								WHERE kd_penghargaan='$kode';"
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
				'Pengajuan Hapus Data Penghargaan',
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

	public function terima_tambah($kode, $pegawai) {
		$msg		= false;
		$edit 		= $this->db->query(
						"UPDATE t_penghargaan SET status_penghargaan='0' 
						WHERE kd_penghargaan='$kode';"
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
				'Terima Pengajuan Tambah Data Penghargaan',
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
						"UPDATE t_penghargaan SET status_penghargaan='1' 
						WHERE kd_penghargaan='$kode';"
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
				'Tolak Pengajuan Tambah Data Penghargaan',
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
		$kode 		= $_POST['kd_penghargaan'];
		$pegawai 	= $_POST['id_pegawai'];
		$msg		= false;
		$edit 		= $this->penghargaan_model->terima_edit( $kode );
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
				'Terima Pengajuan Edit Data Penghargaan',
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
						"UPDATE t_penghargaan SET status_penghargaan='0' 
						WHERE kd_penghargaan='$kode';"
		);
		$edit 		= $this->db->query(
						"UPDATE tmp_penghargaan SET status_penghargaan='1' 
						WHERE kd_penghargaan='$kode';"
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
				'Tolak Pengajuan Edit Data Penghargaan',
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
						"UPDATE t_penghargaan SET status_penghargaan='1' 
						WHERE kd_penghargaan='$kode';"
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
				'Terima Pengajuan Hapus Data Penghargaan',
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
						"UPDATE t_penghargaan SET status_penghargaan='0' 
						WHERE kd_penghargaan='$kode';"
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
				'Tolak Pengajuan Hapus Data Penghargaan',
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
