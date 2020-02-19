<?php
class Status_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_id() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_status) AS idmax 
						  FROM t_pegawai_status;"
						);
		$id 			= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$id		= ($k->idmax)+1;
			}
		} else {
			$id 		= 1;
		}
		return $id;
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_pegawai_status 
						  WHERE status_status<>'1' 
						  ORDER BY nama_status;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_pegawai_status 
						  WHERE id_status='$id' AND status_status<>'1';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $id, $nama ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_pegawai_status
						  (id_status, nama_status, status_status) 
						  VALUES 
						  ('$id', '$nama', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $nama ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pegawai_status
						  SET nama_status='$nama' 
						  WHERE id_status='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pegawai_status 
						  SET status_status='1'
						  WHERE id_status='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}