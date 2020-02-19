<?php
class Prodi_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_jurusan,IFNULL(C.nm_jenjang,'~') AS jenjang 
						  FROM (t_prodi A INNER JOIN t_jurusan B 
						  ON A.id_jurusan=B.id_jurusan) 
						  LEFT JOIN t_jenjang C 
						  ON A.id_jenjang=C.id_jenjang 
						  WHERE A.sts_prodi<>'1' 
						  ORDER BY B.nm_jurusan,A.nm_prodi;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_jurusan,IFNULL(C.nm_jenjang,'~') AS jenjang 
						  FROM (t_prodi A INNER JOIN t_jurusan B 
						  ON A.id_jurusan=B.id_jurusan) 
						  LEFT JOIN t_jenjang C 
						  ON A.id_jenjang=C.id_jenjang 
						  WHERE A.id_prodi='$kode' AND A.sts_prodi<>'1' 
						  ORDER BY B.nm_jurusan,A.nm_prodi;"
						);
		return $QuerySaya->result();
	}

	public function data_prodi($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_prodi 
						  WHERE sts_prodi<>'1' AND id_jurusan='$kode' 
						  ORDER BY nm_prodi;"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $jurusan, $kode, $nama, $alias, $jenjang ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_prodi
						  (id_jurusan, kd_prodi, nm_prodi, alias_prodi, id_jenjang, sts_prodi) 
						  VALUES 
						  ('$jurusan', '$kode', '$nama', '$alias', '$jenjang', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $jurusan, $kode, $nama, $alias, $jenjang ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_prodi
						  SET id_jurusan='$jurusan', kd_prodi='$kode',
						  nm_prodi='$nama', alias_prodi='$alias', 
						  id_jenjang='$jenjang' 
						  WHERE id_prodi='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_prodi 
						  SET sts_prodi='1'
						  WHERE id_prodi='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
