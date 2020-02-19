<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->library('form_validation');
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pegawai_model');
		$this->load->model('reset_model');
	}

	public function index() {
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			$this->load->view('login');
		} else {
			if ($this->session->userdata('akses_pegawai_siskap')=='Admin') {
				$this->load->view('admin/master/data_reset');
			}else if($this->session->userdata('akses_pegawai_siskap')=='Pimpinan'){
				$this->load->view('pimpinan/master/data_reset');
			}
		}
	}

	public function data() {
		$data					= $this->reset_model->cari_semua();
		$hasil 					= array();
		$result 				= array();
		$nomor					= 0;
		foreach ($data as $data) {
			$nomor 				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nip' 			=> $data->kd_pegawai,
					'nama' 			=> $data->nm_pegawai 	.' '. $data->gelar_belakang	,
					'email' 		=> $data->email_pegawai,
					'action' 		=> '<div class="btn-group">
								  		<button id="btn-reset" type="button" class="btn btn-success btn-xs" 
											data-id="' 		. $data->id_pegawai 	. '" 
											data-nama="' 	. $data->pass_pegawai 	. '" 
											><i>Reset</i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}
	
	// public function ganti() {
	// 	if (isset($_POST['password_baru'])!== $_POST['konfirmasi_password']) {
	// 		$msg 			= false;
	// 	}elseif (isset($_POST['password_baru'])== $_POST['konfirmasi_password']) {
	// 		$edit 				= $this->reset_model->ganti(
	// 								$_POST['id'],
	// 								$_POST['konfirmasi_password']
	// 							);
	// 			$msg 			= true;
	// 	}
	// 	echo json_encode($msg);
	// }

    public function changePasswd()
    {
        $data = array('status' => false, 'messages' => array());

        $this->form_validation->set_rules("password", "Password", "required");
        $this->form_validation->set_rules("password1", "Konfirmasi Password", "required");
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run()) 
        {
            $user = $this->reset_model->get_by_id($_POST['id']);

                if($_POST['password'] == $_POST['password1'])
                {   
                    
                     $ubah = $this->reset_model->change_pass($_POST['id'], $this->bcrypt->hash_password($_POST['password']));
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
