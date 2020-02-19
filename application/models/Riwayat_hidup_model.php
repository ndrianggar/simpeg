<?php
class Riwayat_hidup_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_pegawai) AS idmax 
						  FROM t_pegawai;"
						);
		$kode 			= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$tmp 	= ((int)$k->idmax)+1;
				$kode 	= str_pad($tmp, 12, "0", STR_PAD_LEFT);
			}
		} else {
			$kode 		= "000000000001";
		}
		return $kode;
	}

	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,E.nama_kecamatan,
						  F.nama_kota,G.nama_propinsi,YEAR(curdate()) - YEAR(A.tanggal_lahir) 
						  AS usia,J.nama_status 
						  FROM (((((((t_pegawai A 
						  INNER JOIN t_agama B          ON A.kd_agama=B.kd_agama) 
						  LEFT JOIN  t_jenis C          ON A.id_jenis=C.id_jenis) 
						  LEFT JOIN  t_pegawai_status J ON A.id_status=J.id_status)
						  LEFT JOIN  alamat_kelurahan D ON A.id_kelurahan=D.id_kelurahan) 
						  LEFT JOIN  alamat_kecamatan E ON D.id_kecamatan=E.id_kecamatan)  
						  LEFT JOIN  alamat_kota F      ON E.id_kota=F.id_kota) 
						  LEFT JOIN  alamat_propinsi G  ON F.id_propinsi=G.id_propinsi)
						  WHERE A.sts_pegawai<>'1' 
						  ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}

	public function cari_cetak($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,
							E.nama_kecamatan,F.nama_kota,G.nama_propinsi, H.*,I.*,
							YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia,J.nama_status
							FROM (((((((((t_pegawai A 
							INNER JOIN t_agama B          ON A.kd_agama=B.kd_agama)
							LEFT JOIN t_pegawai_status J  ON A.id_status=J.id_status)
							LEFT JOIN t_jenis C           ON A.id_jenis=C.id_jenis)
							LEFT JOIN alamat_kelurahan D  ON A.id_kelurahan=D.id_kelurahan)
							LEFT JOIN alamat_kecamatan E  ON D.id_kecamatan=E.id_kecamatan)
							LEFT JOIN alamat_kota F       ON E.id_kota=F.id_kota)
							LEFT JOIN alamat_propinsi G   ON F.id_propinsi=G.id_propinsi)
							LEFT JOIN t_riwayat_pangkat H ON A.id_pegawai=H.id_pegawai)
							LEFT JOIN t_pangkat I         ON H.id_pangkat=I.id_pangkat)
							WHERE A.sts_pegawai<>'1' AND A.id_pegawai='$kode' 
							ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}
	public function cari_pendidikan($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, H.*,I.*
							FROM t_pendidikan A
							INNER JOIN t_pegawai H ON A.id_pegawai=H.id_pegawai
							INNER JOIN t_jenjang I ON A.id_jenjang = I.id_jenjang
							WHERE H.sts_pegawai<>'1' AND A.id_pegawai='$kode' AND A.status_pendidikan<>'1';"
						);
		return $QuerySaya->result();
	}

	public function cari_kunjungan($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*
							FROM t_luar_negeri A
							INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							WHERE B.sts_pegawai<>'1' AND A.id_pegawai='$kode' AND A.status_kunjungan<>'1';"
						);
		return $QuerySaya->result();
	}

	public function cari_pangkat($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*,C.*
							FROM t_riwayat_pangkat A
							INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							INNER JOIN t_pangkat C ON A.id_pangkat=C.id_pangkat
							WHERE B.sts_pegawai<>'1' AND A.id_pegawai='$kode' AND A.status_riwayat_pangkat='A';"
						);
		return $QuerySaya->result();
	}

	public function cari_jabatan($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*,C.*
							FROM t_riwayat_jabatan A
							INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							INNER JOIN t_jabatan C ON A.kd_jabatan=C.kd_jabatan
							WHERE B.sts_pegawai<>'1' AND A.id_pegawai='$kode' AND A.status_riwayat_jabatan='A';"
						);
		return $QuerySaya->result();
	}

	public function cari_penghargaan($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*
							FROM t_penghargaan A
							INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							WHERE B.sts_pegawai<>'1' AND A.id_pegawai='$kode' AND A.status_penghargaan<>'1';"
						);
		return $QuerySaya->result();
	}

	public function cari_organisasi($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*
							FROM t_organisasi A
							INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							WHERE B.sts_pegawai<>'1' AND A.id_pegawai='$kode' AND A.status_organisasi<>'1';"
						);
		return $QuerySaya->result();
	}

	public function cari_pasangan($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*,C.*
							FROM t_keluarga A
							INNER JOIN t_pegawai B ON A.kd_pegawai=B.id_pegawai
							INNER JOIN t_hubungan C ON A.kd_hubungan=C.kd_hubungan
							WHERE B.sts_pegawai<>'1' AND A.kd_pegawai='$kode' AND A.sts_keluarga<>'1' AND A.kd_hubungan='01' OR A.kd_hubungan='02';"
						);
		return $QuerySaya->result();
	}

	public function cari_anak($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*,C.*
							FROM t_keluarga A
							INNER JOIN t_pegawai B ON A.kd_pegawai=B.id_pegawai
							INNER JOIN t_hubungan C ON A.kd_hubungan=C.kd_hubungan
							WHERE B.sts_pegawai<>'1' AND A.kd_pegawai='$kode' AND A.sts_keluarga<>'1' AND A.kd_hubungan='03';"
						);
		return $QuerySaya->result();
	}

	public function cari_orang_tua($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*,C.*
							FROM t_keluarga A
							INNER JOIN t_pegawai B ON A.kd_pegawai=B.id_pegawai
							INNER JOIN t_hubungan C ON A.kd_hubungan=C.kd_hubungan
							WHERE B.sts_pegawai<>'1' AND A.kd_pegawai='$kode' AND A.sts_keluarga<>'1' AND A.kd_hubungan='04';"
						);
		return $QuerySaya->result();
	}

	public function cari_saudara($kode) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.*,C.*
							FROM t_keluarga A
							INNER JOIN t_pegawai B ON A.kd_pegawai=B.id_pegawai
							INNER JOIN t_hubungan C ON A.kd_hubungan=C.kd_hubungan
							WHERE B.sts_pegawai<>'1' AND A.kd_pegawai='$kode' AND A.sts_keluarga<>'1' AND A.kd_hubungan='05';"
						);
		return $QuerySaya->result();
	}
}
