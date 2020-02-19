<?php
class Pendidikan_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(kd_pendidikan) AS idmax 
							FROM t_pendidikan;"
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
							FROM tmp_pendidikan;"
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
							"SELECT A.*,B.nm_jenjang,B.alias_polines,B.alias_umum 
							FROM t_pendidikan A INNER JOIN t_jenjang B 
							ON A.id_jenjang=B.id_jenjang 
							WHERE A.status_pendidikan<>'1' AND A.kd_pendidikan='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT A.*,DATE_FORMAT(A.awal_pendidikan, '%d-%m-%Y') AS awal,
							DATE_FORMAT(A.akhir_pendidikan, '%d-%m-%Y') AS akhir,
							B.nm_jenjang,B.alias_polines,B.alias_umum
							FROM tmp_pendidikan A 
							INNER JOIN t_jenjang B ON A.id_jenjang=B.id_jenjang
							WHERE A.status_pendidikan<>'1' AND A.kd_pendidikan='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp2( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT A.*,DATE_FORMAT(A.awal_pendidikan, '%d-%m-%Y') AS awal,
							DATE_FORMAT(A.akhir_pendidikan, '%d-%m-%Y') AS akhir,
							B.nm_jenjang,B.alias_polines,B.alias_umum
							FROM t_pendidikan A 
							INNER JOIN t_jenjang B ON A.id_jenjang=B.id_jenjang
							WHERE A.status_pendidikan<>'1' AND A.kd_pendidikan='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_pegawai( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT A.*,B.nm_jenjang,B.alias_polines,B.alias_umum 
							FROM t_pendidikan A INNER JOIN t_jenjang B 
							ON A.id_jenjang=B.id_jenjang   
							WHERE A.status_pendidikan<>'1' AND A.id_pegawai='$kode' 
							ORDER BY A.akhir_pendidikan;"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $pegawai, $jenjang, $nama, $jurusan, $awal, $akhir, $ijazah, $tempat, $kepala, $status ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_pendidikan
							(kd_pendidikan, id_pegawai, id_jenjang, nama_pendidikan, jurusan_pendidikan, 
							awal_pendidikan, akhir_pendidikan, ijazah_pendidikan, tempat_pendidikan, kepala_pendidikan, 
							status_pendidikan) VALUES 
							('$kode', '$pegawai', '$jenjang', '$nama', '$jurusan', 
							'$awal', '$akhir', '$ijazah', '$tempat', '$kepala', 
							'$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function tambah_tmp( $tmp, $kode, $pegawai, $jenjang, $nama, $jurusan, $awal, $akhir, $ijazah, $tempat, $kepala, $status ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO tmp_pendidikan
							(id_tmp, kd_pendidikan, id_pegawai, id_jenjang, nama_pendidikan, jurusan_pendidikan, 
							awal_pendidikan, akhir_pendidikan, ijazah_pendidikan, tempat_pendidikan, kepala_pendidikan, 
							status_pendidikan) VALUES 
							('$tmp', '$kode', '$pegawai', '$jenjang', '$nama', '$jurusan', 
							'$awal', '$akhir', '$ijazah', '$tempat', '$kepala', 
							'$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $pegawai, $jenjang, $nama, $jurusan, $awal, $akhir, $ijazah, $tempat, $kepala ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_pendidikan SET 
							id_jenjang='$jenjang', nama_pendidikan='$nama', 
							jurusan_pendidikan='$jurusan', awal_pendidikan='$awal', 
							akhir_pendidikan='$akhir', ijazah_pendidikan='$ijazah', 
							tempat_pendidikan='$tempat', kepala_pendidikan='$kepala' 
							WHERE kd_pendidikan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function terima_edit($kode, $pegawai){
		$QuerySaya 		= $this->db->query(
						"UPDATE t_pendidikan A INNER JOIN tmp_pendidikan B 
						ON A.kd_pendidikan=B.kd_pendidikan 
						SET A.id_jenjang=B.id_jenjang,
						A.nama_pendidikan=B.nama_pendidikan,
						A.jurusan_pendidikan=B.jurusan_pendidikan,
						A.awal_pendidikan=B.awal_pendidikan,
						A.akhir_pendidikan=B.akhir_pendidikan,
						A.ijazah_pendidikan=B.ijazah_pendidikan,
						A.tempat_pendidikan=B.tempat_pendidikan,
						A.kepala_pendidikan=B.kepala_pendidikan,
						A.file_pendidikan=B.file_pendidikan,
						A.status_pendidikan='0' 
						WHERE A.kd_pendidikan='$kode' AND B.status_pendidikan='0';"
					);
		$QuerySaya 		= $this->db->query(
						"UPDATE tmp_pendidikan  
						SET status_pendidikan='1' 
						WHERE kd_pendidikan='$kode' AND status_pendidikan='0';"
					);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function edit_sts( $kode, $pegawai, $status ) {
		if ($status=="1") {
			$QuerySaya 		= 	$this->db->query(
							"UPDATE t_pendidikan 
							SET status_aktif='0'
							WHERE kd_pendidikan='$kode';"
						);
		} else {
			$QuerySaya 		= 	$this->db->query(
							"UPDATE t_pendidikan 
							SET status_aktif='0'
							WHERE id_pegawai='$pegawai';"
						);
			$QuerySaya 		= 	$this->db->query(
							"UPDATE t_pendidikan 
							SET status_aktif='1'
							WHERE kd_pendidikan='$kode';"
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
							"UPDATE t_pendidikan 
							SET status_pendidikan='1'
							WHERE kd_pendidikan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
