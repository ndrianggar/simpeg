<?php
class Kursus_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(kd_kursus) AS idmax 
							FROM t_kursus;"
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
							FROM tmp_kursus;"
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
							"SELECT * FROM t_kursus 
							WHERE sts_kursus<>'1' AND kd_kursus='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT A.*,DATE_FORMAT(awal_kursus, '%d-%m-%Y') AS awal,
							DATE_FORMAT(akhir_kursus, '%d-%m-%Y') AS akhir, B.nm_jenis_kursus
							FROM tmp_kursus A
							INNER JOIN t_jenis_kursus B ON A.id_jenis_kursus=B.id_jenis_kursus
							WHERE A.status_kursus<>'1' AND A.kd_kursus='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp2( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT A.*,DATE_FORMAT(awal_kursus, '%d-%m-%Y') AS awal,
							DATE_FORMAT(akhir_kursus, '%d-%m-%Y') AS akhir, B.nm_jenis_kursus
							FROM t_kursus A
							INNER JOIN t_jenis_kursus B ON A.id_jenis_kursus=B.id_jenis_kursus
							WHERE A.status_kursus<>'1' AND A.kd_kursus='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_pegawai( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT A.*,B.nm_jenis_kursus 
							FROM t_kursus A INNER JOIN t_jenis_kursus B 
							ON A.id_jenis_kursus=B.id_jenis_kursus    
							WHERE A.status_kursus<>'1' AND A.id_pegawai='$kode' 
							ORDER BY A.akhir_kursus;"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $pegawai, $jenis, $nama, $awal, $akhir, $ijazah, $tempat, $kepala, $durasi, $status ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_kursus
							(kd_kursus, id_pegawai, id_jenis_kursus, nama_kursus, awal_kursus, 
							akhir_kursus, ijazah_kursus, tempat_kursus, kepala_kursus, durasi_kursus, 
							status_kursus) 
							VALUES 
							('$kode', '$pegawai', '$jenis', '$nama', '$awal',  
							'$akhir', '$ijazah', '$tempat', '$kepala', '$durasi',
							'$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function tambah_tmp( $tmp, $kode, $pegawai, $jenis, $nama, $awal, $akhir, $ijazah, $tempat, $kepala, $durasi, $status ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO tmp_kursus
							(id_tmp, kd_kursus, id_pegawai, id_jenis_kursus, nama_kursus, 
							awal_kursus, akhir_kursus, ijazah_kursus, tempat_kursus, kepala_kursus, 
							durasi_kursus, status_kursus) 
							VALUES 
							('$tmp','$kode', '$pegawai', '$jenis', '$nama', 
							'$awal', '$akhir', '$ijazah', '$tempat', '$kepala', 
							'$durasi', '$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $pegawai, $jenis, $nama, $awal, $akhir, $ijazah, $tempat, $kepala, $durasi ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_kursus SET 
							id_jenis_kursus='$jenis',
							nama_kursus='$nama', awal_kursus='$awal', 
							akhir_kursus='$akhir', ijazah_kursus='$ijazah', 
							tempat_kursus='$tempat', kepala_kursus='$kepala',
							durasi_kursus='$durasi'  
							WHERE kd_kursus='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function terima_edit($kode, $pegawai){
		$QuerySaya 		= $this->db->query(
						"UPDATE t_kursus A INNER JOIN tmp_kursus B 
						ON A.kd_kursus=B.kd_kursus 
						SET 
						A.id_jenis_kursus=B.id_jenis_kursus,
						A.nama_kursus=B.nama_kursus,
						A.awal_kursus=B.awal_kursus,
						A.akhir_kursus=B.akhir_kursus,
						A.ijazah_kursus=B.ijazah_kursus,
						A.tempat_kursus=B.tempat_kursus,
						A.kepala_kursus=B.kepala_kursus,
						A.durasi_kursus=B.durasi_kursus,
						A.file_kursus=B.file_kursus,
						A.status_kursus='0' 
						WHERE A.kd_kursus='$kode' AND B.status_kursus='0';"
					);
		$QuerySaya 		= $this->db->query(
						"UPDATE tmp_kursus  
						SET status_kursus='1' 
						WHERE kd_kursus='$kode' AND status_kursus='0';"
					);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
	
	public function hapus( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_kursus 
							SET status_kursus='1'
							WHERE kd_kursus='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
