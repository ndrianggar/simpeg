<?php
class Suratlain_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_id() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(id_surat_lain) AS idmax 
							FROM t_surat_lain;"
						);
		$id 			= 	1;
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$id 	= 	($k->idmax)+1;
			}
		}
		return $id;
	}
		
	public function buat_kode_tmp() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(id_tmp) AS idmax 
							FROM tmp_surat_lain;"
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

	public function cari_kd( $id ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT * FROM t_surat_lain 
							WHERE status_surat_lain<>'1' AND id_surat_lain='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_pegawai( $id ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *
							 FROM t_surat_lain
							 WHERE status_surat_lain<>'1' AND id_pegawai='$id';"
						);
		return $QuerySaya->result();
	}
		
	public function cari_tmp( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *, DATE_FORMAT(tanggal_surat_lain, '%d-%m-%Y') AS tgl_surat_lain
							FROM tmp_surat_lain 
							WHERE status_surat_lain<>'1' AND id_surat_lain='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp2( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT *, DATE_FORMAT(tanggal_surat_lain, '%d-%m-%Y') AS tgl_surat_lain
							FROM t_surat_lain 
							WHERE status_surat_lain<>'1' AND id_surat_lain='$kode';"
						);
		return $QuerySaya->result();
	}

	public function tambah( $id, $pegawai, $nama, $tanggal, $tempat, $keterangan, $status ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_surat_lain
							(id_surat_lain, id_pegawai, nama_surat_lain, tanggal_surat_lain, 
							tempat_surat_lain, keterangan_surat_lain, status_surat_lain) VALUES 
							('$id', '$pegawai', '$nama', '$tanggal', '$tempat', '$keterangan', '$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function tambah_tmp( $tmp, $id, $pegawai, $nama, $tanggal, $tempat, $keterangan, $status ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO tmp_surat_lain
							(id_tmp,id_surat_lain, id_pegawai, nama_surat_lain, tanggal_surat_lain, 
							tempat_surat_lain, keterangan_surat_lain, status_surat_lain) VALUES 
							('$tmp','$id', '$pegawai', '$nama', '$tanggal', '$tempat', '$keterangan', '$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $nama, $tanggal, $tempat, $keterangan ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_surat_lain SET 
							nama_surat_lain='$nama', 
							tanggal_surat_lain='$tanggal', 
							tempat_surat_lain='$tempat',
							keterangan_surat_lain='$keterangan' 
							WHERE id_surat_lain='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_surat_lain 
							SET status_surat_lain='1'
							WHERE id_surat_lain='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function terima_edit($kode, $pegawai){
		$QuerySaya 		= $this->db->query(
						"UPDATE t_surat_lain A INNER JOIN tmp_surat_lain B 
						ON A.id_surat_lain=B.id_surat_lain 
						SET A.nama_surat_lain=B.nama_surat_lain,
						A.nomor_surat_lain=B.nomor_surat_lain,
						A.tempat_surat_lain=B.tempat_surat_lain,
						A.kepala_surat_lain=B.kepala_surat_lain,
						A.tanggal_surat_lain=B.tanggal_surat_lain,
						A.keterangan_surat_lain=B.keterangan_surat_lain,
						A.file_surat_lain=B.file_surat_lain,
						A.status_surat_lain='0' 
						WHERE A.id_surat_lain='$kode' AND B.status_surat_lain='0';"
					);
		$QuerySaya 		= $this->db->query(
						"UPDATE tmp_surat_lain  
						SET status_surat_lain='1' 
						WHERE id_surat_lain='$kode' AND status_surat_lain='0';"
					);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

}
