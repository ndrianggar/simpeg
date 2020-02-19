<?php
class Jenis_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_id() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_jenis) AS idmax 
						  FROM t_jenis;"
						);
		$id 			= 1;
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$id 	= ($k->idmax)+1;
			}
		} else {
			$id 		= 1;
		}
		return $id;
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_jenis 
						  WHERE sts_jenis<>'1';"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_jenis 
						  WHERE id_jenis='$kode' AND sts_jenis<>'1';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $id, $kode, $nama, $alias ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_jenis
						  (id_jenis, kd_jenis, nm_jenis, alias_jenis, sts_jenis) 
						  VALUES 
						  ( '$id','$kode', '$nama', '$alias', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $kode, $nama, $alias ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_jenis
						  SET kd_jenis='$kode', nm_jenis='$nama', alias_jenis='$alias' 
						  WHERE id_jenis='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_jenis 
						  SET sts_jenis='1'
						  WHERE id_jenis='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
