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
	.tabel th {padding:8px 5px;}
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
				<div style="border:1px; width: 150px; height: auto; margin-left: 570px;	margin-top:-10px;">
 					<img src="assets/foto/'.$foto.'" style="width: 150px; height: auto;">
				</div>
				<br>
				<div style="margin-left:50px; font-size:12px; margin-top:0px;">
					<p  style="margin-top:-10px; font-size: 14px;">I. KETERANGAN PERORANGAN</p>
				</div>
				<table style="margin-left:50px; margin-top:0px; font-size:12px; width:100%;" border="1px" class="tabel rata">
					<tr>
						<td style="width: 5%>1.</td>
						<td colspan="2" style="width: 35%">Nama Lengkap</td>
						<td style="width: 50%">'.$riwayat->gelar_depan . ' ' . $riwayat->nm_pegawai  . ' ' . $riwayat->gelar_belakang.'</td>
					</tr>
					<tr>
						<td>2.</td>
						<td colspan="2">N.I.P</td>
						<td>'. $riwayat->kd_pegawai .'</td>
					</tr>
					<tr>
						<td>3.</td>
						<td colspan="2">Pangkat dan Golongan Ruang</td>
						<td>'. $riwayat->nm_pangkat .', '. $riwayat->gol_pangkat .'</td>
					</tr>
					<tr>
						<td>4.</td>
						<td colspan="2">Tempat Lahir</td>
						<td>'. $riwayat->tempat_lahir .'</td>
					</tr>
					<tr>
						<td>5.</td>
						<td colspan="2">Tanggal Lahir</td>
						<td> '. date('d F Y',strtotime($riwayat->tanggal_lahir)) .'</td>
					</tr>
					<tr>
						<td>6.</td>
						<td colspan="2">Jenis Kelamin</td>
						<td>'. $riwayat->jenis_kelamin .'</td>
					</tr>
					<tr>
						<td>7.</td>
						<td colspan="2">Agama</td>
						<td>'. $riwayat->nm_agama .'</td>
					</tr>
					<tr>
						<td>8.</td>
						<td colspan="2">Status Perkawinan</td>
						<td>' . $riwayat->status_perkawinan . '</td>
					</tr>
					<tr>
						<td rowspan="5">9.</td>
						<td rowspan="5">Alamat Rumah</td>
						<td>a. Jalan / Desa</td>
						<td>'. $riwayat->alamat_jalan .'</td>
					</tr>
					<tr>
						<td>b. Kelurahan</td>
						<td>'. $riwayat->nama_kelurahan .'</td>
					</tr>
					<tr>
						<td>c. Kecamatan</td>
						<td>'. $riwayat->nama_kecamatan .'</td>
					</tr>
					<tr>
						<td>d. Kabupaten / Kota</td>
						<td>'. $riwayat->nama_kota .'</td>
					</tr>
					<tr>
						<td>e. Propinsi</td>
						<td>'. $riwayat->nama_propinsi .'</td>
					</tr>
					<tr>
						<td rowspan="7">10.</td>
						<td rowspan="7">Keterangan Badan</td>
						<td>a. Tinggi (cm)</td>
						<td>'. $riwayat->tinggi_badan .'</td>
					</tr>
					<tr>
						<td>b. Berat Badan (kg)</td>
						<td>'. $riwayat->berat_badan .'</td>
					</tr>
					<tr>
						<td>c. Rambut</td>
						<td>'. $riwayat->rambut .'</td>
					</tr>
					<tr>
						<td>d. Bentuk Muka</td>
						<td>'. $riwayat->bentuk_muka .'</td>
					</tr>
					<tr>
						<td>e. Warna Kulit</td>
						<td>'. $riwayat->warna_kulit .'</td>
					</tr>
					<tr>
						<td>f. Ciri Khas</td>
						<td>'. $riwayat->ciri_khas .'</td>
					</tr>
					<tr>
						<td>g. Cacat Tubuh</td>
						<td>'. $riwayat->cacat_tubuh .'</td>
					</tr>
					<tr>
						<td>11.</td>
						<td colspan="2">Kegemaran (Hobby)</td>
						<td>'. $riwayat->hobi_pegawai .'</td>
					</tr>
				</table>';
$content 		.= '</page>';

	$content 	.= '<page style="font-size: 12px" orientation="portrait" format="A4" >
						';
	$content	.= 
				'
				<div style="margin-left:50px; font-size:12px; margin-top:30px;">
					<p  style="margin-top:-10px; font-size: 14px;">II. PENDIDIKAN</p>
				</div>
				<div style="margin-left:50px; font-size:12px; margin-top:0px;">
					<p  style="margin-top:0px; font-size: 12px;">1. PENDIDIKAN DI DALAM DAN DI LUAR NEGERI</p>
				</div>';
	$content	.= 
				'<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
						<col style="width: 9%">
						<col style="width: 25%">
						<col style="width: 15%">
						<col style="width: 13%">
						<col style="width: 10%">
						<col style="width: 18%">
						<tr>
							<th align="center" >TINGKAT</th>
							<th align="center" >NAMA PENDIDIKAN</th>
							<th align="center" >JURUSAN</th>
							<th align="center" >STTB/TANDA LULUS/TAHUN  IJAZAH</th>
							<th align="center" >TEMPAT</th>
							<th align="center" >NAMA KEPALA SEKOLAH  DIREKTUR / DEKAN / PROMOTOR</th>
						</tr>
						<tr>
							<th align="center" style="font-size:7px;">1</th>
							<th align="center" style="font-size:7px;">2</th>
							<th align="center" style="font-size:7px;">3</th>
							<th align="center" style="font-size:7px;">4</th>
							<th align="center" style="font-size:7px;">5</th>
							<th align="center" style="font-size:7px;">6</th>
						</tr>';
		foreach ($pendidikan as $pendidikan) {
		$content	.= 
					'<tr>
							<td>'. $pendidikan->alias_polines .'</td>
							<td>'. $pendidikan->nama_pendidikan .'</td>
							<td>'. $pendidikan->jurusan_pendidikan .'</td>
							<td>'. $pendidikan->akhir_pendidikan .'</td>
							<td>'. $pendidikan->tempat_pendidikan .'</td>
							<td>'. $pendidikan->kepala_pendidikan .'</td>
						</tr>';
		}
	$content	.= '</table>';

		$content	.= 
			'<div style="margin-left:50px; font-size:12px; margin-top:10px;">
					<p  style="margin-top:0px; font-size: 12px;">2. KURSUS/LATIHAN DI DALAM DAN DI LUAR NEGERI</p>
				</div>';
	$content	.= 
				'<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 20%">
					<col style="width: 20%">
					<col style="width: 9%">
					<col style="width: 13%">
					<col style="width: 13%">
					<tr>
						<th align="center" style="width:150px;" >NAMA / KURSUS / LATIHAN</th>
						<th align="center" style="width:150px;">LAMANYA TGL / BLN / TH S/D TGL / BLN / TH</th>
						<th align="center" style="width:115px;">IJAZAH / TANDALULUS / SURATKET(TH)</th>
						<th align="center" >TEMPAT</th>
						<th align="center" >KETERANGAN</th>
						
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						<th align="center" style="font-size:7px;">5</th>
						
					</tr>';
		
		foreach ($kunjungan as $kunjungan) {
		$content	.= 
					'<tr>
						<td>'. $kunjungan->tujuan_kunjungan .'</td>
						<td>'. $kunjungan->awal_kunjungan .' s/d '. $kunjungan->akhir_kunjungan .'</td>
						<td>'. $kunjungan->akhir_kunjungan .'</td>
						<td>'. $kunjungan->negara .'</td>
						<td>'. $kunjungan->pembiayaan_kunjungan .'</td>
					</tr>';
		}
	$content	.= 
				'</table>';
				
	$content	.= 
				'
				<div style="margin-left:50px; font-size:12px; margin-top:30px;">
					<p  style="margin-top:-10px; font-size: 14px;">III. RIWAYAT PEKERJAAN</p>
				</div>
				<div style="margin-left:50px; font-size:12px; margin-top:0px;">
					<p  style="margin-top:0px; font-size: 12px;">1. RIWAYAT KEPANGKATAN GOLONGAN RUANG PENGGAJIAN</p>
				</div>';
	$content	.= 
				'<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 15%">
					<col style="width: 12%">
					<col style="width: 10%">
					<col style="width: 9%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 14%">
					<tr>
						<th align="center" rowspan="2">PANGKAT</th>
						<th align="center" rowspan="2">GOL RUANG PENGGAJIAN</th>
						<th align="center" rowspan="2">BERLAKU TMT</th>
						<th align="center" rowspan="2">GAJI POKOK</th>
						<th align="center" colspan="3">SURAT KEPUTUSAN</th>
						<th align="center" rowspan="2">PERATURAN YANG DIJADIKAN DASAR</th>
					</tr>
					<tr>
						<th align="center" style="font-size:12px;">PENJABAT</th>
						<th align="center" style="font-size:12px;">NOMOR</th>
						<th align="center" style="font-size:12px;">TGL</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						<th align="center" style="font-size:7px;">5</th>
						<th align="center" style="font-size:7px;">6</th>
						<th align="center" style="font-size:7px;">7</th>
						<th align="center" style="font-size:7px;">8</th>
						
					</tr>';
	foreach ($pangkat as $pangkat) {
	$content	.= 
					'<tr>
						<td>'. $pangkat->nm_pangkat .'</td>
						<td>'. $pangkat->gol_pangkat .'</td>
						<td>'. $pangkat->tmt_pangkat .'</td>
						<td>'. $pangkat->gaji_pangkat .'</td>
						<td>'. $pangkat->sk_pejabat .'</td>
						<td>'. $pangkat->sk_nomor .'</td>
						<td>'. $pangkat->sk_tanggal .'</td>
						<td>'. $pangkat->dasar_pangkat .'</td>
					</tr>';
	}					
	$content	.= 
				'</table>';
	$content	.= 
				'<div style="margin-left:50px; font-size:12px; margin-top:10px;">
					<p  style="margin-top:0px; font-size: 12px;">2. PENGALAMAN JABATAN/PEKERJAAN</p>
				</div>';
	$content	.= 
				'<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 25%">
					<col style="width: 12%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 11%">
					<col style="width: 11%">
					<col style="width: 11%">
					<tr>
						<th align="center" rowspan="2">JABATAN / PEKERJAAN</th>
						<th align="center" rowspan="2">MULAI  DAN SAMPAI</th>
						<th align="center" rowspan="2">GOL RUANG GAJI</th>
						<th align="center" rowspan="2">GAJI POKOK</th>
						<th align="center" colspan="3">SURAT KEPUTUSAN</th>
						</tr>
					<tr>
						<th align="center" style="font-size:12px;">PENJABAT</th>
						<th align="center" style="font-size:12px;">NOMOR</th>
						<th align="center" style="font-size:12px;">TGL</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						<th align="center" style="font-size:7px;">5</th>
						<th align="center" style="font-size:7px;">6</th>
						<th align="center" style="font-size:7px;">7</th>
											
					</tr>';

	foreach ($jabatan as $jabatan) {
	$content	.= 
					'<tr>
						<td>'. $jabatan->nm_jabatan .'</td>
						<td>'. date('Y',strtotime($jabatan->tmt_jabatan)) .' - '. date('Y',strtotime($jabatan->tmt_pelantikan)) .'</td>
						<td>'. $jabatan->gaji_jabatan .'</td>
						<td>'. $jabatan->gaji_jabatan .'</td>
						<td>'. $jabatan->sk_pejabat .'</td>
						<td>'. $jabatan->sk_nomor .'</td>
						<td>'. $jabatan->sk_tanggal .'</td>
					</tr>';
	}					
	$content	.= 
				'</table>';

	$content	.= 
				'
				<div style="margin-left:50px; font-size:12px; margin-top:30px;">
					<p  style="margin-top:-10px; font-size: 14px;">IV.TANDA JASA /PENGHARGAAN</p>
				</div>';
				
	$content	.= 
				'<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 38%">
					<col style="width: 17%">
					<col style="width: 35%">
					<tr>
						<th align="center" ">NAMA BINTANG SATYALENCANA PENGHARGAAN</th>
						<th align="center" ">TAHUN PEROLEHAN</th>
						<th align="center" ">NAMA NEGARA / INSTANSI YANG MEMBERI</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						
						
					</tr>';

	foreach ($penghargaan as $penghargaan) {				
	$content	.= 
					'<tr>
						<td>'. $penghargaan->nama_penghargaan .'</td>
						<td>'. $penghargaan->tahun_penghargaan .'</td>
						<td>'. $penghargaan->pemberi_penghargaan .'</td>
						
					</tr>';
	}
	$content	.= 
				'</table>';

	$content	.= 
				'<div style="margin-left:50px; font-size:12px; margin-top:30px;">
					<p  style="margin-top:-10px; font-size: 14px;">IV.PENGALAMAN KE LUAR NEGRI</p>
				</div>';
				
	$content	.= 
				'<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 15%">
					<col style="width: 15%">
					<col style="width: 20%">
					<col style="width: 16%">
					<tr>
						<th align="center" style="width:200px;">NEGARA</th>
						<th align="center" style="width:165px;">TUJUAN KUNJUNGAN</th>
						<th align="center" >LAMANYA</th>
						<th align="center" >YANG MEMBIAYAI</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						
					</tr>';
	foreach ($luar_negeri as $luar_negeri) {				
					
	$content	.= 
					'<tr>
						<td>'. $luar_negeri->negara .'</td>
						<td>'. $luar_negeri->tujuan_kunjungan .'</td>
						<td>'. $luar_negeri->awal_kunjungan .' - '. $luar_negeri->akhir_kunjungan .'</td>
						<td>'. $luar_negeri->pembiayaan_kunjungan .'</td>
					</tr>';
	}
	$content	.= 
				'</table>';

	$content	.= 
				'<div style="margin-left:50px; font-size:12px; margin-top:30px;">
					<p  style="margin-top:-10px; font-size: 14px;">VI.KETERANGAN KELUARGA</p>
				</div>
				<div style="margin-left:50px; font-size:12px; margin-top:0px;">
					<p  style="margin-top:0px; font-size: 12px;">1. ISTRI/SUAMI</p>
				</div>
				
				<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 20%">
					<col style="width: 15%">
					<col style="width: 11%">
					<col style="width: 11%">
					<col style="width: 18%">
					<col style="width: 15.5%">
					<tr>
						<th align="center" >NAMA </th>
						<th align="center" >TEMPAT  LAHIR</th>
						<th align="center" >TANGGAL  LAHIR</th>
						<th align="center" >TANGGAL MENIKAH</th>
						<th align="center" >PEKERJAAN</th>
						<th align="center" >KETERANGAN</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						<th align="center" style="font-size:7px;">5</th>
						<th align="center" style="font-size:7px;">6</th>
						
						
					</tr>';

	foreach ($pasangan as $pasangan) {				
	$content	.= 
					'<tr>
						<td>'. $pasangan->nama_keluarga .'</td>
						<td>'. $pasangan->tempat_lahir .'</td>
						<td>'. $pasangan->tanggal_lahir .'</td>
						<td>'. $pasangan->tanggal_nikah .'</td>
						<td>'. $pasangan->pekerjaan_keluarga .'</td>
						<td>'. $pasangan->keterangan_keluarga .'</td>
						
					</tr>';
	}					
	$content	.= 
	
				'</table>

				';
	$content	.= 
				'
				<div style="margin-left:50px; font-size:12px; margin-top:10px;">
					<p  style="margin-top:0px; font-size: 12px;">2.ANAK</p>
				</div>
				
				<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 20%">
					<col style="width: 15%">
					<col style="width: 11%">
					<col style="width: 11%">
					<col style="width: 18%">
					<col style="width: 15.5%">
					<tr>
						<th align="center" >NAMA</th>
						<th align="center" >JENIS KELAMIN</th>
						<th align="center" >TEMPAT  LAHIR</th>
						<th align="center" >TANGGAL  LAHIR</th>
						<th align="center" >SEKOLAH/<br>PEKERJAAN</th>
						<th align="center" >KETERANGAN</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						<th align="center" style="font-size:7px;">5</th>
						<th align="center" style="font-size:7px;">6</th>
						
						
					</tr>';

	foreach ($anak as $anak) {				
	$content	.= 
					'<tr>
						<td>'. $anak->nama_keluarga .'</td>
						<td>'. $anak->jenis_kelamin .'</td>
						<td>'. $anak->tempat_lahir .'</td>
						<td>'. $anak->tanggal_lahir .'</td>
						<td>'. $anak->pekerjaan_keluarga .'</td>
						<td>'. $anak->keterangan_keluarga .'</td>
						
					</tr>';
	}					
	$content	.= 
	
				'</table>
				<div style="margin-left:50px; font-size:12px; margin-top:10px;">
					3.BAPAK DAN IBU KANDUNG
				</div>
				
				<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 24.5%">
					<col style="width: 22%">
					<col style="width: 22%">
					<col style="width: 22%">
					<tr>
						<th align="center" >NAMA</th>
						<th align="center" >TANGGAL LAHIR / UMUR</th>
						<th align="center" >PEKERJAAN</th>
						<th align="center" >KETERANGAN</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						
						
					</tr>';

	foreach ($orang_tua as $orang_tua) {				
	$content	.= 
					'<tr>
						<td>'. $orang_tua->nama_keluarga .'</td>
						<td>'. $orang_tua->tanggal_lahir .'</td>
						<td>'. $orang_tua->pekerjaan_keluarga .'</td>
						<td>'. $orang_tua->keterangan_keluarga .'</td>
						
					</tr>';
	}					
	$content	.= 
	
				'</table>
				<div style="margin-left:50px; font-size:12px; margin-top:10px;">
					<p  style="margin-top:10px; font-size: 12px;">4.BAPAK DAN IBU MERTUA</p>
				</div>
				
				<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 24.5%">
					<col style="width: 22%">
					<col style="width: 22%">
					<col style="width: 22%">
					<tr>
						<th align="center" >NAMA</th>
						<th align="center" >TANGGAL LAHIR / UMUR</th>
						<th align="center" >PEKERJAAN</th>
						<th align="center" >KETERANGAN</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						
						
					</tr>';

	foreach ($mertua as $mertua) {				
	$content	.= 
					'<tr>
						<td>'. $mertua->nama_keluarga .'</td>
						<td>'. $mertua->tanggal_lahir .'</td>
						<td>'. $mertua->pekerjaan_keluarga .'</td>
						<td>'. $mertua->keterangan_keluarga .'</td>
						
					</tr>';
	}					
	$content	.= 
	
				'</table>
					<div style="margin-left:50px; font-size:12px; margin-top:10px;">
					<p  style="margin-top:10px; font-size: 12px;">5.SAUDARA KANDUNG</p>
				</div>
				
				<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 24.5%">
					<col style="width: 16%">
					<col style="width: 16%">
					<col style="width: 17%">
					<col style="width: 17%">
					<tr>
						<th align="center" >NAMA</th>
						<th align="center" >JENIS KELAMIN</th>
						<th align="center" >TANGGA LAHIR / UMUR</th>
						<th align="center" >PEKERJAAN</th>
						<th align="center" >KETERANGAN</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						<th align="center" style="font-size:7px;">5</th>
						
						
					</tr>';

	foreach ($saudara as $saudara) {				
	$content	.= 
					'<tr>
						<td>'. $saudara->nama_keluarga .'</td>
						<td>'. $saudara->jenis_kelamin .'</td>
						<td>'. $saudara->tanggal_lahir .'</td>
						<td>'. $saudara->pekerjaan_keluarga .'</td>
						<td>'. $saudara->keterangan_keluarga .'</td>
						
					</tr>';
	}					
	$content	.= 
	
				'</table>
			


				';
	$content	.= 
				'
				<div style="margin-left:50px; font-size:12px; margin-top:30px;">
					<p  style="margin-top:-10px; font-size: 14px;">VI. KETERANGAN ORGANISASI</p>
				</div>
				<div style="margin-left:50px; font-size:12px; margin-top:0px;">
					<p  style="margin-top:0px; font-size: 12px;">1.SEMASA MENGIKUTI PENDIDIKAN PADA SLTA KE BAWAH</p>
				</div>';
				
				
	$content	.= 
				'<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 24.5%">
					<col style="width: 16%">
					<col style="width: 16%">
					<col style="width: 17%">
					<col style="width: 17%">
					<tr>
						<th align="center" >NAMA ORGANISASI</th>
						<th align="center" >KEDUDUKAN DALAM ORGANISASI</th>
						<th align="center" >DALAM TH S/D TH</th>
						<th align="center" >TEMPAT</th>
						<th align="center" >NAMA PEMIMPIN ORGANISASI</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						<th align="center" style="font-size:7px;">5</th>
						
						
					</tr>';

	foreach ($organisasi as $organisasi) {				
	$content	.= 
					'<tr>
						<td>'. $organisasi->nama_organisasi .'</td>
						<td>'. $organisasi->jabatan_organisasi .'</td>
						<td>'. $organisasi->awal_organisasi .' - '. $organisasi->akhir_organisasi .'</td>
						<td>'. $organisasi->tempat_organisasi .'</td>
						<td>'. $organisasi->ketua_organisasi .'</td>
						
					</tr>';
	}					
	$content	.= 
				'</table>';
			
	$content	.= 
				'<div style="margin-left:50px; font-size:12px; margin-top:10px;">
					<p  style="margin-top:0px; font-size: 12px;">2.SEMASA MENGIKUTI PENDIDIKAN PADA PERGURUAN TINGGI</p>
				</div>
				
				
				<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 24.5%">
					<col style="width: 16%">
					<col style="width: 16%">
					<col style="width: 17%">
					<col style="width: 17%">
					<tr>
						<th align="center" >NAMA ORGANISASI</th>
						<th align="center" >KEDUDUKAN DALAM ORGANISASI</th>
						<th align="center" >DALAM TH S/D TH</th>
						<th align="center" >TEMPAT</th>
						<th align="center" >NAMA PEMIMPIN ORGANISASI</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						<th align="center" style="font-size:7px;">5</th>
						
						
					</tr>';

	foreach ($organisasi as $organisasi) {				
	$content	.= 
					'<tr>
						<td>'. $organisasi->nama_organisasi .'</td>
						<td>'. $organisasi->jabatan_organisasi .'</td>
						<td>'. $organisasi->awal_organisasi .' - '. $organisasi->akhir_organisasi .'</td>
						<td>'. $organisasi->tempat_organisasi .'</td>
						<td>'. $organisasi->ketua_organisasi .'</td>
						
					</tr>';
	}					
	$content	.= 
					
				'</table>
					<div style="margin-left:50px; font-size:12px; margin-top:10px;">
					<p  style="margin-top:0px; font-size: 12px;">3. SESUDAH SELESAI PENDIDIKAN DAN ATAU SELAMA MENJADI PEGAWAI</p>
				</div>
				
				
				<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 24.5%">
					<col style="width: 16%">
					<col style="width: 16%">
					<col style="width: 17%">
					<col style="width: 17%">
					<tr>
						<th align="center" >NAMA ORGANISASI</th>
						<th align="center" >KEDUDUKAN DALAM ORGANISASI</th>
						<th align="center" >DALAM TH S/D TH</th>
						<th align="center" >TEMPAT</th>
						<th align="center" >NAMA PEMIMPIN ORGANISASI</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						<th align="center" style="font-size:7px;">5</th>
						
						
					</tr>';

	foreach ($organisasi as $organisasi) {				
	$content	.= 
					'<tr>
						<td>'. $organisasi->nama_organisasi .'</td>
						<td>'. $organisasi->jabatan_organisasi .'</td>
						<td>'. $organisasi->awal_organisasi .' - '. $organisasi->akhir_organisasi .'</td>
						<td>'. $organisasi->tempat_organisasi .'</td>
						<td>'. $organisasi->ketua_organisasi .'</td>
						
					</tr>';
	}					
	$content	.= 
	
				'</table>
			

			


				';
	$content	.= 
				'
				<div style="margin-left:50px; font-size:12px; margin-top:30px;">
					<p  style="margin-top:-10px; font-size: 14px;">VIII. KETERANGAN LAIN-LAIN</p>
				</div>
				<div style="margin-left:50px; font-size:12px; margin-top:0px;">
					<p  style="margin-top:0px; font-size: 12px;">1. RIWAYAT KEPANGKATAN GOLONGAN RUANG PENGGAJIAN</p>
				</div>
				<table style="margin-left:50px; margin-top:10px; font-size:12px;" border="1px" class="tabel">
					<col style="width: 5%">
					<col style="width: 40.5%">
					<col style="width: 15%">
					<col style="width: 15%">
					<col style="width: 15%">
					<tr>
						<th align="center" rowspan="2">NO.</th>
						<th align="center" rowspan="2">NAMA KETERANGAN</th>
						
						<th align="center" colspan="3" >SURAT KETERANGAN</th>
						</tr>
					<tr>
						<th align="center" >PENJABAT</th>
						<th align="center" >NOMOR</th>
						<th align="center" >TANGGAL</th>
					</tr>
					<tr>
						<th align="center" style="font-size:7px;">1</th>
						<th align="center" style="font-size:7px;">2</th>
						<th align="center" style="font-size:7px;">3</th>
						<th align="center" style="font-size:7px;">4</th>
						<th align="center" style="font-size:7px;">5</th>
						
					</tr>
					<tr>
						<td>1.</td>
						<td>KETERANGAN KELAKUAN BAIK</td>
						<td></td>
						<td></td>
						<td></td>
						
					</tr>
					<tr>
						<td>2.</td>
						<td>KETERANGAN BERBADAN SEHAT</td>
						<td></td>
						<td></td>
						<td></td>
						
					</tr>
					<tr >
						<td>3.</td>
						<td>KETERANGAN LAIN YANG DI ANGGAP PERLU</td>
						<td></td>
						<td></td>
						<td></td>
						
					</tr>
					
				</table>


				<div style="margin-left:50px; font-size:18px; margin-top:30px;">
					<p  style="margin-top:0px; font-size: 12px;">Demikianlah daftar riwayat hidup ini saya buat dengan sesungguhnya dan apabila di kemudian hari terdapat keterangan yang</p>
					<p  style="margin-top:-10px; font-size: 12px;"> tidak benar saya bersedia dituntut dimuka pengadilan serta bersedia menerima segala
						tindakan yang diambil oleh Pemerintah.</p>
				</div>

				<div style="margin-left:520px; font-size:18px; margin-top:30px;">
					<p  style="margin-top:0px; font-size: 12px;">....................., ..................................</p>
				</div>
				<div style="margin-left:520px; font-size:18px; margin-top:30px;">
					<p  style="margin-top:-10px; font-size: 12px;">Yang Membuat</p>
				</div>
				<br>
				<br>
				<div style="margin-left:520px; font-size:18px; margin-top:30px;">
					<p  style="margin-top:0px; font-size: 12px;">'.$riwayat->gelar_depan . ' ' . $riwayat->nm_pegawai  . ' ' . $riwayat->gelar_belakang.'</p>
				</div>

				<div style="margin-left:50px; font-size:18px; margin-top:30px;">
					<p  style="margin-top:0px; font-size: 12px;"><b><u>PERHATIAN :</u></b></p>
				</div>

				<table style="margin-left:70px; margin-top:10px;">
					<tr>
						<td>1.</td>
						<td>Harus ditulis dengan tangan sendiri dengan huruf cetak dan dengan tinta hitam.</td>
						
					</tr>
					<tr >
						<td>2.</td>
						<td>Jika ada yang salah harus dicoret, yang dicoret tersebut tetap dibaca kemudian yang benar ditulis diatas atau</td>
						
					</tr>
					<tr >
						<td></td>
						<td>dibawahnya dan diparaf.</td>
						
					</tr>
					<tr >
						<td>3.</td>
						<td>Kolom yang kosong diberi tanda.</td>
						
					</tr>
					
				</table>

				';
$content 		.= '</page>';




require_once(__DIR__ .'/../../../../assets/html2pdf/html2pdf.class.php');
$html2pdf 	= new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('daftar_riwayat_hidup.pdf');
} ?>

