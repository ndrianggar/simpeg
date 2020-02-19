<?php
class Keluarga_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_kode() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(kd_keluarga) AS idmax 
							FROM t_keluarga;"
						);
		$kode 			= 	"";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$kode  	= 	$k->idmax+1;
			}
		} else {
			$kode 		= 	"1";
		}
		return $kode;
	}

	public function buat_kode_tmp() {
		$QuerySaya 		= 	$this->db->query(
							"SELECT MAX(id_tmp) AS idmax 
							FROM tmp_keluarga;"
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

	public function hubungan() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_hubungan 
						  WHERE sts_hubungan<>'1'
						  ORDER BY kd_hubungan;"	
						);
		return $QuerySaya->result();
	}

	public function cari_semua( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*,B.nm_hubungan,C.nm_agama 
						  FROM (t_keluarga A INNER JOIN t_hubungan B 
						  ON A.kd_hubungan=B.kd_hubungan) INNER JOIN t_agama C 
						  ON A.kd_agama=C.kd_agama 
						  WHERE A.sts_keluarga<>'1' AND A.kd_pegawai='$kode' 
						  ORDER BY A.kd_hubungan,A.tanggal_nikah,A.tanggal_lahir;"
						);	
		return $QuerySaya->result();
	}

	public function cari_kd( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT * FROM t_keluarga 
							WHERE sts_keluarga<>'1' AND kd_keluarga='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT A.*,  DATE_FORMAT(A.tanggal_lahir, '%d-%m-%Y') as tgl_lahir,  DATE_FORMAT(A.tanggal_cerai, '%d-%m-%Y') as tgl_cerai,  
							DATE_FORMAT(A.tanggal_nikah, '%d-%m-%Y') as tgl_nikah,  DATE_FORMAT(A.tanggal_meninggal, '%d-%m-%Y') as tgl_meninggal,
							B.nm_hubungan,C.nm_agama 
						  FROM (tmp_keluarga A INNER JOIN t_hubungan B 
						  ON A.kd_hubungan=B.kd_hubungan) INNER JOIN t_agama C 
						  ON A.kd_agama=C.kd_agama 
						  WHERE A.sts_keluarga<>'1' AND A.kd_keluarga='$kode';"
						);
		return $QuerySaya->result();
	}

	public function cari_tmp2( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"SELECT A.*,  DATE_FORMAT(A.tanggal_lahir, '%d-%m-%Y') as tgl_lahir,  DATE_FORMAT(A.tanggal_cerai, '%d-%m-%Y') as tgl_cerai,  
							DATE_FORMAT(A.tanggal_nikah, '%d-%m-%Y') as tgl_nikah,  DATE_FORMAT(A.tanggal_meninggal, '%d-%m-%Y') as tgl_meninggal,
							B.nm_hubungan,C.nm_agama 
						  FROM (t_keluarga A INNER JOIN t_hubungan B 
						  ON A.kd_hubungan=B.kd_hubungan) INNER JOIN t_agama C 
						  ON A.kd_agama=C.kd_agama 
						  WHERE A.sts_keluarga<>'1' AND A.kd_keluarga='$kode';"
						);
		return $QuerySaya->result();
	}

	public function tambah( $kode, $pegawai, $hubungan, $nama, $gelar_depan, 
							$gelar_belakang, $jenis, $ktp, $jk, $agama,
							$tempat_lahir, $tanggal_lahir, $akte_kelahiran, $tanggal_nikah, $akte_nikah,
							$status_cerai, $tanggal_cerai, $akte_cerai, $status_hidup, $tanggal_meninggal,
							$akte_meninggal, $hp, $telp, $email, $pekerjaan,
							$status_perkawinan, $alamat, $keterangan, $status) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO t_keluarga
							(kd_keluarga,kd_pegawai,kd_hubungan,nama_keluarga,gelar_depan,
							gelar_belakang,jenis_keluarga,ektp_keluarga,jenis_kelamin,kd_agama,
							tempat_lahir, tanggal_lahir,akte_kelahiran,tanggal_nikah,akte_nikah,
							status_cerai,tanggal_cerai,akte_cerai,status_hidup,tanggal_meninggal,
							akte_meninggal,hp_keluarga,telp_keluarga,email_keluarga,pekerjaan_keluarga,
							status_perkawinan,alamat_keluarga,keterangan_keluarga,sts_keluarga) 
							VALUES 
							('$kode', '$pegawai', '$hubungan', '$nama', '$gelar_depan',
							'$gelar_belakang', '$jenis', '$ktp', '$jk', '$agama',
							'$tempat_lahir', '$tanggal_lahir', '$akte_kelahiran', '$tanggal_nikah', '$akte_nikah',
							'$status_cerai', '$tanggal_cerai', '$akte_cerai', '$status_hidup', '$tanggal_meninggal',
							'$akte_meninggal', '$hp', '$telp', '$email', '$pekerjaan',
							'$status_perkawinan', '$alamat', '$keterangan', '$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function tambah_tmp( $tmp, $kode, $pegawai, $hubungan, $nama, $gelar_depan, 
							$gelar_belakang, $jenis, $ktp, $jk, $agama,
							$tempat_lahir, $tanggal_lahir, $akte_kelahiran, $tanggal_nikah, $akte_nikah,
							$status_cerai, $tanggal_cerai, $akte_cerai, $status_hidup, $tanggal_meninggal,
							$akte_meninggal, $hp, $telp, $email, $pekerjaan,
							$status_perkawinan, $alamat, $keterangan, $status) {
		$QuerySaya 		= 	$this->db->query(
							"INSERT INTO tmp_keluarga
							(id_tmp,kd_keluarga,kd_pegawai,kd_hubungan,nama_keluarga,gelar_depan,
							gelar_belakang,jenis_keluarga,ektp_keluarga,jenis_kelamin,kd_agama,
							tempat_lahir, tanggal_lahir,akte_kelahiran,tanggal_nikah,akte_nikah,
							status_cerai,tanggal_cerai,akte_cerai,status_hidup,tanggal_meninggal,
							akte_meninggal,hp_keluarga,telp_keluarga,email_keluarga,pekerjaan_keluarga,
							status_perkawinan,alamat_keluarga,keterangan_keluarga,sts_keluarga) 
							VALUES 
							('$tmp','$kode', '$pegawai', '$hubungan', '$nama', '$gelar_depan',
							'$gelar_belakang', '$jenis', '$ktp', '$jk', '$agama',
							'$tempat_lahir', '$tanggal_lahir', '$akte_kelahiran', '$tanggal_nikah', '$akte_nikah',
							'$status_cerai', '$tanggal_cerai', '$akte_cerai', '$status_hidup', '$tanggal_meninggal',
							'$akte_meninggal', '$hp', '$telp', '$email', '$pekerjaan',
							'$status_perkawinan', '$alamat', '$keterangan', '$status');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function edit( $kode, $pegawai, $kd_hubungan, $nama_keluarga, $gelar_depan, $gelar_belakang, $jenis_keluarga, $ektp_keluarga, 
							$jenis_kelamin, $kd_agama, $tempat_lahir, $tanggal_lahir, $akte_kelahiran, $tanggal_nikah, $akte_nikah,
							 $status_cerai, $tanggal_cerai, $akte_cerai, $status_hidup, $tanggal_meninggal, $akte_meninggal, $hp_keluarga,
							  $telp_keluarga, $email_keluarga, $pekerjaan_keluarga, $status_perkawinan, $alamat_keluarga, $keterangan_keluarga ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_keluarga 
							SET kd_hubungan='$kd_hubungan',
							nama_keluarga='$nama_keluarga',
							gelar_depan='$gelar_depan',
							gelar_belakang='$gelar_belakang',
							jenis_keluarga='$jenis_keluarga',
							ektp_keluarga='$ektp_keluarga',
							jenis_kelamin='$jenis_kelamin',
							kd_agama='$kd_agama',
							tempat_lahir='$tempat_lahir',
							tanggal_lahir='$tanggal_lahir',
							akte_kelahiran='$akte_kelahiran',
							tanggal_nikah='$tanggal_nikah',
							akte_nikah='$akte_nikah',
							status_cerai='$status_cerai',
							tanggal_cerai='$tanggal_cerai',
							akte_cerai='$akte_cerai',
							status_hidup='$status_hidup',
							tanggal_meninggal='$tanggal_meninggal',
							akte_meninggal='$akte_meninggal',
							hp_keluarga='$hp_keluarga',
							telp_keluarga='$telp_keluarga',
							email_keluarga='$email_keluarga',
							pekerjaan_keluarga='$pekerjaan_keluarga',
							status_perkawinan='$status_perkawinan',
							alamat_keluarga='$alamat_keluarga',
							keterangan_keluarga='$keterangan_keluarga'
							WHERE kd_keluarga='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function terima_edit($kode, $pegawai){
		$QuerySaya 		= $this->db->query(
						"UPDATE t_keluarga A INNER JOIN tmp_keluarga B 
						ON A.kd_keluarga=B.kd_keluarga 
						SET A.kd_hubungan=B.kd_hubungan,
						A.nama_keluarga=B.nama_keluarga,
						A.gelar_depan=B.gelar_depan,
						A.gelar_belakang=B.gelar_belakang,
						A.jenis_keluarga=B.jenis_keluarga,
						A.ektp_keluarga=B.ektp_keluarga,
						A.jenis_kelamin=B.jenis_kelamin,
						A.kd_agama=B.kd_agama,
						A.tempat_lahir=B.tempat_lahir,
						A.tanggal_lahir=B.tanggal_lahir,
						A.akte_kelahiran=B.akte_kelahiran,
						A.tanggal_nikah=B.tanggal_nikah,
						A.akte_nikah=B.akte_nikah,
						A.status_cerai=B.status_cerai,
						A.tanggal_cerai=B.tanggal_cerai,
						A.akte_cerai=B.akte_cerai,
						A.status_hidup=B.status_hidup,
						A.tanggal_meninggal=B.tanggal_meninggal,
						A.akte_meninggal=B.akte_meninggal,
						A.hp_keluarga=B.hp_keluarga,
						A.telp_keluarga=B.telp_keluarga,
						A.email_keluarga=B.email_keluarga,
						A.pekerjaan_keluarga=B.pekerjaan_keluarga,
						A.status_perkawinan=B.status_perkawinan,
						A.alamat_keluarga=B.alamat_keluarga,
						A.keterangan_keluarga=B.keterangan_keluarga,
						A.foto_keluarga=B.foto_keluarga,
						A.sts_keluarga='0' 
						WHERE A.kd_keluarga='$kode' AND B.sts_keluarga='0';"
					);
		$QuerySaya 		= $this->db->query(
						"UPDATE tmp_keluarga  
						SET sts_keluarga='1' 
						WHERE kd_keluarga='$kode' AND sts_keluarga='0';"
					);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $kode ) {
		$QuerySaya 		= 	$this->db->query(
							"UPDATE t_keluarga 
							SET sts_keluarga='1'
							WHERE kd_keluarga='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
