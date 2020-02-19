<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('prodi_model');
		$this->load->model('jurusan_model');
		$this->load->model('jenjang_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$data['jurusan']	= $this->jurusan_model->cari_semua();
				$data['jenjang']	= $this->jenjang_model->cari_semua();
				$this->load->view('admin/master/data_prodi', $data );
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$data['jurusan']	= $this->jurusan_model->cari_semua();
				$data['jenjang']	= $this->jenjang_model->cari_semua();
				$this->load->view('pimpinan/master/data_prodi', $data );
			}
		}
	}

	public function data() {
		$data					= $this->prodi_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'jurusan'		=> $data->nm_jurusan,
					'kode' 			=> $data->kd_prodi,
					'nama' 			=> $data->nm_prodi,
					'alias' 		=> $data->alias_prodi,
					'jenjang'		=> $data->jenjang,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-id="' 		. $data->id_prodi 		. '" 
														data-kode="' 	. $data->kd_prodi 		. '" 
														data-nama="' 	. $data->nm_prodi 		. '"
														data-alias="' 	. $data->alias_prodi 	. '" 
														data-jurusan="' . $data->id_jurusan 	. '" 
														data-jenjang="' . $data->id_jenjang 	. '" 
														><i class="fa fa-edit"></i></button>' 	.
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-id="' 		. $data->id_prodi 		. '" 
														data-nama="' 	. $data->nm_prodi 		. '" 
														><i class="fa fa-trash-o"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function data_prodi($kode) {
		$data			= $this->prodi_model->data_prodi($kode);		
		$result			= '';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->id_prodi . '">' . $data->nm_prodi . '</option>';
		}
		echo json_encode($result);
	}
	
	public function tambah() {
		if (isset($_POST['tambah-nama'])) {
			$nama 				= $_POST['tambah-nama'];
			$check				= $this->db->query("SELECT * FROM t_prodi WHERE nm_prodi='$nama' AND sts_prodi<>'1';");
			$msg				= false;
			if ($check->num_rows()==0){
				$simpan 			= $this->prodi_model->tambah(
										$_POST['tambah-jurusan'],
										$_POST['tambah-kode'],
										$_POST['tambah-nama'],
										$_POST['tambah-alias'],
										$_POST['tambah-jenjang']
									);
				
				if ($simpan) {
					$msg 		= true;
				}
			}			
			echo json_encode($msg);
		}
	}
	
	public function edit() {
		if (isset($_POST['tambah-id'])) {
			$edit 				= $this->prodi_model->edit(
									$_POST['tambah-id'],
									$_POST['tambah-jurusan'],
									$_POST['tambah-kode'],
									$_POST['tambah-nama'],
									$_POST['tambah-alias'],
									$_POST['tambah-jenjang']
								);
			$msg 				= false;
			if ($edit) {
				$msg			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($kode) {
		$hapus 				= $this->prodi_model->hapus($kode);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
