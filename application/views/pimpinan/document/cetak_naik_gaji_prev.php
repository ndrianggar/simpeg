<?php
$content	=
'<style type="text/css">
	.tabel {border-collapse:collapse;}
	.tabel th {padding:8px 5px;}
	.tabel td {padding:8px 5px;}
</style>';


	$content 	.= '<page style="font-size: 16px; " orientation="portrait" format="A4" >
							<p align="center" style="margin-top:40px; font-size: 14px;"><b>KEMENTRIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI</b></p>
							<p align="center" style="margin-top:-10px; font-size: 14px;"><b>POLITEKNIK NEGERI SEMARANG</b></p>
						';
	$content	.= 
				'
				<hr>
				<div style="margin-left:50px; margin-top:0px; font-size:12px;">
					<table>
						<tr>
							<td>Nomor</td>
							<td>:</td>
							<td>'.$nomor_surat.'</td>
						</tr>
						<tr>
							<td>Hal</td>
							<td>:</td>
							<td>'.$hal_surat.'</td>
						</tr>
						<tr>
							<td>Catatan</td>
							<td>:</td>
							<td>'.$catatan_surat.'</td>
						</tr>
					</table>
				</div>
				<div style="margin-left:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">'.$tujuan_surat.'</p>
					
				</div>
				<div style="margin-left:50px; margin-right:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">'.$pembukaan_surat.'</p>
				</div>

				<div style="margin-left:50px; margin-top:20px; font-size:12px;">
					<table>
						<tr>
							<td>1.</td>
							<td>Nama</td>
							<td>:</td>
							<td><b>'.$nm_pegawai.'</b></td>
						</tr>
						<tr>
							<td>2.</td>
							<td>NIP</td>
							<td>:</td>
							<td>'.$nip_baru.'</td>
						</tr>
						<tr>
							<td>3.</td>
							<td>Pangkat/Jabatan</td>
							<td>:</td>
							<td>'.$nm_pangkat.' / '.$nm_jabatan.'</td>
						</tr>
						<tr>
							<td>4.</td>
							<td>Kantor/Tempat</td>
							<td>:</td>
							<td>'.$kantor.'</td>
						</tr>
						<tr>
							<td>5.</td>
							<td>Gaji Pokok</td>
							<td>:</td>
							<td>'.$gaji.'</td>
						</tr>
						
					</table>
				</div>

				<div style="margin-left:50px; margin-right:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">'.$dasar_surat.'</p>
				</div>

				<div style="margin-left:50px; margin-top:20px; font-size:12px;">
					<table>
						<tr>
							<td>a.</td>
							<td>Oleh Pejabat </td>
							<td>:</td>
							<td>'.$pejabat.'</td>
						</tr>
						<tr>
							<td>b.</td>
							<td>Tanggal.Nomor</td>
							<td>:</td>
							<td>'.$tanggal_pejabat.'</td>
							<td>Nomor : '.$nomor_pejabat.'</td>
						</tr>
						<tr>
							<td>c.</td>
							<td>Tanggal Mulai Berlakunya <br> Gaji Tersebut</td>
							<td>:</td>
							<td>'.$tanggal_berlaku.'</td>
						</tr>
						<tr>
							<td>d.</td>
							<td>Masa Kerja Golongan <br> Pada Masa Tanggal tsb</td>
							<td>:</td>
							<td>'.$masa_kerja.'</td>
						</tr>						
					</table>
				</div>


				<div style="margin-left:50px; margin-right:50px; margin-top:0px; font-size:12px;">
					<p>'.$hingga_memperoleh.'</p>
				</div>

				<div style="margin-left:50px; margin-top:20px; font-size:12px;">
					<table>
						<tr>
							<td>6.</td>
							<td>a. Gaji Pokok Baru</td>
							<td>:</td>
							<td>'.$gaji_baru.'</td>
						</tr>
						<tr>
							<td></td>
							<td>b. Tunjangan Jabatan</td>
							<td>:</td>
							<td>'.$tunjangan_jabatan.'</td>
						</tr>
						<tr>
							<td>7.</td>
							<td>Berdasarkan Masa Kerja</td>
							<td>:</td>
							<td>'.$masa_kerja_baru.'</td>
						</tr>
						<tr>
							<td>8.</td>
							<td>Dalam Golongan</td>
							<td>:</td>
							<td>'.$golongan.'</td>
						</tr>
						<tr>
							<td>9.</td>
							<td>Mulai Tanggal</td>
							<td>:</td>
							<td>'.$mulai_tanggal.'</td>
						</tr>
					</table>
				</div>

				<div style="margin-left:50px; margin-right:50px; margin-top:0px; font-size:12px;">
					<p>'.$penutup_surat.'</p>
				</div>

				<div style="float:right; margin-left:400px; margin-top:0px; font-size:12px;">
					
					<p>'.$nm_jabatan2.'</p>
					<br>
					<br>
					<p><b>'.$nama.'</b></p>
					<p style="margin-top:-10px;">NIP. '.$nip.'</p>
				</div>
				<div style="margin-left:50px; margin-top:10px; font-size:12px;">
					<p><b>SALINAN :</b></p>
					<p style="margin-top:-10px;">'.$salinan.'</p>
				
				</div>

				';
$content 		.= '</page>';


require_once(__DIR__ .'/../../../../assets/html2pdf/html2pdf.class.php');
$html2pdf 	= new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('naik_gaji.pdf');

?>