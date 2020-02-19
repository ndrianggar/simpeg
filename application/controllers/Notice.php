<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('notice_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index() {
		// Zonk
	}

	public function lihat_semua() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_notice');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_notice');
			}else if($this->session->userdata('akses_pegawai_siskap')=='User'){
				$this->load->view('user/pegawai/data_notice');
			}
		}
	}

	public function data_admin() {
		$data					= $this->notice_model->cari_semua();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'				=> $nomor,
					'id' 				=> $data->id_notice,
					'tanggal' 			=> $data->tanggal_notice,
					'nama'				=> '<a href="' . base_url() . 'notice/read_notice_admin/' . $data->id_notice . '/' . $data->id_pegawai . '">
												<span class="image"><img width="75px" height="75px" src="' . base_url() . 'assets/foto/' . $data->foto_pegawai . '" alt="Profile Image">
												</span>
												<span>
													<span>' . $data->gelar_depan . ' ' . $data->nm_pegawai . ' ' . $data->gelar_belakang . '<i>(' . $data->hak_akses . ')</i></span>
													<span class="time">'. date('d-m-Y H:i', strtotime($data->tanggal_notice)) . '</span>
												</span>
												<span class="message"><b>'. $data->ket_notice .'</b></span>
											</a>' ,
					'jenis' 			=> $data->jenis_notice
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}


	public function data_user() {
		$data					= $this->notice_model->cari_semua_user($this->session->userdata('kode_pegawai_siskap'));
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'				=> $nomor,
					'id' 				=> $data->id_notice,
					'tanggal' 			=> $data->tanggal_notice,
					'nama'				=> '<a href="' . base_url() . 'notice/read_notice_user/' . $data->id_notice . '/' . $data->id_pegawai . '">
												<span class="image"><img width="75px" height="75px" src="' . base_url() . 'assets/foto/' . $data->foto_pegawai . '" alt="Profile Image">
												</span>
												<span>
													<span>' . $data->gelar_depan . ' ' . $data->nm_pegawai . ' ' . $data->gelar_belakang . '<i>(' . $data->hak_akses . ')</i></span>
													<span class="time">'. date('d-m-Y H:i', strtotime($data->tanggal_notice)) . '</span>
												</span>
												<span class="message"><b>'. $data->ket_notice .'</b></span>
											</a>' ,
					'jenis' 			=> $data->jenis_notice
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function data_user_unread() {
		$data 	= $this->notice_model->cari_user_unread($this->session->userdata('kode_pegawai_siskap'));
		$angka 	= 0 ;
		$notice = '';
		foreach ($data as $data) {
			$angka	= $angka + 1 ;
			$notice .= 	'
							<a href="' . base_url() . 'notice/read_notice_user/' . $data->id_notice . '/' . $data->id_pegawai . '">
								<span class="image"><img src="' . base_url() . 'assets/foto/' . $data->foto_pegawai . '" alt="Profile Image"></span>
								<span>
									<span>' . $data->gelar_depan . ' ' . $data->nm_pegawai . ' ' . $data->gelar_belakang . '<br><i>(' . $data->hak_akses . ')</i></span>
									<span class="time">'. date('d-m-Y H:i', strtotime($data->tanggal_notice)) . '</span>
								</span>
								<span class="message">'. $data->ket_notice .'</span>
							</a>
						';

		}
		$msg['angka']		= $angka;
		$msg['list_notice']	= $notice;

		echo json_encode($msg);
	}

	public function data_admin_unread() {
		$data 	= $this->notice_model->cari_admin_unread();
		$angka 	= 0 ;
		$notice = '';
		foreach ($data as $data) {
			$angka	= $angka + 1 ;
			$notice .= 	'
							<a href="' . base_url() . 'notice/read_notice_admin/' . $data->id_notice . '/' . $data->id_pegawai . '">
								<span class="image"><img src="' . base_url() . 'assets/foto/' . $data->foto_pegawai . '" alt="Profile Image"></span>
								<span>
									<span>' . $data->gelar_depan . ' ' . $data->nm_pegawai . ' ' . $data->gelar_belakang . '<br><i>(' . $data->hak_akses . ')</i></span>
									<span class="time">'. date('d-m-Y H:i', strtotime($data->tanggal_notice)) . '</span>
								</span>
								<span class="message">'. $data->ket_notice .'</span>
							</a>
						';

		}
		$msg['angka']		= $angka;
		$msg['list_notice']	= $notice;

		echo json_encode($msg);
	}

	public function read_notice_admin( $id, $pegawai ) {
		$read_notice 	= $this->notice_model->admin_read(
							$id,
							$this->session->userdata('kode_pegawai_siskap'),
							date('Y-m-d H:i:s'),
							$_SERVER['REMOTE_ADDR'],
							$pegawai
						);
		redirect (base_url().'pegawai/detail/'.$pegawai);
	}

	public function read_notice_user( $id, $pegawai ) {
		$read_notice 	= $this->notice_model->user_read(
							$this->session->userdata('kode_pegawai_siskap'),
							date('Y-m-d H:i:s'),
							$_SERVER['REMOTE_ADDR']
						);
		redirect (base_url().'pegawai/detail/'.$pegawai);
	}
	
	public function tambah() {
		if ($_POST['nama']!=='') {
			$nama 				= $_POST['nama'];
			$check				= $this->db->query("SELECT * FROM t_notice WHERE nm_notice='$nama' AND sts_notice<>'1';");
			$msg 				= false;
			if ($check->num_rows()==0){
				$kode				= $this->notice_model->buat_kode();		
				$simpan 			= $this->notice_model->tambah(
										$kode,
										$_POST['nama']
									);
				
				if ($simpan) {
					$msg 		= true;
				}
			}			
			echo json_encode($msg);
		}
	}
	
	public function edit() {
		if ($_POST['kode']!=='') {
			$edit 				= $this->notice_model->edit(
									$_POST['kode'],
									$_POST['nama']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
}
