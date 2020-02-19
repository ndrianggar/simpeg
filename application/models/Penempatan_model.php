<?php
class Penempatan_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.id_penempatan,A.nm_penempatan,A.id_jurusan,
						  IFNULL(B.kd_jurusan,'~') AS kode_jurusan,
						  IFNULL(B.nm_jurusan,'~') AS nama_jurusan,A.id_prodi,
						  IFNULL(C.kd_prodi,'~') AS kode_prodi,
						  IFNULL(C.nm_prodi,'~') AS nama_prodi 
						  FROM (t_penempatan A LEFT JOIN t_jurusan B 
						  ON A.id_jurusan=B.id_jurusan) LEFT JOIN t_prodi C 
						  ON A.id_prodi=C.id_prodi 
						  WHERE A.sts_penempatan<>'1' 
						  ORDER BY A.nm_penempatan;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.id_penempatan,A.nm_penempatan,A.id_jurusan,
						  IFNULL(B.kd_jurusan,'~') AS kode_jurusan,
						  IFNULL(B.nm_jurusan,'~') AS nama_jurusan,A.id_prodi,
						  IFNULL(C.kd_prodi,'~') AS kode_prodi,
						  IFNULL(C.nm_prodi,'~') AS nama_prodi 
						  FROM (t_penempatan A LEFT JOIN t_jurusan B 
						  ON A.id_jurusan=B.id_jurusan) LEFT JOIN t_prodi C 
						  ON A.id_prodi=C.id_prodi 
						  WHERE kd_penempatan='$kode' AND A.sts_penempatan<>'1' 
						  ORDER BY A.nm_penempatan;"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $nama, $jurusan, $prodi ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_penempatan
						  (nm_penempatan, id_jurusan, id_prodi, sts_penempatan) 
						  VALUES 
						  ('$nama', '$jurusan', '$prodi', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $nama, $jurusan, $prodi ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_penempatan
						  SET nm_penempatan='$nama', id_jurusan='$jurusan', id_prodi='$prodi' 
						  WHERE id_penempatan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_penempatan 
						  SET sts_penempatan='1'
						  WHERE id_penempatan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
