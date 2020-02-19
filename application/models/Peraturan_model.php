<?php
class Peraturan_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(kd_peraturan) AS idmax 
						  FROM t_peraturan;"
						);
		$kode 			= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$tmp 	= ((int)$k->idmax)+1;
				$kode 	= str_pad($tmp, 12, "0", STR_PAD_LEFT);
			}
		} else {
			$kode 		= "000000000001";
		}
		return $kode;
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_peraturan 
						  WHERE sts_peraturan<>'1' 
						  ORDER BY nm_peraturan;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_peraturan 
						  WHERE kd_peraturan='$kode' AND sts_peraturan<>'1';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $nama, $tanggal, $kepala ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_peraturan
						  (kd_peraturan, nm_peraturan, tgl_peraturan, kepala_peraturan, sts_peraturan) 
						  VALUES 
						  ('$kode', '$nama', '$tanggal', '$kepala', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $nama, $tanggal, $kepala ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_peraturan
						  SET nm_peraturan='$nama', tgl_peraturan='$tanggal',
						  kepala_peraturan='$kepala'  
						  WHERE kd_peraturan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_peraturan 
						  SET sts_peraturan='1'
						  WHERE kd_peraturan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
