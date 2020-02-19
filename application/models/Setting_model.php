<?php
class Setting_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_agama,C.nm_jenis,D.nama_kelurahan,
						  E.nama_kecamatan,F.nama_kota,G.nama_propinsi,
						  YEAR(curdate()) - YEAR(A.tanggal_lahir) AS usia,
						  I.nm_prodi 
						  FROM ((((((t_pegawai A 
						  INNER JOIN t_agama B         ON A.kd_agama=B.kd_agama) 
						  LEFT JOIN t_jenis C          ON A.id_jenis=C.id_jenis) 
						  LEFT JOIN alamat_kelurahan D ON A.id_kelurahan=D.id_kelurahan) 
						  LEFT JOIN alamat_kecamatan E ON D.id_kecamatan=E.id_kecamatan)  
						  LEFT JOIN alamat_kota F      ON E.id_kota=F.id_kota) 
						  LEFT JOIN alamat_propinsi G  ON F.id_propinsi=G.id_propinsi)
						  LEFT JOIN t_prodi I          ON A.id_prodi=I.id_prodi
						  WHERE A.sts_pegawai<>'1' 
						  ORDER BY A.nm_pegawai"
						);
		return $QuerySaya->result();
	}

		
	public function edit( $kode, $nama, $email, $password ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pegawai
						  SET nm_pegawai='$nama', email_pegawai='$email', pass_pegawai='$password'
						  WHERE id_pegawai='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}


    public function change_pass($id, $password)
    {
     

        $data = array(
            'pass_pegawai'      => $password
            );
        $where = "id_pegawai = '$id'";

        $this->db->update('t_pegawai', $data, $where);
        return true;
	}
	// SELECT * FROM alamat_kota ORDER BY id_kota desc limit 1;
}
