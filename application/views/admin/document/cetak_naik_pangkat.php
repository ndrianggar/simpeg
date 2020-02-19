<?php
foreach ($data_naik_pangkat as $row) { 
$content	=
'<style type="text/css">
	.tabel {border-collapse:collapse;}
	.tabel th {padding:8px 5px;}
	.tabel td {padding:8px 5px;}
</style>';

	$content 	.= '<page style="font-size: 16px; " orientation="portrait" format="A4" >
						<div style="width:20%; margin-left:40px;">
							<img src="assets/images/logo2.gif" style="margin-left:20px; height:100px; width:100px;">
						</div>
						<div style="width:80%; margin-left:135px;">
							<p align="center" style="margin-top:-80px; font-size: 14px;">KEMENTRIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI</p>
							<p align="center" style="margin-top:-10px; font-size: 14px;"><b>POLITEKNIK NEGERI SEMARANG</b></p>
							<p align="center" style="margin-top:-10px; font-size: 12px;">Jalan Prof. H. Soedarto, S.H. Tembalang, Semarang 50275, PO BOX 6199/SMS</p>
							<p align="center" style="margin-top:-10px; font-size: 12px;">Telephone (024) 7473417, 7499586, Facsimile (024) 7472396</p>
							<p align="center" style="margin-top:-10px; font-size: 12px;">http:/www.polines.ae.id, E-mail : sekretariat@polines.ae.id.</p>
						</div>
						';
	$content	.= 
				'
				<hr>
				<div style="margin-left:50px; margin-top:0px; font-size:12px;">
					<table>
						<tr>
							<td>Nomor</td>
							<td>:</td>
							<td>'.$row->nomor_pangkat.'</td>
						</tr>
						<tr>
							<td>Lampiran</td>
							<td>:</td>
							<td>1 (satu) bandel</td>
						</tr>
						<tr>
							<td>Hal</td>
							<td>:</td>
							<td>'.$row->hal_pangkat.' <br> a.n Sdr. '.$row->nm_pegawai.'</td>
						</tr>
					</table>
				</div>
				<div style="margin-left:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">'.$row->tujuan_pangkat.'</p>
				</div>
				<div style="margin-left:50px; margin-right:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">'.$row->pembukaan_pangkat.'</p>
				</div>

				<div style="margin-left:50px; margin-top:20px; font-size:12px;">
					<table>
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td>'.$row->nm_pegawai.'</td>
						</tr>
						<tr>
							<td>NIP</td>
							<td>:</td>
							<td>'.$row->nip_baru.'</td>
						</tr>
						<tr>
							<td>NIDN</td>
							<td>:</td>
							<td>'.$row->nidn_pangkat.'</td>
						</tr>
						<tr>
							<td>Tempat, Tanggal Lahir</td>
							<td>:</td>
							<td>'.$row->tempat_lahir.', '.date('d F Y',strtotime($row->tanggal_lahir)).'</td>
						</tr>
						<tr>
							<td>Pangkat,gol,ruang,TMT</td>
							<td>:</td>
							<td>'.$row->nm_pangkat.','.$row->gol_pangkat.','.$row->ruang_pangkat.' '.date('d F Y',strtotime($row->tmt_pgrt_lama_pangkat)).'</td>
						</tr>
						<tr>
							<td>Jabatan TMT</td>
							<td>:</td>
							<td>'.$row->nm_jabatan.', '.date('d F Y',strtotime($row->tmt_jabatan_lama_pangkat)).'</td>
						</tr>
						<tr>
							<td>Unit Kerja</td>
							<td>:</td>
							<td>'.$row->unit_kerja_pangkat.'</td>
						</tr>
						<tr>
							<td>Jumlah Angka Kredit baru yagn diusulkan</td>
							<td>:</td>
							<td>'.$row->usulan_angka_kredit_pangkat.'</td>
						</tr>
						<tr>
							<td><b>Menjadi</b></td>
						</tr>
						<tr>
							<td>Jabatan TMT</td>
							<td>:</td>
							<td>'.$row->nama_jabatan.', '.date('d F Y',strtotime($row->tmt_jabatan_baru_pangkat)).'</td>
						</tr>
						<tr>
							<td>Mata Kuliah</td>
							<td>:</td>
							<td>'.$row->mata_kuliah_pangkat.'</td>
						</tr>
						<tr>
							<td>Pangkat,golongan,ruang,TMT</td>
							<td>:</td>
							<td>'.$row->nama_pangkat.', '.date('d F Y',strtotime($row->tmt_pgrt_baru_pangkat)).'</td>
						</tr>
						
					</table>
				</div>

				<div style="margin-left:50px; margin-right:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">'.$row->salam_persetujuan_pangkat.'</p>
				</div>

				<div style="margin-left:50px; margin-right:50px; margin-top:0px; font-size:12px;">
					<table>
						<tr>
							<td>'.$row->persetujuan_pangkat.'</td>
						</tr>
					</table>
				</div>
				<div style="margin-left:50px; margin-right:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">'.$row->salam_pertimbangan_pangkat.'</p>
				</div>

				<div style="margin-left:50px; margin-right:50px; margin-top:0px; font-size:12px;">
					<table>
						<tr>
							<td>'.$row->pertimbangan_pangkat.'</td>
						</tr>
					</table>
				</div>

				<div style="margin-left:50px; margin-right:50px; margin-top:0px; font-size:12px;">
					<p>'.$row->penutup_pangkat.'</p>
				</div>


				<div style="float:right; margin-left:400px; margin-top:0px; font-size:12px;">
					<p >'.$row->nm_jabatan2.'</p>
					<br>
					<br>
					<p>'.$row->nama.'</p>
					<p style="margin-top:-10px;">NIP. '.$row->nip.' </p>
				</div>
				<div style="margin-left:50px; margin-top:-10px; font-size:12px;">
					<p>Tembusan :</p>
					<p style="margin-top:-10px;">'.$row->tembusan_pangkat.'</p>
				</div>

				';
$content 		.= '</page>';


	$content 	.= '<page style="font-size: 16px; " orientation="portrait" format="A4" >
						<div style="width:20%; margin-left:40px;">
							<img src="assets/images/logo2.gif" style="margin-left:20px; height:100px; width:100px;">
						</div>
						<div style="width:80%; margin-left:135px;">
							<p align="center" style="margin-top:-80px; font-size: 14px;">KEMENTRIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI</p>
							<p align="center" style="margin-top:-10px; font-size: 14px;"><b>POLITEKNIK NEGERI SEMARANG</b></p>
							<p align="center" style="margin-top:-10px; font-size: 12px;">Jalan Prof. H. Soedarto, S.H. Tembalang, Semarang 50275, PO BOX 6199/SMS</p>
							<p align="center" style="margin-top:-10px; font-size: 12px;">Telephone (024) 7473417, 7499586, Facsimile (024) 7472396</p>
							<p align="center" style="margin-top:-10px; font-size: 12px;">http:/www.polines.ae.id, E-mail : sekretariat@polines.ae.id.</p>
						</div>
						';
	$content	.= 
				'
				<hr>
				<div style="margin-left:50px; margin-top:0px; font-size:12px;">
					<table>
						<tr>
							<td>Nomor</td>
							<td>:</td>
							<td>'.$row->nomor_pangkat.'</td>
						</tr>
						<tr>
							<td>Lampiran</td>
							<td>:</td>
							<td>1 (satu) bandel</td>
						</tr>
						<tr>
							<td>Hal</td>
							<td>:</td>
							<td>'.$row->hal_pangkat.' <br> a.n Sdr. '.$row->nm_pegawai.'</td>
						</tr>
					</table>
				</div>
				<div style="margin-left:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">'.$row->tujuan_pangkat.'</p>
				</div>
				<div style="margin-left:50px; margin-right:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">'.$row->pembukaan_pangkat.'</p>
				</div>

				<div style="margin-left:50px; margin-top:20px; font-size:12px;">
					<table>
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td>'.$row->nm_pegawai.'</td>
						</tr>
						<tr>
							<td>NIP</td>
							<td>:</td>
							<td>'.$row->nip_baru.'</td>
						</tr>
						<tr>
							<td>NIDN</td>
							<td>:</td>
							<td>'.$row->nidn_pangkat.'</td>
						</tr>
						<tr>
							<td>Tempat, Tanggal Lahir</td>
							<td>:</td>
							<td>'.$row->tempat_lahir.', '.date('d F Y',strtotime($row->tanggal_lahir)).'</td>
						</tr>
						<tr>
							<td>Pangkat,golongan,ruang,TMT</td>
							<td>:</td>
							<td>'.$row->nm_pangkat.','.$row->gol_pangkat.','.$row->ruang_pangkat.' '.date('d F Y',strtotime($row->tmt_pgrt_lama_pangkat)).'</td>
						</tr>
						<tr>
							<td>Dalam Mata Kuliah</td>
							<td>:</td>
							<td>'.$row->mata_kuliah_pangkat.'</td>
						</tr>
						<tr>
							<td>Unit Kerja</td>
							<td>:</td>
							<td>'.$row->unit_kerja_pangkat.'</td>
						</tr>
						
					</table>
				</div>

				<div style="margin-left:50px; margin-right:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">'.$row->salam_pertimbangan_pangkat.'</p>
				</div>

				<div style="margin-left:50px; margin-right:50px; margin-top:0px; font-size:12px;">
					<table>
						<tr>
							<td>'.$row->pertimbangan_pangkat.'</td>
						</tr>
					</table>
				</div>

				<div style="margin-left:50px; margin-right:50px; margin-top:0px; font-size:12px;">
					<p>'.$row->penutup_pangkat.'</p>
				</div>


				<div style="float:right; margin-left:400px; margin-top:0px; font-size:12px;">
					<p >'.$row->nm_jabatan2.'</p>
					<br>
					<br>
					<p>'.$row->nama.'</p>
					<p style="margin-top:-10px;">NIP. '.$row->nip.' </p>
				</div>
				<div style="margin-left:50px; margin-top:10px; font-size:12px;">
					<p>Tembusan :</p>
					<p style="margin-top:-10px;">'.$row->tembusan_pangkat.'</p>
				</div>

				';
$content 		.= '</page>';

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
							<td>9625/PL4.7.1/KP/2017</td>
						</tr>
						<tr>
							<td>Hal</td>
							<td>:</td>
							<td>Kenaikan Gaji Berkala</td>
						</tr>
						<tr>
							<td>Catatan</td>
							<td>:</td>
							<td>KGB yang akan datang <br> Pada tanggal 01-01-2019</td>
						</tr>
					</table>
				</div>
				<div style="margin-left:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">Yth. Kepala Kantor Pelayanan</p>
					<p style="margin-top:-8px;">Perbendaharaan Negara</p>
					<p style="margin-top:-8px;">Semarang</p>
				</div>
				<div style="margin-left:50px; margin-right:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">Dengan ini diberitahukan. Bahwa berhubung dengan telah dipenuhinya masa kerja dan syarat-syarat lain kepada :</p>
				</div>

				<div style="margin-left:50px; margin-top:20px; font-size:12px;">
					<table>
						<tr>
							<td>1.</td>
							<td>Nama</td>
							<td>:</td>
							<td><b>DIANITA RATNA KUSUMASTUTI, S.T,M.T</b></td>
						</tr>
						<tr>
							<td>2.</td>
							<td>NIP</td>
							<td>:</td>
							<td>197009041995012001</td>
						</tr>
						<tr>
							<td>3.</td>
							<td>Pangkat/Jabatan</td>
							<td>:</td>
							<td>Pembina d.t Lektor Kepala dmk. Manajemen Konstruksi</td>
						</tr>
						<tr>
							<td>4.</td>
							<td>Kantor/Tempat</td>
							<td>:</td>
							<td>Politeknik Negeri Semarang</td>
						</tr>
						<tr>
							<td>5.</td>
							<td>Gaji Pokok</td>
							<td>:</td>
							<td>Rp. 3.832.800,- <br> (tiga juta delapan ratus tiga puluh dua ribu delapan ratus rupiah)</td>
						</tr>
						
					</table>
				</div>

				<div style="margin-left:50px; margin-right:50px; margin-top:20px; font-size:12px;">
					<p style="margin-top:-8px;">Atas dasar SKP terakhir tentang gaji/pangkatnya ditetapkan :</p>
				</div>

				<div style="margin-left:50px; margin-top:20px; font-size:12px;">
					<table>
						<tr>
							<td>a.</td>
							<td>Oleh Pejabat </td>
							<td>:</td>
							<td>Menristekdikti R.I.</td>
						</tr>
						<tr>
							<td>b.</td>
							<td>Tanggal.Nomor</td>
							<td>:</td>
							<td>14-10-2016</td>
							<td>Nomor : 79218/A2.3/KP/2016</td>
						</tr>
						<tr>
							<td>c.</td>
							<td>Tanggal Mulai Berlakunya <br> Gaji Tersebut</td>
							<td>:</td>
							<td>01-10-2016</td>
						</tr>
						<tr>
							<td>d.</td>
							<td>Masa Kerja Golongan <br> Pada Masa Tanggal tsb</td>
							<td>:</td>
							<td>19 Tahun 9 Bulan </td>
						</tr>						
					</table>
				</div>


				<div style="margin-left:50px; margin-right:50px; margin-top:0px; font-size:12px;">
					<p>diberikan kenaikan gaji berkala hingga memperoleh :</p>
				</div>

				<div style="margin-left:50px; margin-top:20px; font-size:12px;">
					<table>
						<tr>
							<td>6.</td>
							<td>a. Gaji Pokok Baru</td>
							<td>:</td>
							<td>Rp. 3.953.600,- <br> (tiga juta sembilanratus lima puluh tiga ribu enam ratus rupiah)</td>
						</tr>
						<tr>
							<td></td>
							<td>b. Tunjangan Jabatan</td>
							<td>:</td>
							<td>Rp. 900.000,- <br> (sembilan ratus ribu rupiah)</td>
						</tr>
						<tr>
							<td>7.</td>
							<td>Berdasarkan Masa Kerja</td>
							<td>:</td>
							<td>20 Tahun 0 Bulan</td>
						</tr>
						<tr>
							<td>8.</td>
							<td>Dalam Golongan</td>
							<td>:</td>
							<td>IV/a</td>
						</tr>
						<tr>
							<td>9.</td>
							<td>Mulai Tanggal</td>
							<td>:</td>
							<td>01-01-2017</td>
						</tr>
					</table>
				</div>

				<div style="margin-left:50px; margin-right:50px; margin-top:0px; font-size:12px;">
					<p>Diharap agar sesuai dengan PP 30 tahun 2015 dan pelaksanaan APBN tahun 2015 kepada pegawai tersebut dapat dibayarkan penghasilan berdasarkan gaji pokoknya.</p>
				</div>

				<div style="float:right; margin-left:400px; margin-top:0px; font-size:12px;">
					<p  >a.n. Direktur</p>
					<p style="margin-top:-10px;">Wakil Direktur Bidang Umum dan Keuangan</p>
					<br>
					<br>
					<p><b>M. NOOR ARDIANSAH, SE.M.Si.Akt.</b></p>
					<p style="margin-top:-10px;">NIP. 197609152000031001</p>
				</div>
				<div style="margin-left:50px; margin-top:10px; font-size:12px;">
					<p><b>SALINAN :</b></p>
					<p style="margin-top:-10px;">1. Kepada BKN Biro TUK Jakarta.</p>
					<p style="margin-top:-10px;">2. Sekjen KEMENRISTEK di Jakarta (u.p. KAROPEG).</p>
					<p style="margin-top:-10px;">3. Kepala Kantor Cabang PT. TASPEN Semarang.</p>
					<p style="margin-top:-10px;">4. Bendaharawan Politeknik Negeri Semarang.</p>
					<p style="margin-top:-10px;">5. Pegawai yang bersangkutan.</p>
				</div>

				';
$content 		.= '</page>';


require_once(__DIR__ .'/../../../../assets/html2pdf/html2pdf.class.php');
$html2pdf 	= new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('naik_pangkat.pdf');
} ?>