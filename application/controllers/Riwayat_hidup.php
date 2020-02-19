<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_hidup extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('riwayat_hidup_model');
	}

	public function index() {
		$this->load->view('admin/document/daftar_riwayat_hidup');	
	}

	public function cetak($id) {
		$data['riwayat_hidup']	= $this->riwayat_hidup_model->cari_cetak($id);
		$data['pendidikan']		= $this->riwayat_hidup_model->cari_pendidikan($id);
		$data['kunjungan']		= $this->riwayat_hidup_model->cari_kunjungan($id);
		$data['pangkat']		= $this->riwayat_hidup_model->cari_pangkat($id);
		$data['jabatan']		= $this->riwayat_hidup_model->cari_jabatan($id);
		$data['penghargaan']	= $this->riwayat_hidup_model->cari_penghargaan($id);
		$data['luar_negeri']	= $this->riwayat_hidup_model->cari_kunjungan($id);
		$data['organisasi']		= $this->riwayat_hidup_model->cari_organisasi($id);
		$data['pasangan']		= $this->riwayat_hidup_model->cari_pasangan($id);
		$data['anak']			= $this->riwayat_hidup_model->cari_anak($id);
		$data['orang_tua']		= $this->riwayat_hidup_model->cari_orang_tua($id);
		$data['mertua']			= $this->riwayat_hidup_model->cari_orang_tua($id);
		$data['saudara']		= $this->riwayat_hidup_model->cari_saudara($id);
		$this->load->view( 'admin/document/cetak_riwayat_hidup', $data );
	}

	public function data() {
		$data					= $this->riwayat_hidup_model->cari_semua();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nip' 			=> $data->kd_pegawai,
					'nama' 			=>  $data->gelar_depan .' '. $data->nm_pegawai .' '. $data->gelar_belakang,
					'status' 		=> $data->nama_status,
					'jenis' 		=> $data->nm_jenis,
					'action' 		=> '<div class="btn-group">
								  		<button id="btn-cetak" type="button" class="btn btn-success btn-xs" 
											data-id="' 		. $data->id_pegawai 	. '" 
											data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-file-pdf-o"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}
	

}
