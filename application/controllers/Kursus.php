<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kursus extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('kursus_model');
		$this->load->model('notice_model');
	}

	public function index() {

	}

	public function data($kode) {
		$data 					= $this->kursus_model->cari_pegawai($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$link_file 			= '';
			$btn_status 		= '';
			$btn_action 		= '';

			if ($data->file_kursus=='') {
				$link_file		= $data->ijazah_kursus;
			} else {
				$link_file		= '<a href="' 			. base_url() 			. 
								  'assets/pdf/' 		. $data->file_kursus 	. 
								  '" target="_Blank" style="color:blue;" 
								  data-toggle="tooltip" data-placement="left" 
								  title="Klik untuk melihat File"><b>' 	
								  . $data->ijazah_kursus 	.  '</b></a>';
			}

			if ($data->file_kursus=='') {
				$btn_file		= '';
			} else {
				$btn_file		=  base_url() . 'assets/pdf/' . $data->file_kursus ;
			}

			if ($data->status_kursus=='0') {
				$btn_action 	= 	'<div class="btn-group">										
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
											data-pegawai="' . $data->id_pegawai 	. '"
											data-jenis="' 	. $data->id_jenis_kursus. '"
											data-kode="' 	. $data->kd_kursus		. '"
											data-nama="' 	. $data->nama_kursus 	. '"
											data-awal="' 	. date('d-m-Y',strtotime($data->awal_kursus))	. '"
											data-akhir="' 	. date('d-m-Y',strtotime($data->akhir_kursus))	. '" 
											data-ijazah="' 	. $data->ijazah_kursus 	. '"
											data-tempat="' 	. $data->tempat_kursus 	. '"
											data-kepala="' 	. $data->kepala_kursus 	. '"
											data-durasi="' 	. $data->durasi_kursus 	. '"
											data-file="' 	. base_url() . $data->file_kursus 		. '"
											data-btn_file="' 	. $btn_file 	. '"
											><i class="fa fa-edit"></i>
										</button>
									 		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_kursus 		. '" 
											data-pegawai="' . $data->id_pegawai 	. '"
											data-nama="' 	. $data->nama_kursus 	. '"
											><i class="fa fa-trash-o"></i>
										</button>
									</div>';
				$btn_action_user=	$btn_action;
			} elseif ($data->status_kursus=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah" type="button" class="btn btn-success btn-xs" 
											data-kode="' 	. $data->kd_kursus		. '"
											data-pegawai="' . $data->id_pegawai 	. '"
											data-nama="' 	. $data->nama_kursus 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_kursus 		. '" 
											data-pegawai="' . $data->id_pegawai 	. '" 
											data-nama="' 	. $data->nama_kursus 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user= 	'<button id="btn-batal-tambah" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 		. $data->kd_kursus 		. '" 
										data-pegawai="' 	. $data->id_pegawai 	. '" 
										data-nama="' 		. $data->nama_kursus 	. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->status_kursus=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit" type="button" class="btn btn-success btn-xs" 
											data-kode="' 	. $data->kd_kursus		. '"
											data-pegawai="' . $data->id_pegawai 	. '"
											data-nama="' 	. $data->nama_kursus 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-edit" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_kursus 		. '" 
											data-pegawai="' . $data->id_pegawai 	. '" 
											data-nama="' 	. $data->nama_kursus 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 		. $data->kd_kursus 		. '" 
										data-pegawai="' 	. $data->id_pegawai 	. '" 
										data-nama="' 		. $data->nama_kursus 	. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->status_kursus=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus" type="button" class="btn btn-success btn-xs" 
											data-kode="' 	. $data->kd_kursus		. '"
											data-pegawai="' . $data->id_pegawai 	. '"
											data-nama="' 	. $data->nama_kursus 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-hapus" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_kursus 		. '" 
											data-pegawai="' . $data->id_pegawai 	. '" 
											data-nama="' 	. $data->nama_kursus 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 	. $data->kd_kursus 			. '" 
										data-pegawai="' . $data->id_pegawai 		. '" 
										data-nama="' 	. $data->nama_kursus 		. '"
										><i class="fa fa-times"></i>
									</button>';
			}

			$hasil[]			= array(
					'no'			=> $nomor,
					'jenis'			=> $data->nm_jenis_kursus,
					'nama' 			=> $data->nama_kursus,
					'tahun' 		=> date('d F Y',strtotime($data->awal_kursus)) . ' s/d ' . date('d F Y',strtotime($data->akhir_kursus)),
					'ijazah' 		=> $link_file,
					'tempat' 		=> $data->tempat_kursus,
					'tandatangan' 	=> $data->kepala_kursus,
					'durasi'		=> $data->durasi_kursus,
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

	public function data_tmp($kode) {
		$data		= $this->kursus_model->cari_tmp($kode);
		foreach ($data as $didik ) {
			$jenis 			= $didik->nm_jenis_kursus;
			$nama 			= $didik->nama_kursus;
			$awal 			= $didik->awal;
			$akhir 			= $didik->akhir;
			$ijazah 		= $didik->ijazah_kursus;
			$tempat 		= $didik->tempat_kursus;
			$kepala 		= $didik->kepala_kursus;
			$durasi 		= $didik->durasi_kursus;
		}

		$pend2		= $this->kursus_model->cari_tmp2($kode);

		foreach ($pend2 as $didik2 ) {
			$jenis2 		= $didik2->nm_jenis_kursus;
			$nama2 			= $didik2->nama_kursus;
			$awal2 			= $didik2->awal;
			$akhir2 		= $didik2->akhir;
			$ijazah2 		= $didik2->ijazah_kursus;
			$tempat2 		= $didik2->tempat_kursus;
			$kepala2 		= $didik2->kepala_kursus;
			$durasi2 		= $didik2->durasi_kursus;
		}

		if($jenis != $jenis2){
			$data['jenis_k'] = 'green';
			$data['a'] 		= $jenis2;
			$data['a2'] 		= '#ff9900';
		}else{
			$data['jenis_k'] = 'black';
			$data['a'] 		= '';
		}

		if($nama != $nama2){
			$data['nama'] = 'green';
			$data['b'] 		= $nama2;
			$data['b2'] 		= '#ff9900';
		}else{
			$data['nama'] = 'black';
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

		if($ijazah != $ijazah2){
			$data['ijazah'] = 'green';
			$data['e'] 		= $ijazah2;
			$data['e2'] 		= '#ff9900';
		}else{
			$data['ijazah'] = 'black';
			$data['e'] 		= '';
		}

		if($tempat != $tempat2){
			$data['tempat'] = 'green';
			$data['f'] 		= $tempat2;
			$data['f2'] 		= '#ff9900';
		}else{
			$data['tempat'] = 'black';
			$data['f'] 		= '';
		}

		if($kepala != $kepala2){
			$data['kepala'] = 'green';
			$data['g'] 		= $kepala2;
			$data['g2'] 		= '#ff9900';
		}else{
			$data['kepala'] = 'black';
			$data['g'] 		= '';
		}

		if($durasi != $durasi2){
			$data['durasi'] = 'green';
			$data['h'] 		= $durasi2;
			$data['h2'] 		= '#ff9900';
		}else{
			$data['durasi'] = 'black';
			$data['h'] 		= '';
		}
		// if (count($data)>0){
			echo json_encode($data);
		// } else {
		// 	echo json_encode('false');
		// }
	}
	
	public function tambah() {
		$kode							= $this->kursus_model->buat_kode();
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_kursus'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->kursus_model->tambah(
							$kode,
							$_POST['id_pegawai'],
							$_POST['id_jenis_kursus'],
							$_POST['nama_kursus'],
							tgl_sql($_POST['awal_kursus']),
							tgl_sql($_POST['akhir_kursus']),
							$_POST['ijazah_kursus'],
							$_POST['tempat_kursus'],
							$_POST['kepala_kursus'],
							$_POST['durasi_kursus'],
							'0'
						);
				
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['file_kursus']['name'])) {

				} else {
					$upload 		= $this->upload->do_upload('file_kursus');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE t_kursus SET 
									  file_kursus='$nama_upload' 
									  WHERE kd_kursus='$kode';");
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
				'Tambah Data',
				date('Y-m-d H:i:s'),
				'#',
				'Tambah Data kursus NonFormal',
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
		$kode							= $this->kursus_model->buat_kode();
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_kursus'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->kursus_model->tambah(
							$kode,
							$_POST['id_pegawai'],
							$_POST['id_jenis_kursus'],
							$_POST['nama_kursus'],
							tgl_sql($_POST['awal_kursus']),
							tgl_sql($_POST['akhir_kursus']),
							$_POST['ijazah_kursus'],
							$_POST['tempat_kursus'],
							$_POST['kepala_kursus'],
							$_POST['durasi_kursus'],
							'2'
						);
				
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['file_kursus']['name'])) {

				} else {
					$upload 		= $this->upload->do_upload('file_kursus');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE t_kursus SET 
									  file_kursus='$nama_upload' 
									  WHERE kd_kursus='$kode';");
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
				'Pengajuan Tambah Data kursus NonFormal',
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
		$kode 							= $_POST['kode_kursus'];
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_kursus'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->kursus_model->edit(
							$kode,
							$_POST['id_pegawai'],
							$_POST['id_jenis_kursus'],
							$_POST['nama_kursus'],
							tgl_sql($_POST['awal_kursus']),
							tgl_sql($_POST['akhir_kursus']),
							$_POST['ijazah_kursus'],
							$_POST['tempat_kursus'],
							$_POST['kepala_kursus'],
							$_POST['durasi_kursus']
						);
				
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['file_kursus']['name'])) {

				} else {
					$upload 		= $this->upload->do_upload('file_kursus');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE t_kursus SET 
									  file_kursus='$nama_upload' 
									  WHERE kd_kursus='$kode';");
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
				'Edit Data',
				date('Y-m-d H:i:s'),
				'#',
				'Edit Data kursus NonFormal',
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
		$tmp 							= $this->kursus_model->buat_kode_tmp();
		$kode 							= $_POST['kode_kursus'];
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_kursus'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->kursus_model->tambah_tmp(
							$tmp,
							$kode,
							$_POST['id_pegawai'],
							$_POST['id_jenis_kursus'],
							$_POST['nama_kursus'],
							tgl_sql($_POST['awal_kursus']),
							tgl_sql($_POST['akhir_kursus']),
							$_POST['ijazah_kursus'],
							$_POST['tempat_kursus'],
							$_POST['kepala_kursus'],
							$_POST['durasi_kursus'],
							'0'
						);
			$simpan 	=	$this->db->query(
								"UPDATE t_kursus 
								SET status_kursus='3'
								WHERE kd_kursus='$kode';"
							);
				
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['file_kursus']['name'])) {
					$simpan 	=	$this->db->query(
								"UPDATE tmp_kursus A RIGHT JOIN t_kursus B 
								ON A.kd_kursus=B.kd_kursus 
								SET A.file_kursus=B.file_kursus
								WHERE A.id_tmp='$tmp';"
							);
				} else {
					$upload 		= $this->upload->do_upload('file_kursus');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE tmp_kursus SET 
									  file_kursus='$nama_upload' 
									  WHERE kd_kursus='$kode';");
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
				'Pengajuan Edit Data kursus NonFormal',
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
								"UPDATE t_kursus 
								SET status_kursus='1'
								WHERE kd_kursus='$kode';"
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
				'Hapus Data kursus NonFormal',
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
								"UPDATE t_kursus 
								SET status_kursus='4'
								WHERE kd_kursus='$kode';"
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
				'Pengajuan Hapus Data kursus NonFormal',
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
						"UPDATE t_kursus SET status_kursus='0' 
						WHERE kd_kursus='$kode';"
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
				'Terima Pengajuan Tambah Data Pendidikan NonFormal',
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
						"UPDATE t_kursus SET status_kursus='1' 
						WHERE kd_kursus='$kode';"
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
				'Tolak Pengajuan Tambah Data Pendidikan NonFormal',
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
		$kode 		= $_POST['kode_kursus'];
		$pegawai 	= $_POST['id_pegawai'];
		$msg		= false;
		$edit 		= $this->kursus_model->terima_edit(
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
				'Terima Pengajuan Edit Data Pendidikan NonFormal',
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
						"UPDATE t_kursus SET status_kursus='0' 
						WHERE kd_kursus='$kode';"
		);
		$edit 		= $this->db->query(
						"UPDATE tmp_kursus SET status_kursus='1' 
						WHERE kd_kursus='$kode';"
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
				'Tolak Pengajuan Edit Data Pendidikan NonFormal',
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
						"UPDATE t_kursus SET status_kursus='1' 
						WHERE kd_kursus='$kode';"
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
				'Terima Pengajuan Hapus Data Pendidikan NonFormal',
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
						"UPDATE t_kursus SET status_kursus='0' 
						WHERE kd_kursus='$kode';"
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
				'Tolak Pengajuan Hapus Data Pendidikan NonFormal',
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
