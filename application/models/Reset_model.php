<?php
class Reset_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT *
						   FROM t_pegawai 
						   WHERE sts_pegawai <>'1' AND hak_akses<>'Admin';"
						);
		return $QuerySaya->result();
	}

	public function ganti( $kode, $password ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE t_pegawai 
						  SET pass_pegawai='$password'
						  WHERE id_pegawai='$kode';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function get_by_id ($id)
	{
		$QuerySaya 		= $this->db->query(
						  "SELECT *
						   FROM t_pegawai 
						   WHERE sts_pegawai <>'1' AND id_pegawai='$id';"
						);
		return $QuerySaya->result();
	}

    public function change_pass($id, $password)
    {
        // $data = array(
        //     'pass_pegawai'      => $password
        //     );
        // $where = "id_pegawai = '$id'";

        // $this->db->update('t_pegawai', $data, $where);
        $this->db->query("UPDATE t_pegawai SET pass_pegawai='$password' 
        				WHERE id_pegawai='$id';");
        return true;
	}

}
