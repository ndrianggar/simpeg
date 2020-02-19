<?php
class Pengurus_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_pegawai) AS idmax 
						  FROM t_pegawai;"
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
						  "SELECT id_pegawai, kd_pegawai, nm_pegawai, foto_pegawai, hak_akses, gelar_belakang
						   FROM t_pegawai 
						   WHERE sts_pegawai <>'1' AND hak_akses='Admin' OR hak_akses='Pimpinan';"
						);
		return $QuerySaya->result();
	}


	public function cari_user() {
		$QuerySaya 		= $this->db->query(
						  "SELECT id_pegawai, kd_pegawai, nm_pegawai, foto_pegawai, hak_akses, gelar_belakang
						   FROM t_pegawai 
						   WHERE sts_pegawai <>'1' AND hak_akses='User';"
						);
		return $QuerySaya->result();
	}

	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pegawai 
						  SET hak_akses='User'
						  WHERE id_pegawai='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}


	public function pilih( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pegawai 
						  SET hak_akses='Admin'
						  WHERE id_pegawai='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function pilih_pimpinan( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pegawai 
						  SET hak_akses='Pimpinan'
						  WHERE id_pegawai='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
