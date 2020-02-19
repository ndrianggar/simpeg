<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('jabatan_model');
		$this->load->model('penempatan_model');
		$this->load->model('eselon_model');
		$this->load->model('peraturan_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$data['jenis']		= $this->jabatan_model->cari_jenis();
				$data['eselon']		= $this->eselon_model->cari_semua();
				$data['peraturan']		= $this->peraturan_model->cari_semua();
				$this->load->view('admin/master/data_jabatan', $data );
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$data['jenis']		= $this->jabatan_model->cari_jenis();
				$data['eselon']		= $this->eselon_model->cari_semua();
				$data['peraturan']		= $this->peraturan_model->cari_semua();
				$this->load->view('pimpinan/master/data_jabatan', $data );
	}
		}
	}

	public function data() {
		$data					= $this->jabatan_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-kode="' 		. $data->kd_jabatan 	. '" 
														data-jenis="' 		. $data->kd_jenis	 	. '" 
														data-nama="' 		. $data->nm_jabatan 	. '"
														data-eselon="' 		. $data->kd_eselon	 	. '" 
														data-kelas="' 		. $data->kls_jabatan	. '" 
														data-tunjangan="' 	. $data->tunj_jabatan	. '"
														data-peraturan="' 	. $data->kd_peraturan	. '"
														><i class="fa fa-edit"></i></button>
										<button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-kode="' 		. $data->kd_jabatan 	. '" 
														data-nama="' 		. $data->nm_jabatan 	. '" 
														><i class="fa fa-trash-o"></i></button>
										</div>',
					'kode' 			=> $data->kd_jabatan,
					'jenis' 		=> $data->nm_jenis,
					'nama' 			=> $data->nm_jabatan,
					'eselon'		=> $data->nama_eselon,
					'kelas' 		=> $data->kls_jabatan,
					'tunjangan'		=> number_format($data->tunj_jabatan),
					'dasar'			=> $data->peraturan
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
			$check				= $this->db->query("SELECT * FROM t_jabatan WHERE nm_jabatan='$nama' AND sts_jabatan<>'1';");
			$msg 			 	= false;
			if ($check->num_rows()==0){
				$kode				= $this->jabatan_model->buat_kode();		
				$simpan 			= $this->jabatan_model->tambah(
										$kode,
										$_POST['tambah-jenis'],
										$_POST['tambah-eselon'],
										$_POST['tambah-nama'],
										$_POST['tambah-kelas'],
										$_POST['tunjangan'],
										$_POST['peraturan']
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
			$edit 				= $this->jabatan_model->edit(
									$_POST['tambah-kode'],
									$_POST['tambah-jenis'],
									$_POST['tambah-eselon'],
									$_POST['tambah-nama'],
									$_POST['tambah-kelas'],
									$_POST['tunjangan'],
									$_POST['peraturan']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($kode) {
		$hapus 				= $this->jabatan_model->hapus($kode);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}

	public function data_jenis($kode) {
		$data			= $this->jabatan_model->data_jenis($kode);		
		$result			= '<option value="">-- Pilih Jenis Jabatan --</option>';
		foreach ($data as $data) {
			$result		= $result . '<option value="' . $data->kd_jabatan . '">' . $data->nm_jabatan . '</option>';
		}
		echo json_encode($result);
	}
}
