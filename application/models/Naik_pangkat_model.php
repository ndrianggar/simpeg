<?php
class Naik_pangkat_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(kd_naik_pangkat) AS idmax 
							FROM t_naik_pangkat;"
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
						  "SELECT A.*, B.nm_pegawai, B.nip_baru, C.*, D.*, (E.nm_pangkat)as nama_pangkat, (F.nm_jabatan)as nama_jabatan, B.gelar_belakang, B.gelar_depan
						FROM t_naik_pangkat A
						INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
						INNER JOIN t_pangkat C ON A.pgrt_lama_pangkat=C.kd_pangkat
						INNER JOIN t_jabatan D ON A.jabatan_lama_pangkat=D.kd_jabatan
						INNER JOIN t_pangkat E ON A.pgrt_baru_pangkat=E.kd_pangkat
						INNER JOIN t_jabatan F ON A.jabatan_baru_pangkat=F.kd_jabatan
						WHERE A.status_naik_pangkat<>'1';"
						);
		return $QuerySaya->result();
	}

	public function cari_edit($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.nm_pegawai, B.nip_baru, (C.nm_pegawai)as nama, (C.nip_baru)as nip, (G.nm_pangkat)as nama_pangkat, (H.nm_jabatan)as nama_jabatan, B.gelar_belakang, B.gelar_depan
						  FROM t_naik_pangkat A
						  INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
						  INNER JOIN t_pegawai C ON A.penandatangan_pegawai=C.id_pegawai
						  INNER JOIN t_pangkat G ON A.pgrt_baru_pangkat=G.kd_pangkat
						  INNER JOIN t_jabatan H ON A.jabatan_baru_pangkat=H.kd_jabatan					
						  WHERE A.status_naik_pangkat<>'1' AND A.kd_naik_pangkat='$id';"
						);
		return $QuerySaya->result();
	}

	public function cari_cetak($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.nm_pegawai, B.nip_baru, B.tempat_lahir, B.tanggal_lahir, B.alamat_jalan, (C.nm_pegawai) as nama, (C.nip_baru)as nip, D.*, E.*, (F.kd_jabatan)as aa, (F.nm_jabatan)as nm_jabatan2, (G.nm_pangkat)as nama_pangkat, (H.nm_jabatan)as nama_jabatan, B.gelar_belakang, B.gelar_depan
						FROM t_naik_pangkat A
						INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
						INNER JOIN t_pegawai C ON A.penandatangan_pegawai=C.id_pegawai
						INNER JOIN t_pangkat D ON A.pgrt_lama_pangkat=D.kd_pangkat
						INNER JOIN t_jabatan E ON A.jabatan_lama_pangkat=E.kd_jabatan
						INNER JOIN t_jabatan F ON A.penandatangan_jabatan=F.kd_jabatan
						INNER JOIN t_pangkat G ON A.pgrt_baru_pangkat=G.kd_pangkat
						INNER JOIN t_jabatan H ON A.jabatan_baru_pangkat=H.kd_jabatan					
						WHERE A.status_naik_pangkat<>'1' AND A.kd_naik_pangkat='$id'
						ORDER BY A.nomor_pangkat;"
						);
		return $QuerySaya->result();
	}

	public function cari_prev($kode, $kode2) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.nm_pegawai, B.nip_baru, B.tempat_lahir, B.tanggal_lahir, B.alamat_jalan, (C.nm_pegawai) as nama, (C.nip_baru)as nip, D.*, E.*, (F.kd_jabatan)as aa, (F.nm_jabatan)as nm_jabatan2, (G.nm_pangkat)as nama_pangkat, (H.nm_jabatan)as nama_jabatan, B.gelar_belakang, B.gelar_depan
							FROM t_naik_pangkat A
							INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							INNER JOIN t_pegawai C ON A.penandatangan_pegawai=C.id_pegawai
							INNER JOIN t_pangkat D ON A.pgrt_lama_pangkat=D.id_pangkat
							INNER JOIN t_jabatan E ON A.jabatan_lama_pangkat=E.kd_jabatan
							INNER JOIN t_jabatan F ON A.penandatangan_jabatan=F.kd_jabatan
							INNER JOIN t_pangkat G ON A.pgrt_baru_pangkat=G.id_pangkat
							INNER JOIN t_jabatan H ON A.jabatan_baru_pangkat=H.kd_jabatan					
							WHERE A.status_naik_pangkat<>'1' AND B.id_pegawai='$kode' AND A.penandatangan_pegawai='$kode2'
							ORDER BY A.nomor_pangkat;"
						);
		return $QuerySaya->result();
	}

	public function tambah( $kode, $nomor,  $nama, $nidn, $pangkat, $tmt_pangkat, $jabatan, $tmt_jabatan, $unit_kerja, $usulan_angka, 
							$jabatan_baru, $tmt_jabatan_baru, $mata_kuiah, $pangkat_baru, $tmt_pangkat_baru, $hal, $p_pegawai,$p_jabatan, $tujuan, $pembukaan, 
							$salam_persetujuan, $persetujuan, $salam_pertimbangan, $pertimbangan, $penutup, $tembusan ) {
		
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_naik_pangkat
							
							(kd_naik_pangkat, nomor_pangkat, id_pegawai, nidn_pangkat, pgrt_lama_pangkat,
							tmt_pgrt_lama_pangkat, jabatan_lama_pangkat, tmt_jabatan_lama_pangkat, unit_kerja_pangkat, usulan_angka_kredit_pangkat, 
							jabatan_baru_pangkat, tmt_jabatan_baru_pangkat, mata_kuliah_pangkat, pgrt_baru_pangkat, tmt_pgrt_baru_pangkat, 
							hal_pangkat, penandatangan_pegawai, penandatangan_jabatan, tujuan_pangkat, pembukaan_pangkat, salam_persetujuan_pangkat, persetujuan_pangkat, 
							salam_pertimbangan_pangkat, pertimbangan_pangkat, penutup_pangkat, tembusan_pangkat,  status_naik_pangkat) VALUES 
							
							('$kode', '$nomor', '$nama', '$nidn', '$pangkat', '$tmt_pangkat',
							'$jabatan', '$tmt_jabatan', '$unit_kerja','$usulan_angka', '$jabatan_baru', 
							'$tmt_jabatan_baru', '$mata_kuiah', '$pangkat_baru', '$tmt_pangkat_baru', '$hal', '$p_pegawai', '$p_jabatan',
							'$tujuan','$pembukaan','$salam_persetujuan','$persetujuan','$salam_pertimbangan',
							'$pertimbangan','$penutup','$tembusan','0');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $kode, $nomor,  $nama, $nidn, $pangkat, $tmt_pangkat, $jabatan, $tmt_jabatan, $unit_kerja, $usulan_angka, 
							$jabatan_baru, $tmt_jabatan_baru, $mata_kuiah, $pangkat_baru, $tmt_pangkat_baru, $hal, $p_pegawai,$p_jabatan, $tujuan, $pembukaan, 
							$salam_persetujuan, $persetujuan, $salam_pertimbangan, $pertimbangan, $penutup, $tembusan ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_naik_pangkat SET 
							nomor_pangkat='$nomor', id_pegawai='$nama', 
							nidn_pangkat='$nidn', pgrt_lama_pangkat='$pangkat', 
							tmt_pgrt_lama_pangkat='$tmt_pangkat', jabatan_lama_pangkat='$jabatan', 
							tmt_jabatan_lama_pangkat='$tmt_jabatan', unit_kerja_pangkat='$unit_kerja', 
							usulan_angka_kredit_pangkat='$usulan_angka', jabatan_baru_pangkat='$jabatan_baru',
							tmt_jabatan_baru_pangkat='$tmt_jabatan_baru', mata_kuliah_pangkat='$mata_kuiah', 
							pgrt_baru_pangkat='$pangkat_baru', tmt_pgrt_baru_pangkat='$tmt_pangkat_baru', 
							hal_pangkat='$hal', penandatangan_pegawai='$p_pegawai', 
							penandatangan_jabatan='$p_jabatan', tujuan_pangkat='$tujuan', 
							pembukaan_pangkat='$pembukaan', salam_persetujuan_pangkat='$salam_persetujuan', 
							persetujuan_pangkat='$persetujuan', salam_pertimbangan_pangkat='$salam_pertimbangan', 
							pertimbangan_pangkat='$pertimbangan', penutup_pangkat='$penutup', 
							tembusan_pangkat='$tembusan'
							WHERE kd_naik_pangkat='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}


		
	public function hapus( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_naik_pangkat 
							SET status_naik_pangkat='1'
							WHERE kd_naik_pangkat='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function data_terakhir(){
		$QuerySaya 		= 	$this->db->query(
							"SELECT * FROM t_naik_pangkat ORDER BY kd_naik_pangkat desc limit 1"
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
