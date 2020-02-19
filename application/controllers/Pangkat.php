<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pangkat extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pangkat_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_pangkat');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_pangkat');
			}
		}
	}

	public function data() {
		$data					= $this->pangkat_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kd_pangkat,
					'nama' 			=> $data->nm_pangkat,
					'golongan' 		=> $data->gol_pangkat,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-kode="' 	. $data->kd_pangkat 	. '" 
														data-nama="' 	. $data->nm_pangkat 	. '" 
														data-golongan="'. $data->gol_pangkat 	. '" 
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-kode="' 	. $data->kd_pangkat 	. '" 
														data-nama="' 	. $data->nm_pangkat 	. '" 
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
			$check				= $this->db->query("SELECT * FROM t_pangkat WHERE kd_pangkat='$kode' AND sts_pangkat<>'1';");
			$msg 				= false;
			if ($check->num_rows()==0){
				$kode				= $this->pangkat_model->buat_kode();		
				$simpan 			= $this->pangkat_model->tambah(
										$kode,
										$_POST['tambah-kode'],
										$_POST['tambah-nama'],
										$_POST['tambah-golongan']
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
			$id					= $_POST['tambah-id'];
			$kode 				= $_POST['tambah-kode'];
			$check				= $this->db->query("SELECT * FROM t_pangkat WHERE kd_pangkat='$kode' AND sts_pangkat<>'1' AND id_pangkat<>'$id';");
			$msg 				= false;
			if ($check->num_rows()==0){
				$edit 				= $this->pangkat_model->edit(
										$_POST['tambah-id'],					
										$_POST['tambah-kode'],
										$_POST['tambah-nama'],
										$_POST['tambah-golongan']
									);
				if ($edit) {
					$msg 			= true;
				}
			}
			
			echo json_encode($msg);
		}
	}
	
	public function hapus($kode) {
		$hapus 				= $this->pangkat_model->hapus($kode);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
