<?php
class Riwayat_jabatan_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(kd_riwayat_jabatan) AS idmax 
							FROM t_riwayat_jabatan;"
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
							"SELECT * FROM t_riwayat_jabatan 
							WHERE sts_riwayat_jabatan<>'1' AND kd_riwayat_jabatan='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_pegawai( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT A.*,B.nm_jabatan,
							B.kd_jenis,C.nm_jenis,B.kd_eselon,IFNULL(E.nm_eselon,'~') 
							AS eselon, D.nm_penempatan
							FROM (((t_riwayat_jabatan A INNER JOIN t_jabatan B 
							ON A.kd_jabatan=B.kd_jabatan) INNER JOIN t_jenis_jabatan C
							ON B.kd_jenis=C.kd_jenis) LEFT JOIN t_penempatan D 
							ON A.id_penempatan=D.id_penempatan) LEFT JOIN t_eselon E 
							ON B.kd_eselon=E.kd_eselon 
							WHERE A.id_pegawai='$kode' AND A.status_riwayat_jabatan<>'1' 
							ORDER BY A.tmt_jabatan;"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $kode, $pegawai, $jabatan, $tmt_jabatan, $tmt_pelantikan, $gaji, $pejabat, $nomor, $tanggal, $no_spmt, $tgl_spmt, $no_spmj, $tgl_spmj, $penempatan ) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_riwayat_jabatan
							(kd_riwayat_jabatan, id_pegawai, kd_jabatan, tmt_jabatan, tmt_pelantikan, 
							gaji_jabatan, sk_pejabat, sk_nomor, sk_tanggal, spmt_nomor, 
							spmt_tanggal, spmj_nomor, spmj_tanggal, id_penempatan, status_riwayat_jabatan) 
							VALUES 
							('$kode', '$pegawai', '$jabatan', '$tmt_jabatan', '$tmt_pelantikan', 
							'$gaji', '$pejabat', '$nomor', '$tanggal', '$no_spmt', 
							'$tgl_spmt', '$no_spmj', '$tgl_spmj', '$penempatan', 'A');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $pegawai, $jabatan, $tmt_jabatan, $tmt_pelantikan, $gaji, $pejabat, $nomor, $tanggal, $no_spmt, $tgl_spmt, $no_spmj, $tgl_spmj, $penempatan ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_riwayat_jabatan SET 
							kd_jabatan='$jabatan', tmt_jabatan='$tmt_jabatan',
							tmt_pelantikan='$tmt_pelantikan', gaji_jabatan='$gaji', 
							sk_pejabat='$pejabat', sk_nomor='$nomor', 
							sk_tanggal='$tanggal', spmt_nomor='$no_spmt',
							spmt_tanggal='$tgl_spmt', spmj_nomor='$no_spmj',
							spmj_tanggal='$tgl_spmj', id_penempatan='$penempatan' 
							WHERE kd_riwayat_jabatan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function edit_sts( $kode, $status ) {
		if ($status=="A") {
			$QuerySaya 		= 	$this->db->query(
							"UPDATE t_riwayat_jabatan 
							SET status_riwayat_jabatan='0'
							WHERE kd_riwayat_jabatan='$kode';"
						);
		} else {
			$QuerySaya 		= 	$this->db->query(
							"UPDATE t_riwayat_jabatan 
							SET status_riwayat_jabatan='A'
							WHERE kd_riwayat_jabatan='$kode';"
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
							"UPDATE t_riwayat_jabatan 
							SET status_riwayat_jabatan='1'
							WHERE kd_riwayat_jabatan='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
