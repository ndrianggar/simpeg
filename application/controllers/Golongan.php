<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Golongan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('golongan_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_golongan');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_golongan');
			}
		}
	}

	public function data() {
		$data					= $this->golongan_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kd_golongan,
					'nama' 			=> $data->nm_golongan,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-kode="' 	. $data->kd_golongan 	. '" 
														data-nama="' 	. $data->nm_golongan 	. '" 
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-kode="' 	. $data->kd_golongan 	. '" 
														data-nama="' 	. $data->nm_golongan 	. '" 
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
			$check				= $this->db->query("SELECT * FROM t_golongan WHERE nm_golongan='$nama' AND sts_golongan<>'1';");
			$msg				= false;
			if ($check->num_rows()==0){
				$kode				= $this->golongan_model->buat_kode();		
				$simpan 			= $this->golongan_model->tambah(
										$kode,
										$_POST['tambah-nama']
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
			$edit 				= $this->golongan_model->edit(
									$_POST['tambah-kode'],
									$_POST['tambah-nama']
								);
			$msg 				= false;
			if ($edit) {
				$msg			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($kode) {
		$hapus 				= $this->golongan_model->hapus($kode);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
