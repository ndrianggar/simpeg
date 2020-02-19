<?php
class Golongan_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(kd_golongan) AS idmax 
						  FROM t_golongan;"
						);
		$kode 			= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$tmp 	= ((int)$k->idmax)+1;
				$kode 	= str_pad($tmp, 4, "0", STR_PAD_LEFT);
			}
		} else {
			$kode 		= "0001";
		}
		return $kode;
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_golongan 
						  WHERE sts_golongan<>'1' 
						  ORDER BY nm_golongan;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_golongan 
						  WHERE kd_golongan='$kode' AND sts_golongan<>'1';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $nama ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_golongan
						  (kd_golongan, nm_golongan, sts_golongan) 
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
						  "UPDATE t_golongan
						  SET nm_golongan='$nama' 
						  WHERE kd_golongan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_golongan 
						  SET sts_golongan='1'
						  WHERE kd_golongan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
