<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Luar_negri extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('luar_negri_model');
		$this->load->model('notice_model');
	}

	public function index() {
		$this->load->view('admin/master/pegawai/data_pegawai_luar_negri');
	}

	public function data($kode) {
		$data 					= $this->luar_negri_model->cari_pegawai($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$link_file 			= '';
			$btn_status 		= '';
			$btn_action 		= '';
			$nomor 				= $nomor + 1;

			if ($data->file_kunjungan=='') {
				$link_file		= $data->negara;
			} else {
				$link_file		= '<a href="' 			. base_url() 			. 
								  'assets/pdf/' 		. $data->file_kunjungan . 
								  '" target="_Blank" style="color:blue;" 
								  data-toggle="tooltip" data-placement="left" 
								  title="Klik untuk melihat File"><b>' 	
								  . $data->negara 	.  '</b></a>';
			}

			if ($data->file_kunjungan=='') {
				$btn_file		= '';
			} else {
				$btn_file		=  base_url() . 'assets/pdf/' . $data->file_kunjungan ;
			}

			if ($data->status_kunjungan=='0') {
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
												data-kd="' 			. $data->kd_kunjungan 			. '" 
												data-pegawai="' 	. $data->id_pegawai 			. '" 
												data-negara="' 		. $data->negara 				. '"
												data-tujuan="' 		. $data->tujuan_kunjungan 		. '"
												data-awal="' 		. $data->awal 					. '"
												data-akhir="' 		. $data->akhir 			 		. '"
												data-pembiayaan="' 	. $data->pembiayaan_kunjungan 	. '"
												data-btn_file="' 	. $btn_file 	. '"
												><i class="fa fa-edit"></i>
										</button>
								  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
												data-kd="' 			. $data->kd_kunjungan 			. '" 
												data-pegawai="' 	. $data->id_pegawai 			. '"
												data-negara="' 		. $data->negara 				. '"
												><i class="fa fa-trash-o"></i>
										</button>
									</div>';
				$btn_action_user=	$btn_action;
			} elseif ($data->status_kunjungan=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah" type="button" class="btn btn-success btn-xs" 
											data-kode="' 	. $data->kd_kunjungan		. '"
											data-pegawai="' . $data->id_pegawai 		. '"
											data-nama="' 	. $data->negara 			. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_kunjungan 		. '" 
											data-pegawai="' . $data->id_pegawai 		. '" 
											data-nama="' 	. $data->negara 			. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user= 	'<button id="btn-batal-tambah" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 		. $data->kd_kunjungan 		. '" 
										data-pegawai="' 	. $data->id_pegawai 		. '" 
										data-nama="' 		. $data->negara 			. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->status_kunjungan=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit" type="button" class="btn btn-success btn-xs" 
											data-kode="' 	. $data->kd_kunjungan		. '"
											data-pegawai="' . $data->id_pegawai 		. '"
											data-nama="' 	. $data->negara 			. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-edit" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_kunjungan 		. '" 
											data-pegawai="' . $data->id_pegawai 		. '" 
											data-nama="' 	. $data->negara 			. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 		. $data->kd_kunjungan 		. '" 
										data-pegawai="' 	. $data->id_pegawai 		. '" 
										data-nama="' 		. $data->negara 			. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->status_kunjungan=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus" type="button" class="btn btn-success btn-xs" 
											data-kode="' 	. $data->kd_kunjungan		. '"
											data-pegawai="' . $data->id_pegawai 		. '"
											data-nama="' 	. $data->negara 			. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-hapus" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_kunjungan 		. '" 
											data-pegawai="' . $data->id_pegawai 		. '" 
											data-nama="' 	. $data->negara 			. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 	. $data->kd_kunjungan 			. '" 
										data-pegawai="' . $data->id_pegawai 			. '" 
										data-nama="' 	. $data->negara 				. '"
										><i class="fa fa-times"></i>
									</button>';
			}
			$hasil[]			= array(
					'no'			=> $nomor,
					'negara'		=> $link_file,
					'tujuan'		=> $data->tujuan_kunjungan,
					'lama'			=> date('d F Y',strtotime($data->awal)) ."  s/d  ". date('d F Y',strtotime($data->akhir)),
					'pembiayaan'	=> $data->pembiayaan_kunjungan,
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
		$data		= $this->luar_negri_model->cari_tmp($kode);
		foreach ($data as $didik ) {
			$negara 		= $didik->negara;
			$tujuan 		= $didik->tujuan_kunjungan;
			$awal 		= $didik->awal;
			$akhir 		= $didik->akhir;
			$pembiayaan 		= $didik->pembiayaan_kunjungan;
		}
		$pend2		= $this->luar_negri_model->cari_tmp2($kode);

		foreach ($pend2 as $didik2 ) {
			$negara2 		= $didik2->negara;
			$tujuan2		= $didik2->tujuan_kunjungan;
			$awal2			= $didik2->awal;
			$akhir2			= $didik2->akhir;
			$pembiayaan2	= $didik2->pembiayaan_kunjungan;
		}

		if($negara != $negara2){
			$data['negara'] = 'green';
			$data['a'] 		= $negara2;
			$data['a2'] 		= '#ff9900';
		}else{
			$data['negara'] = 'black';
			$data['a'] 		= '';
		}

		if($tujuan != $tujuan2){
			$data['tujuan'] = 'green';
			$data['b'] 		= $tujuan2;
			$data['b2'] 		= '#ff9900';
		}else{
			$data['tujuan'] = 'black';
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

		if($pembiayaan != $pembiayaan2){
			$data['pembiayaan'] = 'green';
			$data['e'] 		= $pembiayaan2;
			$data['e2'] 		= '#ff9900';
		}else{
			$data['pembiayaan'] = 'black';
			$data['e'] 		='';
		}

		// if (count($data)>0){
			echo json_encode($data);
		// } else {
		// 	echo json_encode('false');
		// }
	}
	
	public function tambah() {
		$kode		= $this->luar_negri_model->buat_kode();
		$simpan 	= $this->luar_negri_model->tambah(
						$kode,
						$_POST['id_pegawai'],
						$_POST['negara_kunjungan'],
						$_POST['tujuan_kunjungan'],
						tgl_sql($_POST['awal_kunjungan']),
						tgl_sql($_POST['akhir_kunjungan']),
						$_POST['pembiayaan_kunjungan'],
						'0'
					);
			
		if ($simpan) {
			$msg	= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya
		
		$this->load->library('upload', $config);
		if (!empty($_FILES['file_kunjungan']['name'])) {
			if ($this->upload->do_upload('file_kunjungan')) {
				$upload_file 	= $this->upload->data();
				$nama_file 		= $upload_file['file_name'];
				$update_file 	= $this->db->query(
									"UPDATE t_luar_negeri 
									SET file_kunjungan='$nama_file' 
									WHERE kd_kunjungan='$kode';"
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
				'Tambah Data Pengalaman Luar Negeri',
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
		$kode		= $this->luar_negri_model->buat_kode();
		$simpan 	= $this->luar_negri_model->tambah(
						$kode,
						$_POST['id_pegawai'],
						$_POST['negara_kunjungan'],
						$_POST['tujuan_kunjungan'],
						tgl_sql($_POST['awal_kunjungan']),
						tgl_sql($_POST['akhir_kunjungan']),
						$_POST['pembiayaan_kunjungan'],
						'2'
					);
			
		if ($simpan) {
			$msg	= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if (!empty($_FILES['file_kunjungan']['name'])) {
			if ($this->upload->do_upload('file_kunjungan')) {
				$upload_file 	= $this->upload->data();
				$nama_file 		= $upload_file['file_name'];
				$update_file 	= $this->db->query(
									"UPDATE t_luar_negeri 
									SET file_kunjungan='$nama_file' 
									WHERE kd_kunjungan='$kode';"
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
				'Pengajuan Tambah Data Pengalaman Luar Negeri',
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
		$kode 		= $_POST['kd_kunjungan'];
		$simpan 	= $this->luar_negri_model->edit(
						$_POST['kd_kunjungan'],
						$_POST['negara_kunjungan'],
						$_POST['tujuan_kunjungan'],
						tgl_sql($_POST['awal_kunjungan']),
						tgl_sql($_POST['akhir_kunjungan']),
						$_POST['pembiayaan_kunjungan']
					);
			
		if ($simpan) {
			$msg	= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya
		
		$this->load->library('upload', $config);
		if (!empty($_FILES['file_kunjungan']['name'])) {
			if ($this->upload->do_upload('file_kunjungan')) {
				$upload_file 	= $this->upload->data();
				$nama_file 		= $upload_file['file_name'];
				$update_file 	= $this->db->query(
									"UPDATE t_luar_negeri
									SET file_kunjungan='$nama_file' 
									WHERE kd_kunjungan='$kode';"
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
				'Edit Data Pengalaman Luar Negeri',
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
		$tmp 		= $this->luar_negri_model->buat_kode_tmp();
		$kode 		= $_POST['kd_kunjungan'];
		$simpan 	= $this->luar_negri_model->tambah_tmp(
						$tmp,
						$kode,
						$_POST['id_pegawai'],
						$_POST['negara_kunjungan'],
						$_POST['tujuan_kunjungan'],
						tgl_sql($_POST['awal_kunjungan']),
						tgl_sql($_POST['akhir_kunjungan']),
						$_POST['pembiayaan_kunjungan'],
						'0'
					);
		$simpan 	=	$this->db->query(
						"UPDATE t_luar_negeri 
						SET status_kunjungan='3'
						WHERE kd_kunjungan='$kode';"
					);
			
		if ($simpan) {
			$msg	= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya
		
		$this->load->library('upload', $config);
		if (empty($_FILES['file_kunjungan']['name'])) {
			$simpan 	=	$this->db->query(
						"UPDATE tmp_luar_negeri A RIGHT JOIN t_luar_negeri B 
						ON A.kd_kunjungan=B.kd_kunjungan 
						SET A.file_kunjungan=B.file_kunjungan
						WHERE A.id_tmp='$tmp';"
					);
		} else {
			$upload 		= $this->upload->do_upload('file_kunjungan');
			$data			= $this->upload->data();
			$nama_upload 	= $data['file_name'];

			$simpan			= $this->db->query("UPDATE tmp_luar_negeri SET 
							  file_kunjungan='$nama_upload' 
							  WHERE kd_kunjungan='$kode';");
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
				'Pengajuan Edit Data Pengalaman Luar Negeri',
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
		$hapus 				= $this->luar_negri_model->hapus($kode);
		$msg 	= false;
		if ($hapus) {
			$msg = true;
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
				'Hapus Data Pengalaman Luar Negeri',
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
		$hapus 				= $this->luar_negri_model->hapus($kode);$this->db->query(
								"UPDATE t_luar_negeri 
								SET status_kunjungan='4'
								WHERE kd_kunjungan='$kode';"
							);
		if ($hapus) {
			$msg = true;
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
				'Pengajuan Hapus Data Pengalaman Luar Negeri',
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
						"UPDATE t_luar_negeri SET status_kunjungan='0' 
						WHERE kd_kunjungan='$kode';"
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
				'Terima Pengajuan Tambah Data Kunjungan',
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
						"UPDATE t_luar_negeri SET status_kunjungan='1' 
						WHERE kd_kunjungan='$kode';"
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
				'Tolak Pengajuan Tambah Data Kunjungan',
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
		$kode 		= $_POST['kd_kunjungan'];
		$pegawai 	= $_POST['id_pegawai'];
		$msg		= false;
		$edit 		= $this->luar_negri_model->terima_edit( $kode );
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
				'Terima Pengajuan Edit Data Kunjungan',
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
						"UPDATE t_luar_negeri SET status_kunjungan='0' 
						WHERE kd_kunjungan='$kode';"
		);
		$edit 		= $this->db->query(
						"UPDATE tmp_luar_negeri SET status_kunjungan='1' 
						WHERE kd_kunjungan='$kode';"
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
				'Tolak Pengajuan Edit Data Kunjungan',
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
						"UPDATE t_luar_negeri SET status_kunjungan='1' 
						WHERE kd_kunjungan='$kode';"
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
				'Terima Pengajuan Hapus Data Kunjungan',
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
						"UPDATE t_luar_negeri SET status_kunjungan='0' 
						WHERE kd_kunjungan='$kode';"
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
				'Tolak Pengajuan Hapus Data Kunjungan',
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
