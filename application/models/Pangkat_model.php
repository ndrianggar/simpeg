<?php
class Pangkat_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_pangkat) AS idmax 
						  FROM t_pangkat;"
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
						  "SELECT * FROM t_pangkat 
						  WHERE sts_pangkat<>'1' 
						  ORDER BY kd_pangkat,gol_pangkat, ruang_pangkat;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_pangkat 
						  WHERE id_pangkat='$kode' AND sts_pangkat<>'1' 
						  ORDER BY kd_pangkat,gol_pangkat, ruang_pangkat;"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $id, $kode, $nama, $gol ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_pangkat
						  (id_pangkat, kd_pangkat, nm_pangkat, gol_pangkat, sts_pangkat) 
						  VALUES 
						  ('$id', '$kode', '$nama', '$gol', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $kode, $nama, $gol) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pangkat
						  SET kd_pangkat='$kode', nm_pangkat='$nama', gol_pangkat='$gol'  
						  WHERE id_pangkat='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pangkat 
						  SET sts_pangkat='1'
						  WHERE id_pangkat='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
