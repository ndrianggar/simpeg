<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('pendidikan_model');
		$this->load->model('notice_model');
	}

	public function index() {
	}

	public function data($kode) {
		$data 					= $this->pendidikan_model->cari_pegawai($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$link_file 			= '';
			$btn_status 		= '';
			$btn_action 		= '';

			if ($data->file_pendidikan=='') {
				$link_file		= $data->ijazah_pendidikan;
			} else {
				$link_file		= '<a href="' 			. base_url() 				. 
								  'assets/pdf/' 		. $data->file_pendidikan 	. 
								  '" target="_Blank" style="color:blue;" 
								  data-toggle="tooltip" data-placement="left" 
								  title="Klik untuk melihat File"><b>' 	
								  . $data->ijazah_pendidikan 	.  '</b></a>';
			}

			if ($data->file_pendidikan=='') {
				$btn_file		= '';
			} else {
				$btn_file		=  base_url() . 'assets/pdf/' . $data->file_pendidikan ;
			}

			if ($data->status_pendidikan=='0') {
				if ($data->status_aktif=='1') {
					$btn_status = 	'<button id="btn-ganti" type="button" class="btn btn-success btn-xs" 
										data-kode="' 	. $data->kd_pendidikan 	. '" 
										data-pegawai="' . $kode 				. '"
										data-status="' 	. $data->status_aktif 	. '" 
										><i class="fa fa-refresh"> Aktif</i>
								  	</button>';
				} elseif ($data->status_aktif=='0') {
					$btn_status = 	'<button id="btn-ganti" type="button" class="btn btn-dark btn-xs" 
										data-kode="' 	. $data->kd_pendidikan 	. '" 
										data-pegawai="' . $kode 				. '"
										data-status="' 	. $data->status_aktif 	. '" 
										><i class="fa fa-refresh"> Non-Aktif</i>
								  	</button>';
				}

				$btn_action 		= 	'<div class="btn-group">
											<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
												data-pegawai="' . $data->id_pegawai 		. '"
												data-kode="' 	. $data->kd_pendidikan		. '"
												data-jenjang="' . $data->id_jenjang 		. '" 
												data-nama="' 	. $data->nama_pendidikan 	. '"
												data-jurusan="' . $data->jurusan_pendidikan 		. '"
												data-awal="' 	. date('d-m-Y',strtotime($data->awal_pendidikan))	. '"
												data-akhir="' 	. date('d-m-Y',strtotime($data->akhir_pendidikan))	. '" 
												data-ijazah="' 	. $data->ijazah_pendidikan 	. '"
												data-tempat="' 	. $data->tempat_pendidikan 	. '"
												data-kepala="' 	. $data->kepala_pendidikan 	. '"
												data-file="' 	. base_url() . $data->file_pendidikan 		. '"
												data-btn_file="' 	. $btn_file 	. '"

												><i class="fa fa-edit"></i>
											</button>
									  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
												data-kode="' 	. $data->kd_pendidikan 		. '" 
												data-nama="' 	. $data->nama_pendidikan 	. '"
												data-pegawai="' . $data->id_pegawai 		. '" 
												><i class="fa fa-trash-o"></i>
											</button>
										</div>';
				$btn_action_user	=	$btn_action;
			} elseif ($data->status_pendidikan=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah" type="button" class="btn btn-success btn-xs" 
											data-pegawai="' . $data->id_pegawai 		. '"
											data-kode="' 	. $data->kd_pendidikan		. '"
											data-nama="' 	. $data->nama_pendidikan 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_pendidikan 		. '" 
											data-pegawai="' . $data->id_pegawai 		. '" 
											data-nama="' 	. $data->nama_pendidikan 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-tambah" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 	. $data->kd_pendidikan 		. '" 
										data-pegawai="' . $data->id_pegawai 		. '" 
										data-nama="' 	. $data->nama_pendidikan 	. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->status_pendidikan=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit" type="button" class="btn btn-success btn-xs" 
											data-pegawai="' . $data->id_pegawai 		. '"
											data-kode="' 	. $data->kd_pendidikan		. '"
											data-nama="' 	. $data->nama_pendidikan 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-edit" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_pendidikan 		. '" 
											data-pegawai="' . $data->id_pegawai 		. '" 
											data-nama="' 	. $data->nama_pendidikan 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 	. $data->kd_pendidikan 		. '" 
										data-pegawai="' . $data->id_pegawai 		. '" 
										data-nama="' 	. $data->nama_pendidikan 	. '"
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->status_pendidikan=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus" type="button" class="btn btn-success btn-xs" 
											data-pegawai="' . $data->id_pegawai 		. '"
											data-kode="' 	. $data->kd_pendidikan		. '"
											data-nama="' 	. $data->nama_pendidikan 	. '"
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-hapus" type="button" class="btn btn-danger btn-xs" 
											data-kode="' 	. $data->kd_pendidikan 		. '" 
											data-pegawai="' . $data->id_pegawai 		. '" 
											data-nama="' 	. $data->nama_pendidikan 	. '"
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus" type="button" class="btn btn-danger btn-xs" 
										data-kode="' 	. $data->kd_pendidikan 		. '" 
										data-pegawai="' . $data->id_pegawai 		. '" 
										data-nama="' 	. $data->nama_pendidikan 	. '"
										><i class="fa fa-times"></i>
									</button>';
			}
			$hasil[]			= array(
					'no'			=> $nomor,
					'jenjang' 		=> $data->alias_polines,
					'nama' 			=> $data->nama_pendidikan,
					'jurusan' 		=> $data->jurusan_pendidikan,
					'tahun' 		=> date('Y',strtotime($data->awal_pendidikan)) . '-' . date('Y',strtotime($data->akhir_pendidikan)),
					'ijazah' 		=> $link_file,
					'tempat' 		=> $data->tempat_pendidikan,
					'tandatangan' 	=> $data->kepala_pendidikan,
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
		$data		= $this->pendidikan_model->cari_tmp($kode);
		foreach ($data as $didik ) {
			$nama 		= $didik->nama_pendidikan;
			$nm_jenjang 		= $didik->nm_jenjang;
			$jurusan 		= $didik->jurusan_pendidikan;
			$awal 		= $didik->awal;
			$akhir 		= $didik->akhir;
			$ijazah 		= $didik->ijazah_pendidikan;
			$tempat 		= $didik->tempat_pendidikan;
			$kepala 		= $didik->kepala_pendidikan;
		}
		$pend2		= $this->pendidikan_model->cari_tmp2($kode);

		foreach ($pend2 as $didik2 ) {
			$nama2 		= $didik2->nama_pendidikan;
			$nm_jenjang2 = $didik2->nm_jenjang;
			$jurusan2 	= $didik2->jurusan_pendidikan;
			$awal2 		= $didik2->awal;
			$akhir2 		= $didik2->akhir;
			$ijazah2 	= $didik2->ijazah_pendidikan;
			$tempat2 	= $didik2->tempat_pendidikan;
			$kepala2 	= $didik2->kepala_pendidikan;

		}

		if($nama != $nama2){
			$data['nama'] = 'green';
			$data['a'] 		= $nama2;
			$data['a2'] 		= '#ff9900';
		}else{
			$data['nama'] = 'black';
			$data['a'] 		= '';
		}

		if($nm_jenjang != $nm_jenjang2){
			$data['nm_jenjang'] = 'green';
			$data['b'] = $nm_jenjang2;
			$data['b2'] = '#ff9900';
		}else{
			$data['nm_jenjang'] = 'black';
			$data['b'] = '';
		}

		if($jurusan != $jurusan2){
			$data['jurusan'] = 'green';
			$data['c'] 	= $jurusan2;
			$data['c2'] 		= '#ff9900';
		}else{
			$data['jurusan'] = 'black';
			$data['c'] 	= '';
		}

		if($awal != $awal2){
			$data['awala'] = 'green';
			$data['d'] 		= $awal2;
			$data['d2'] 		= '#ff9900';
		}else{
			$data['awala'] = 'black';
			$data['d'] 		= '';
		}

		if($akhir != $akhir2){
			$data['akhira'] = 'green';
			$data['e'] 		= $akhir2;
			$data['e2'] 		= '#ff9900';
		}else{
			$data['akhira'] = 'black';
			$data['e'] 		= '';
		}

		if($ijazah != $ijazah2){
			$data['ijazah'] = 'green';
			$data['f'] 	= $ijazah2;
			$data['f2'] 		= '#ff9900';
		}else{
			$data['ijazah'] = 'black';
			$data['f'] 	= '';
		}

		if($tempat != $tempat2){
			$data['tempat'] = 'green';
			$data['g'] 	= $tempat2;
			$data['g2'] 		= '#ff9900';
		}else{
			$data['tempat'] = 'black';
			$data['g'] 	= '';
		}

		if($kepala != $kepala2){
			$data['kepala'] = 'green';
			$data['h'] 	= $kepala2;
			$data['h2'] 		= '#ff9900';
		}else{
			$data['kepala'] = 'black';
			$data['h'] 	= '';
		}
		// if (count($data)>0){
			echo json_encode($data);
		// } else {
		// 	echo json_encode('false');
		// }
	}

	public function tambah() {
		$kode							= $this->pendidikan_model->buat_kode();
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_pendidikan'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->pendidikan_model->tambah(
							$kode,
							$_POST['id_pegawai'],
							$_POST['id_jenjang'],
							$_POST['nama_pendidikan'],
							$_POST['jurusan_pendidikan'],
							tgl_sql($_POST['awal_pendidikan']),
							tgl_sql($_POST['akhir_pendidikan']),
							$_POST['ijazah_pendidikan'],
							$_POST['tempat_pendidikan'],
							$_POST['kepala_pendidikan'],
							'0'
						);
				
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['file_pendidikan']['name'])) {

				} else {
					$upload 		= $this->upload->do_upload('file_pendidikan');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE t_pendidikan SET 
									  file_pendidikan='$nama_upload' 
									  WHERE kd_pendidikan='$kode';");
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
				'Tambah Data Pendidikan Formal',
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
		$kode							= $this->pendidikan_model->buat_kode();
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_pendidikan'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->pendidikan_model->tambah(
							$kode,
							$_POST['id_pegawai'],
							$_POST['id_jenjang'],
							$_POST['nama_pendidikan'],
							$_POST['jurusan_pendidikan'],
							tgl_sql($_POST['awal_pendidikan']),
							tgl_sql($_POST['akhir_pendidikan']),
							$_POST['ijazah_pendidikan'],
							$_POST['tempat_pendidikan'],
							$_POST['kepala_pendidikan'],
							'2'
						);
				
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['file_pendidikan']['name'])) {

				} else {
					$upload 		= $this->upload->do_upload('file_pendidikan');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE t_pendidikan SET 
									  file_pendidikan='$nama_upload' 
									  WHERE kd_pendidikan='$kode';");
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
				'Pengajuan Tambah Data Pendidikan Formal',
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
		$kode 							= $_POST['kode_pendidikan'];
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_pendidikan'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->pendidikan_model->edit(
							$kode,
							$_POST['id_pegawai'],
							$_POST['id_jenjang'],
							$_POST['nama_pendidikan'],
							$_POST['jurusan_pendidikan'],
							tgl_sql($_POST['awal_pendidikan']),
							tgl_sql($_POST['akhir_pendidikan']),
							$_POST['ijazah_pendidikan'],
							$_POST['tempat_pendidikan'],
							$_POST['kepala_pendidikan']
						);
				
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['file_pendidikan']['name'])) {

				} else {
					$upload 		= $this->upload->do_upload('file_pendidikan');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE t_pendidikan SET 
									  file_pendidikan='$nama_upload' 
									  WHERE kd_pendidikan='$kode';");
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
				'Edit Data Pendidikan Formal',
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
		$tmp 							= $this->pendidikan_model->buat_kode_tmp();
		$kode 							= $_POST['kode_pendidikan'];
		$nmfile 						= $kode . "_" .time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['file_name'] 			= $nmfile; //nama yang terupload nantinya

		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if (empty($_POST['id_pegawai']) && empty($_POST['nama_pendidikan'])) {
			$msg		= false;
		} else {
			$simpan 	= $this->pendidikan_model->tambah_tmp(
							$tmp,
							$kode,
							$_POST['id_pegawai'],
							$_POST['id_jenjang'],
							$_POST['nama_pendidikan'],
							$_POST['jurusan_pendidikan'],
							tgl_sql($_POST['awal_pendidikan']),
							tgl_sql($_POST['akhir_pendidikan']),
							$_POST['ijazah_pendidikan'],
							$_POST['tempat_pendidikan'],
							$_POST['kepala_pendidikan'],
							'0'
						);
			$simpan 	=	$this->db->query(
								"UPDATE t_pendidikan 
								SET status_pendidikan='3'
								WHERE kd_pendidikan='$kode';"
							);
			if ($simpan) {
				$msg	= true;

				if (empty($_FILES['file_pendidikan']['name'])) {
					$simpan 	=	$this->db->query(
								"UPDATE tmp_pendidikan A RIGHT JOIN t_pendidikan B 
								ON A.kd_pendidikan=B.kd_pendidikan 
								SET A.file_pendidikan=B.file_pendidikan
								WHERE A.id_tmp='$tmp';"
							);
				} else {
					$upload 		= $this->upload->do_upload('file_pendidikan');
					$data			= $this->upload->data();
					$nama_upload 	= $data['file_name'];

					$simpan			= $this->db->query("UPDATE tmp_pendidikan SET 
									  file_pendidikan='$nama_upload' 
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
				'Pengajuan Edit Data Pendidikan Formal',
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

	public function edit_sts($kode, $pegawai, $status) {
		$edit 				= $this->pendidikan_model->edit_sts($kode, $pegawai, $status);
		$msg				= false;
		if ($edit) {
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
				'Edit Status',
				date('Y-m-d H:i:s'),
				'#',
				'Edit Status Pendidikan Formal',
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
		$hapus 				= $this->pendidikan_model->hapus($kode);
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
				'Hapus Data Pendidikan Formal',
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
								"UPDATE t_pendidikan 
								SET status_pendidikan='4'
								WHERE kd_pendidikan='$kode';"
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
				'Pengajuan Hapus Data Pendidikan Formal',
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
						"UPDATE t_pendidikan SET status_pendidikan='0' 
						WHERE kd_pendidikan='$kode';"
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
				'Terima Pengajuan Tambah Data Pendidikan Formal',
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
						"UPDATE t_pendidikan SET status_pendidikan='1' 
						WHERE kd_pendidikan='$kode';"
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
				'Tolak Pengajuan Tambah Data Pendidikan Formal',
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
		$kode 		= $_POST['kode_pendidikan'];
		$pegawai 	= $_POST['id_pegawai'];
		$msg		= false;
		$edit 		= $this->pendidikan_model->terima_edit(
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
				'Terima Pengajuan Edit Data Pendidikan Formal',
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
						"UPDATE t_pendidikan SET status_pendidikan='0' 
						WHERE kd_pendidikan='$kode';"
		);
		$edit 		= $this->db->query(
						"UPDATE tmp_pendidikan SET status_pendidikan='1' 
						WHERE kd_pendidikan='$kode';"
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
				'Tolak Pengajuan Edit Data Pendidikan Formal',
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
						"UPDATE t_pendidikan SET status_pendidikan='1' 
						WHERE kd_pendidikan='$kode';"
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
				'Terima Pengajuan Hapus Data Pendidikan Formal',
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
						"UPDATE t_pendidikan SET status_pendidikan='0' 
						WHERE kd_pendidikan='$kode';"
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
				'Tolak Pengajuan Hapus Data Pendidikan Formal',
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
