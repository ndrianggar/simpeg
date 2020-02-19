<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('jurusan_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_jurusan');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_jurusan');
			}
		}
	}

	public function data() {
		$data					= $this->jurusan_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kd_jurusan,
					'nama' 			=> '<a href="'.base_url().'prodi/'.$data->id_jurusan.'">' . $data->nm_jurusan . '</a>',
					'alias'			=> $data->alias_jurusan,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-id="' 		. $data->id_jurusan 	. '"
														data-kode="' 	. $data->kd_jurusan 	. '" 
														data-nama="' 	. $data->nm_jurusan 	. '"
														data-alias="' 	. $data->alias_jurusan 	. '"
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-id="' 		. $data->id_jurusan 	. '"
														data-kode="' 	. $data->kd_jurusan 	. '" 
														data-nama="' 	. $data->nm_jurusan 	. '" 
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
		if (isset($_POST['tambah-kode'])) {
			$kode 				= $_POST['tambah-kode'];
			$check				= $this->db->query("SELECT * FROM t_jurusan WHERE kd_jurusan='$kode' AND sts_jurusan<>'1';");
			$msg				= false;
			if ($check->num_rows()==0){
				$simpan 			= $this->jurusan_model->tambah(
										$_POST['tambah-kode'],
										$_POST['tambah-nama'],
										$_POST['tambah-alias']
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
			$edit 				= $this->jurusan_model->edit(
									$_POST['tambah-id'],
									$_POST['tambah-kode'],
									$_POST['tambah-nama'],
									$_POST['tambah-alias']
								);
			$msg 				= false;
			if ($edit) {
				$msg			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($id) {
		$hapus 				= $this->jurusan_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
