<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pertanyaan_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_pertanyaan');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_pertanyaan');
			}
		}
	}

	public function data() {
		$data					= $this->pertanyaan_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'isi' 			=> '<b>' 					. $data->judul 		. 
									   '</b><br>' 				. $data->isi 		.
									   '<br><br><b>' 			. $data->nama 		. 
									   '</b> <i>(' 				. $data->jabatan 	.
									   ')</i><br> Tanggal : ' 	. $data->tanggal,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-kode="' 	. $data->id 	. '" 
														data-nama="' 	. $data->judul 	. '" 
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-kode="' 	. $data->id 	. '" 
														data-nama="' 	. $data->judul 	. '" 
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
		if (isset($_POST['nama'])) {
			$kode				= $this->pertanyaan_model->buat_kode();		
			$simpan 			= $this->pertanyaan_model->tambah(
										$kode,
										date ("Y-m-d"),
										$_POST['judul'],
										nl2br($_POST['isi']),
										$_POST['nama'],
										$_POST['jabatan']
										
								);
				
			if ($simpan) {
				$msg 		= true;
			} else {
				$msg 		= false;
			}			
			echo json_encode($msg);
		}
	}
	
	public function edit() {
		if (isset($_POST['tambah-kode'])) {
			$edit 				= $this->agama_model->edit(
									$_POST['tambah-kode'],
									$_POST['tambah-nama']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($kode) {
		$hapus 				= $this->agama_model->hapus($kode);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
