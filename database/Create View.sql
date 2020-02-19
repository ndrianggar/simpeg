-- Create view manual

CREATE VIEW get_pmk 
AS 
(
	SELECT `t_riwayat_pangkat`.`id_pegawai` AS `id_pegawai`, 
	SUM(`t_riwayat_pangkat`.`pmk`)   AS `pmk` 
	FROM `t_riwayat_pangkat` 
	WHERE (`t_riwayat_pangkat`.`status_riwayat_pangkat` <> '1')
	GROUP BY `t_riwayat_pangkat`.`id_pegawai`
);

CREATE VIEW `data_duk` 
AS
(
	SELECT A.id_pegawai,A.kd_pegawai,A.nip_baru,A.nm_pegawai,A.gelar_depan,A.id_jenis,
	A.gelar_belakang,A.tmt_polines,A.tmt_cpns,A.tmt_pns,K.id_jurusan,B.nm_jurusan,
	C.id_pangkat,D.kd_pangkat,D.nm_pangkat,D.gol_pangkat,C.tmt_pangkat,E.kd_jabatan,
	E.tmt_jabatan,G.kd_jenis,G.nm_jenis,F.nm_jabatan,F.kls_jabatan,H.kd_pendidikan,
	H.nama_pendidikan,YEAR(H.akhir_pendidikan) AS tahun_pendidikan,H.id_jenjang,
	I.kd_jenjang,I.nm_jenjang,I.alias_umum,I.alias_polines,H.jurusan_pendidikan,
	'-' AS keterangan, YEAR(CURDATE()) - YEAR(A.tanggal_lahir) AS usia,J.pmk,
	A.sts_kematian,A.akta_kematian,A.tgl_kematian,A.file_kematian,A.sts_pensiun,
	A.tgl_pensiun,A.sk_pensiun,A.file_pensiun,A.ket_pensiun 
	FROM 
	(((((((((t_pegawai A INNER JOIN t_prodi K ON A.id_prodi=K.id_prodi)
	INNER JOIN t_jurusan B ON K.id_jurusan=B.id_jurusan)
	LEFT JOIN t_riwayat_pangkat C ON A.id_pegawai=C.id_pegawai AND C.status_riwayat_pangkat='A') 
	LEFT JOIN t_pangkat D ON C.id_pangkat=D.id_pangkat) 
	LEFT JOIN t_riwayat_jabatan E ON A.id_pegawai=E.id_pegawai AND E.status_riwayat_jabatan='A')
	LEFT JOIN t_jabatan F ON E.kd_jabatan=F.kd_jabatan)
	LEFT JOIN t_jenis_jabatan G ON F.kd_jenis=G.kd_jenis)
	LEFT JOIN t_pendidikan H ON A.id_pegawai=H.id_pegawai AND H.status_aktif='1')
	LEFT JOIN t_jenjang I ON H.id_jenjang=I.id_jenjang)
	LEFT JOIN get_pmk J ON A.id_pegawai=J.id_pegawai 
	ORDER BY D.kd_pangkat DESC,C.tmt_pangkat DESC,F.kls_jabatan DESC,
	E.tmt_jabatan DESC,I.kd_jenjang DESC,H.akhir_pendidikan DESC,A.tanggal_lahir DESC
);

CREATE VIEW `data_pegawai` 
AS
(
	SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,D.id_kecamatan,
	E.nama_kecamatan,E.id_kota,F.nama_kota,F.id_propinsi,G.nama_propinsi,
	YEAR(CURDATE()) - YEAR(A.tanggal_lahir) AS usia,
	I.nm_prodi,I.id_jurusan,H.nm_jurusan,J.nama_status,K.nm_pangkat,
	M.nm_jabatan,K.gol_pangkat,O.nm_eselon,P.nm_penempatan
	FROM ((((((((((((((t_pegawai A 
	LEFT JOIN t_agama B ON A.kd_agama=B.kd_agama)
	LEFT JOIN t_pegawai_status J ON A.id_status=J.id_status)  
	LEFT JOIN t_jenis C ON A.id_jenis=C.id_jenis) 
	LEFT JOIN alamat_kelurahan D ON A.id_kelurahan=D.id_kelurahan) 
	LEFT JOIN alamat_kecamatan E ON D.id_kecamatan=E.id_kecamatan)  
	LEFT JOIN alamat_kota F ON E.id_kota=F.id_kota) 
	LEFT JOIN alamat_propinsi G ON F.id_propinsi=G.id_propinsi)
	LEFT JOIN t_prodi I ON A.id_prodi=I.id_prodi)
	LEFT JOIN t_jurusan H ON I.id_jurusan=H.id_jurusan)
	LEFT JOIN t_riwayat_pangkat N ON A.id_pegawai=N.id_pegawai AND N.status_riwayat_pangkat='A')
	LEFT JOIN t_pangkat K ON N.id_pangkat=K.id_pangkat)
	LEFT JOIN t_riwayat_jabatan L ON A.id_pegawai=L.id_pegawai AND L.status_riwayat_jabatan='A')
	LEFT JOIN t_jabatan M ON L.kd_jabatan=M.kd_jabatan)
	LEFT JOIN t_eselon O ON M.kd_eselon=O.kd_eselon)
	LEFT JOIN t_penempatan P ON L.id_penempatan=P.id_penempatan 						  
	WHERE A.sts_pegawai<>'1' 
	ORDER BY A.nm_pegawai
);