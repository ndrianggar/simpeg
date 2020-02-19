<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenjang extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('jenjang_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_jenjang');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_jenjang');
			}
		}
	}

	public function data() {
		$data					= $this->jenjang_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kd_jenjang,
					'nama' 			=> $data->nm_jenjang,
					'alias1'		=> $data->alias_polines,
					'alias2'		=> $data->alias_umum,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-id="' 		. $data->id_jenjang 	. '"
														data-kode="' 	. $data->kd_jenjang 	. '" 
														data-nama="' 	. $data->nm_jenjang 	. '"
														data-alias1="' 	. $data->alias_polines 	. '"
														data-alias2="' 	. $data->alias_umum 	. '"
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-id="' 		. $data->id_jenjang 	. '"
														data-kode="' 	. $data->kd_jenjang 	. '" 
														data-nama="' 	. $data->nm_jenjang 	. '" 
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
			$check				= $this->db->query("SELECT * FROM t_jenjang WHERE kd_jenjang='$kode' AND sts_jenjang<>'1';");
			$msg 				= false;
			if ($check->num_rows()==0){
				$simpan 			= $this->jenjang_model->tambah(
										$_POST['tambah-kode'],
										$_POST['tambah-nama'],
										$_POST['tambah-alias1'],
										$_POST['tambah-alias2']
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
			$edit 				= $this->jenjang_model->edit(
									$_POST['tambah-id'],
									$_POST['tambah-kode'],
									$_POST['tambah-nama'],
									$_POST['tambah-alias1'],
									$_POST['tambah-alias2']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($id) {
		$hapus 				= $this->jenjang_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
