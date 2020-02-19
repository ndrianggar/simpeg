<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->library('form_validation');
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
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
		$this->load->model('setting_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/pegawai/data_setting_admin');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/pegawai/data_setting_admin');
			} else {
				$kode 				= $this->session->userdata('kode_pegawai_siskap');
				$data['pegawai']	= $this->pegawai_model->cari_kd($kode);
				$data['hubungan']	= $this->keluarga_model->hubungan();
				$data['jenjang']	= $this->jenjang_model->cari_semua();
				$data['pangkat']	= $this->pangkat_model->cari_semua();
				$data['jenis']		= $this->jabatan_model->cari_jenis();
				$data['jabatan']	= $this->jabatan_model->cari_semua();
				$data['penempatan']	= $this->penempatan_model->cari_semua();
				$data['agama']		= $this->agama_model->cari_semua();
				$data['profil']		= $this->setting_model->cari_semua();
				$this->load->view('user/pegawai/data_setting_user', $data );
			}
		}
	}

	public function data_list()
	{
		$query  = "SELECT * FROM t_pegawai WHERE id_pegawai = ".$this->session->userdata('kode_pegawai_siskap');
		$data   = $this->db->query($query)->row();

		header('Content-type: text/javascript');
		echo json_encode($data);
	}

	public function edit(){
		if (isset($_POST['nama'])) {
			$simpan 	= $this->setting_model->edit(
							$_POST['id'],
							$_POST['nama'],
							$_POST['email'],
							$this->bcrypt->hash_password($_POST['password'])
						);
				
			if ($simpan) {
				$msg	= true;
			}
		}
		echo json_encode($msg);	

	}


    public function changePasswd()
    {
        $data = array('status' => false, 'messages' => array());

        $this->form_validation->set_rules("password", "Password", "required");
        $this->form_validation->set_rules("password1", "Konfirmasi Password", "required");
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run()) 
        {
            $user = $this->reset_model->get_by_id($this->session->userdata('kode_pegawai_siskap'));

                if($_POST['password'] == $_POST['password1'])
                {   
                    
                     $ubah = $this->reset_model->change_pass($this->session->userdata('kode_pegawai_siskap'), $_POST['password']);
                     if($ubah)
                     {
                        $data['status'] = TRUE;
                     }   
                }
                else
                {
                    foreach ($_POST as $key => $value)
                    {
                        $data['messages'][$key] = form_error($key);
                    }
                    $data['messages']['password1'] = '<p class="text-danger">Password dan konfirmasi tidak sama</p>';
                }
            
        }
        else
        {
            foreach ($_POST as $key => $value) 
            {
                $data['messages'][$key] = form_error($key);
            }
        }
        
        header('Content-type: text/javascript');
        echo json_encode($data);
    }


}
