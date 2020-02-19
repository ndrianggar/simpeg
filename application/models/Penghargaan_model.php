<?php
class Penghargaan_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(kd_penghargaan) AS idmax 
							FROM t_penghargaan;"
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
							FROM tmp_penghargaan;"
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
							"SELECT * FROM t_penghargaan 
							WHERE status_penghargaan<>'1' AND kd_penghargaan='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *
							FROM tmp_penghargaan
							WHERE status_penghargaan<>'1' AND kd_penghargaan='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp2( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *
							FROM t_penghargaan
							WHERE status_penghargaan<>'1' AND kd_penghargaan='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_pegawai( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *
							 FROM t_penghargaan
							 WHERE status_penghargaan<>'1' AND id_pegawai='$kode';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $pegawai, $nama, $tahun, $pemberi_penghargaan, $status ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_penghargaan
							(kd_penghargaan, id_pegawai, nama_penghargaan, tahun_penghargaan, 
							pemberi_penghargaan, status_penghargaan) VALUES 
							('$kode', '$pegawai', '$nama', '$tahun', '$pemberi_penghargaan', '$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function tambah_tmp( $tmp, $kode, $pegawai, $nama, $tahun, $pemberi_penghargaan, $status ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO tmp_penghargaan
							(id_tmp,kd_penghargaan, id_pegawai, nama_penghargaan, tahun_penghargaan, 
							pemberi_penghargaan, status_penghargaan) VALUES 
							('$tmp','$kode', '$pegawai', '$nama', '$tahun', '$pemberi_penghargaan', '$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $nama, $tahun, $pemberi ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_penghargaan SET 
							nama_penghargaan='$nama', tahun_penghargaan='$tahun', 
							pemberi_penghargaan='$pemberi' 
							WHERE kd_penghargaan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function terima_edit( $kode ){
		$QuerySaya 		= $this->db->query(
						"UPDATE t_penghargaan A INNER JOIN tmp_penghargaan B 
						ON A.kd_penghargaan=B.kd_penghargaan 
						SET 
						A.nama_penghargaan=B.nama_penghargaan,
						A.tahun_penghargaan=B.tahun_penghargaan,
						A.pemberi_penghargaan=B.pemberi_penghargaan,
						A.file_penghargaan=B.file_penghargaan,
						A.status_penghargaan='0' 
						WHERE A.kd_penghargaan='$kode' AND B.status_penghargaan='0';"
					);
		$QuerySaya 		= $this->db->query(
						"UPDATE tmp_penghargaan  
						SET status_penghargaan='1' 
						WHERE kd_penghargaan='$kode' AND status_penghargaan='0';"
					);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_penghargaan 
							SET status_penghargaan='1'
							WHERE kd_penghargaan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
