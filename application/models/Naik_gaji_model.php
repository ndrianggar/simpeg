<?php
class Naik_gaji_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(kd_naik_gaji) AS idmax 
							FROM t_naik_gaji;"
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
						  "SELECT A.*, B.nm_pegawai, B.nip_baru, C.*, D.*, (A.gaji_pokok)as gaji, B.gelar_belakang, B.gelar_depan
						FROM t_naik_gaji A
						INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
						INNER JOIN t_pangkat C ON A.pangkat_pegawai=C.id_pangkat
						INNER JOIN t_jabatan D ON A.jabatan_pegawai=D.kd_jabatan
						WHERE A.status_naik_gaji<>'1';"
						);
		return $QuerySaya->result();
	}

	public function cari_edit($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.nm_pegawai, B.nip_baru, (C.nm_pegawai)as nama, (C.nip_baru)as nip, (G.nm_pangkat)as nama_pangkat, (H.nm_jabatan)as nama_jabatan, B.gelar_belakang, B.gelar_depan
							FROM t_naik_gaji A
							INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							INNER JOIN t_pegawai C ON A.penandatangan_pegawai=C.id_pegawai
							INNER JOIN t_pangkat G ON A.pangkat_pegawai=G.id_pangkat
							INNER JOIN t_jabatan H ON A.jabatan_pegawai=H.kd_jabatan					
							WHERE A.status_naik_gaji<>'1' AND A.kd_naik_gaji='$id';"
						);
		return $QuerySaya->result();
	}

	public function cari_cetak($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.nm_pegawai, B.nip_baru, (C.nm_pegawai) as nama, (C.nip_baru)as nip, D.*, E.*, (F.kd_jabatan)as aa, (F.nm_jabatan)as nm_jabatan2, (A.gaji_pokok)as gaji, B.gelar_belakang, B.gelar_depan
							FROM t_naik_gaji A
							INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							INNER JOIN t_pegawai C ON A.penandatangan_pegawai=C.id_pegawai
							INNER JOIN t_pangkat D ON A.pangkat_pegawai=D.id_pangkat
							INNER JOIN t_jabatan E ON A.jabatan_pegawai=E.kd_jabatan
							INNER JOIN t_jabatan F ON A.penandatangan_jabatan=F.kd_jabatan
							WHERE A.status_naik_gaji<>'1' AND A.kd_naik_gaji='$id'
							ORDER BY A.nomor_surat;"
						);
		return $QuerySaya->result();
	}

	public function cari_prev($kode, $kode2) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.nm_pegawai, B.nip_baru, B.tempat_lahir, B.tanggal_lahir, B.alamat_jalan, (C.nm_pegawai) as nama, (C.nip_baru)as nip, D.*, E.*, (F.kd_jabatan)as aa, (F.nm_jabatan)as nm_jabatan2, B.gelar_belakang, B.gelar_depan
							FROM t_naik_gaji A
							INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							INNER JOIN t_pegawai C ON A.penandatangan_pegawai=C.id_pegawai
							INNER JOIN t_pangkat D ON A.pangkat_pegawai=D.id_pangkat
							INNER JOIN t_jabatan E ON A.jabatan_pegawai=E.kd_jabatan
							INNER JOIN t_jabatan F ON A.penandatangan_jabatan=F.kd_jabatan
							WHERE A.status_naik_gaji<>'1' AND B.id_pegawai='$kode' AND A.penandatangan_pegawai='$kode2'
							ORDER BY A.nomor_surat;"
						);
		return $QuerySaya->result();
	}

	public function tambah( $kode, $nomor,  $tanggal, $pegawai, $pangkat, $jabatan, $kantor, $gaji, $pejabat, $tanggal_skp, $nomor_skp, 
							$tanggal_berlaku, $masa_kerja, $gaji_baru, $tunjangan, $masa_kerja_baru, $golongan, $tanggal_mulai,$p_pegawai, $p_jabatan, $hal, 
							$catatan, $tujuan, $pembukaan, $dasar, $hingga, $penutup, $salinan ) {
		
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_naik_gaji
							
							(kd_naik_gaji, nomor_surat, tanggal_gaji, id_pegawai, pangkat_pegawai,
							jabatan_pegawai, kantor, gaji_pokok, pejabat, tanggal_pejabat, nomor_pejabat, 
							tanggal_berlaku, masa_kerja, gaji_baru, tunjangan_jabatan, masa_kerja_baru, 
							golongan, mulai_tanggal, penandatangan_pegawai, penandatangan_jabatan, hal_surat, catatan_surat, tujuan_surat, 
							pembukaan_surat, dasar_surat, hingga_memperoleh, penutup_surat,  salinan, status_naik_gaji) VALUES 
							
							('$kode', '$nomor', '$tanggal', '$pegawai', '$pangkat', '$jabatan', '$kantor',
							'$gaji', '$pejabat', '$tanggal_skp','$nomor_skp', '$tanggal_berlaku', 
							'$masa_kerja', '$gaji_baru', '$tunjangan', '$masa_kerja_baru', '$golongan', '$tanggal_mulai', '$p_pegawai', '$p_jabatan',
							'$hal','$catatan','$tujuan','$pembukaan','$dasar',
							'$hingga','$penutup','$salinan','0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $nomor,  $tanggal, $pegawai, $pangkat, $jabatan, $kantor, $gaji, $pejabat, $tanggal_skp, $nomor_skp, 
							$tanggal_berlaku, $masa_kerja, $gaji_baru, $tunjangan, $masa_kerja_baru, $golongan, $tanggal_mulai,$p_pegawai, $p_jabatan, $hal, 
							$catatan, $tujuan, $pembukaan, $dasar, $hingga, $penutup, $salinan ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_naik_gaji SET 
							kd_naik_gaji='$kode', nomor_surat='$nomor', 
							tanggal_gaji='$tanggal', id_pegawai='$pegawai', 
							pangkat_pegawai='$pangkat', jabatan_pegawai='$jabatan', 
							kantor='$kantor', gaji_pokok='$gaji', 
							pejabat='$pejabat', tanggal_pejabat='$tanggal_skp',
							nomor_pejabat='$nomor_skp', tanggal_berlaku='$tanggal_berlaku', 
							masa_kerja='$masa_kerja', gaji_baru='$gaji_baru', 
							tunjangan_jabatan='$tunjangan', masa_kerja_baru='$masa_kerja_baru', 
							penandatangan_pegawai='$p_pegawai', penandatangan_jabatan='$p_jabatan', hal_surat='$hal', 
							catatan_surat='$catatan', tujuan_surat='$tujuan', 
							pembukaan_surat='$pembukaan', dasar_surat='$dasar', 
							hingga_memperoleh='$hingga', penutup_surat='$penutup', 
							salinan='$salinan'
							WHERE kd_naik_gaji='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}


		
	public function hapus( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_naik_gaji
							SET status_naik_gaji='1'
							WHERE kd_naik_gaji='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function data_terakhir(){
		$QuerySaya 		= 	$this->db->query(
							"SELECT * FROM t_naik_gaji ORDER BY kd_naik_gaji desc limit 1"
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

	public function data_jabatan_tmt($kode, $tmt) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*, C.*
							FROM t_pegawai A
							INNER JOIN t_riwayat_jabatan B ON A.id_pegawai = B.id_pegawai
							INNER JOIN t_jabatan C ON C.kd_jabatan = B.kd_jabatan
							WHERE B.status_riwayat_jabatan='A' AND A.id_pegawai='$kode' AND B.kd_jabatan='$tmt';"
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
							FROM t_naik_pangkat A
							INNER JOIN t_pegawai B ON A.id_pegawai = B.id_pegawai
							INNER JOIN t_riwayat_pangkat C ON C.id_pegawai = B.id_pegawai
							INNER JOIN t_pangkat D ON D.id_pangkat = C.id_pangkat
							WHERE C.status_riwayat_pangkat='A' AND A.kd_naik_pangkat='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_jabatan($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*, C.*,D.*
							FROM t_naik_pangkat A
							INNER JOIN t_pegawai B ON A.id_pegawai = B.id_pegawai
							INNER JOIN t_riwayat_jabatan C ON C.id_pegawai = B.id_pegawai
							INNER JOIN t_jabatan D ON D.kd_jabatan = C.kd_jabatan
							WHERE C.status_riwayat_jabatan='A' AND A.kd_naik_pangkat='$kode';"
						);
		return $QuerySaya->result();
	}


	public function cari_jabatan2($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*, C.*,D.*
							FROM t_naik_pangkat A
							INNER JOIN t_pegawai B ON A.penandatangan_pegawai = B.id_pegawai
							INNER JOIN t_riwayat_jabatan C ON C.id_pegawai = B.id_pegawai
							INNER JOIN t_jabatan D ON D.kd_jabatan = C.kd_jabatan
							WHERE C.status_riwayat_jabatan='A' AND A.kd_naik_pangkat='$kode';"
						);
		return $QuerySaya->result();
	}

}
