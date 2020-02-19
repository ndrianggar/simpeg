<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_jabatan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('riwayat_jabatan_model');
		$this->load->model('notice_model');
	}

	public function index() {
	
	}

	public function data($kode) {
		$data 					= $this->riwayat_jabatan_model->cari_pegawai($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$btn_status 		='';

			if ($data->sk_file=='') {
				$file_sk		= $data->sk_nomor;
			} else {
				$file_sk		= '<a href="' 			. base_url() 				. 
								  'assets/pdf/' 		. $data->sk_file 	. 
								  '" target="_Blank" style="color:blue;" 
								  data-toggle="tooltip" data-placement="left" 
								  title="Klik untuk melihat File"><b>' 	
								  . $data->sk_nomor 	.  '</b></a>';
			}

			if ($data->spmt_file=='') {
				$file_spmt		= $data->spmt_nomor;
			} else {
				$file_spmt		= '<a href="' 			. base_url() 				. 
								  'assets/pdf/' 		. $data->spmt_file 	. 
								  '" target="_Blank" style="color:blue;" 
								  data-toggle="tooltip" data-placement="left" 
								  title="Klik untuk melihat File"><b>' 	
								  . $data->spmt_nomor 	.  '</b></a>';
			}

			if ($data->spmj_file=='') {
				$file_spmj		= $data->spmj_nomor;
			} else {
				$file_spmj		= '<a href="' 			. base_url() 				. 
								  'assets/pdf/' 		. $data->spmj_file 	. 
								  '" target="_Blank" style="color:blue;" 
								  data-toggle="tooltip" data-placement="left" 
								  title="Klik untuk melihat File"><b>' 	
								  . $data->spmj_nomor 	.  '</b></a>';
			}

			if ($data->sk_file=='') {
				$btn_file_sk		= '';
			} else {
				$btn_file_sk		=  base_url() . 'assets/pdf/' . $data->sk_file ;
			}

			if ($data->spmt_file=='') {
				$btn_file_spmt		= '';
			} else {
				$btn_file_spmt		=  base_url() . 'assets/pdf/' . $data->spmt_file ;
			}

			if ($data->spmj_file=='') {
				$btn_file_spmj		= '';
			} else {
				$btn_file_spmj		=  base_url() . 'assets/pdf/' . $data->spmj_file ;
			}

			if ($data->status_riwayat_jabatan=='A') {
				$btn_status 	= '<button id="btn-ganti" type="button" class="btn btn-success btn-xs" 
										data-kode="' 	. $data->kd_riwayat_jabatan 	. '" 
										data-status="' 	. $data->status_riwayat_jabatan . '" 
										><i class="fa fa-refresh"> Aktif</i>
								  </button>';
			} elseif ($data->status_riwayat_jabatan=='0') {
				$btn_status 	= '<button id="btn-ganti" type="button" class="btn btn-dark btn-xs" 
										data-kode="' 	. $data->kd_riwayat_jabatan 	. '" 
										data-status="' 	. $data->status_riwayat_jabatan . '" 
										><i class="fa fa-refresh"> Non-Aktif</i>
								  </button>';
			}
			$hasil[]			= array(
					'no'			=> $nomor,
					'jabatan' 		=> $data->nm_jabatan,
					'tmt' 			=> date('d F Y', strtotime($data->tmt_jabatan)),
					'gaji' 			=> number_format($data->gaji_jabatan),
					'lantik' 		=> date('d F Y', strtotime($data->tmt_pelantikan)),
					'pejabat' 		=> $data->sk_pejabat,
					'nomor' 		=> $file_sk,
					'tanggal' 		=> date('d F Y', strtotime($data->sk_tanggal)),
					'nomor_spmt' 		=> $file_spmt,
					'tanggal_spmt' 		=> date('d F Y', strtotime($data->spmt_tanggal)),
					'nomor_spmj' 		=> $file_spmj,
					'tanggal_spmj' 		=> date('d F Y', strtotime($data->spmj_tanggal)),
					'status'		=> $btn_status,
					'action' 		=> '<div class="btn-group">										
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-pegawai="' . $data->id_pegawai 		. '"
														data-kode="' 	. $data->kd_riwayat_jabatan	. '"
														data-jabatan="' . $data->kd_jabatan 		. '" 
														data-jenis="' . $data->kd_jenis 		. '" 
														data-penempatan="' . $data->id_penempatan 		. '" 
														data-tmt="' 	. date('d-m-Y',strtotime($data->tmt_jabatan))	. '"
														data-gaji="' 	. $data->gaji_jabatan 		. '"
														data-pejabat="' . $data->sk_pejabat			. '"
														data-nomor="' 	. $data->sk_nomor			. '" 
														data-tanggal="' . date('d-m-Y',strtotime($data->sk_tanggal))	. '"
														data-nomor_spmt="' 	. $data->spmt_nomor			. '" 
														data-tanggal_spmt="' . date('d-m-Y',strtotime($data->spmt_tanggal))	. '"
														data-nomor_spmj="' 	. $data->spmj_nomor			. '" 
														data-tanggal_spmj="' . date('d-m-Y',strtotime($data->spmj_tanggal))	. '"
														data-btn_file_sk="' 	. $btn_file_sk 	. '"
														data-btn_file_spmt="' 	. $btn_file_spmt 	. '"
														data-btn_file_spmj="' 	. $btn_file_spmj 	. '"
														><i class="fa fa-edit"></i></button>
								  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-kode="' 	. $data->kd_riwayat_jabatan . '"
														data-nama="' 	. $data->nm_jabatan 		. '" 
														><i class="fa fa-trash-o"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}
	
	public function tambah() {
		$kode							= $this->riwayat_jabatan_model->buat_kode();
		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if ($_POST['tmt_jabatan']=='') {
			$tmt_jabatan	= '0000-00-00';
		} else {
			$tmt_jabatan	= substr($_POST['tmt_jabatan'],6,4) . '-' . substr($_POST['tmt_jabatan'],3,2) . '-' . substr($_POST['tmt_jabatan'],0,2);
		}
		if ($_POST['tmt_pelantikan']=='') {
			$tmt_pelantikan	= '0000-00-00';
		} else {
			$tmt_pelantikan	= substr($_POST['tmt_pelantikan'],6,4) . '-' . substr($_POST['tmt_pelantikan'],3,2) . '-' . substr($_POST['tmt_pelantikan'],0,2);
		}
		if ($_POST['tanggal_sk']=='') {
			$tanggal_sk		= '0000-00-00';
		} else {
			$tanggal_sk 	= substr($_POST['tanggal_sk'],6,4) . '-' . substr($_POST['tanggal_sk'],3,2) . '-' . substr($_POST['tanggal_sk'],0,2);
		}
		if ($_POST['tanggal_spmt']=='') {
			$tanggal_spmt	= '0000-00-00';
		} else {
			$tanggal_spmt 	= substr($_POST['tanggal_spmt'],6,4) . '-' . substr($_POST['tanggal_spmt'],3,2) . '-' . substr($_POST['tanggal_spmt'],0,2);
		}
		if ($_POST['tanggal_spmj']=='') {
			$tanggal_spmj	= '0000-00-00';
		} else {
			$tanggal_spmj 	= substr($_POST['tanggal_spmj'],6,4) . '-' . substr($_POST['tanggal_spmj'],3,2) . '-' . substr($_POST['tanggal_spmj'],0,2);
		}
		$simpan 			= $this->riwayat_jabatan_model->tambah(
								$kode,
								$_POST['id_pegawai'],
								$_POST['kd_jabatan'],
								$tmt_jabatan,
								$tmt_pelantikan,
								$_POST['gaji_jabatan'],
								$_POST['pejabat_sk'],
								$_POST['nomor_sk'],
								$tanggal_sk,
								$_POST['nomor_spmt'],
								$tanggal_spmt,
								$_POST['nomor_spmj'],
								$tanggal_spmj,
								$_POST['id_penempatan']
							);
				
		if ($simpan) {
			$msg	= true;

			if (empty($_FILES['file_sk']['name'])) {
			} else {
				$nmfile 					= "rj_sk_" . $kode ;
				$config['file_name'] 		= $nmfile;
				$this->upload->initialize($config);

				$upload 					= $this->upload->do_upload('file_sk');
				$data						= $this->upload->data();
				$nama_upload 				= $data['file_name'];
				$simpan						= $this->db->query("UPDATE t_riwayat_jabatan SET 
											  sk_file='$nama_upload' 
											  WHERE kd_riwayat_jabatan='$kode';");
			}

			if (empty($_FILES['file_spmt']['name'])) {
			} else {
				$nmfile 					= "rj_spmt_" . $kode ;
				$config['file_name'] 		= $nmfile;
				$this->upload->initialize($config);

				$upload 					= $this->upload->do_upload('file_spmt');
				$data						= $this->upload->data();
				$nama_upload 				= $data['file_name'];
				$simpan						= $this->db->query("UPDATE t_riwayat_jabatan SET 
											  spmt_file='$nama_upload' 
											  WHERE kd_riwayat_jabatan='$kode';");
			}

			if (empty($_FILES['file_spmj']['name'])) {
			} else {
				$nmfile 					= "rj_spmj_" . $kode ;
				$config['file_name'] 		= $nmfile;
				$this->upload->initialize($config);

				$upload 					= $this->upload->do_upload('file_spmj');
				$data						= $this->upload->data();
				$nama_upload 				= $data['file_name'];
				$simpan						= $this->db->query("UPDATE t_riwayat_jabatan SET 
											  spmj_file='$nama_upload' 
											  WHERE kd_riwayat_jabatan='$kode';");
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
				'Tambah Data Riwayat Jabatan',
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
		$msg							= false;
		$kode							= $_POST['kd_riwayat_jabatan'];
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if ($_POST['tmt_jabatan']=='') {
			$tmt_jabatan	= '0000-00-00';
		} else {
			$tmt_jabatan	= substr($_POST['tmt_jabatan'],6,4) . '-' . substr($_POST['tmt_jabatan'],3,2) . '-' . substr($_POST['tmt_jabatan'],0,2);
		}
		if ($_POST['tmt_pelantikan']=='') {
			$tmt_pelantikan	= '0000-00-00';
		} else {
			$tmt_pelantikan	= substr($_POST['tmt_pelantikan'],6,4) . '-' . substr($_POST['tmt_pelantikan'],3,2) . '-' . substr($_POST['tmt_pelantikan'],0,2);
		}
		if ($_POST['tanggal_sk']=='') {
			$tanggal_sk		= '0000-00-00';
		} else {
			$tanggal_sk 	= substr($_POST['tanggal_sk'],6,4) . '-' . substr($_POST['tanggal_sk'],3,2) . '-' . substr($_POST['tanggal_sk'],0,2);
		}
		if ($_POST['tanggal_spmt']=='') {
			$tanggal_spmt	= '0000-00-00';
		} else {
			$tanggal_spmt 	= substr($_POST['tanggal_spmt'],6,4) . '-' . substr($_POST['tanggal_spmt'],3,2) . '-' . substr($_POST['tanggal_spmt'],0,2);
		}
		if ($_POST['tanggal_spmj']=='') {
			$tanggal_spmj	= '0000-00-00';
		} else {
			$tanggal_spmj 	= substr($_POST['tanggal_spmj'],6,4) . '-' . substr($_POST['tanggal_spmj'],3,2) . '-' . substr($_POST['tanggal_spmj'],0,2);
		}
		$simpan 			= $this->riwayat_jabatan_model->edit(
								$kode,
								$_POST['id_pegawai'],
								$_POST['kd_jabatan'],
								$tmt_jabatan,
								$tmt_pelantikan,
								$_POST['gaji_jabatan'],
								$_POST['pejabat_sk'],
								$_POST['nomor_sk'],
								$tanggal_sk,
								$_POST['nomor_spmt'],
								$tanggal_spmt,
								$_POST['nomor_spmj'],
								$tanggal_spmj,
								$_POST['id_penempatan']
							);
				
		if ($simpan) {
			$msg	= true;

			if (empty($_FILES['file_sk']['name'])) {
			} else {
				$nmfile 					= "rj_sk_" . $kode ;
				$config['file_name'] 		= $nmfile;
				$this->upload->initialize($config);

				$upload 					= $this->upload->do_upload('file_sk');
				$data						= $this->upload->data();
				$nama_upload 				= $data['file_name'];
				$simpan						= $this->db->query("UPDATE t_riwayat_jabatan SET 
											  sk_file='$nama_upload' 
											  WHERE kd_riwayat_jabatan='$kode';");
			}

			if (empty($_FILES['file_spmt']['name'])) {
			} else {
				$nmfile 					= "rj_spmt_" . $kode ;
				$config['file_name'] 		= $nmfile;
				$this->upload->initialize($config);

				$upload 					= $this->upload->do_upload('file_spmt');
				$data						= $this->upload->data();
				$nama_upload 				= $data['file_name'];
				$simpan						= $this->db->query("UPDATE t_riwayat_jabatan SET 
											  spmt_file='$nama_upload' 
											  WHERE kd_riwayat_jabatan='$kode';");
			}

			if (empty($_FILES['file_spmj']['name'])) {
			} else {
				$nmfile 					= "rj_spmj_" . $kode ;
				$config['file_name'] 		= $nmfile;
				$this->upload->initialize($config);

				$upload 					= $this->upload->do_upload('file_spmj');
				$data						= $this->upload->data();
				$nama_upload 				= $data['file_name'];
				$simpan						= $this->db->query("UPDATE t_riwayat_jabatan SET 
											  spmj_file='$nama_upload' 
											  WHERE kd_riwayat_jabatan='$kode';");
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
				'Edit Data Riwayat Jabatan',
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

	public function edit_sts($kode, $status) {
		$edit 				= $this->riwayat_jabatan_model->edit_sts($kode, $status);
		$msg				= false;
		if ($edit) {
			$msg 			= true;
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
				'Edit Data Riwayat Jabatan',
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
		$hapus 				= $this->riwayat_jabatan_model->hapus($kode);
		$msg				= false;
		if ($hapus) {
			$msg 			= true;
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
		// 		'Hapus Data Riwayat Jabatan',
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
}
