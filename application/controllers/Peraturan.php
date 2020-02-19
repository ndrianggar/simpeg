<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peraturan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('peraturan_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_peraturan');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_peraturan');
			}
		}
	}

	public function data() {
		$data					= $this->peraturan_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kd_peraturan,
					'nama' 			=> $data->nm_peraturan,
					'tanggal' 		=> $data->tgl_peraturan,
					'kepala' 		=> $data->kepala_peraturan,
					'action' 		=> '<div class="btn-group">
											<button id="btn-file" type="button" class="btn btn-default btn-xs" 
															data-file="' 	. base_url() . 'assets/foto/' . $data->file_peraturan 	. '" 
															><i class="fa fa-file-pdf-o"></i></button>
											<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
															data-kode="' 	. $data->kd_peraturan 	. '" 
															data-nama="' 	. $data->nm_peraturan 	. '" 
															data-tanggal="' . date('d-m-Y', strtotime($data->tgl_peraturan)) . '"
															data-kepala="' 	. $data->kepala_peraturan 	. '"
															><i class="fa fa-edit"></i></button>
											<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
															data-kode="' 	. $data->kd_peraturan 	. '" 
															data-nama="' 	. $data->nm_peraturan 	. '" 
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
		if ($_POST['nama']!=='') {
			$nama 				= $_POST['nama'];
			if ($_POST['tanggal']=='') {
				$tanggal			= '0000-00-00';
			} else {
				$tanggal 			= substr($_POST['tanggal'],6,4) . '-' . substr($_POST['tanggal'],3,2) . '-' . substr($_POST['tanggal'],0,2);
			}
			$check				= $this->db->query("SELECT * FROM t_peraturan WHERE nm_peraturan='$nama' AND sts_peraturan<>'1';");
			$msg 				= false;
			if ($check->num_rows()==0){
				$kode				= $this->peraturan_model->buat_kode();		
				$simpan 			= $this->peraturan_model->tambah(
										$kode,
										$_POST['nama'],
										$tanggal,
										$_POST['kepala']
									);
				
				if ($simpan) {
					$msg 		= true;

					// Simpan Foto & File jika ada
					$config['upload_path']			= './assets/foto/';
					$config['allowed_types']		= 'jpg|png|pdf';
					$config['max_size']				= 10000;
					
					$this->load->library('upload', $config);
					if (empty($_FILES['file']['name'])) {

					} else {
						$upload 		= $this->upload->do_upload('file');
						$data			= $this->upload->data();
						$nama_upload 	= $data['file_name'];

						$simpan			= $this->db->query("UPDATE t_peraturan SET 
										  file_peraturan='$nama_upload' 
										  WHERE kd_peraturan='$kode';");
					}
				}
			}			
		} else {
			$msg				= false;
		}
		echo json_encode($msg);
	}
	
	public function edit() {
		$kode 					= $_POST['kode'];
		if ($_POST['tanggal']=='') {
			$tanggal			= '0000-00-00';
		} else {
			$tanggal 			= substr($_POST['tanggal'],6,4) . '-' . substr($_POST['tanggal'],3,2) . '-' . substr($_POST['tanggal'],0,2);
		}

		if (($_POST['kode']!=='') && ($_POST['nama']!=='')) {
			$edit 				= $this->peraturan_model->edit(
									$kode,
									$_POST['nama'],
									$tanggal,
									$_POST['kepala']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			// Simpan Foto & File jika ada
			$config['upload_path']			= './assets/foto/';
			$config['allowed_types']		= 'jpg|png|pdf';
			$config['max_size']				= 10000;
			
			$this->load->library('upload', $config);
			if (empty($_FILES['file']['name'])) {

			} else {
				$upload 		= $this->upload->do_upload('file');
				$data			= $this->upload->data();
				$nama_upload 	= $data['file_name'];

				$simpan			= $this->db->query("UPDATE t_peraturan SET 
								  file_peraturan='$nama_upload' 
								  WHERE kd_peraturan='$kode';");
			}
		} else {
			$msg 		= false;
		}

		echo json_encode($msg);
	}
	
	public function hapus($kode) {
		$hapus 				= $this->peraturan_model->hapus($kode);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
