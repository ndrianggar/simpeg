<?php
class Pensiun_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(kd_pensiun) AS idmax 
							FROM t_pensiun;"
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

	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.nm_pegawai, B.nip_baru, C.*, D.*, B.gelar_belakang, B.gelar_depan
							FROM t_pensiun A INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							INNER JOIN t_pangkat C ON A.pangkat_pensiun=C.id_pangkat
							INNER JOIN t_jabatan D ON A.jabatan_pensiun=D.kd_jabatan
							WHERE A.status_pensiun<>'1'
							ORDER BY A.nomor_pensiun;"
						);
		return $QuerySaya->result();
	}

	public function cari_edit($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.nm_pegawai, B.nip_baru, (C.nm_pegawai) nama, B.gelar_depan, B.gelar_belakang
						  FROM t_pensiun A INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
						  INNER JOIN t_pegawai C ON A.penandatangan_pensiun=C.id_pegawai
						  WHERE A.status_pensiun<>'1' AND A.kd_pensiun='$id';"
						);
		return $QuerySaya->result();
	}

	public function cari_cetak($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.nm_pegawai, B.nip_baru, B.tempat_lahir, B.tanggal_lahir, B.alamat_jalan, (C.nm_pegawai) as nama, (C.nip_baru)as nip, D.*, E.*, (F.kd_jabatan)as aa, (F.nm_jabatan)as nm_jabatan2, B.gelar_depan, B.gelar_belakang
							FROM t_pensiun A INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							INNER JOIN t_pegawai C ON A.penandatangan_pensiun=C.id_pegawai
							INNER JOIN t_pangkat D ON A.pangkat_pensiun=D.id_pangkat
							INNER JOIN t_jabatan E ON A.jabatan_pensiun=E.kd_jabatan
							INNER JOIN t_jabatan F ON A.penandatangan_jabatan=F.kd_jabatan
							WHERE A.status_pensiun<>'1' AND A.kd_pensiun='$id'
							ORDER BY A.nomor_pensiun;"
						);
		return $QuerySaya->result();
	}

	public function cari_prev($kode, $kode2) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.nm_pegawai, B.nip_baru, B.tempat_lahir, B.tanggal_lahir, B.alamat_jalan, (C.nm_pegawai) as nama, (C.nip_baru)as nip, D.*, E.*, (F.kd_jabatan)as aa, (F.nm_jabatan)as nm_jabatan2, B.gelar_depan, B.gelar_belakang
							FROM t_pensiun A INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							INNER JOIN t_pegawai C ON A.penandatangan_pensiun=C.id_pegawai
							INNER JOIN t_pangkat D ON A.pangkat_pensiun=D.id_pangkat
							INNER JOIN t_jabatan E ON A.jabatan_pensiun=E.kd_jabatan
							INNER JOIN t_jabatan F ON A.penandatangan_jabatan=F.kd_jabatan
							WHERE A.status_pensiun<>'1' AND B.id_pegawai='$kode' AND A.penandatangan_pensiun='$kode2'
							ORDER BY A.nomor_pensiun;"
						);
		return $QuerySaya->result();
	}

	// public function cari_prev($kode) {
	// 	$QuerySaya 		= $this->db->query(
	// 					  "SELECT A.*, B.nm_pegawai, B.nip_baru, B.tempat_lahir, B.tanggal_lahir, B.alamat_jalan, (C.nm_pegawai) nama, (C.nip_baru)nip
	// 					  FROM t_pensiun A INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
	// 					  INNER JOIN t_pegawai C ON A.penandatangan_pensiun=C.id_pegawai
	// 					  WHERE A.status_pensiun<>'1' AND B.id_pegawai='$kode' 
	// 					  ORDER BY A.nomor_pensiun;"
	// 					);
	// 	return $QuerySaya->result();
	// }

	public function tambah( $kode, $nomor, $perihal, $tanggal, $nama, $pangkat, $jabatan, $penempatan, $penandatangan, $penandatangan_jabatan, 
							$tujuan, $pembukaan, $lampiran, $penutup, $tembusan) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_pensiun
							(kd_pensiun, nomor_pensiun, perihal_pensiun, tanggal_pensiun, id_pegawai,pangkat_pensiun,
							jabatan_pensiun, penempatan_pensiun, penandatangan_pensiun, penandatangan_jabatan, tujuan_pensiun, 
							pembukaan_pensiun, lampiran_pensiun, penutup_pensiun, tembusan_pensiun, status_pensiun) VALUES 
							('$kode', '$nomor', '$perihal', '$tanggal', '$nama', '$pangkat',
							'$jabatan','$penempatan','$penandatangan','$penandatangan_jabatan','$tujuan', 
							'$pembukaan', '$lampiran', '$penutup', '$tembusan', '0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $nomor, $perihal, $tanggal, $nama, $pangkat, $jabatan, $penempatan, $penandatangan, $penandatangan_jabatan, 
							$tujuan, $pembukaan, $lampiran, $penutup, $tembusan ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_pensiun SET 
							nomor_pensiun='$nomor', perihal_pensiun='$perihal', tanggal_pensiun='$tanggal', 
							id_pegawai='$nama', pangkat_pensiun='$pangkat', 
							jabatan_pensiun='$jabatan', penempatan_pensiun='$penempatan', 
							penandatangan_pensiun='$penandatangan', penandatangan_jabatan='$penandatangan_jabatan', 
							tujuan_pensiun='$tujuan', pembukaan_pensiun='$pembukaan', 
							lampiran_pensiun='$lampiran', penutup_pensiun='$penutup',
							tembusan_pensiun='$tembusan'
							WHERE kd_pensiun='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}


		
	public function hapus( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_pensiun 
							SET status_pensiun='1'
							WHERE kd_pensiun='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function data_terakhir(){
		$QuerySaya 		= 	$this->db->query(
							"SELECT * FROM t_pensiun ORDER BY tanggal_pensiun desc, kd_pensiun desc limit 1"
						);
		return $QuerySaya->result();
	}


	public function data_pangkat($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*, C.*
							FROM t_pegawai A
							INNER JOIN t_riwayat_pangkat B ON A.id_pegawai = B.id_pegawai
							INNER JOIN t_pangkat C ON C.id_pangkat = B.id_pangkat
							WHERE B.status_riwayat_pangkat='A' AND A.id_pegawai='$kode';"
						);
		return $QuerySaya->result();
	}

	public function data_jabatan($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*, C.*
							FROM t_pegawai A
							INNER JOIN t_riwayat_jabatan B ON A.id_pegawai = B.id_pegawai
							INNER JOIN t_jabatan C ON C.kd_jabatan = B.kd_jabatan
							WHERE B.status_riwayat_jabatan='A' AND A.id_pegawai='$kode';"
						);
		return $QuerySaya->result();
	}

	public function data_jabatan2($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*, C.*
							FROM t_pegawai A
							INNER JOIN t_riwayat_jabatan B ON A.id_pegawai = B.id_pegawai
							INNER JOIN t_jabatan C ON C.kd_jabatan = B.kd_jabatan
							WHERE B.status_riwayat_jabatan='A' AND A.id_pegawai='$kode';"
						);
		return $QuerySaya->result();
	}


	public function cari_pangkat($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*, C.*,D.*
							FROM t_pensiun A
							INNER JOIN t_pegawai B ON A.id_pegawai = B.id_pegawai
							INNER JOIN t_riwayat_pangkat C ON C.id_pegawai = B.id_pegawai
							INNER JOIN t_pangkat D ON D.id_pangkat = C.id_pangkat
							WHERE C.status_riwayat_pangkat='A' AND A.kd_pensiun='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_jabatan($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*, C.*,D.*
							FROM t_pensiun A
							INNER JOIN t_pegawai B ON A.id_pegawai = B.id_pegawai
							INNER JOIN t_riwayat_jabatan C ON C.id_pegawai = B.id_pegawai
							INNER JOIN t_jabatan D ON D.kd_jabatan = C.kd_jabatan
							WHERE C.status_riwayat_jabatan='A' AND A.kd_pensiun='$kode';"
						);
		return $QuerySaya->result();
	}


	public function cari_jabatan2($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*, C.*,D.*
							FROM t_pensiun A
							INNER JOIN t_pegawai B ON A.penandatangan_pensiun = B.id_pegawai
							INNER JOIN t_riwayat_jabatan C ON C.id_pegawai = B.id_pegawai
							INNER JOIN t_jabatan D ON D.kd_jabatan = C.kd_jabatan
							WHERE C.status_riwayat_jabatan='A' AND A.kd_pensiun='$kode';"
						);
		return $QuerySaya->result();
	}

}
