<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('pegawai_model');
		$this->load->model('alamat_model');
		$this->load->model('keluarga_model');
		$this->load->model('pendidikan_model');
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
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
		} else {
			// $this->pegawai_model->update_log();
		}
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$data['pesan']	= '';
			$this->load->view('login',$data);
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/dashboard');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/dashboard');
			} else {
				redirect (base_url() .'pegawai/detail/'.$this->session->userdata('kode_pegawai_siskap'));
			}
		}
	}

	public function login() {
		$kode 			= $_POST['kode_pegawai'];
		$pass 			= $_POST['pass_pegawai'];
		$time_check 	= time()-1200;
		$QuerySaya		= $this->db->query(
							"SELECT * FROM t_pegawai 
							WHERE (kd_pegawai='$kode' OR nip_baru='$kode' OR email_pegawai='$kode') 
							AND sts_pegawai<>'1' limit 1;"		
						);
		if ($QuerySaya->num_rows() == 0) {
			$data['pesan']	= 'Data Pegawai tidak ditemukan.';
			$this->load->view('login', $data );
		} else {
			foreach ($QuerySaya->result() as $data1) {
				// with bcrypt
				/*if ($this->bcrypt->check_password($_POST['pass_pegawai'], $data1->pass_pegawai)) { */
					if ($data1->status_login=='0') {
						$data1 		= $QuerySaya->row();
						$this->session->set_userdata('kode_pegawai_siskap', 	$data1->id_pegawai);
						$this->session->set_userdata('nama_pegawai_siskap', 	$data1->gelar_depan . $data1->nm_pegawai . $data1->gelar_belakang);
						$this->session->set_userdata('foto_pegawai_siskap', 	base_url() . 'assets/foto/' . $data1->foto_pegawai);
						$this->session->set_userdata('akses_pegawai_siskap', 	$data1->hak_akses);
						$this->session->set_userdata('pass_pegawai_siskap', 	$data1->pass_pegawai);
						$update 	= $this->pegawai_model->update_log();
						redirect (base_url());
					} else {
						if ($data1->sess_time<$time_check) {
							$data1 		= $QuerySaya->row();
							$this->session->set_userdata('kode_pegawai_siskap', 	$data1->id_pegawai);
							$this->session->set_userdata('nama_pegawai_siskap', 	$data1->gelar_depan . $data1->nm_pegawai . $data1->gelar_belakang);
							$this->session->set_userdata('foto_pegawai_siskap', 	base_url() . 'assets/foto/' . $data1->foto_pegawai);
							$this->session->set_userdata('akses_pegawai_siskap', 	$data1->hak_akses);
							$this->session->set_userdata('pass_pegawai_siskap', 	$data1->pass_pegawai);
							$update 	= $this->pegawai_model->update_log();
							redirect (base_url());
						} else {
							$data['pesan']	= 'Kode Karyawan sedang aktif';
							$this->load->view('login', $data );
						}
					}
			/*	} else { 
					$data['pesan']	= 'Password kamu salah, silakan coba lagi..';
					$this->load->view('login', $data );
				}*/
			}
		}
	}

	// public function login() {
	// 	$kode 			= $_POST['kode'];
	// 	$pass 			= $_POST['pass'];
	// 	$time_check 	= time()-1200;
	// 	$QuerySaya		= $this->db->query(
	// 						"SELECT * FROM tabel_karyawan 
	// 						WHERE kode_karyawan='$kode' 
	// 						AND password_karyawan='$pass';"		
	// 					);
	// 	if ($QuerySaya->num_rows() == 0) {
	// 		$data['pesan']	= 'Kode Karyawan tidak ditemukan';
	// 		$this->load->view('login',$data);
	// 	} else {
	// 		foreach ($QuerySaya->result() as $data) {
	// 			if ($data->sess_time<$time_check) {
	// 				$data 		= $QuerySaya->row();
	// 				$this->session->set_userdata('id_karyawan_modern', 		$data->id_karyawan);
	// 				$this->session->set_userdata('nama_karyawan_modern', 	$data->nama_karyawan);
	// 				$this->session->set_userdata('id_toko_modern', 			$data->id_toko);
	// 				$this->session->set_userdata('foto_karyawan_modern', 		 	base_url() .'assets/foto/' . $data->foto_karyawan);
	// 				$update 	= $this->karyawan_model->update_log();
	// 				redirect (base_url());
	// 			} else {
	// 				$data['pesan']	= 'Kode Karyawan sedang aktif';
	// 				$this->load->view('login', $data );
	// 			}
	// 		}
	// 	}
	// }

	public function logout() {
		$waktu 	= date('Y-m-d H:i:s');
		$update = $this->pegawai_model->logout(
						'0',
						$waktu
						);
		$this->session->sess_destroy();
		redirect (base_url());
	}

	public function check_online() {
		$data 	= $this->pegawai_model->user_online();
		$angka 	= 0 ;
		$notice = '';
		foreach ($data as $data) {
			$angka	= $angka + 1 ;
			$notice .= 	'<li>
							<a>
								<span class="image"><img src="' . base_url() .'assets/foto/' . $data->foto_pegawai . '" alt="Profile Image" /></span>
								<span>
									<span>'. $data->gelar_depan . $data->nm_pegawai . $data->gelar_belakang .
									'<br>NIP : '. $data->nip_baru .
									'</span>
								</span>
							</a>
						</li>';
		}
		$msg['angka']		= $angka;
		$msg['list_user']	= $notice;

		echo json_encode($msg);
	}

	public function upd_pass() {
		$data 			= $this->pegawai_model->cari_semua();
		foreach ($data as $data) {
			$id 		= $data->id_pegawai;
			$new_pass	= $this->bcrypt->hash_password($data->pass_pegawai);
			$upd 		= $this->db->query(
							"UPDATE t_pegawai 
							SET pass_pegawai='$new_pass' 
							WHERE id_pegawai='$id';"
			);
		}
	}
}
