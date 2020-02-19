<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alamat extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('alamat_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_alamat');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_alamat');
			}
		}
	}

	public function data() {
		$data					= $this->alamat_model->data_propinsi();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama' 			=> $data->nama_propinsi,

					'detail' 		=> '<div class="btn-group">
										<button id="btn-detail" type="button" class="btn btn-success btn-xs" 
											data-kd="' 		. $data->id_propinsi 	. '" 
											><i>Detail</i></button>
										</div>',
										
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
											data-kd="' 		. $data->id_propinsi 	. '"
											data-nama="' 	. $data->nama_propinsi 	. '"
											><i class="fa fa-edit"></i></button>
								  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
											data-kd="' 		. $data->id_propinsi 	. '" 
											data-nama="' 	. $data->nama_propinsi 	. '" 
											><i class="fa fa-trash-o"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function tambah_propinsi() {
		if (isset($_POST['nama_propinsi'])) {
			$kode		= $this->alamat_model->buat_kode();
			$simpan 	= $this->alamat_model->tambah_propinsi(
							$kode,
							$_POST['nama_propinsi']
						);
				
			if ($simpan) {
				$msg	= true;
			}

		}
		echo json_encode($msg);	
	}

	public function edit_propinsi(){
		if (isset($_POST['nama_propinsi'])) {
			$kode 		= $_POST['id'];
			$simpan 	= $this->alamat_model->edit_propinsi(
							$_POST['id'],
							$_POST['nama_propinsi']
						);
				
			if ($simpan) {
				$msg	= true;
			}
		}
		echo json_encode($msg);	

	}

	public function hapus_propinsi($kode) {
		$hapus 				= $this->alamat_model->hapus_propinsi($kode);
		$msg 	= false;
		if ($hapus) {
			$msg = true;
		}
		echo json_encode($msg);
	}

	public function detail($kode) {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$data['propinsi']	= $kode;
				$data['kota']		= $this->alamat_model->data_kota($kode);
				$this->load->view( 'admin/master/data_alamat_kota', $data );
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$data['propinsi']	= $kode;
				$data['kota']		= $this->alamat_model->data_kota($kode);
				$this->load->view( 'pimpinan/master/data_alamat_kota', $data );
			}
		}
	}

	public function kota($kode) {
		$data					= $this->alamat_model->data_kota($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama' 			=> $data->nama_kota,

					'detail' 		=> '<div class="btn-group">
										<button id="btn-detail" type="button" class="btn btn-success btn-xs" 
											data-kd="' 			. $data->id_kota 	. '" 
											><i>Detail</i></button>
										</div>',
										
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
											data-kd="' 			. $data->id_kota 		. '"
											data-id_propinsi="' . $data->id_propinsi 	. '"
											data-nama="' 		. $data->nama_kota 		. '"
											><i class="fa fa-edit"></i></button>
								  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
											data-kd="' 			. $data->id_kota 		. '" 
											data-nama="' 		. $data->nama_kota 		. '" 
											><i class="fa fa-trash-o"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function tambah_kota() {
		if (isset($_POST['id_propinsi_kota']) && isset($_POST['nama_kota'])) {
			$kode		= $this->alamat_model->buat_kode_kota();
			$simpan 	= $this->alamat_model->tambah_kota(
							$kode,
							$_POST['id_propinsi_kota'],
							$_POST['nama_kota']
						);
				
			if ($simpan) {
				$msg	= true;
			}

		}
		echo json_encode($msg);	
	}
	public function edit_kota(){
		if (isset($_POST['nama_kota'])) {
			$kode 		= $_POST['id'];
			$simpan 	= $this->alamat_model->edit_kota(
							$_POST['id'],
							$_POST['nama_kota']
						);
				
			if ($simpan) {
				$msg	= true;
			}
		}
		echo json_encode($msg);	

	}

	public function hapus_kota($kode) {
		$hapus 				= $this->alamat_model->hapus_kota($kode);
		$msg 	= false;
		if ($hapus) {
			$msg = true;
		}
		echo json_encode($msg);
	}


	public function detail_kecamatan($kode) {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$data['kota']	= $kode;
				$data['kd']	= $this->alamat_model->cari_id_kota($kode);
				$data['kecamatan']	= $this->alamat_model->data_kecamatan($kode);
				$this->load->view( 'admin/master/data_alamat_kecamatan', $data );
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$data['kota']	= $kode;
				$data['kd']	= $this->alamat_model->cari_id_kota($kode);
				$data['kecamatan']	= $this->alamat_model->data_kecamatan($kode);
				$this->load->view( 'pimpinan/master/data_alamat_kecamatan', $data );
			}
		}
	}

	public function kecamatan($kode) {
		$data					= $this->alamat_model->data_kecamatan($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama' 			=> $data->nama_kecamatan,

					'detail' 		=> '<div class="btn-group">
										<button id="btn-detail" type="button" class="btn btn-success btn-xs" 
														data-kd="' 		. $data->id_kecamatan 	. '" 
														><i>Detail</i></button>
										</div>',
										
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
											data-kd="' 		. $data->id_kecamatan 	. '"
											data-nama="' 	. $data->nama_kecamatan . '"
											><i class="fa fa-edit"></i></button>
								  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
											data-kd="' 		. $data->id_kecamatan 	. '" 
											data-nama="' 	. $data->nama_kecamatan . '" 
											><i class="fa fa-trash-o"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function tambah_kecamatan() {
		if (isset($_POST['id_kota_kecamatan']) && isset($_POST['nama_kecamatan'])) {
			$kode		= $this->alamat_model->buat_kode_kecamatan();
			$simpan 	= $this->alamat_model->tambah_kecamatan(
							$kode,
							$_POST['id_kota_kecamatan'],
							$_POST['nama_kecamatan']
						);
				
			if ($simpan) {
				$msg	= true;
			}

		}
		echo json_encode($msg);	
	}

	public function edit_kecamatan(){
		if (isset($_POST['nama_kecamatan'])) {
			$kode 		= $_POST['id'];
			$simpan 	= $this->alamat_model->edit_kecamatan(
							$_POST['id'],
							$_POST['nama_kecamatan']
						);
				
			if ($simpan) {
				$msg	= true;
			}
		}
		echo json_encode($msg);	

	}

	public function hapus_kecamatan($kode) {
		$hapus 				= $this->alamat_model->hapus_kecamatan($kode);
		$msg 	= false;
		if ($hapus) {
			$msg = true;
		}
		echo json_encode($msg);
	}

	public function detail_kelurahan($kode) {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$data['kecamatan']	= $kode;
				$data['kelurahan']	= $this->alamat_model->data_kelurahan($kode);
				$data['kd']	= $this->alamat_model->cari_id_kecamatan($kode);
				$this->load->view( 'admin/master/data_alamat_kelurahan', $data );
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$data['kecamatan']	= $kode;
				$data['kelurahan']	= $this->alamat_model->data_kelurahan($kode);
				$data['kd']	= $this->alamat_model->cari_id_kecamatan($kode);
				$this->load->view( 'pimpinan/master/data_alamat_kelurahan', $data );
			}
		}
	}

	public function kelurahan($kode) {
		$data					= $this->alamat_model->data_kelurahan($kode);
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama' 			=> $data->nama_kelurahan,
					'kode_pos' 			=> $data->kodepos_kelurahan,

					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
											data-kd="' 		. $data->id_kelurahan 	. '"
											data-nama="' 	. $data->nama_kelurahan . '"
											data-kode_pos="' 	. $data->kodepos_kelurahan . '"
											><i class="fa fa-edit"></i></button>
								  		<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
											data-kd="' 		. $data->id_kelurahan 	. '" 
											data-nama="' 	. $data->nama_kelurahan . '" 
											><i class="fa fa-trash-o"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function tambah_kelurahan() {
		if (isset($_POST['id_kecamatan_kelurahan']) && isset($_POST['nama_kelurahan'])) {
			$kode		= $this->alamat_model->buat_kode_kelurahan();
			$simpan 	= $this->alamat_model->tambah_kelurahan(
							$kode,
							$_POST['id_kecamatan_kelurahan'],
							$_POST['nama_kelurahan'],
							$_POST['kode_pos']
						);
				
			if ($simpan) {
				$msg	= true;
			}

		}
		echo json_encode($msg);	
	}

	public function edit_kelurahan(){
		if (isset($_POST['nama_kelurahan'])) {
			$kode 		= $_POST['id'];
			$simpan 	= $this->alamat_model->edit_kelurahan(
							$_POST['id'],
							$_POST['nama_kelurahan'],
							$_POST['kode_pos']
						);
				
			if ($simpan) {
				$msg	= true;
			}
		}
		echo json_encode($msg);	

	}

	public function hapus_kelurahan($kode) {
		$hapus 				= $this->alamat_model->hapus_kelurahan($kode);
		$msg 	= false;
		if ($hapus) {
			$msg = true;
		}
		echo json_encode($msg);
	}

	public function data_propinsi() {
		$data			= $this->alamat_model->data_propinsi();		
		$result			= '';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->id_propinsi . '">' . $data->nama_propinsi . '</option>';
		}
		echo json_encode($result);
	}

	public function data_kota($kode) {
		$data			= $this->alamat_model->data_kota($kode);		
		$result			= '';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->id_kota . '">' . $data->nama_kota . '</option>';
		}
		echo json_encode($result);
	}

	public function data_kecamatan($kode) {
		$data			= $this->alamat_model->data_kecamatan($kode);		
		$result			= '';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->id_kecamatan . '">' . $data->nama_kecamatan . '</option>';
		}
		echo json_encode($result);
	}

	public function data_kelurahan($kode) {
		$data			= $this->alamat_model->data_kelurahan($kode);		
		$result			= '';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->id_kelurahan . '">' . $data->nama_kelurahan . '</option>';
		}
		echo json_encode($result);
	}
}
