<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('kode_pegawai_siskap')== Null) {
			redirect ('user/logout');
		}
	}

	public function total_pegawai(){
		$data 		= $this->db->query(
						"SELECT COUNT(id_pegawai) AS total 
						FROM t_pegawai WHERE sts_pegawai='0' 
						GROUP BY sts_pegawai;"
					);
		foreach ($data->result() as $data) {
			$msg 	= $data->total;
		}
		echo json_encode($msg);
	}
}
