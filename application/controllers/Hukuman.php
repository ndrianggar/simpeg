<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hukuman extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('hukuman_model');
		$this->load->model('notice_model');
	}

	public function index() {
	
	}

	public function data($kode) {
		$data 					= $this->hukuman_model->cari_pegawai($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;

			if ($data->sk_file=='') {
				$link_file		= $data->jenis_hukuman;
			} else {
				$link_file		= '<a href="' 			. base_url() 				. 
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

			$hasil[]			= array(
					'no'			=> $nomor,
					'jenis' 		=> $data->jenis_hukuman,
					'sanksi'		=> $data->sanksi_hukuman,
					'pejabat' 		=> $data->sk_pejabat,
					'nomor' 		=> $link_file,
					'tanggal' 		=> date('d F Y', strtotime($data->tanggal)),
					'action' 		=> '<div class="btn-group">										
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-pegawai="' . $data->id_pegawai 	. '"
														data-kode="' 	. $data->kd_hukuman		. '"
														data-jenis="' 	. $data->jenis_hukuman 	. '" 
														data-sanksi="' 	. $data->sanksi_hukuman . '"
														data-pejabat="' . $data->sk_pejabat		. '"
														data-nomor="' 	. $data->sk_nomor		. '" 
														data-tanggal="' . $data->tanggal		. '"
														data-btn_file="' 	. $btn_file 	. '"
														><i class="fa fa-edit"></i></button>
								  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-kode="' 	. $data->kd_hukuman 	. '"
														data-nama="' 	. $data->jenis_hukuman	. '" 
														data-pegawai="' . $data->id_pegawai 	. '" 
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
		$kode							= $this->hukuman_model->buat_kode();
		$msg							= false;
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		$simpan 			= $this->hukuman_model->tambah(
								$kode,
								$_POST['id_pegawai'],
								$_POST['jenis_hukuman'],
								$_POST['sanksi_hukuman'],
								$_POST['pejabat_hukuman'],
								$_POST['nomor_hukuman'],
								tgl_sql($_POST['tanggal_hukuman']),
								'0'
							);
				
		if ($simpan) {
			$msg	= true;

		}

		if (empty($_FILES['file_hukuman']['name'])) {
		} else {
			$nmfile 					= "hukuman_sk_" . $kode ;
			$config['file_name'] 		= $nmfile;
			$this->upload->initialize($config);

			$upload 					= $this->upload->do_upload('file_hukuman');
			$data						= $this->upload->data();
			$nama_upload 				= $data['file_name'];
			$simpan						= $this->db->query("UPDATE t_hukuman SET 
										  sk_file='$nama_upload' 
										  WHERE kd_hukuman='$kode';");
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
				'Tambah Data Hukuman Disiplin',
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
		$kode							= $_POST['kd_hukuman'];
		$config['upload_path']			= './assets/pdf/';
		$config['allowed_types']		= 'pdf';
		$config['max_size']				= 10000;

		$this->load->library('upload', $config);
		
		$simpan 			= $this->hukuman_model->edit(
								$kode,
								$_POST['id_pegawai'],
								$_POST['jenis_hukuman'],
								$_POST['sanksi_hukuman'],
								$_POST['pejabat_hukuman'],
								$_POST['nomor_hukuman'],
								tgl_sql($_POST['tanggal_hukuman'])
							);
				
		if ($simpan) {
			$msg	= true;

		}
		if (empty($_FILES['file_hukuman']['name'])) {
		} else {
			$nmfile 					= "hukuman_sk_" . $kode ;
			$config['file_name'] 		= $nmfile;
			$this->upload->initialize($config);

			$upload 					= $this->upload->do_upload('file_hukuman');
			$data						= $this->upload->data();
			$nama_upload 				= $data['file_name'];
			$simpan						= $this->db->query("UPDATE t_hukuman SET 
										  sk_file='$nama_upload' 
										  WHERE kd_hukuman='$kode';");
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
				'Edit Data Hukuman Disiplin',
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
		$hapus 				= $this->hukuman_model->hapus($kode);
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
				'Hapus Data Hukuman Disiplin',
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
