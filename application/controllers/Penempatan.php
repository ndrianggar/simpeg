<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penempatan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('penempatan_model');
		$this->load->model('jurusan_model');
		$this->load->model('prodi_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$data['jurusan'] 	= $this->jurusan_model->cari_semua();
				$data['prodi']		= $this->prodi_model->cari_semua();
				$this->load->view('admin/master/data_penempatan', $data);
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$data['jurusan'] 	= $this->jurusan_model->cari_semua();
				$data['prodi']		= $this->prodi_model->cari_semua();
				$this->load->view('pimpinan/master/data_penempatan', $data);
			}
		}
	}

	public function data() {
		$data					= $this->penempatan_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama' 			=> $data->nm_penempatan,
					'jurusan' 		=> $data->nama_jurusan,
					'prodi' 		=> $data->nama_prodi,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-kode="' 		. $data->id_penempatan 	. '" 
														data-nama="' 		. $data->nm_penempatan 	. '" 
														data-jurusan="' 	. $data->id_jurusan 	. '" 
														data-prodi="' 		. $data->id_prodi	 	. '" 
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-kode="' 	. $data->id_penempatan 	. '" 
														data-nama="' 	. $data->nm_penempatan 	. '" 
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
		if (isset($_POST['tambah-nama'])) {
			$nama 				= $_POST['tambah-nama'];
			$check				= $this->db->query("SELECT * FROM t_penempatan WHERE nm_penempatan='$nama' AND sts_penempatan<>'1';");
			$msg 				= false;
			if ($check->num_rows()==0){
				$simpan 			= $this->penempatan_model->tambah(
										$_POST['tambah-nama'],
										$_POST['tambah-jurusan'],
										$_POST['tambah-prodi']
									);
				
				if ($simpan) {
					$msg 		= true;
				}
			}			
			echo json_encode($msg);
		}
	}
	
	public function edit() {
		if (isset($_POST['tambah-kode'])) {
			$edit 				= $this->penempatan_model->edit(
									$_POST['tambah-kode'],
									$_POST['tambah-nama'],
									$_POST['tambah-jurusan'],
									$_POST['tambah-prodi']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($kode) {
		$hapus 				= $this->penempatan_model->hapus($kode);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
