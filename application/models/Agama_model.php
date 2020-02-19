<?php
class Agama_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(kd_agama) AS idmax 
						  FROM t_agama;"
						);
		$kode 			= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$tmp 	= ((int)$k->idmax)+1;
				$kode 	= str_pad($tmp, 2, "0", STR_PAD_LEFT);
			}
		} else {
			$kode 		= "01";
		}
		return $kode;
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_agama 
						  WHERE sts_agama<>'1' 
						  ORDER BY nm_agama;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_agama 
						  WHERE kd_agama='$kode' AND sts_agama<>'1';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $nama ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_agama
						  (kd_agama, nm_agama, sts_agama) 
						  VALUES 
						  ('$kode', '$nama', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $nama ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_agama
						  SET nm_agama='$nama' 
						  WHERE kd_agama='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_agama 
						  SET sts_agama='1'
						  WHERE kd_agama='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
