<?php
class Pegawai_model extends CI_Model {

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
							WHERE A.sts_pegawai<>'1' AND A.sts_kematian<>'1' AND A.sts_pensiun<>'1'
							group by A.nip_baru
							ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}

	public function cari_group( $jenis ) {
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
							WHERE A.sts_pegawai<>'1' AND A.sts_kematian<>'1' AND A.sts_pensiun<>'1' AND  A.id_jenis='$jenis'
							ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}

	public function cari_duk_jurusan($jurusan) {
		if ($jurusan=='Semua'){
			$QuerySaya 		= $this->db->query(
							  "SELECT * FROM data_duk 
							  WHERE (sts_kematian<>'1' AND sts_pensiun<>'1');"
							);
		} else {
			$QuerySaya 		= $this->db->query(
							  "SELECT * FROM data_duk 
							  WHERE (sts_kematian<>'1' AND sts_pensiun<>'1') 
							  AND id_jurusan='$jurusan';"
							);
		}
		return $QuerySaya->result();
	}

	public function cari_duk_jenis($jenis) {
		if ($jenis=='Semua'){
			$QuerySaya 		= $this->db->query(
							  "SELECT * FROM data_duk 
							  WHERE (sts_kematian<>'1' AND sts_pensiun<>'1');"
							);
		} else {
			$QuerySaya 		= $this->db->query(
							  "SELECT * FROM data_duk 
							  WHERE (sts_kematian<>'1' AND sts_pensiun<>'1') 
							  AND id_jenis='$jenis';"
							);
		}
		
		return $QuerySaya->result();
	}

	public function cari_duk_pensiun() {
		$QuerySaya 		= $this->db->query(
							"SELECT * FROM data_duk 
							WHERE (sts_kematian='1' OR sts_pensiun='1');"
						);
		return $QuerySaya->result();
	}

	public function cari_terima( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,D.id_kecamatan,
						  E.nama_kecamatan,E.id_kota,F.nama_kota,F.id_propinsi,G.nama_propinsi,
						  YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia,
						  I.nm_prodi,I.id_jurusan,H.nm_jurusan,J.nama_status 
						  FROM ((((((((tmp_pegawai A 
						  INNER JOIN t_agama B         ON A.kd_agama=B.kd_agama)
						  INNER JOIN t_pegawai_status J ON A.id_status=J.id_status)  
						  LEFT JOIN t_jenis C          ON A.id_jenis=C.id_jenis) 
						  LEFT JOIN alamat_kelurahan D ON A.id_kelurahan=D.id_kelurahan) 
						  LEFT JOIN alamat_kecamatan E ON D.id_kecamatan=E.id_kecamatan)  
						  LEFT JOIN alamat_kota F      ON E.id_kota=F.id_kota) 
						  LEFT JOIN alamat_propinsi G  ON F.id_propinsi=G.id_propinsi)
						  LEFT JOIN t_prodi I          ON A.id_prodi=I.id_prodi)
						  LEFT JOIN t_jurusan H        ON I.id_jurusan=H.id_jurusan
						  WHERE A.sts_pegawai<>'1' AND A.id_pegawai='$kode' 
						  ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}

	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,D.id_kecamatan,
						  E.nama_kecamatan,E.id_kota,F.nama_kota,F.id_propinsi,G.nama_propinsi,
						  YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia,
						  I.nm_prodi,I.id_jurusan,H.nm_jurusan,J.nama_status 
						  FROM ((((((((t_pegawai A 
						  INNER JOIN t_agama B         ON A.kd_agama=B.kd_agama)
						  INNER JOIN t_pegawai_status J ON A.id_status=J.id_status)  
						  LEFT JOIN t_jenis C          ON A.id_jenis=C.id_jenis) 
						  LEFT JOIN alamat_kelurahan D ON A.id_kelurahan=D.id_kelurahan) 
						  LEFT JOIN alamat_kecamatan E ON D.id_kecamatan=E.id_kecamatan)  
						  LEFT JOIN alamat_kota F      ON E.id_kota=F.id_kota) 
						  LEFT JOIN alamat_propinsi G  ON F.id_propinsi=G.id_propinsi)
						  LEFT JOIN t_prodi I          ON A.id_prodi=I.id_prodi)
						  LEFT JOIN t_jurusan H        ON I.id_jurusan=H.id_jurusan 
						  WHERE A.sts_pegawai<>'1' AND id_pegawai='$kode' 
						  ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $id, $kode, $jenis, $nip_lama, $nip_baru, $nama,
							$gelar_depan, $gelar_blkg, $ktp, $npwp, $tmt_polines, 
							$tmt_cpns, $tmt_pns, $no_sk, $jk, $tempat, $tgl_lahir, 
							$darah, $agama, $status_perkawinan, $hp1, $hp2, $telpon, $email, 
							$jalan, $kelurahan, $kecamatan, $kota, $propinsi, $tinggi,  
							$berat, $rambut, $muka, $kulit, $ciri, $cacat, $hobi, 
							$no_sbakn, $tgl_sbakn, $no_skmpk, $tgl_skmpk, $no_sttpl, 
							$tgl_sttpl, $no_spmt, $tgl_spmt, $no_spmj, $tgl_spmj,
							$status, $jurusan, $prodi, $pass ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_pegawai
						  (id_pegawai, kd_pegawai, id_jenis, nip_lama, nip_baru,
						  nm_pegawai, gelar_depan, gelar_belakang, ektp_pegawai, npwp_pegawai, 
						  tmt_polines, tmt_cpns, tmt_pns, no_sk, jenis_kelamin, 
						  tempat_lahir, tanggal_lahir, golongan_darah, kd_agama, status_perkawinan, 
						  hp1_pegawai, hp2_pegawai, telepon_pegawai, email_pegawai, alamat_jalan, 
						  id_kelurahan, tinggi_badan, 
						  berat_badan, rambut, bentuk_muka, warna_kulit, ciri_khas, 
						  cacat_tubuh, hobi_pegawai, no_sbakn, tgl_sbakn, no_skmpk, 
						  tgl_skmpk, no_sttpl, tgl_sttpl, no_spmt, tgl_spmt, 
						  no_spmj, tgl_spmj , id_status, sts_pegawai, id_prodi, 
						  pass_pegawai) 
						  VALUES 
						  ('$id', '$kode', '$jenis', '$nip_lama', '$nip_baru', 
						  '$nama', '$gelar_depan', '$gelar_blkg', '$ktp', '$npwp', 
						  '$tmt_polines', '$tmt_cpns', '$tmt_pns', '$no_sk', '$jk', 
						  '$tempat', '$tgl_lahir', '$darah', '$agama', '$status_perkawinan', 
						  '$hp1', '$hp2', '$telpon', '$email', '$jalan', 
						  '$kelurahan', '$tinggi', 
						  '$berat', '$rambut', '$muka', '$kulit', '$ciri', 
						  '$cacat', '$hobi', '$no_sbakn', '$tgl_sbakn', '$no_skmpk', 
						  '$tgl_skmpk', '$no_sttpl', '$tgl_sttpl', '$no_spmt', '$tgl_spmt', 
						  '$no_spmj', '$tgl_spmj', '$status', '0', '$prodi', '$pass' );"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function tambah_tmp($tmp, $id, $kode, $jenis, $nip_lama, $nip_baru, $nama,
							$gelar_depan, $gelar_blkg, $ktp, $npwp, $tmt_polines, 
							$tmt_cpns, $tmt_pns, $no_sk, $jk, $tempat, $tgl_lahir, 
							$darah, $agama, $status_perkawinan, $hp1, $hp2, $telpon, $email, 
							$jalan, $kelurahan, $kecamatan, $kota, $propinsi, $tinggi,  
							$berat, $rambut, $muka, $kulit, $ciri, $cacat, $hobi, 
							$no_sbakn, $tgl_sbakn, $no_skmpk, $tgl_skmpk, $no_sttpl, 
							$tgl_sttpl, $no_spmt, $tgl_spmt, $no_spmj, $tgl_spmj,
							$status, $jurusan, $prodi, $pass ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO tmp_pegawai
						  (id_tmp, id_pegawai, kd_pegawai, id_jenis, nip_lama, nip_baru,
						  nm_pegawai, gelar_depan, gelar_belakang, ektp_pegawai, npwp_pegawai, 
						  tmt_polines, tmt_cpns, tmt_pns, no_sk, jenis_kelamin, 
						  tempat_lahir, tanggal_lahir, golongan_darah, kd_agama, status_perkawinan, 
						  hp1_pegawai, hp2_pegawai, telepon_pegawai, email_pegawai, alamat_jalan, 
						  id_kelurahan, id_kecamatan, id_kota, id_propinsi, tinggi_badan, 
						  berat_badan, rambut, bentuk_muka, warna_kulit, ciri_khas, 
						  cacat_tubuh, hobi_pegawai, no_sbakn, tgl_sbakn, no_skmpk, 
						  tgl_skmpk, no_sttpl, tgl_sttpl, no_spmt, tgl_spmt, 
						  no_spmj, tgl_spmj , id_status, sts_pegawai, id_jurusan, id_prodi, 
						  pass_pegawai) 
						  VALUES 
						  ('$tmp', '$id', '$kode', '$jenis', '$nip_lama', '$nip_baru', 
						  '$nama', '$gelar_depan', '$gelar_blkg', '$ktp', '$npwp', 
						  '$tmt_polines', '$tmt_cpns', '$tmt_pns', '$no_sk', '$jk', 
						  '$tempat', '$tgl_lahir', '$darah', '$agama', '$status_perkawinan', 
						  '$hp1', '$hp2', '$telpon', '$email', '$jalan', 
						  '$kelurahan', '$kecamatan', '$kota', '$propinsi', '$tinggi', 
						  '$berat', '$rambut', '$muka', '$kulit', '$ciri', 
						  '$cacat', '$hobi', '$no_sbakn', '$tgl_sbakn', '$no_skmpk', 
						  '$tgl_skmpk', '$no_sttpl', '$tgl_sttpl', '$no_spmt', '$tgl_spmt', 
						  '$no_spmj', '$tgl_spmj', '$status', '0', '$jurusan', '$prodi', '$pass' );"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function cari_tmp( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,D.id_kecamatan,
						  E.nama_kecamatan,E.id_kota,F.nama_kota,F.id_propinsi,G.nama_propinsi,
						  YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia,
						  I.nm_prodi,I.id_jurusan,H.nm_jurusan,J.nama_status 
						  FROM ((((((((tmp_pegawai A 
						  INNER JOIN t_agama B         ON A.kd_agama=B.kd_agama)
						  INNER JOIN t_pegawai_status J ON A.id_status=J.id_status)  
						  LEFT JOIN t_jenis C          ON A.id_jenis=C.id_jenis) 
						  LEFT JOIN alamat_kelurahan D ON A.id_kelurahan=D.id_kelurahan) 
						  LEFT JOIN alamat_kecamatan E ON D.id_kecamatan=E.id_kecamatan)  
						  LEFT JOIN alamat_kota F      ON E.id_kota=F.id_kota) 
						  LEFT JOIN alamat_propinsi G  ON F.id_propinsi=G.id_propinsi)
						  LEFT JOIN t_prodi I          ON A.id_prodi=I.id_prodi)
						  LEFT JOIN t_jurusan H        ON I.id_jurusan=H.id_jurusan
						  WHERE A.sts_pegawai<>'1' AND A.id_pegawai='$kode'
						  ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp2( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,D.id_kecamatan,
						  E.nama_kecamatan,E.id_kota,F.nama_kota,F.id_propinsi,G.nama_propinsi,
						  YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia,
						  I.nm_prodi,I.id_jurusan,H.nm_jurusan,J.nama_status 
						  FROM ((((((((t_pegawai A 
						  INNER JOIN t_agama B         ON A.kd_agama=B.kd_agama)
						  INNER JOIN t_pegawai_status J ON A.id_status=J.id_status)  
						  LEFT JOIN t_jenis C          ON A.id_jenis=C.id_jenis) 
						  LEFT JOIN alamat_kelurahan D ON A.id_kelurahan=D.id_kelurahan) 
						  LEFT JOIN alamat_kecamatan E ON D.id_kecamatan=E.id_kecamatan)  
						  LEFT JOIN alamat_kota F      ON E.id_kota=F.id_kota) 
						  LEFT JOIN alamat_propinsi G  ON F.id_propinsi=G.id_propinsi)
						  LEFT JOIN t_prodi I          ON A.id_prodi=I.id_prodi)
						  LEFT JOIN t_jurusan H        ON I.id_jurusan=H.id_jurusan
						  WHERE A.sts_pegawai<>'1' AND A.id_pegawai='$kode'
						  ORDER BY A.nm_pegawai;"
						);
		return $QuerySaya->result();
	}

	public function terima_edit($kode){
		$QuerySaya 		= $this->db->query(
						"UPDATE t_pegawai A INNER JOIN tmp_pegawai B 
						ON A.id_pegawai=B.id_pegawai 
						SET A.kd_pegawai=B.kd_pegawai,
						A.id_jenis=B.id_jenis,
						A.id_prodi=B.id_prodi,
						A.nip_lama=B.nip_lama,
						A.nip_baru=B.nip_baru,
						A.nm_pegawai=B.nm_pegawai,
						A.gelar_depan=B.gelar_depan,
						A.gelar_belakang=B.gelar_belakang,
						A.ektp_pegawai=B.ektp_pegawai,
						A.npwp_pegawai=B.npwp_pegawai,
						A.tmt_polines=B.tmt_polines,
						A.tmt_cpns=B.tmt_cpns,
						A.tmt_pns=B.tmt_pns,
						A.no_sk=B.no_sk,
						A.jenis_kelamin=B.jenis_kelamin,
						A.tempat_lahir=B.tempat_lahir,
						A.tanggal_lahir=B.tanggal_lahir,
						A.golongan_darah=B.golongan_darah,
						A.kd_agama=B.kd_agama,
						A.status_perkawinan=B.status_perkawinan,
						A.hp1_pegawai=B.hp1_pegawai,
						A.hp2_pegawai=B.hp2_pegawai,
						A.telepon_pegawai=B.telepon_pegawai,
						A.email_pegawai=B.email_pegawai,
						A.alamat_jalan=B.alamat_jalan,
						A.id_kelurahan=B.id_kelurahan,
						A.tinggi_badan=B.tinggi_badan,
						A.berat_badan=B.berat_badan,
						A.rambut=B.rambut,
						A.bentuk_muka=B.bentuk_muka,
						A.warna_kulit=B.warna_kulit,
						A.ciri_khas=B.ciri_khas,
						A.cacat_tubuh=B.cacat_tubuh,
						A.hobi_pegawai=B.hobi_pegawai,
						A.foto_pegawai=B.foto_pegawai,
						A.no_sbakn=B.no_sbakn,
						A.tgl_sbakn=B.tgl_sbakn,
						A.file_sbakn=B.file_sbakn,
						A.no_skmpk=B.no_skmpk,
						A.tgl_skmpk=B.tgl_skmpk,
						A.file_skmpk=B.file_skmpk,
						A.no_sttpl=B.no_sttpl,
						A.tgl_sttpl=B.tgl_sttpl,
						A.file_sttpl=B.file_sttpl,
						A.no_spmt=B.no_spmt,
						A.tgl_spmt=B.tgl_spmt,
						A.file_spmt=B.file_spmt,
						A.no_spmj=B.no_spmj,
						A.tgl_spmj=B.tgl_spmj,
						A.file_spmj=B.file_spmj,
						A.id_status=B.id_status,
						A.sts_pegawai='0' 
						WHERE A.id_pegawai='$kode' AND B.sts_pegawai='0';"
					);
		$QuerySaya 		= $this->db->query(
						"UPDATE tmp_pegawai  
						SET sts_pegawai='1' 
						WHERE id_pegawai='$kode' AND sts_pegawai='0';"
					);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function edit3( $id, $kode, $jenis, $nip_lama, $nip_baru, $nama,
							$gelar_depan, $gelar_blkg, $ktp, $npwp, $tmt_polines, 
							$tmt_cpns, $tmt_pns, $no_sk, $jk, $tempat, $tgl_lahir, 
							$darah, $agama, $status_perkawinan, $hp1, $hp2, $telpon, $email, 
							$jalan, $kelurahan, $kecamatan, $kota, $propinsi, $tinggi,  
							$berat, $rambut, $muka, $kulit, $ciri, $cacat, $hobi, 
							$no_sbakn, $tgl_sbakn, $no_skmpk, $tgl_skmpk, $no_sttpl, 
							$tgl_sttpl, $no_spmt, $tgl_spmt, $no_spmj, $tgl_spmj,
							$status, $jurusan, $prodi ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pegawai SET
						  kd_pegawai = '$kode', id_jenis= '$jenis', nip_lama='$nip_lama', nip_baru='$nip_baru',
						  nm_pegawai='$nama', gelar_depan='$gelar_depan', gelar_belakang='$gelar_blkg', ektp_pegawai='$ktp', npwp_pegawai='$npwp', 
						  tmt_polines='$tmt_polines', tmt_cpns='$tmt_cpns', tmt_pns='$tmt_pns', no_sk='$no_sk', jenis_kelamin='$jk', 
						  tempat_lahir='$tempat', tanggal_lahir='$tgl_lahir', golongan_darah='$darah', kd_agama='$agama', status_perkawinan='$status_perkawinan', 
						  hp1_pegawai='$hp1', hp2_pegawai='$hp2', telepon_pegawai='$telpon', email_pegawai='$email', alamat_jalan='$jalan', 
						  id_kelurahan='$kelurahan', tinggi_badan='$tinggi', 
						  berat_badan='$berat', rambut='$rambut', bentuk_muka='$muka', warna_kulit='$kulit', ciri_khas='$ciri', 
						  cacat_tubuh='$cacat', hobi_pegawai='$hobi', no_sbakn='$no_sbakn', tgl_sbakn='$tgl_sbakn', no_skmpk='$no_skmpk', 
						  tgl_skmpk='$tgl_skmpk', no_sttpl='$no_sttpl', tgl_sttpl='$tgl_sttpl', no_spmt='$no_spmt', tgl_spmt='$tgl_spmt', 
						  no_spmj='$no_spmj', tgl_spmj='$tgl_spmj' , id_status='$status', id_prodi='$prodi' 
						  WHERE id_pegawai = '$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function edit4( $id, $kode, $jenis, $nip_lama, $nip_baru, $nama,
							$gelar_depan, $gelar_blkg, $ktp, $npwp, $tmt_polines, 
							$tmt_cpns, $tmt_pns, $no_sk, $jk, $tempat, $tgl_lahir, 
							$darah, $agama, $status_perkawinan, $hp1, $hp2, $telpon, $email, 
							$jalan, $tinggi,  
							$berat, $rambut, $muka, $kulit, $ciri, $cacat, $hobi, 
							$no_sbakn, $tgl_sbakn, $no_skmpk, $tgl_skmpk, $no_sttpl, 
							$tgl_sttpl, $no_spmt, $tgl_spmt, $no_spmj, $tgl_spmj,
							$status, $jurusan, $prodi ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pegawai SET
						  kd_pegawai = '$kode', id_jenis= '$jenis', nip_lama='$nip_lama', nip_baru='$nip_baru',
						  nm_pegawai='$nama', gelar_depan='$gelar_depan', gelar_belakang='$gelar_blkg', ektp_pegawai='$ktp', npwp_pegawai='$npwp', 
						  tmt_polines='$tmt_polines', tmt_cpns='$tmt_cpns', tmt_pns='$tmt_pns', no_sk='$no_sk', jenis_kelamin='$jk', 
						  tempat_lahir='$tempat', tanggal_lahir='$tgl_lahir', golongan_darah='$darah', kd_agama='$agama', status_perkawinan='$status_perkawinan', 
						  hp1_pegawai='$hp1', hp2_pegawai='$hp2', telepon_pegawai='$telpon', email_pegawai='$email', alamat_jalan='$jalan', 
						  tinggi_badan='$tinggi', 
						  berat_badan='$berat', rambut='$rambut', bentuk_muka='$muka', warna_kulit='$kulit', ciri_khas='$ciri', 
						  cacat_tubuh='$cacat', hobi_pegawai='$hobi', no_sbakn='$no_sbakn', tgl_sbakn='$tgl_sbakn', no_skmpk='$no_skmpk', 
						  tgl_skmpk='$tgl_skmpk', no_sttpl='$no_sttpl', tgl_sttpl='$tgl_sttpl', no_spmt='$no_spmt', tgl_spmt='$tgl_spmt', 
						  no_spmj='$no_spmj', tgl_spmj='$tgl_spmj' , id_status='$status', id_prodi='$prodi' 
						  WHERE id_pegawai = '$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
			
	public function hapus( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pegawai 
						  SET sts_pegawai='1'
						  WHERE id_pegawai='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function update_log() {
		$ip_client 		= $_SERVER['REMOTE_ADDR'];
		$sess_id 		= session_id();
		$waktu 			= time('Y-m-d H:i:s');
		$sess_time 		= time();
		$id_pegawai 	= $this->session->userdata('kode_pegawai_siskap');
		$QuerySaya 		= $this->db->query(
							"UPDATE t_pegawai 
							SET 
							sess_id='$sess_id',
							sess_time='$sess_time',
							status_login='1',
							last_login='$waktu',
							ip_login='$ip_client' 
							WHERE id_pegawai='$id_pegawai';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function logout( $status, $waktu ) {
		$ip_client 		= $_SERVER['REMOTE_ADDR'];
		$sess_id 		= session_id();
		$sess_time 		= time();
		$id_pegawai 	= $this->session->userdata('kode_pegawai_siskap');
		$QuerySaya 		= $this->db->query(
							"UPDATE t_pegawai 
							SET 
							sess_id='',
							sess_time=0,
							status_login='0',
							last_login='$waktu',
							ip_login='$ip_client' 
							WHERE id_pegawai='$id_pegawai';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function user_online(){
		$time_check 	= time()-1200;
		$QuerySaya		= 	$this->db->query(
							"SELECT nm_pegawai,foto_pegawai,gelar_depan,gelar_belakang,nip_baru 
							FROM t_pegawai 
							WHERE status_login='1' AND sess_time>$time_check;"
						);
		return $QuerySaya->result();
	}
}
