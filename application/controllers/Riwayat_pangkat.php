<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_pangkat extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('riwayat_pangkat_model');
		$this->load->model('notice_model');
	}

	public function index() {
	
	}

	public function data($kode) {
		$data 					= $this->riwayat_pangkat_model->cari_pegawai($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$btn_status 		= '';

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

			if ($data->sk_file=='') {
				$btn_file		= '';
			} else {
				$btn_file		=  base_url() . 'assets/pdf/' . $data->sk_file ;
			}

			if ($data->status_riwayat_pangkat=='A') {
				$btn_status 		= '<button id="btn-ganti" type="button" class="btn btn-success btn-xs" 
											data-kode="' 	. $data->kd_riwayat_pangkat 	. '" 
											data-pegawai="' . $kode 						. '"
											data-status="' 	. $data->status_riwayat_pangkat . '" 
											><i class="fa fa-refresh"> Aktif</i>
									  </button>';
			} elseif ($data->status_riwayat_pangkat=='0') {
				$btn_status 		= '<button id="btn-ganti" type="button" class="btn btn-dark btn-xs" 
											data-kode="' 	. $data->kd_riwayat_pangkat 	. '" 
											data-pegawai="' . $kode 						. '"
											data-status="' 	. $data->status_riwayat_pangkat . '" 
											><i class="fa fa-refresh"> Non-Aktif</i>
									  </button>';
			}
			$hasil[]			= array(
					'no'			=> $nomor,
					'pangkat' 		=> $data->nm_pangkat,
					'golongan'		=> $data->gol_pangkat,
					'tmt' 			=> date('d F Y', strtotime($data->tmt_pangkat)),
					'gaji' 			=> number_format($data->gaji_pangkat),
					'pejabat' 		=> $data->sk_pejabat,
					'nomor' 		=> $file_sk,
					'tanggal' 		=> date('d F Y', strtotime($data->sk_tanggal)),
					'dasar' 		=> $data->dasar_pangkat,
					'pmk' 		=> $data->pmk,
					'status'		=> $btn_status,
					'action' 		=> '<div class="btn-group">										
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-pegawai="' . $data->id_pegawai 		. '"
														data-kode="' 	. $data->kd_riwayat_pangkat	. '"
														data-pangkat="' . $data->id_pangkat 		. '" 
														data-nama="' 	. $data->nm_pangkat 		. '"
														data-tmt="' 	. date('d-m-Y',strtotime($data->tmt_pangkat))	. '"
														data-gaji="' 	. $data->gaji_pangkat 		. '"
														data-pejabat="' . $data->sk_pejabat			. '"
														data-nomor="' 	. $data->sk_nomor			. '" 
														data-tanggal="' . date('d-m-Y',strtotime($data->sk_tanggal))	. '"
														data-dasar="' 	. $data->dasar_pangkat		. '" 
														data-pmk="' 	. $data->pmk			. '" 
														data-btn_file="' 	. $btn_file 	. '"
														><i class="fa fa-edit"></i></button>
								  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-kode="' 	. $data->kd_riwayat_pangkat . '"
														data-nama="' 	. $data->nm_pangkat 		. '" 
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
		$kode							= $this->riwayat_pangkat_model->buat_kode();
		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if ($_POST['tmt_pangkat']=='') {
			$tmt_pangkat	= '0000-00-00';
		} else {
			$tmt_pangkat	= substr($_POST['tmt_pangkat'],6,4) . '-' . substr($_POST['tmt_pangkat'],3,2) . '-' . substr($_POST['tmt_pangkat'],0,2);
		}
		if ($_POST['tanggal_sk']=='') {
			$tanggal_sk		= '0000-00-00';
		} else {
			$tanggal_sk 	= substr($_POST['tanggal_sk'],6,4) . '-' . substr($_POST['tanggal_sk'],3,2) . '-' . substr($_POST['tanggal_sk'],0,2);
		}
		
		$simpan 			= $this->riwayat_pangkat_model->tambah(
								$kode,
								$_POST['id_pegawai'],
								$_POST['kd_pangkat'],
								$tmt_pangkat,
								$_POST['gaji_pangkat'],
								$_POST['pejabat_sk'],
								$_POST['nomor_sk'],
								$tanggal_sk,
								$_POST['dasar_pangkat'],
								$_POST['pmk']
							);
				
		if ($simpan) {
			$msg	= true;

			if (empty($_FILES['file_sk']['name'])) {
			} else {
				$nmfile 					= "rp_sk_" . $kode ;
				$config['file_name'] 		= $nmfile;
				$this->upload->initialize($config);

				$upload 					= $this->upload->do_upload('file_sk');
				$data						= $this->upload->data();
				$nama_upload 				= $data['file_name'];
				$simpan						= $this->db->query("UPDATE t_riwayat_pangkat SET 
											  sk_file='$nama_upload' 
											  WHERE kd_riwayat_pangkat='$kode';");
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
				'Tambah Data Riwayat Pangkat',
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
		$kode							= $_POST['kd_riwayat_pangkat'];
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		if ($_POST['tmt_pangkat']=='') {
			$tmt_pangkat	= '0000-00-00';
		} else {
			$tmt_pangkat	= substr($_POST['tmt_pangkat'],6,4) . '-' . substr($_POST['tmt_pangkat'],3,2) . '-' . substr($_POST['tmt_pangkat'],0,2);
		}
		if ($_POST['tanggal_sk']=='') {
			$tanggal_sk		= '0000-00-00';
		} else {
			$tanggal_sk 	= substr($_POST['tanggal_sk'],6,4) . '-' . substr($_POST['tanggal_sk'],3,2) . '-' . substr($_POST['tanggal_sk'],0,2);
		}
		
		$simpan 			= $this->riwayat_pangkat_model->edit(
								$kode,
								$_POST['id_pegawai'],
								$_POST['kd_pangkat'],
								$tmt_pangkat,
								$_POST['gaji_pangkat'],
								$_POST['pejabat_sk'],
								$_POST['nomor_sk'],
								$tanggal_sk,
								$_POST['dasar_pangkat'],
								$_POST['pmk']

							);
				
		if ($simpan) {
			$msg	= true;

			if (empty($_FILES['file_sk']['name'])) {
			} else {
				$nmfile 					= "rp_sk_" . $kode ;
				$config['file_name'] 		= $nmfile;
				$this->upload->initialize($config);

				$upload 					= $this->upload->do_upload('file_sk');
				$data						= $this->upload->data();
				$nama_upload 				= $data['file_name'];
				$simpan						= $this->db->query("UPDATE t_riwayat_pangkat SET 
											  sk_file='$nama_upload' 
											  WHERE kd_riwayat_pangkat='$kode';");
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
				'Edit Data Riwayat Pangkat',
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
		$edit 				= $this->riwayat_pangkat_model->edit_sts($kode, $pegawai, $status);
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
				'Edit Data',
				date('Y-m-d H:i:s'),
				'#',
				'Edit Data Riwayat Pangkat',
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
		$hapus 				= $this->riwayat_pangkat_model->hapus($kode);
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
		// 		'Hapus Data Riwayat Pangkat',
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
