<?php
class Alamat_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(id_propinsi) AS idmax 
							FROM alamat_propinsi;"
						);
		$kode 			= 	"";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$tmp 	= 	((int)$k->idmax)+1;
				$kode 	= 	str_pad($tmp, 1, STR_PAD_LEFT);
			}
		} else {
			$kode 		= 	"1";
		}
		return $kode;
	}
		
	public function buat_kode_kota() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(id_kota) AS idmax 
							FROM alamat_kota;"
						);
		$kode 			= 	"";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$tmp 	= 	((int)$k->idmax)+1;
				$kode 	= 	str_pad($tmp, 1, STR_PAD_LEFT);
			}
		} else {
			$kode 		= 	"1";
		}
		return $kode;
	}

	public function buat_kode_kecamatan() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(id_kecamatan) AS idmax 
							FROM alamat_kecamatan;"
						);
		$kode 			= 	"";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$tmp 	= 	((int)$k->idmax)+1;
				$kode 	= 	str_pad($tmp, 1, STR_PAD_LEFT);
			}
		} else {
			$kode 		= 	"1";
		}
		return $kode;
	}

	public function buat_kode_kelurahan() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(id_kelurahan) AS idmax 
							FROM alamat_kelurahan;"
						);
		$kode 			= 	"";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$tmp 	= 	((int)$k->idmax)+1;
				$kode 	= 	str_pad($tmp, 1, STR_PAD_LEFT);
			}
		} else {
			$kode 		= 	"1";
		}
		return $kode;
	}

	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*
							FROM alamat_propinsi A
							LEFT JOIN alamat_kota B ON A.id_propinsi = B.id_propinsi
							WHERE B.status_kota<>'1' AND B.id_propinsi='$kode'
							ORDER BY B.nama_kota;"
						);					
		return $QuerySaya->result();
	}

	public function cari_id_kota( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*
							FROM alamat_propinsi A
							LEFT JOIN alamat_kota B ON A.id_propinsi = B.id_propinsi
							WHERE B.status_kota<>'1' AND B.id_kota='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_id_kecamatan( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*, C.*
							FROM alamat_propinsi A
							LEFT JOIN alamat_kota B ON A.id_propinsi = B.id_propinsi
							LEFT JOIN alamat_kecamatan C ON B.id_kota = C.id_kota
							WHERE C.status_kecamatan<>'1' AND C.id_kecamatan='$kode';"
						);
		return $QuerySaya->result();
	}
	public function data_propinsi() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM alamat_propinsi 
						  WHERE status_propinsi<>'1' 
						  ORDER BY nama_propinsi;"
						);
		return $QuerySaya->result();
	}

	public function data_kota($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM alamat_kota 
						  WHERE status_kota<>'1' AND id_propinsi='$kode' 
						  ORDER BY nama_kota;"
						);
		return $QuerySaya->result();
	}

	public function data_kecamatan($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM alamat_kecamatan 
						  WHERE status_kecamatan<>'1' AND id_kota='$kode' 
						  ORDER BY nama_kecamatan;"
						);
		return $QuerySaya->result();
	}

	public function data_kelurahan($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM alamat_kelurahan 
						  WHERE status_kelurahan<>'1' AND id_kecamatan='$kode' 
						  ORDER BY nama_kelurahan;"
						);
		return $QuerySaya->result();
	}
	

	public function tambah_propinsi( $kode, $nama ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO alamat_propinsi
							(id_propinsi, nama_propinsi, status_propinsi) VALUES 
							('$kode', '$nama', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function edit_propinsi( $kode, $nama ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE alamat_propinsi SET 
							nama_propinsi='$nama' 
							WHERE id_propinsi='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function hapus_propinsi( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE alamat_propinsi 
							SET status_propinsi='1'
							WHERE id_propinsi='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}


	public function tambah_kota( $kode, $propinsi, $nama ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO alamat_kota
							(id_kota, id_propinsi, nama_kota, status_kota) VALUES 
							('$kode', '$propinsi', '$nama', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function edit_kota( $kode, $nama ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE alamat_kota SET 
							nama_kota='$nama' 
							WHERE id_kota='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function hapus_kota( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE alamat_kota 
							SET status_kota='1'
							WHERE id_kota='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function tambah_kecamatan( $kode, $kota, $nama ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO alamat_kecamatan
							(id_kecamatan, id_kota, nama_kecamatan, status_kecamatan) VALUES 
							('$kode', '$kota', '$nama', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function edit_kecamatan( $kode, $nama ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE alamat_kecamatan SET 
							nama_kecamatan='$nama' 
							WHERE id_kecamatan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function hapus_kecamatan( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE alamat_kecamatan 
							SET status_kecamatan='1'
							WHERE id_kecamatan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function tambah_kelurahan( $kode, $kecamatan, $nama, $pos ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO alamat_kelurahan
							(id_kelurahan, id_kecamatan, nama_kelurahan, kodepos_kelurahan, status_kelurahan) VALUES 
							('$kode', '$kecamatan', '$nama', '$pos', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function edit_kelurahan( $kode, $nama, $pos ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE alamat_kelurahan SET 
							nama_kelurahan='$nama',
							kodepos_kelurahan='$pos' 
							WHERE id_kelurahan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function hapus_kelurahan( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE alamat_kelurahan 
							SET status_kelurahan='1'
							WHERE id_kelurahan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
