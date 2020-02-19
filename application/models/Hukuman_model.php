<?php
class Hukuman_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(kd_hukuman) AS idmax 
							FROM t_hukuman;"
						);
		$kode 			= 	"";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$tmp 	= 	((int)$k->idmax)+1;
				$kode 	= 	str_pad($tmp, 12, "0", STR_PAD_LEFT);
			}
		} else {
			$kode 		= 	"000000000001";
		}
		return $kode;
	}
		
	public function cari_kd( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT * FROM t_hukuman 
							WHERE status_hukuman<>'1' AND kd_hukuman='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_pegawai( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *,DATE_FORMAT(sk_tanggal, '%d-%m-%Y') AS tanggal 
							 FROM t_hukuman
							 WHERE status_hukuman<>'1' AND id_pegawai='$kode';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $pegawai, $jenis, $sanksi, $kepala, $nomor, $tanggal, $status) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_hukuman
							(kd_hukuman, id_pegawai, jenis_hukuman, sanksi_hukuman, 
							sk_pejabat, sk_nomor, sk_tanggal, status_hukuman) VALUES 
							('$kode', '$pegawai', '$jenis', '$sanksi', '$kepala', '$nomor', '$tanggal', '$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $pegawai, $jenis, $sanksi, $kepala, $nomor, $tanggal) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_hukuman SET 
							jenis_hukuman='$jenis', 
							sanksi_hukuman='$sanksi', 
							sk_pejabat='$kepala',
							sk_nomor='$nomor',
							sk_tanggal='$tanggal'  
							WHERE kd_hukuman='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
	
	public function hapus( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_hukuman 
							SET status_hukuman='1'
							WHERE kd_hukuman='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
