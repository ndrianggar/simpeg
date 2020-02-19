<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_kursus extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('jenis_kursus_model');
	}

	public function index() {
		$this->load->view('admin/master/data_jenis_kursus');
	}

	public function data() {
		$data					= $this->jenis_kursus_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kd_jenis_kursus,
					'nama' 			=> $data->nm_jenis_kursus,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-id="' 		. $data->id_jenis_kursus 	. '"
														data-kode="' 	. $data->kd_jenis_kursus 	. '" 
														data-nama="' 	. $data->nm_jenis_kursus 	. '"
														><i class="fa fa-edit"></i></button>
								  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-id="' 		. $data->id_jenis_kursus 	. '" 
														data-nama="' 	. $data->nm_jenis_kursus 	. '" 
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
		if (isset($_POST['kode'])) {
			$id 				= $this->jenis_kursus_model->buat_id();
			$kode 				= $_POST['kode'];
			$check				= $this->db->query("SELECT * FROM t_jenis_kursus WHERE kd_jenis_kursus='$kode' AND sts_jenis_kursus<>'1';");
			$msg 				= false;
			if ($check->num_rows()==0){
				$simpan 			= $this->jenis_kursus_model->tambah(
										$id,
										$_POST['kode'],
										$_POST['nama']
									);
				
				if ($simpan) {
					$msg 		= true;
				}
			}			
			echo json_encode($msg);
		}
	}
	
	public function edit() {
		if (isset($_POST['kode'])) {
			$edit 				= $this->jenis_kursus_model->edit(
									$_POST['id'],
									$_POST['kode'],
									$_POST['nama']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($kode) {
		$hapus 				= $this->jenis_kursus_model->hapus($kode);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
