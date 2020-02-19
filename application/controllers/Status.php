<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('status_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_status');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_status');
			}
		}
	}

	public function data() {
		$data					= $this->status_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'id' 			=> $data->id_status,
					'nama' 			=> $data->nama_status,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-id="' 	. $data->id_status 	. '" 
														data-nama="' 	. $data->nama_status 	. '" 
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-id="' 	. $data->id_status 	. '" 
														data-nama="' 	. $data->nama_status 	. '" 
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
			$nama 				= $_POST['tambah-nama'];
			$check				= $this->db->query("SELECT * FROM t_pegawai_status WHERE nama_status='$nama' AND status_status<>'1';");
			$msg 				= false;
			if ($check->num_rows()==0){
				$id					= $this->status_model->buat_id();		
				$simpan 			= $this->status_model->tambah(
										$id,
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
		if ($_POST['tambah-id']!=='') {
			$edit 				= $this->status_model->edit(
									$_POST['tambah-id'],
									$_POST['tambah-nama']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($id) {
		$hapus 				= $this->status_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
