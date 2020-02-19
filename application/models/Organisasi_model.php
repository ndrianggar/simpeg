<?php
class Organisasi_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(kd_organisasi) AS idmax 
							FROM t_organisasi;"
						);
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$kode 	= 	$k->idmax +1;
			}
		} else {
			$kode 		= 	1;
		}
		return $kode;
	}
		
	public function buat_kode_tmp() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(id_tmp) AS idmax 
							FROM tmp_organisasi;"
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
							"SELECT * FROM t_organisasi 
							WHERE status_organisasi<>'1' AND kd_organisasi='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *, DATE_FORMAT(awal_organisasi, '%d-%m-%Y') AS awal,
							DATE_FORMAT(akhir_organisasi, '%d-%m-%Y') AS akhir
							FROM tmp_organisasi 
							WHERE status_organisasi<>'1' AND kd_organisasi='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp2( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *, DATE_FORMAT(awal_organisasi, '%d-%m-%Y') AS awal,
							DATE_FORMAT(akhir_organisasi, '%d-%m-%Y') AS akhir
							FROM t_organisasi 
							WHERE status_organisasi<>'1' AND kd_organisasi='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_pegawai( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *
							 FROM t_organisasi
							 WHERE status_organisasi<>'1' AND id_pegawai='$kode';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $pegawai, $nama, $jabatan, $awal, $akhir, $tempat, $ketua, $status ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_organisasi
							(kd_organisasi,id_pegawai,nama_organisasi,jabatan_organisasi,awal_organisasi,
							akhir_organisasi,tempat_organisasi,ketua_organisasi,status_organisasi) VALUES 
							('$kode', '$pegawai', '$nama', '$jabatan', '$awal', 
							'$akhir','$tempat', '$ketua', '$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function tambah_tmp( $tmp, $kode, $pegawai, $nama, $jabatan, $awal, $akhir, $tempat, $ketua, $status ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO tmp_organisasi
							(id_tmp, kd_organisasi,id_pegawai,nama_organisasi,jabatan_organisasi,awal_organisasi,
							akhir_organisasi,tempat_organisasi,ketua_organisasi,status_organisasi) VALUES 
							('$tmp','$kode', '$pegawai', '$nama', '$jabatan', '$awal', 
							'$akhir','$tempat', '$ketua', '$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function edit1( $kode, $pegawai, $nama, $jabatan, $awal, $akhir, $tempat, $ketua ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_organisasi SET 
							nama_organisasi='$nama', jabatan_organisasi='$jabatan', 
							awal_organisasi='$awal',akhir_organisasi='$akhir',tempat_organisasi='$tempat',
							ketua_organisasi='$ketua' 
							WHERE kd_organisasi='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function edit2( $kode, $nama,  $pemberi ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_penghargaan SET 
							nama_penghargaan='$nama', 
							pemberi_penghargaan='$pemberi' 
							WHERE kd_penghargaan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

		
	public function terima_edit($kode, $pegawai){
		$QuerySaya 		= $this->db->query(
						"UPDATE t_organisasi A INNER JOIN tmp_organisasi B 
						ON A.kd_organisasi=B.kd_organisasi 
						SET A.nama_organisasi=B.nama_organisasi,
						A.jabatan_organisasi=B.jabatan_organisasi,
						A.awal_organisasi=B.awal_organisasi,
						A.akhir_organisasi=B.akhir_organisasi,
						A.tempat_organisasi=B.tempat_organisasi,
						A.ketua_organisasi=B.ketua_organisasi,
						A.file_organisasi=B.file_organisasi,
						A.status_organisasi='0' 
						WHERE A.kd_organisasi='$kode' AND B.status_organisasi='0';"
					);
		$QuerySaya 		= $this->db->query(
						"UPDATE tmp_organisasi  
						SET status_organisasi='1' 
						WHERE kd_organisasi='$kode' AND status_organisasi='0';"
					);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}


	public function hapus( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_organisasi 
							SET status_organisasi='1'
							WHERE kd_organisasi='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
