<?php
class Jenjang_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
			
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_jenjang 
						  WHERE sts_jenjang<>'1' 
						  ORDER BY kd_jenjang;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_jenjang 
						  WHERE id_jenjang='$id' AND sts_jenjang<>'1';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $nama , $alias1, $alias2 ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_jenjang
						  (kd_jenjang, nm_jenjang, alias_polines, alias_umum, sts_jenjang) 
						  VALUES 
						  ('$kode', '$nama', '$alias1', '$alias2', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $kode, $nama , $alias1, $alias2 ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_jenjang
						  SET kd_jenjang='$kode', nm_jenjang='$nama',
						  alias_polines='$alias1', alias_umum='$alias2'  
						  WHERE id_jenjang='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_jenjang 
						  SET sts_jenjang='1'
						  WHERE id_jenjang='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
