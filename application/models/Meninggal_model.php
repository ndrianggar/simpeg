<?php
class Meninggal_model extends CI_Model {

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
				$kode 	= str_pad($tmp, 12,   "0", STR_PAD_LEFT);
			}
		} else {
			$kode 		= "000000000001";
		}
		return $kode;
	}
		
	public function buat_kode_tmp() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(id_tmp) AS idmax 
							FROM tmp_pegawai;"
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
						  "SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,
							E.nama_kecamatan, E.id_kecamatan, F.nama_kota, F.id_kota, G.nama_propinsi,G.id_propinsi,
							K.nm_pangkat, L.nm_jabatan, K.gol_pangkat, N.nm_penempatan,
							YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia,
							H.nm_prodi,I.nm_jurusan,J.nama_status
							FROM ((((((((((((((t_pegawai A
							INNER JOIN t_agama B         ON A.kd_agama=B.kd_agama)
							INNER JOIN t_pegawai_status J ON A.id_status=J.id_status)
							LEFT JOIN t_jenis C          ON A.id_jenis=C.id_jenis)
							LEFT JOIN alamat_kelurahan D ON A.id_kelurahan=D.id_kelurahan)
							LEFT JOIN alamat_kecamatan E ON D.id_kecamatan=E.id_kecamatan)
							LEFT JOIN alamat_kota F      ON E.id_kota=F.id_kota)
							LEFT JOIN alamat_propinsi G  ON F.id_propinsi=G.id_propinsi)
							LEFT JOIN t_riwayat_pangkat O ON A.id_pegawai = O.id_pegawai)
							LEFT JOIN t_pangkat K 		 ON O.id_pangkat = K.id_pangkat)
							LEFT JOIN t_riwayat_jabatan P ON A.id_pegawai = P.id_pegawai)
							LEFT JOIN t_jabatan L 		 ON P.kd_jabatan = L.kd_jabatan)
							LEFT JOIN t_penempatan N 		 ON P.id_penempatan = N.id_penempatan)
							LEFT JOIN t_prodi H          ON A.id_prodi=H.id_prodi)
							LEFT JOIN t_jurusan I        ON H.id_jurusan=I.id_jurusan)
							WHERE A.sts_pegawai<>'1' AND A.sts_kematian='1'
							ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}

	public function cari_nip() {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,
							E.nama_kecamatan, E.id_kecamatan, F.nama_kota, F.id_kota, G.nama_propinsi,G.id_propinsi,
							YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia,
							H.nm_prodi,I.nm_jurusan,J.nama_status
							FROM (((((((((t_pegawai A
							INNER JOIN t_agama B         ON A.kd_agama=B.kd_agama)
							INNER JOIN t_pegawai_status J ON A.id_status=J.id_status)
							LEFT JOIN t_jenis C          ON A.id_jenis=C.id_jenis)
							LEFT JOIN alamat_kelurahan D ON A.id_kelurahan=D.id_kelurahan)
							LEFT JOIN alamat_kecamatan E ON D.id_kecamatan=E.id_kecamatan)
							LEFT JOIN alamat_kota F      ON E.id_kota=F.id_kota)
							LEFT JOIN alamat_propinsi G  ON F.id_propinsi=G.id_propinsi)
							LEFT JOIN t_prodi H          ON A.id_prodi=H.id_prodi)
							LEFT JOIN t_jurusan I        ON H.id_jurusan=I.id_jurusan)
							WHERE A.sts_pegawai<>'1'
							ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}

	public function cari_data_meninggal($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_agama,C.nm_jenis,
							E.nm_pangkat, G.nm_jabatan, E.gol_pangkat, K.nm_penempatan,
							YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia,
							H.nm_prodi,I.nm_jurusan,J.nama_status
							FROM ((((((((((t_pegawai A
							INNER JOIN t_agama B         ON A.kd_agama=B.kd_agama)
							INNER JOIN t_pegawai_status J ON A.id_status=J.id_status)
							LEFT JOIN t_jenis C          ON A.id_jenis=C.id_jenis)
							LEFT JOIN t_riwayat_pangkat D ON A.id_pegawai = D.id_pegawai)
							LEFT JOIN t_pangkat E 		 ON D.id_pangkat = E.id_pangkat)
							LEFT JOIN t_riwayat_jabatan F ON A.id_pegawai = F.id_pegawai)
							LEFT JOIN t_jabatan G 		 ON F.kd_jabatan = G.kd_jabatan)
							LEFT JOIN t_penempatan K 		 ON F.id_penempatan = K.id_penempatan)
							LEFT JOIN t_prodi H          ON A.id_prodi=H.id_prodi)
							LEFT JOIN t_jurusan I        ON H.id_jurusan=I.id_jurusan)
							WHERE A.sts_pegawai<>'1' AND A.id_pegawai='$id'
							ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}
	public function cari_user($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,
						  E.nama_kecamatan,F.nama_kota,G.nama_propinsi,
						  YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia,
						  H.nm_jurusan,I.nm_prodi,J.nama_status 
						  FROM ((((((((t_pegawai A 
						  INNER JOIN t_agama B         ON A.kd_agama=B.kd_agama)
						  INNER JOIN t_pegawai_status J ON A.id_status=J.id_status)  
						  LEFT JOIN t_jenis C          ON A.id_jenis=C.id_jenis) 
						  LEFT JOIN alamat_kelurahan D ON A.id_kelurahan=D.id_kelurahan) 
						  LEFT JOIN alamat_kecamatan E ON A.id_kecamatan=E.id_kecamatan)  
						  LEFT JOIN alamat_kota F      ON A.id_kota=F.id_kota) 
						  LEFT JOIN alamat_propinsi G  ON A.id_propinsi=G.id_propinsi)
						  LEFT JOIN t_jurusan H        ON A.id_jurusan=H.id_jurusan)
						  LEFT JOIN t_prodi I          ON A.id_prodi=I.id_prodi
						  WHERE A.sts_pegawai<>'1' AND A.id_pegawai='$id'
						  ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}

	public function cari_group( $jenis ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,
						  E.nama_kecamatan,F.nama_kota,G.nama_propinsi,
						  YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia,
						  H.nm_jurusan,I.nm_prodi,J.nama_status 
						  FROM ((((((((t_pegawai A 
						  INNER JOIN t_agama B         ON A.kd_agama=B.kd_agama)
						  INNER JOIN t_pegawai_status J ON A.id_status=J.id_status)  
						  LEFT JOIN t_jenis C          ON A.id_jenis=C.id_jenis) 
						  LEFT JOIN alamat_kelurahan D ON A.id_kelurahan=D.id_kelurahan) 
						  LEFT JOIN alamat_kecamatan E ON A.id_kecamatan=E.id_kecamatan)  
						  LEFT JOIN alamat_kota F      ON A.id_kota=F.id_kota) 
						  LEFT JOIN alamat_propinsi G  ON A.id_propinsi=G.id_propinsi)
						  LEFT JOIN t_jurusan H        ON A.id_jurusan=H.id_jurusan)
						  LEFT JOIN t_prodi I          ON A.id_prodi=I.id_prodi
						  WHERE A.sts_pegawai<>'1' AND A.id_jenis='$jenis' 
						  ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}

	public function cari_duk($jurusan) {
		if ($jurusan=='Semua'){
			$QuerySaya 		= $this->db->query(
							  "SELECT A.id_pegawai,A.kd_pegawai,A.nip_baru,A.nm_pegawai,A.gelar_depan,
							  A.gelar_belakang,A.tmt_polines,A.tmt_cpns,A.tmt_pns,A.id_jurusan,B.nm_jurusan,
							  C.kd_pangkat,D.nm_pangkat,D.gol_pangkat,C.tmt_pangkat,E.kd_jabatan,E.tmt_jabatan,
							  F.nm_jabatan,G.kd_jenis,G.nm_jenis,F.nm_jabatan,F.kls_jabatan,H.kd_pendidikan,
							  H.nama_pendidikan,YEAR(H.akhir_pendidikan) AS tahun_pendidikan,H.id_jenjang,
							  I.kd_jenjang,I.nm_jenjang,I.alias_umum,I.alias_polines,H.jurusan_pendidikan,
							  '-' AS keterangan,
							  YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia  
							  FROM 
							  (((((((t_pegawai A INNER JOIN t_jurusan B ON A.id_jurusan=B.id_jurusan)
							  LEFT JOIN t_riwayat_pangkat C ON A.id_pegawai=C.id_pegawai AND C.status_riwayat_pangkat='A') 
							  LEFT JOIN t_pangkat D ON C.kd_pangkat=D.kd_pangkat) 
							  LEFT JOIN t_riwayat_jabatan E ON A.id_pegawai=E.id_pegawai AND E.status_riwayat_jabatan='A')
							  LEFT JOIN t_jabatan F ON E.kd_jabatan=F.kd_jabatan)
							  LEFT JOIN t_jenis_jabatan G ON F.kd_jenis=G.kd_jenis)
							  LEFT JOIN t_pendidikan H ON A.id_pegawai=H.id_pegawai AND H.status_aktif='1')
							  LEFT JOIN t_jenjang I ON H.id_jenjang=I.id_jenjang 
							  ORDER BY C.kd_pangkat DESC;
							  "
							);
		} else {
			$QuerySaya 		= $this->db->query(
							  "SELECT A.id_pegawai,A.kd_pegawai,A.nip_baru,A.nm_pegawai,A.gelar_depan,
							  A.gelar_belakang,A.tmt_polines,A.tmt_cpns,A.tmt_pns,A.id_jurusan,B.nm_jurusan,
							  C.kd_pangkat,D.nm_pangkat,D.gol_pangkat,C.tmt_pangkat,E.kd_jabatan,E.tmt_jabatan,
							  F.nm_jabatan,G.kd_jenis,G.nm_jenis,F.nm_jabatan,F.kls_jabatan,H.kd_pendidikan,
							  H.nama_pendidikan,YEAR(H.akhir_pendidikan) AS tahun_pendidikan,H.id_jenjang,
							  I.kd_jenjang,I.nm_jenjang,I.alias_umum,I.alias_polines,H.jurusan_pendidikan,
							  '-' AS keterangan,
							  YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia  
							  FROM 
							  (((((((t_pegawai A INNER JOIN t_jurusan B ON A.id_jurusan=B.id_jurusan)
							  LEFT JOIN t_riwayat_pangkat C ON A.id_pegawai=C.id_pegawai AND C.status_riwayat_pangkat='A') 
							  LEFT JOIN t_pangkat D ON C.kd_pangkat=D.kd_pangkat) 
							  LEFT JOIN t_riwayat_jabatan E ON A.id_pegawai=E.id_pegawai AND E.status_riwayat_jabatan='A')
							  LEFT JOIN t_jabatan F ON E.kd_jabatan=F.kd_jabatan)
							  LEFT JOIN t_jenis_jabatan G ON F.kd_jenis=G.kd_jenis)
							  LEFT JOIN t_pendidikan H ON A.id_pegawai=H.id_pegawai AND H.status_aktif='1')
							  LEFT JOIN t_jenjang I ON H.id_jenjang=I.id_jenjang 
							  WHERE A.id_jurusan='$jurusan' 
							  ORDER BY C.kd_pangkat DESC;
							  "
							);
		}
		
		return $QuerySaya->result();
	}


	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,
						  E.nama_kecamatan,F.nama_kota,G.nama_propinsi,
						  YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia,
						  H.nm_jurusan,I.nm_prodi,J.nama_status 
						  FROM ((((((((t_pegawai A 
						  INNER JOIN t_agama B         ON A.kd_agama=B.kd_agama) 
						  INNER JOIN t_pegawai_status J ON A.id_status=J.id_status)
						  LEFT JOIN t_jenis C          ON A.id_jenis=C.id_jenis) 
						  LEFT JOIN alamat_kelurahan D ON A.id_kelurahan=D.id_kelurahan) 
						  LEFT JOIN alamat_kecamatan E ON A.id_kecamatan=E.id_kecamatan)  
						  LEFT JOIN alamat_kota F      ON A.id_kota=F.id_kota) 
						  LEFT JOIN alamat_propinsi G  ON A.id_propinsi=G.id_propinsi)
						  LEFT JOIN t_jurusan H        ON A.id_jurusan=H.id_jurusan)
						  LEFT JOIN t_prodi I          ON A.id_prodi=I.id_prodi
						  WHERE A.sts_pegawai<>'1' AND id_pegawai='$kode' 
						  ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}
		


	public function tambah( $id, $tgl, $akta ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pegawai SET
						  tgl_kematian = '$tgl', akta_kematian= '$akta', sts_kematian='1'
						  WHERE id_pegawai = '$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

}
