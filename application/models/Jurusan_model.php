<?php
class Jurusan_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_jurusan 
						  WHERE sts_jurusan<>'1';"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_jurusan 
						  WHERE id_jurusan='$id' AND sts_jurusan<>'1';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $nama, $alias ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_jurusan
						  (kd_jurusan, nm_jurusan, alias_jurusan, sts_jurusan) 
						  VALUES 
						  ('$kode', '$nama', '$alias', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $kode, $nama, $alias ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_jurusan
						  SET kd_jurusan='$kode', nm_jurusan='$nama', alias_jurusan='$alias' 
						  WHERE id_jurusan='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_jurusan 
						  SET sts_jurusan='1'
						  WHERE id_jurusan='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
