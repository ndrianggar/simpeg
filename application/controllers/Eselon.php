<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eselon extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('eselon_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_eselon');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_eselon');
			}
		}
	}

	public function data() {
		$data					= $this->eselon_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kd_eselon,
					'nama' 			=> $data->nm_eselon,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-kode="' 	. $data->kd_eselon 	. '" 
														data-nama="' 	. $data->nm_eselon 	. '" 
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-kode="' 	. $data->kd_eselon 	. '" 
														data-nama="' 	. $data->nm_eselon 	. '" 
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
		if ($_POST['tambah-nama']!=='') {
			$nama 			= $_POST['tambah-nama'];
			$check			= $this->db->query(
								"SELECT * FROM t_eselon 
								WHERE nm_eselon='$nama' 
								AND sts_eselon<>'1';");
			$msg			= false;
			if ($check->num_rows()==0){
				$kode		= $this->eselon_model->buat_kode();		
				$simpan 	= $this->eselon_model->tambah(
								$kode,
								$_POST['tambah-nama']
							);
				
				if ($simpan) {
					$msg	= true;
				}
			}			
			echo json_encode($msg);
		}
	}
	
	public function edit() {
		if (isset($_POST['tambah-kode'])) {
			$edit 		= $this->eselon_model->edit(
							$_POST['tambah-kode'],
							$_POST['tambah-nama']
						);
			$msg		= false;
			if ($edit) {
				$msg 	= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($kode) {
		$hapus 				= $this->eselon_model->hapus($kode);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
