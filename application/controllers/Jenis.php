<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('jenis_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_jenis');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_jenis');
			}
		}
	}

	public function data() {
		$data					= $this->jenis_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kd_jenis,
					'nama' 			=> $data->nm_jenis,
					'jenis'			=> $data->alias_jenis,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-id="' 		. $data->id_jenis 		. '"
														data-kode="' 	. $data->kd_jenis 		. '" 
														data-nama="' 	. $data->nm_jenis 		. '"
														data-alias="' 	. $data->alias_jenis 	. '" 
														><i class="fa fa-edit"></i></button>' 	.
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-id="' 		. $data->id_jenis 	. '" 
														data-nama="' 	. $data->nm_jenis 	. '" 
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
			$id 				= $this->jenis_model->buat_id();
			$nama 				= $_POST['tambah-nama'];
			$check				= $this->db->query("SELECT * FROM t_jenis WHERE nm_jenis='$nama' AND sts_jenis<>'1';");
			$msg 				= false;
			if ($check->num_rows()==0){
				$simpan 			= $this->jenis_model->tambah(
										$id,
										$_POST['tambah-kode'],
										$_POST['tambah-nama'],
										$_POST['tambah-jenis']
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
			$edit 				= $this->jenis_model->edit(
									$_POST['tambah-id'],
									$_POST['tambah-kode'],
									$_POST['tambah-nama'],
									$_POST['tambah-jenis']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($kode) {
		$hapus 				= $this->jenis_model->hapus($kode);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
