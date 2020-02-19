<?php
class Jabatan_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(kd_jabatan) AS idmax 
						  FROM t_jabatan;"
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
						  "SELECT A.kd_jabatan,A.kd_jenis,B.nm_jenis,A.nm_jabatan,
						  A.kd_eselon,IFNULL(C.nm_eselon,'-') AS nama_eselon,
						  A.kls_jabatan,A.tunj_jabatan,A.kd_peraturan,
						  IFNULL(D.nm_peraturan,'-') AS peraturan,A.sts_jabatan 
						  FROM ((t_jabatan A INNER JOIN t_jenis_jabatan B 
						  ON A.kd_jenis=B.kd_jenis) LEFT JOIN t_eselon C 
						  ON A.kd_eselon=C.kd_eselon) LEFT JOIN t_peraturan D 
						  ON A.kd_peraturan=D.kd_peraturan   
						  WHERE A.sts_jabatan<>'1'
						  ORDER BY B.nm_jenis,A.nm_jabatan;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.kd_jabatan,A.kd_jenis,B.nm_jenis,A.nm_jabatan,
						  A.kd_eselon,IFNULL(C.nm_eselon,'-') AS nama_eselon,
						  A.kls_jabatan,A.tunj_jabatan,A.kd_peraturan,
						  IFNULL(D.nm_peraturan,'-') AS peraturan,A.sts_jabatan 
						  FROM ((t_jabatan A INNER JOIN t_jenis_jabatan B 
						  ON A.kd_jenis=B.kd_jenis) LEFT JOIN t_eselon C 
						  ON A.kd_eselon=C.kd_eselon) LEFT JOIN t_peraturan D 
						  ON A.kd_peraturan=D.kd_peraturan  
						  WHERE A.kd_jabatan='$kode' AND A.sts_jabatan<>'1'  
						  ORDER BY B.nm_jenis,A.nm_jabatan;"
						);
		return $QuerySaya->result();
	}

	public function cari_jenis() {
		$QuerySaya		= $this->db->query(
						  "SELECT * FROM t_jenis_jabatan WHERE sts_jenis<>'1' ORDER BY nm_jenis;"
						);
		return $QuerySaya->result();
	}

	public function data_jenis($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_jabatan 
						  WHERE sts_jabatan<>'1' AND kd_jenis='$kode' 
						  ORDER BY nm_jabatan;"
						);
		return $QuerySaya->result();
	}
	
	public function tambah( $kode, $jenis, $eselon, $nama, $kelas, $tunjangan, $peraturan ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_jabatan
						  (kd_jabatan, kd_jenis, kd_eselon, nm_jabatan, kls_jabatan, tunj_jabatan, kd_peraturan, sts_jabatan) 
						  VALUES 
						  ('$kode', '$jenis', '$eselon', '$nama', '$kelas', '$tunjangan', '$peraturan', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $jenis, $eselon, $nama, $kelas, $tunjangan, $peraturan ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_jabatan
						  SET nm_jabatan='$nama', kd_jenis='$jenis',
						  kd_eselon='$eselon', kls_jabatan='$kelas',
						  tunj_jabatan='$tunjangan', kd_peraturan='$peraturan' 
						  WHERE kd_jabatan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_jabatan 
						  SET sts_jabatan='1'
						  WHERE kd_jabatan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
