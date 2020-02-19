<?php
class Pertanyaan_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id) AS idmax 
						  FROM t_pertanyaan;"
						);
		$kode 			= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$tmp 	= ((int)$k->idmax)+1;
				$kode 	= str_pad($tmp, 10, "0", STR_PAD_LEFT);
			}
		} else {
			$kode 		= "0000000001";
		}
		return $kode;
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_pertanyaan 
						  WHERE status<>'1' 
						  ORDER BY tanggal,judul;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_pertanyaan 
						  WHERE id='$id' AND status<>'1';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $id, $tanggal, $judul, $isi, $nama, $jabatan ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_pertanyaan
						  ( id, tanggal, judul, isi, nama, jabatan, status) 
						  VALUES 
						  ('$id', '$tanggal', '$judul', '$isi', '$nama', '$jabatan', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $nama ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pertanyaan
						  SET nm_pertanyaan='$nama' 
						  WHERE kd_pertanyaan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pertanyaan 
						  SET sts_pertanyaan='1'
						  WHERE kd_pertanyaan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
