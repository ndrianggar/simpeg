<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengurus extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('pengurus_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_pengurus');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_pengurus');
			}
		}
	}

	public function data() {
		$data					= $this->pengurus_model->cari_semua();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nip' 			=> $data->kd_pegawai,
					'nama' 			=> $data->nm_pegawai 	.' '. $data->gelar_belakang	,
					'hak_akses' 			=> $data->hak_akses,
					'foto' 			=> '<img src="'. base_url(). 'assets/foto/'.$data->foto_pegawai.' " style="width:100px; height:100px;" ></img>',										
					'action' 		=> '<div class="btn-group">
								  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
											data-id="' 		. $data->id_pegawai 	. '" 
											data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-trash-o"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}
	

	public function data_user() {
		$data					= $this->pengurus_model->cari_user();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nip' 			=> $data->kd_pegawai,
					'nama' 			=> $data->nm_pegawai 	.' '. $data->gelar_belakang	,
					'pilih' 		=> '<div class="btn-group">
										<button id="btn-pilih" type="button" class="btn btn-success btn-xs" 
														data-id="' 			. $data->id_pegawai 			. '" 
														data-nama="' 		. $data->nm_pegawai 		. '"
														data-nip="'		. $data->kd_pegawai		. '"
														><i>Jadikan Admin </i></button>
										</div>',
					'pilih_pimpinan' => '<div class="btn-group">
										<button id="btn-pilih-pimpinan" type="button" class="btn btn-danger btn-xs" 
														data-id="' 			. $data->id_pegawai 			. '" 
														data-nama="' 		. $data->nm_pegawai 		. '"
														data-nip="'		. $data->kd_pegawai		. '"
														><i>Jadikan Pimpinan </i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}
	
	public function hapus($kode) {
		$hapus 				= $this->pengurus_model->hapus($kode);
		$msg 	= false;
		if ($hapus) {
			$msg = true;
		}
		echo json_encode($msg);
	}

	public function pilih($kode) {
		$hapus 				= $this->pengurus_model->pilih($kode);
		$msg 	= false;
		if ($hapus) {
			$msg = true;
		}
		echo json_encode($msg);
	}

	public function pilih_pimpinan($kode) {
		$hapus 				= $this->pengurus_model->pilih_pimpinan($kode);
		$msg 	= false;
		if ($hapus) {
			$msg = true;
		}
		echo json_encode($msg);
	}
}
