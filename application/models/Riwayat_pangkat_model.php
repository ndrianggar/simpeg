<?php
class Riwayat_pangkat_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(kd_riwayat_pangkat) AS idmax 
							FROM t_riwayat_pangkat;"
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
							"SELECT * FROM t_riwayat_pangkat 
							WHERE sts_riwayat_pangkat<>'1' AND kd_riwayat_pangkat='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_pegawai( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT A.kd_riwayat_pangkat,A.id_pangkat,B.nm_pangkat,
							B.gol_pangkat,A.gaji_pangkat,A.tmt_pangkat,A.sk_pejabat,
							A.sk_nomor,A.sk_tanggal,A.sk_file,A.dasar_pangkat,A.pmk,
							A.status_riwayat_pangkat,A.id_pegawai 
							FROM t_riwayat_pangkat A INNER JOIN t_pangkat B 
							ON A.id_pangkat=B.id_pangkat 
							WHERE A.id_pegawai='$kode' AND A.status_riwayat_pangkat<>'1' 
							ORDER BY A.tmt_pangkat;"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $pegawai, $pangkat, $tmt_pangkat, $gaji, $pejabat, $nomor, $tanggal, $dasar, $pmk ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_riwayat_pangkat
							(kd_riwayat_pangkat, id_pegawai, id_pangkat, tmt_pangkat, gaji_pangkat, 
							sk_pejabat, sk_nomor, sk_tanggal, dasar_pangkat, pmk, status_riwayat_pangkat) 
							VALUES 
							('$kode', '$pegawai', '$pangkat', '$tmt_pangkat', '$gaji', 
							'$pejabat', '$nomor', '$tanggal', '$dasar', '$pmk', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $pegawai, $pangkat, $tmt_pangkat, $gaji, $pejabat, $nomor, $tanggal, $dasar, $pmk ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_riwayat_pangkat SET 
							id_pangkat='$pangkat', tmt_pangkat='$tmt_pangkat',
							gaji_pangkat='$gaji', sk_pejabat='$pejabat',
							sk_nomor='$nomor', sk_tanggal='$tanggal', 
							dasar_pangkat='$dasar', pmk='$pmk'
							WHERE kd_riwayat_pangkat='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function edit_sts( $kode, $pegawai, $status ) {
		if ($status=="A") {
			$QuerySaya 		= 	$this->db->query(
							"UPDATE t_riwayat_pangkat 
							SET status_riwayat_pangkat='0'
							WHERE kd_riwayat_pangkat='$kode';"
						);
		} else {
			$QuerySaya 		= 	$this->db->query(
							"UPDATE t_riwayat_pangkat 
							SET status_riwayat_pangkat='0'
							WHERE id_pegawai='$pegawai' AND status_riwayat_pangkat<>'1';"
						);
			$QuerySaya 		= 	$this->db->query(
							"UPDATE t_riwayat_pangkat 
							SET status_riwayat_pangkat='A'
							WHERE kd_riwayat_pangkat='$kode';"
						);
		}
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
	
	public function hapus( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_riwayat_pangkat 
							SET status_riwayat_pangkat='1'
							WHERE kd_riwayat_pangkat='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
