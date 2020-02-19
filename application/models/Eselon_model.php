<?php
class Eselon_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(kd_eselon) AS idmax 
						  FROM t_eselon;"
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
						  "SELECT * FROM t_eselon 
						  WHERE sts_eselon<>'1' 
						  ORDER BY nm_eselon;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_eselon 
						  WHERE kd_eselon='$kode' AND sts_eselon<>'1';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $nama ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_eselon
						  (kd_eselon, nm_eselon, sts_eselon) 
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
						  "UPDATE t_eselon
						  SET nm_eselon='$nama' 
						  WHERE kd_eselon='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_eselon 
						  SET sts_eselon='1'
						  WHERE kd_eselon='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
