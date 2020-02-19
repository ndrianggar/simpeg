<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pensiunan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pensiunan_model');
		$this->load->model('pegawai_model');
		$this->load->model('alamat_model');
		$this->load->model('keluarga_model');
		$this->load->model('pendidikan_model');
		$this->load->model('status_model');
		$this->load->model('jenis_model');
		$this->load->model('agama_model');
		$this->load->model('jenjang_model');
		$this->load->model('pangkat_model');
		$this->load->model('jabatan_model');
		$this->load->model('prodi_model');
		$this->load->model('jurusan_model');
		$this->load->model('penempatan_model');
		$this->load->model('riwayat_jabatan_model');
		$this->load->model('riwayat_pangkat_model');
		$this->load->model('notice_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$data['nip']	= $this->pensiunan_model->cari_nip();
				$this->load->view('admin/pegawai/data_pensiunan', $data);
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/pegawai/data_pensiunan');
			}
		}
	}

	public function data_pensiunan($id) {
		$data 			= $this->pensiunan_model->cari_data_pensiunan($id);
		foreach ($data as $data) {
			# code...
		}
		echo json_encode($data);
	}

	public function data() {
		$data					= $this->pensiunan_model->cari_semua();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$pangkat 			= '';
			$eselon 			= '';
			$penempatan 		= '';
			$golongan 			= '';
			$data_pangkat 		= $this->riwayat_pangkat_model->cari_pegawai($data->id_pegawai);
			foreach ($data_pangkat as $data_pangkat) {
				if ($data_pangkat->status_riwayat_pangkat=='A') {
					$pangkat 	.= $data_pangkat->nm_pangkat . '<br>';
					$golongan 	= $data_pangkat->gol_pangkat;
				}
			}
			$jabatan 			= '';
			$data_jabatan 		= $this->riwayat_jabatan_model->cari_pegawai($data->id_pegawai);
			foreach ($data_jabatan as $data_jabatan) {
				if ($data_jabatan->status_riwayat_jabatan=='A') {
					$jabatan 	.= $data_jabatan->nm_jabatan . '<br>';
					$penempatan = $data_jabatan->nm_penempatan;
					$eselon 	= $data_jabatan->eselon;
				}
			}

			if ($data->sts_pegawai=='0') {
				$btn_status		=	'';
				$btn_action 		= 	'<div class="btn-group">
											<button id="btn-edit" type="button" class="btn btn-warning btn-xs" 
												data-id="' 			. $data->id_pegawai 		. '" 
												data-kode="' 			. $data->kd_pegawai 		. '" 
												data-nama="' 			. $data->nm_pegawai 		. '" 
												data-pangkat="' 			. $data->nm_pangkat		. '" 
												data-jabatan="' 	. $data->nm_jabatan 		. '" 
												data-golongan="' 		. $data->gol_pangkat 			. '" 
												data-penempatan="' 		. $data->nm_penempatan			. '" 
												data-jurusan="' 		. $data->nm_jurusan 				. '" 
												data-prodi="' 			. $data->nm_prodi 		. '" 
												data-tgl="' 			. date('d-m-Y',strtotime($data->tgl_pensiun)) 		. '" 
												data-sk="' 			. $data->sk_pensiun		. '" 
												data-keterangan="' 			. $data->ket_pensiun		. '" 
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
												<td width="35%"><b>Tgl Pensiun</b></td>
												<td width="5%">:</td>
												<td width="60%">' . date('d-m-Y',strtotime($data->tgl_pensiun)) . '</td>
											</tr>
											<tr>
												<td width="35%"><b>SK Pensiun</b></td>
												<td width="5%">:</td>
												<td width="60%">' . $data->sk_pensiun . '</td>
											</tr>
											<tr>
												<td width="35%"><b>Keterangan</b></td>
												<td width="5%">:</td>
												<td width="60%">' . $data->ket_pensiun . '</td>
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

	public function detail($kode) {
		$data['pegawai']	= $this->pegawai_model->cari_kd($kode);
		$data['hubungan']	= $this->keluarga_model->hubungan();
		$data['jenjang']	= $this->jenjang_model->cari_semua();
		$data['pangkat']	= $this->pangkat_model->cari_semua();
		$data['jenis']		= $this->jabatan_model->cari_jenis();
		$data['jabatan']	= $this->jabatan_model->cari_semua();
		$data['penempatan']	= $this->penempatan_model->cari_semua();
		$data['agama']		= $this->agama_model->cari_semua();
		$status				= $this->pegawai_model->cari_user($kode);
		foreach ($status as $status) {
			if ($status->sts_pegawai=='0') {
				$btn_status		=	'';
				$btn_action 		= 	'<div class="btn-group">
											<button id="btn-edit-pegawai" type="button" class="btn btn-warning btn-xs" 
												status-id="' 			. $status->id_pegawai 		. '" 
												status-kode="' 			. $status->kd_pegawai 		. '" 
												status-jenis="' 		. $status->kd_pegawai 		. '" 
												status-nip_lama="' 		. $status->nip_baru 		. '" 
												status-nip_baru="' 		. $status->kd_pegawai 		. '" 
												status-kode="' 			. $status->kd_pegawai 		. '" 
												status-nama="' 			. $status->nm_pegawai 		. '" 
												status-gelar_depan="' 	. $status->gelar_depan 		. '" 
												status-gelar_blkg="' 	. $status->gelar_belakang	. '" 
												status-ktp="' 			. $status->ektp_pegawai		. '" 
												status-tmt_polines="' 	. $status->tmt_polines 		. '" 
												status-tmt_cpns="' 		. $status->tmt_cpns 		. '" 
												status-tmt_pns="' 		. $status->tmt_pns			. '" 
												status-no_sk="' 		. $status->no_sk 			. '" 
												status-jk="' 			. $status->jenis_kelamin 	. '" 
												status-tempat="' 		. $status->tempat_lahir 	. '" 
												status-tanggal="' 		. $status->tanggal_lahir 	. '" 
												status-agama="' 		. $status->nm_agama			. '" 
												status-status="' 		. $status->status_perkawinan. '" 
												status-jalan="' 		. $status->alamat_jalan 	. '" 
												status-kd_kelurahan="'	. $status->id_kelurahan 	. '" 
												status-kelurahan="' 	. $status->nama_kelurahan 	. '" 
												status-kd_kecamatan="'	. $status->id_kecamatan 	. '" 
												status-kecamatan="' 	. $status->nama_kecamatan 	. '" 
												status-kd_kota="' 		. $status->id_kota 			. '" 
												status-kota="' 			. $status->nama_kota 		. '" 
												status-kd_propinsi="' 	. $status->id_propinsi 		. '" 
												status-propinsi="' 		. $status->nama_propinsi 	. '" 
												status-tinggi="' 		. $status->tinggi_badan 	. '" 
												status-berat="' 		. $status->berat_badan 		. '" 
												status-rambut="' 		. $status->rambut 			. '" 
												status-muka="' 			. $status->bentuk_muka 		. '" 
												status-kulit="' 		. $status->warna_kulit 		. '" 
												status-ciri="' 			. $status->ciri_khas 		. '" 
												status-cacat="' 		. $status->cacat_tubuh 		. '" 
												status-foto1="' 		. $status->foto_pegawai 	. '" 
												status-foto2="' 		. base_url() 				. '
												assets/foto/' 			. $status->foto_pegawai 	. '"
												><i class="fa fa-edit"> Edit Data Pegawai</i>
											</button>
										</div>';
				$btn_action_user	=	$btn_action;
			} elseif ($status->sts_pegawai=='2') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Tambah</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-tambah-pegawai" type="button" class="btn btn-success btn-xs" 
												status-id="' 		. $status->id_pegawai 	. '" 
												status-nama="' 	. $status->nm_pegawai 	. '" 
											><i class="fa fa-check"> Terima</i>
										</button>
								  		<button id="btn-tolak-tambah" type="button" class="btn btn-danger btn-xs" 
												status-id="' 		. $status->id_pegawai 	. '" 
												status-nama="' 	. $status->nm_pegawai 	. '" 
											><i class="fa fa-times"> Tolak</i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-tambah-pegawai" type="button" class="btn btn-danger btn-xs" 
												status-id="' 		. $status->id_pegawai 	. '" 
												status-nama="' 	. $status->nm_pegawai 	. '" 
										><i class="fa fa-times"> Batalkan</i>
									</button>';
			} elseif ($status->sts_pegawai=='3') {
				$btn_status		=	'<button type="button" class="btn btn-warning btn-xs">Pengajuan Edit</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-edit-pegawai" type="button" class="btn btn-success btn-xs" 
												status-id="' 		. $status->id_pegawai 	. '" 
												status-nama="' 	. $status->nm_pegawai 	. '" 
											><i class="fa fa-check"> Terima</i>
										</button>
								  		<button id="btn-tolak-edit-pegawai" type="button" class="btn btn-danger btn-xs" 
												status-id="' 		. $status->id_pegawai 	. '" 
												status-nama="' 	. $status->nm_pegawai 	. '" 
											><i class="fa fa-times"> Tolak</i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-edit-pegawai" type="button" class="btn btn-danger btn-xs" 
												status-id="' 		. $status->id_pegawai 	. '" 
												status-nama="' 	. $status->nm_pegawai 	. '" 
										><i class="fa fa-times"> Batalkan</i>
									</button>';
			} elseif ($status->sts_pegawai=='4') {
				$btn_status		=	'<button type="button" class="btn btn-danger btn-xs">Pengajuan Hapus</button>';
				$btn_action 	= 	'<div class="btn-group">
										<button id="btn-terima-hapus-pegawai" type="button" class="btn btn-success btn-xs" 
												status-id="' 		. $status->id_pegawai 	. '" 
												status-nama="' 	. $status->nm_pegawai 	. '" 
											><i class="fa fa-check"> Terima</i>
										</button>
								  		<button id="btn-tolak-hapus-pegawai" type="button" class="btn btn-danger btn-xs" 
												status-id="' 		. $status->id_pegawai 	. '" 
												status-nama="' 	. $status->nm_pegawai 	. '" 
											><i class="fa fa-times"> Tolak</i>
										</button>
									</div>';
				$btn_action_user = 	'<button id="btn-batal-hapus-pegawai" type="button" class="btn btn-danger btn-xs" 
												status-id="' 		. $status->id_pegawai 	. '" 
												status-nama="' 	. $status->nm_pegawai 	. '" 
										><i class="fa fa-times"> Batalkan</i>
									</button>';
			} else {
				$btn_status		=	'';
				$btn_action 		= 	'<div class="btn-group">
											<button id="btn-edit-pegawai" type="button" class="btn btn-warning btn-xs" 
												status-id="' 			. $status->id_pegawai 		. '" 
												status-kode="' 		. $status->kd_pegawai 		. '" 
												status-jenis="' 		. $status->kd_pegawai 		. '" 
												status-nip_lama="' 	. $status->nip_baru 			. '" 
												status-nip_baru="' 	. $status->kd_pegawai 		. '" 
												status-kode="' 		. $status->kd_pegawai 		. '" 
												status-nama="' 		. $status->nm_pegawai 		. '" 
												status-gelar_depan="' . $status->gelar_depan 		. '" 
												status-gelar_blkg="' 	. $status->gelar_belakang		. '" 
												status-ktp="' 		. $status->ektp_pegawai		. '" 
												status-tmt_polines="' . $status->tmt_polines 		. '" 
												status-tmt_cpns="' 	. $status->tmt_cpns 			. '" 
												status-tmt_pns="' 	. $status->tmt_pns			. '" 
												status-no_sk="' 		. $status->no_sk 				. '" 
												status-jk="' 			. $status->jenis_kelamin 		. '" 
												status-tempat="' 		. $status->tempat_lahir 		. '" 
												status-tanggal="' 	. $status->tanggal_lahir 		. '" 
												status-agama="' 		. $status->nm_agama			. '" 
												status-status="' 		. $status->status_perkawinan 	. '" 
												status-jalan="' 		. $status->alamat_jalan 		. '" 
												status-kd_kelurahan="'. $status->id_kelurahan 		. '" 
												status-kelurahan="' 	. $status->nama_kelurahan 		. '" 
												status-kd_kecamatan="'. $status->id_kecamatan 		. '" 
												status-kecamatan="' 	. $status->nama_kecamatan 		. '" 
												status-kd_kota="' 	. $status->id_kota 			. '" 
												status-kota="' 		. $status->nama_kota 			. '" 
												status-kd_propinsi="' . $status->id_propinsi 		. '" 
												status-propinsi="' 	. $status->nama_propinsi 		. '" 
												status-tinggi="' 		. $status->tinggi_badan 		. '" 
												status-berat="' 		. $status->berat_badan 		. '" 
												status-rambut="' 		. $status->rambut 			. '" 
												status-muka="' 		. $status->bentuk_muka 		. '" 
												status-kulit="' 		. $status->warna_kulit 		. '" 
												status-ciri="' 		. $status->ciri_khas 			. '" 
												status-cacat="' 		. $status->cacat_tubuh 		. '" 
												status-foto1="' 		. $status->foto_pegawai 		. '" 
												status-foto2="' 		. base_url() . 'assets/foto/' 
																	. $status->foto_pegawai 		. '"
												><i class="fa fa-edit"> Edit Data Pegawai</i>
											</button>
										</div>';
				$btn_action_user	=	$btn_action;
			}
			$data['status']		= array(
									'status' 			=> $btn_status,
									'action' 			=> $btn_action,
									'action_user' 		=> $btn_action_user
							  );
		}
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/pegawai/data_pegawai_detail', $data );
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/pegawai/data_pegawai_detail', $data );
			} else {
				$this->load->view('user/pegawai/data_pegawai_detail', $data );
			}
		}
	}

	public function tambah() {

		$kode 		= $_POST['id_pegawai'];
		$msg		= false;
		$simpan 	= $this->pensiunan_model->tambah(
					$_POST['id_pegawai'],
					tgl_sql($_POST['tanggal_pensiunan']),
					$_POST['sk_pensiunan'],
					$_POST['keterangan']
				);


		if ($simpan) {
			$msg 				= true;
		}

		// Simpan Foto & File jika ada
		$config['upload_path']			= './assets/foto/';
		$config['allowed_types']		= 'jpg|png|pdf';
		$config['max_size']				= 10000;
		
		$this->load->library('upload', $config);

		if (!empty($_FILES['file_pensiunan']['name'])) {
			if ($this->upload->do_upload('file_pensiunan')) {
				$upload_foto 	= $this->upload->data();
				$nama_foto 		= $upload_foto['file_name'];
				$update_foto 	= $this->db->query(
									"UPDATE t_pegawai 
									SET file_pensiun='$nama_foto' 
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
