<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function tgl_sql($tgl){
	if ($tgl=='') {
		$hasil	= '0000-00-00';
	} else {
		$hasil	= substr($tgl,6,4) . '-' . substr($tgl,3,2) . '-' . substr($tgl,0,2);
	}
	return $hasil;
}

function safe_sql($sql){
	$hasil	= str_replace("'","`",$sql);
	return $hasil;
}

?>