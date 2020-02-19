<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meninggal extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('meninggal_model');
		$this->load->model('pegawai_model');
		$this->load->model('notice_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$data['nip']	= $this->meninggal_model->cari_nip();
				$this->load->view('admin/pegawai/data_meninggal', $data);
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/pegawai/data_meninggal');
			}
		}
	}

	// public function user() {
	// 	if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
	// 		$this->load->view( 'admin/dashboard' );
	// 	} else if ($this->session->userdata('akses_pegawai_siskap')=='User') {
	// 		$this->load->view( 'user/pegawai/data_pegawai_tabel');
	// 	}
	// }

	public function data_meninggal($id) {
		$data 			= $this->meninggal_model->cari_data_meninggal($id);
		foreach ($data as $data) {
			# code...
		}
		echo json_encode($data);
	}

	public function data() {
		$data					= $this->meninggal_model->cari_semua();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;

			if ($data->sts_pegawai=='0') {
				$btn_status		=	'';
				$btn_action 		= 	'<div class="btn-group">
											<button id="btn-edit" type="button" class="btn btn-warning btn-xs" 
												data-id="' 			. $data->id_pegawai 		. '" 
												data-kode="' 		. $data->kd_pegawai 		. '" 
												data-nama="' 		. $data->nm_pegawai 		. '" 
												data-pangkat="' 	. $data->nm_pangkat			. '" 
												data-jabatan="' 	. $data->nm_jabatan 		. '" 
												data-golongan="' 	. $data->gol_pangkat 		. '" 
												data-penempatan="' 	. $data->nm_penempatan		. '" 
												data-jurusan="' 	. $data->nm_jurusan 		. '" 
												data-prodi="' 		. $data->nm_prodi 			. '" 
												data-tgl="' 		. date('d-m-Y',strtotime($data->tgl_kematian)) 	. '" 
												data-akta="' 		. $data->akta_kematian		. '" 
												><i class="fa fa-edit"></i>
											</button>
										</div>';
				$btn_action_user	=	$btn_action;
			} elseif ($data->sts_pegawai=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah" type="button" class="btn btn-success btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-tambah" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->sts_pegawai=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit" type="button" class="btn btn-success btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-edit" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
										><i class="fa fa-times"></i>
									</button>';
			} elseif ($data->sts_pegawai=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus" type="button" class="btn btn-success btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-check"></i>
										</button>
								  		<button id="btn-tolak-hapus" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
											><i class="fa fa-times"></i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus" type="button" class="btn btn-danger btn-xs" 
												data-id="' 		. $data->id_pegawai 	. '" 
												data-nama="' 	. $data->nm_pegawai 	. '" 
										><i class="fa fa-times"></i>
									</button>';
			}


			$hasil[]			= array(
					'no'			=>	$nomor,
					'foto' 			=> 	'<a href="pegawai/detail/' . $data->id_pegawai . '">
											<img src="' . base_url() . 'assets/foto/' . $data->foto_pegawai . '" style="height: auto;width: 120px;">
										</a>',
					'nama' 			=> 	'<a href="'	. base_url() .'pegawai/detail/' . $data->id_pegawai . '">
											<b>' 	. $data->gelar_depan 	. 
											' '		. $data->nm_pegawai 	.
											' '		. $data->gelar_belakang	. 
											'</b> <i>(' 	. $data->usia 	. ' Tahun)</i> 
										</a>
										<br><b>NIP</b> : ' 				. $data->nip_baru 			. 
										'<br>' 							. $data->tempat_lahir 		. 
										', ' 							. date('d-m-Y',strtotime($data->tanggal_lahir)) . 
										'<br>' 							. $data->status_perkawinan 	. 
										'<br><br><b>Alamat</b> :<br>' 	. $data->alamat_jalan 		.
										'<br>Kelurahan ' 				. $data->nama_kelurahan 		.
										' Kecamatan ' 					. $data->nama_kecamatan 		.
										'<br>' 							. $data->nama_kota 			.
										' - ' 							. $data->nama_propinsi 		,
					'keterangan'		=> 	'<table width="100%" border="0">
											<tr>
												<td width="40%"><b>Tgl Meninggal</b></td>
												<td width="5%">:</td>
												<td width="55%">' . date('d-m-Y',strtotime($data->tgl_kematian)) . '</td>
											</tr>
											<tr>
												<td width="40%"><b>Akta Meninggal</b></td>
												<td width="5%">:</td>
												<td width="55%">' . $data->akta_kematian . '</td>
											</tr>
										</table>',
					'status' 			=> $btn_status,
					'action' 			=> $btn_action,
					'action_user' 		=> $btn_action_user
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function tambah() {
		$kode 		= $_POST['id_pegawai'];
		$msg		= false;
		$simpan 	= $this->meninggal_model->tambah(
					$_POST['id_pegawai'],
					tgl_sql($_POST['tanggal_meninggal']),
					$_POST['akte_meninggal']
				);

		if ($simpan) {
			$msg 				= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/foto/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
		
		$this->load->library('upload', $config);

		if (!empty($_FILES['file_meninggal']['name'])) {
			if ($this->upload->do_upload('file_meninggal')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET file_kematian='$nama_foto' 
									WHERE id_pegawai='$kode';"
									); 
			}
		}

		echo json_encode($msg);
	}

	public function hapus($kode) {
		$hapus 				= $this->pegawai_model->hapus($kode);
		$msg['success'] 	= false;
		if ($hapus) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
}
