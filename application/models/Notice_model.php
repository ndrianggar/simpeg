<?php
class Notice_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
		
	public function buat_id() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_notice) AS idmax 
						  FROM t_notice;"
						);
		$id 			= 1;
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $k){
				$id 	= ($k->idmax) + 1;
			}
		}
		return $id;
	}

	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.gelar_depan, B.gelar_belakang, B.nm_pegawai, B.foto_pegawai, B.hak_akses
							FROM t_notice A
							INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai
							WHERE A.status_notice<>'1' AND B.hak_akses<>'Admin'
							ORDER BY A.id_notice DESC;"
						);
		return $QuerySaya->result();
	}

	public function cari_semua_user( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.gelar_depan, B.gelar_belakang, B.nm_pegawai, B.foto_pegawai, B.hak_akses 
						  FROM t_notice A INNER JOIN t_pegawai B ON A.add_id=B.id_pegawai 
						  WHERE A.status_notice<>'1' AND A.id_pegawai='$id' AND A.add_id<>'$id'
						  ORDER BY A.id_notice DESC;"
						);
		return $QuerySaya->result();
	}

	public function cari_admin_unread() {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.gelar_depan, B.gelar_belakang, B.nm_pegawai, B.foto_pegawai, B.hak_akses 
						  FROM t_notice A INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai 
						  WHERE A.admin_read<>'1' AND A.status_notice<>'1'  
						  ORDER BY A.id_notice DESC;"
						);
		return $QuerySaya->result();
	}

	public function cari_admin_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.gelar_depan, B.gelar_belakang, B.nm_pegawai, B.foto_pegawai, B.hak_akses 
						  FROM t_notice A INNER JOIN t_pegawai B ON A.id_pegawai=B.id_pegawai 
						  WHERE A.status_notice<>'1'  
						  ORDER BY A.id_notice DESC;"
						);
		return $QuerySaya->result();
	}
		
	public function cari_user_unread( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.gelar_depan, B.gelar_belakang, B.nm_pegawai, B.foto_pegawai, B.hak_akses 
						  FROM t_notice A INNER JOIN t_pegawai B ON A.add_id=B.id_pegawai 
						  WHERE A.user_read<>'1' AND A.status_notice<>'1' AND A.id_pegawai='$id'  
						  ORDER BY A.id_notice DESC;"
						);
		return $QuerySaya->result();
	}

	public function cari_user_semua( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT A.*, B.gelar_depan, B.gelar_belakang, B.nm_pegawai, B.foto_pegawai, B.hak_akses 
						  FROM t_notice A INNER JOIN t_pegawai B ON A.add_id=B.id_pegawai 
						  WHERE A.status_notice<>'1'  
						  ORDER BY A.id_notice;"
						);
		return $QuerySaya->result();
	}

	public function cari_kd( $kode ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM t_notice 
						  WHERE id_notice='$kode' AND sts_notice<>'1';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $id, $pegawai, $jenis, $tanggal, $link, $keterangan, $user_read, $admin_read, $status, $add_id, $add_time, $add_ip ) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO t_notice
						  (id_notice, id_pegawai, jenis_notice, tanggal_notice, link_notice, ket_notice, user_read, admin_read, status_notice, add_id, add_time, add_ip) 
						  VALUES 
						  ('$id', '$pegawai', '$jenis', '$tanggal', '$link', '$keterangan', '$user_read', '$admin_read', '$status', '$add_id', '$add_time', '$add_ip');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function user_read( $upd_id, $upd_time, $upd_ip ) {
		$id_pegawai 	= $this->session->userdata('kode_pegawai_siskap');
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_notice
						  SET user_read='1', upd_id='$upd_id', upd_time='$upd_time', upd_ip='$upd_ip' 
						  WHERE id_pegawai='$id_pegawai';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function admin_read( $id, $upd_id, $upd_time, $upd_ip, $pegawai ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_notice
						  SET admin_read='1', upd_id='$upd_id', upd_time='$upd_time', upd_ip='$upd_ip' 
						  WHERE id_pegawai='$pegawai';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
