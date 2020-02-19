<?php
class Jenis_kursus_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_id() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_jenis_kursus) AS idmax 
						  FROM t_jenis_kursus;"
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
						  "SELECT * FROM t_jenis_kursus 
						  WHERE sts_jenis_kursus<>'1';"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_jenis_kursus 
						  WHERE id_jenis_kursus='$kode' AND sts_jenis_kursus<>'1';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $id, $kode, $nama ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_jenis_kursus
						  (id_jenis_kursus, kd_jenis_kursus, nm_jenis_kursus, sts_jenis_kursus) 
						  VALUES 
						  ( '$id','$kode', '$nama', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $kode, $nama ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_jenis_kursus
						  SET kd_jenis_kursus='$kode', nm_jenis_kursus='$nama'  
						  WHERE id_jenis_kursus='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_jenis_kursus 
						  SET sts_jenis_kursus='1'
						  WHERE id_jenis_kursus='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
