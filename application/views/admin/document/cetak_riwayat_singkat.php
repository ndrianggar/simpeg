<?php
foreach($riwayat_hidup as $riwayat) {
	$foto = $riwayat->foto_pegawai;
$content	=
'<style type="text/css">
	table
	{
	    width:  100%;
	    border: 1px solid #999;
		border-collapse:collapse;
	}
	.tabel th {padding:8px 5px; background-color:yellow;}
	.tabel td {padding:8px 5px;}
	.icone    { position: absolute; border: none; left: 5px;   top: 5px;  width: 240px; height: 128px;overflow: hidden; }
</style>';

	$content 	.= '<page style="font-size: 12px" orientation="portrait" format="A4" >
						';
	$content	.= 
				'
				<div style=" margin-top:0px; font-size:14px;">
					<h3 align="center"><u>DAFTAR RIWAYAT HIDUP</u></h3>
				</div>
				<div style="border:1px; width: 130px; height: auto; margin-left: 580px;	margin-top:-10px;">
 					<img src="assets/foto/'.$foto.'" style="width: 130px; height: auto;">
				</div>
				<br>
				<table style="margin-left:50px; margin-top:0px; font-size:12px; width:100%;" border="1px" class="tabel rata">
					<col style="width: 4%">
					<col style="width: 20%">
					<col style="width: 40%">
					<tr>
						<th  align="center"  style="colspan=3; " class="text-center">DATA UTAMA</th>
					</tr>
					
					<tr>
						<td align="center" style="width: 10%>1.</td>
						<td  style="width: 35%">NAMA LENGKAP</td>
						<td style="width: 49%">'.$riwayat->gelar_depan . ' ' . $riwayat->nm_pegawai  . ' ' . $riwayat->gelar_belakang.'</td>
					</tr>
					<tr>
						<td align="center" >2.</td>
						<td >NIP</td>
						<td>'. $riwayat->kd_pegawai .'</td>
					</tr>
					<tr>
						<td align="center">3.</td>
						<td >JABATAN</td>
						<td>'. $riwayat->nm_jabatan .'</td>
					</tr>
					<tr>
						<td align="center">4.</td>
						<td >PANGKAT / GOL</td>
						<td>'. $riwayat->nm_pangkat .' '. $riwayat->gol_pangkat .'</td>
					</tr>
					<tr>
						<td align="center">5.</td>
						<td >TEMPAT, TANGGAL LAHIR</td>
						<td>'. $riwayat->tempat_lahir .', '. date('d F Y',strtotime($riwayat->tanggal_lahir)) .'</td>
					</tr>
					<tr>
						<td align="center">6.</td>
						<td >JENIS KELAMIN</td>
						<td>'. $riwayat->jenis_kelamin .'</td>
					</tr>
					<tr>
						<td align="center">7.</td>
						<td >AGAMA</td>
						<td>'. $riwayat->nm_agama .'</td>
					</tr>
					<tr>
						<td align="center">8.</td>
						<td >STATUS PERKAWINAN</td>
						<td>' . $riwayat->status_perkawinan . '</td>
					</tr>
					<tr>
						<td align="center">9.</td>
						<td >ALAMAT RUMAH</td>
						<td>'. $riwayat->alamat_jalan .' '. $riwayat->nama_kelurahan .' '. $riwayat->nama_kecamatan .' '. $riwayat->nama_kota .'</td>
					</tr>
					
				</table>';
				
	$content	.= 
				'
				<div style="margin-left:50px; font-size:12px; margin-top:30px;">
					<p  style="margin-top:-10px; margin-left:50px; font-size: 14px;">1. RIWAYAT PENDIDIKAN</p>
				</div>';
	$content	.= 
				'<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
						<col style="width: 4%">
						<col style="width: 20%">
						<col style="width: 43%">
						<col style="width: 21%">
						<tr>
							<th align="center" >NO</th>
							<th align="center" >TINGKAT</th>
							<th align="center" >NAMA INSTITUSI PENDIDIKAN</th>
							<th align="center" >TAHUN LULUS</th>
						</tr>';
		$nomor = 0;
		foreach ($pendidikan as $pendidikan) {
		$nomor = $nomor + 1;
		$content	.= 
					'<tr>
							<td align="center">'. $nomor .'</td>
							<td align="center">'. $pendidikan->alias_polines .'</td>
							<td align="center">'. $pendidikan->nama_pendidikan .'</td>
							<td align="center">'. date('Y',strtotime($pendidikan->akhir_pendidikan)) .'</td>
						</tr>';
		}
	$content	.= '</table>';

	$content	.= 
				'
				<div style="margin-left:50px; font-size:12px; margin-top:30px;">
					<p  style="margin-top:-10px; margin-left:50px; font-size: 14px;">2. RIWAYAT GOLONGAN</p>
				</div>';
	$content	.= 
				'<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 4%">
					<col style="width: 25%">
					<col style="width: 17%">
					<col style="width: 25%">
					<col style="width: 17%">
					<tr>
						<th align="center" >NO</th>
						<th align="center" >PANGKAT</th>
						<th align="center" >GOL / RUANG</th>
						<th align="center" >TMT GOLONGAN</th>
						<th align="center" >KET</th>
					</tr>';

		$nomor2 = 0;
		foreach ($pangkat as $pangkat) {
		$nomor2 = $nomor2 + 1;
		$content	.= 
					'<tr>
						<td align="center">'. $nomor2 .'</td>
						<td align="center">'. $pangkat->nm_pangkat .'</td>
						<td align="center">'. $pangkat->gol_pangkat .'</td>
						<td align="center">'. $pangkat->tmt_pangkat .'</td>
						<td align="center"></td>
					</tr>';
	}					
	$content	.= 
				'</table>';
	$content	.= 
				'<div style="margin-left:50px; font-size:12px; margin-top:10px;">
					<p  style="margin-top:10px; margin-left:50px; font-size: 14px;">3. RIWAYAT JABATAN</p>
				</div>';
	$content	.= 
				'<table style="margin-left:50px; margin-top:; font-size:12px;" border="1px" class="tabel">
					<col style="width: 4%">
					<col style="width: 30%">
					<col style="width: 34%">
					<col style="width: 20%">
					<tr>
						<th align="center" >NO</th>
						<th align="center" >NAMA JABATAN</th>
						<th align="center" >MULAI  DAN SAMPAI</th>
						<th align="center" >KET</th>
					</tr>';
					
	$nomor3 = 0;
	foreach ($jabatan as $jabatan) {
	$nomor3 = $nomor3 + 1;
	$content	.= 
					'<tr>
						<td align="center">'. $nomor3 .'</td>
						<td align="center">'. $jabatan->nm_jabatan .'</td>
						<td align="center">'. date('d F Y',strtotime($jabatan->tmt_jabatan)) .' - '. date('d F Y',strtotime($jabatan->tmt_pelantikan)) .'</td>
						<td align="center"></td>
					</tr>';
	}					
	$content	.= 
				'</table>';


	$content	.= 
				'<div style="margin-left:50px; font-size:12px; margin-top:30px;">
					<p  style="margin-top:-10px; margin-left:50px; font-size: 14px;">4.KETERANGAN KELUARGA</p>
				</div>
				
				<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 4%">
					<col style="width: 54%">
					<col style="width: 30%">
					<tr>
						<th align="center" >NO </th>
						<th align="center" >NAMA </th>
						<th align="center" >KETERANGAN</th>
					</tr>';
	
	$nomor4 = 0;
	foreach ($pasangan as $pasangan) {				
	$nomor4 = $nomor4 + 1;
	$content	.= 
					'<tr>
						<td align="center">'. $nomor4 .'</td>
						<td align="center">'. $pasangan->nama_keluarga .'</td>
						<td align="center">'. $pasangan->nm_hubungan .'</td>
						
					</tr>';
	}					
	$content	.= 
	
				'</table>

				';
$content 		.= '</page>';




require_once(__DIR__ .'/../../../../assets/html2pdf/html2pdf.class.php');
$html2pdf 	= new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('daftar_riwayat_hidup_singkat.pdf');
} ?>

