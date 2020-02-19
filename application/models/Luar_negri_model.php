<?php
class Luar_negri_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(kd_kunjungan) AS idmax 
							FROM t_luar_negeri;"
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

	public function buat_kode_tmp() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(id_tmp) AS idmax 
							FROM tmp_luar_negeri;"
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
							"SELECT * FROM t_luar_negeri 
							WHERE status_kunjungan<>'1' AND kd_kunjungan='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *,DATE_FORMAT(awal_kunjungan, '%d-%m-%Y') AS awal,
							DATE_FORMAT(akhir_kunjungan, '%d-%m-%Y') AS akhir 
							FROM tmp_luar_negeri
							WHERE status_kunjungan<>'1' AND kd_kunjungan='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp2( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *,DATE_FORMAT(awal_kunjungan, '%d-%m-%Y') AS awal,
							DATE_FORMAT(akhir_kunjungan, '%d-%m-%Y') AS akhir 
							FROM t_luar_negeri
							WHERE status_kunjungan<>'1' AND kd_kunjungan='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_pegawai( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *,DATE_FORMAT(awal_kunjungan, '%d-%m-%Y') AS awal,
							DATE_FORMAT(akhir_kunjungan, '%d-%m-%Y') AS akhir
							 FROM t_luar_negeri
							 WHERE status_kunjungan<>'1' AND id_pegawai='$kode';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $pegawai, $negara, $tujuan, $awal, $akhir, $pembiayaan, $status) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_luar_negeri
							(kd_kunjungan, id_pegawai, negara, tujuan_kunjungan, 
							awal_kunjungan,akhir_kunjungan, pembiayaan_kunjungan,status_kunjungan) VALUES 
							('$kode', '$pegawai', '$negara', '$tujuan', '$awal','$akhir','$pembiayaan','$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function tambah_tmp( $tmp, $kode, $pegawai, $negara, $tujuan, $awal, $akhir, $pembiayaan) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO tmp_luar_negeri
							(id_tmp, kd_kunjungan, id_pegawai, negara, tujuan_kunjungan, 
							awal_kunjungan,akhir_kunjungan, pembiayaan_kunjungan,status_kunjungan) VALUES 
							('$tmp', '$kode', '$pegawai', '$negara', '$tujuan', '$awal','$akhir','$pembiayaan','0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $negara, $tujuan, $awal, $akhir, $pembiayaan ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_luar_negeri SET 
							negara='$negara', 
							tujuan_kunjungan='$tujuan', 
							awal_kunjungan='$awal',
							akhir_kunjungan='$akhir',
							pembiayaan_kunjungan='$pembiayaan' 
							WHERE kd_kunjungan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function terima_edit( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_luar_negeri A INNER JOIN tmp_luar_negeri B 
							ON A.kd_kunjungan=B.kd_kunjungan 
							SET 
							A.negara=B.negara, 
							A.tujuan_kunjungan=B.tujuan_kunjungan, 
							A.awal_kunjungan=B.awal_kunjungan,
							A.akhir_kunjungan=B.akhir_kunjungan,
							A.pembiayaan_kunjungan=B.pembiayaan_kunjungan,
							A.status_kunjungan='0' 
							WHERE A.kd_kunjungan='$kode' AND B.status_kunjungan='0';"
						);
		$QuerySaya 		= $this->db->query(
						"UPDATE tmp_luar_negeri  
						SET status_kunjungan='1' 
						WHERE kd_kunjungan='$kode' AND status_kunjungan='0';"
					);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
	
	public function hapus( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_luar_negeri 
							SET status_kunjungan='1'
							WHERE kd_kunjungan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
