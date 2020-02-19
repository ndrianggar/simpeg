<!DOCTYPE html>
<html>
<?php include(__DIR__ . "/../../tittle.php"); ?>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php include(__DIR__ . "/../sidebar.php"); ?>
			<?php include(__DIR__ . "/../top_nav.php"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>
									<a href="<?=base_url()?>">
										<i class="fa fa-home"></i>
									</a> \ 
									<a href="<?=base_url()?>pegawai">
										Data Pegawai
									</a> \ 
									<a href="#">
										Edit Data Pegawai
									</a>
								</h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<form name="form-tambah" id="form-tambah" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="<?=base_url()?>pegawai/edit_user">
									<?php foreach ($pegawai as $row0) { ?>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">NIP Pagawai *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="id_pegawai" name="id_pegawai" class="form-control" placeholder="Id Pegawai" type="hidden" value="<?=$row0->id_pegawai?>">
													<input id="nip_baru" name="nip_baru" class="form-control" placeholder="Kode Pegawai" required="required" value="<?=$row0->kd_pegawai?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">NIP Lama</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="nip_lama" name="nip_lama" class="form-control" placeholder="NIP Lama" value="<?=$row0->nip_lama?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Nama Pagawai *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="nama_pegawai" name="nama_pegawai" class="form-control" placeholder="Nama Pegawai" required="required" value="<?=$row0->nm_pegawai?>">
												</div>
											</div> 
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Gelar Depan</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="gelar_depan" name="gelar_depan" class="form-control" placeholder="Gelar Depan" value="<?=$row0->gelar_depan?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Gelar Belakang</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="gelar_belakang" name="gelar_belakang" class="form-control" placeholder="Gelar Belakang" value="<?=$row0->gelar_belakang?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tempat Lahir *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required="required" value="<?=$row0->tempat_lahir?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tanggal Lahir *</label>
												<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
													<input id="tanggal_lahir" name="tanggal_lahir" class="form-control has-feedback-right tanggal" placeholder="Tanggal Lahir (dd-mm-yyyy)" required="required" value="<?=date('d-m-Y',strtotime($row0->tanggal_lahir))?>">
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Jenis Kelamin *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<select id="jenis_kelamin" name="jenis_kelamin" class="form-control selectpicker" required="required" >
														<?php 
															if($row0->jenis_kelamin == 'Laki-laki'){
														?>			
																<option value="Laki-laki" selected>Laki-laki</option>
																<option value="Perempuan">Perempuan</option>
														<?php }
														elseif($row0->jenis_kelamin == 'Perempuan') { 
														?>
																<option value="Laki-laki">Laki-laki</option>
																<option value="Perempuan" selected>Perempuan</option>
														<?php }	 ?>

													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Agama *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<select id="agama" name="agama" class="form-control selectpicker" required="required" >
														<?php foreach ($agama as $row1) { 
															if (($row0->kd_agama)==($row1->kd_agama)) { ?>
																<option value="<?=$row1->kd_agama?>" selected><?=$row1->nm_agama?></option>
															<?php } else { ?>
																<option value="<?=$row1->kd_agama?>"><?=$row1->nm_agama?></option>
														<?php
															}
														} 
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Golongan Darah</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="golongan_darah" name="golongan_darah" class="form-control" placeholder="Golongan Darah" value="<?=$row0->golongan_darah?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Status Pernikahan *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<select id="status_pernikahan" name="status_pernikahan" class="form-control selectpicker" required="required" >
														<?php 
															if($row0->status_perkawinan == 'Belum Menikah'){
														?>			
															<option value="Belum Menikah" selected>Belum Menikah</option>
															<option value="Menikah">Menikah</option>
															<option value="Janda">Janda</option>
															<option value="Duda">Duda</option>
														<?php }
														elseif($row0->status_perkawinan == 'Menikah') { 
														?>
															<option value="Belum Menikah">Belum Menikah</option>
															<option value="Menikah" selected>Menikah</option>
															<option value="Janda">Janda</option>
															<option value="Duda">Duda</option>
														<?php }
														elseif($row0->status_perkawinan == 'Janda') { 
														?>
															<option value="Belum Menikah">Belum Menikah</option>
															<option value="Menikah">Menikah</option>
															<option value="Janda" selected>Janda</option>
															<option value="Duda">Duda</option>
														<?php }
														elseif($row0->status_perkawinan == 'Duda') { 
														?>
															<option value="Belum Menikah">Belum Menikah</option>
															<option value="Menikah">Menikah</option>
															<option value="Janda">Janda</option>
															<option value="Duda" selected>Duda</option>
														<?php }
														else { 
														?>
															<option value="Belum Menikah">Belum Menikah</option>
															<option value="Menikah">Menikah</option>
															<option value="Janda">Janda</option>
															<option value="Duda">Duda</option>
														<?php }	 ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Email *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="email" name="email" class="form-control" placeholder="Email" required="required" value="<?=$row0->email_pegawai?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">EKTP *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="ektp" name="ektp" class="form-control" placeholder="EKTP" required="required" value="<?=$row0->ektp_pegawai?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">NPWP</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="npwp" name="npwp" class="form-control" placeholder="NPWP" value="<?=$row0->npwp_pegawai?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Propinsi *</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<select id="propinsi" name="propinsi"  class="form-control selectpicker" data-live-search="true"  title="-- Pilih Propinsi --">
														<?php foreach ($propinsi as $propinsi) { 
															if (($row0->id_propinsi)==($propinsi->id_propinsi)) { ?>
																<option value="<?=$propinsi->id_propinsi?>" selected><?=$propinsi->nama_propinsi?></option>
															<?php } else { ?>
																<option value="<?=$propinsi->id_propinsi?>"><?=$propinsi->nama_propinsi?></option>
														<?php
															}
														} 
														?>

													</select>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12">
													<button type="button" id="btn-tambah-propinsi" class="btn btn-primary" >Add +</button>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Kota *</label>
												<div  id="kota2" class="col-md-6 col-sm-6 col-xs-12">
													<select id="kota" name="kota" class="form-control selectpicker" data-live-search="true"  title="-- Pilih Kota --">
														<option value="<?=$row0->id_kota?>" selected><?=$row0->nama_kota?></option>
													</select>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12">
													<button type="button" id="btn-tambah-kota" class="btn btn-primary" >Add +</button>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Kecamatan *</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<select id="kecamatan" name="kecamatan" class="form-control selectpicker" data-live-search="true"  title="-- Pilih Kecamatan --">
														<option value="<?=$row0->id_kecamatan?>" selected><?=$row0->nama_kecamatan?></option>
													</select>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12">
													<button type="button" id="btn-tambah-kecamatan" class="btn btn-primary" >Add +</button>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Kelurahan *</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<select id="kelurahan" name="kelurahan" class="form-control selectpicker" data-live-search="true"  title="-- Pilih Kelurahan --">
														<option value="<?=$row0->id_kelurahan?>" selected><?=$row0->nama_kelurahan?></option>
													</select>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12">
													<button type="button" id="btn-tambah-kelurahan" class="btn btn-primary" >Add +</button>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Jalan/Desa *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="jalan" name="jalan" class="form-control" rows="2" placeholder="Jalan/Desa" required="required"><?=$row0->alamat_jalan?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Handphone 1</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="no_hp1" name="no_hp1" class="form-control" placeholder="Handphone 1" value="<?=$row0->hp1_pegawai?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Handphone 2</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="no_hp2" name="no_hp2" class="form-control" placeholder="Handphone 2" value="<?=$row0->hp2_pegawai?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Telepon</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="telepon" name="telepon" class="form-control" placeholder="Telepon" value="<?=$row0->telepon_pegawai?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tinggi Badan (Cm)</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="tinggi" name="tinggi" class="form-control" type="number" style="text-align: right;" value="<?=$row0->tinggi_badan?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Berat Badan (Kg)</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="berat" name="berat" class="form-control" type="number" style="text-align: right;" value="<?=$row0->berat_badan?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Rambut</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="rambut" name="rambut" class="form-control" placeholder="Rambut" value="<?=$row0->rambut?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Bentuk Muka</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="muka" name="muka" class="form-control" placeholder="Bentuk Muka" value="<?=$row0->bentuk_muka?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Warna Kulit</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="kulit" name="kulit" class="form-control" placeholder="Warna Kulit" value="<?=$row0->warna_kulit?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Ciri Khas</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="ciri" name="ciri" class="form-control" rows="2" placeholder="Ciri Muka"><?=$row0->ciri_khas?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Cacat Tubuh</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="cacat" name="cacat" class="form-control" rows="2" placeholder="Cacat Tubuh"><?=$row0->cacat_tubuh?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Hobi</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="hobi" name="hobi" class="form-control" placeholder="Hobi" value="<?=$row0->hobi_pegawai?>">
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Status Pagawai *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<select id="status_pegawai"  name="status_pegawai" class="form-control  selectpicker" required="required" title="-- Pilih Status Pegawai --" >
														<?php foreach ($status as $status) { 
															if (($row0->id_status)==($status->id_status)) { ?>
																<option value="<?=$status->id_status?>" selected><?=$status->nama_status?></option>
															<?php } else { ?>
																<option value="<?=$status->id_status?>"><?=$status->nama_status?></option>
														<?php
															}
														} 
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Jenis Pagawai *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<select id="jenis_pegawai" name="jenis_pegawai" class="form-control selectpicker" required="required" title="-- Pilih Jenis Pegawai --">
														<?php foreach ($jenis as $row2) { 
															if (($row0->id_jenis)==($row2->id_jenis)) { ?>
																<option value="<?=$row2->id_jenis?>" selected><?=$row2->nm_jenis?></option>
															<?php } else { ?>
																<option value="<?=$row2->id_jenis?>"><?=$row2->nm_jenis?></option>
														<?php
															}
														} 
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">JurBagSatPusNit *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<select id="jurusan" name="jurusan" class="form-control selectpicker" data-live-search="true" required="required" title="-- Pilih JurBagSatPusNit --">
														<?php foreach ($jurusan as $row3) { 
															if (($row0->id_jurusan)==($row3->id_jurusan)) { ?>
																<option value="<?=$row3->id_jurusan?>" selected><?=$row3->nm_jurusan?></option>
															<?php } else { ?>
																<option value="<?=$row3->id_jurusan?>"><?=$row3->nm_jurusan?></option>
														<?php
															}
														} 
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">ProdiSubDiv *</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<select id="prodi" name="prodi" class="form-control selectpicker" data-live-search="true" title="-- Pilih ProdiSubDiv --">
														<option value="<?=$row0->id_prodi?>" selected><?=$row0->nm_prodi?></option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">TMT Polines *</label>
												<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
													<input id="tmt_polines" name="tmt_polines" class="form-control has-feedback-right tanggal" placeholder="TMT Polines (dd-mm-yyyy)" required="required" value="<?=date('d-m-Y',strtotime($row0->tmt_polines))?>">
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">TMT CPNS</label>
												<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
													<input id="tmt_cpns" name="tmt_cpns" class="form-control has-feedback-right tanggal" placeholder="Tanggal CPNS (dd-mm-yyyy)" value="<?=date('d-m-Y',strtotime($row0->tmt_cpns))?>">
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">TMT PNS</label>
												<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
													<input id="tmt_pns" name="tmt_pns" class="form-control has-feedback-right tanggal" placeholder="Tanggal PNS (dd-mm-yyyy)" value="<?=date('d-m-Y',strtotime($row0->tmt_pns))?>">
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">No. Karpeg</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="no_sk" name="no_sk" class="form-control" placeholder="No. Karpeg" value="<?=$row0->no_sk?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Nomor S. BAKN</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="no_sbakn" name="no_sbakn" class="form-control" placeholder="Nomor S. BAKN" value="<?=$row0->no_sbakn?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tanggal S. BAKN</label>
												<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
													<input id="tgl_sbakn" name="tgl_sbakn" class="form-control has-feedback-right tanggal" placeholder="Tanggal S. BAKN (dd-mm-yyyy)" value="<?=date('d-m-Y',strtotime($row0->tgl_sbakn))?>">
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="label-control col-md-4 col-sm-4 col-xs-12">File S. BAKN</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="file_sbakn" name="file_sbakn" class="form-control" type="File" accept="application/pdf">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Nomor SK. MPK</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="no_skmpk" name="no_skmpk" class="form-control" placeholder="Nomor SK. MPK" value="<?=$row0->no_skmpk?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tanggal SK. MPK</label>
												<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
													<input id="tgl_skmpk" name="tgl_skmpk" class="form-control has-feedback-right tanggal" placeholder="Tanggal SK. MPK (dd-mm-yyyy)" value="<?=date('d-m-Y',strtotime($row0->tgl_skmpk))?>">
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="label-control col-md-4 col-sm-4 col-xs-12">File SK. MPK</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="file_skmpk" name="file_skmpk" class="form-control" type="File" accept="application/pdf">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Nomor STTPL</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="no_sttpl" name="no_sttpl" class="form-control" placeholder="Nomor STTPL" value="<?=$row0->no_sttpl?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tanggal STTPL</label>
												<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
													<input id="tgl_sttpl" name="tgl_sttpl" class="form-control has-feedback-right tanggal" placeholder="Tanggal STTPL (dd-mm-yyyy)" value="<?=date('d-m-Y',strtotime($row0->tgl_sttpl))?>">
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="label-control col-md-4 col-sm-4 col-xs-12">File STTPL</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="file_sttpl" name="file_sttpl" class="form-control" type="File" accept="application/pdf">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Nomor SPMT</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="no_spmt" name="no_spmt" class="form-control" placeholder="Nomor SPMT" value="<?=$row0->no_spmt?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tanggal SPMT</label>
												<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
													<input id="tgl_spmt" name="tgl_spmt" class="form-control has-feedback-right tanggal" placeholder="Tanggal SPMT (dd-mm-yyyy)" value="<?=date('d-m-Y',strtotime($row0->tgl_spmt))?>">
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="label-control col-md-4 col-sm-4 col-xs-12">File SPMT</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="file_spmt" name="file_spmt" class="form-control" type="File" accept="application/pdf">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Nomor SPMJ</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="nomor_spmj" name="no_spmj" class="form-control" placeholder="Nomor SPMJ" value="<?=$row0->no_spmj?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tanggal SPMJ</label>
												<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
													<input id="tgl_spmj" name="tgl_spmj" class="form-control has-feedback-right tanggal" placeholder="Tanggal SPMJ (dd-mm-yyyy)" value="<?=date('d-m-Y',strtotime($row0->tgl_spmj))?>">
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="label-control col-md-4 col-sm-4 col-xs-12">File S. SPMJ</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="file_spmj" name="file_spmj" class="form-control" type="File" accept="application/pdf">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Foto Pegawai</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="foto" name="foto" type="file" class="form-control"  value="<?=$row0->foto_pegawai?>" accept="image/x-png,image/jpeg">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control"></label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<img id="PrevFoto" src="<?=base_url()?>assets/foto/<?=$row0->foto_pegawai?>" style="width: 300px;max-width: 300px;">
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="btn-group">
												<button type="reset" id="btn-batal" class="btn btn-warning">Batal</button>
												<button type="submit" id="btn-simpan" class="btn btn-success">Simpan</button>
											</div>
										</div>
									</div>
									<?php 
										}
									?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->
			
			<!-- Tampilan "model-tambah" -->
			<div class="modal fade" id="modal-tambah-propinsi">
				<form id="form-tambah-propinsi" method="POST" action="<?=base_url()?>alamat/tambah_propinsi/">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">×</button>
								<h4 class="modal-title">Tambah Data</h4>
							</div>
							<div class="modal-body">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Propinsi</label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input id="id" name="id" type="hidden">
											<input id="nama_propinsi" name="nama_propinsi" class="required form-control" placeholder="Nama Propinsi" type="text">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div class="btn-group">
									<button data-dismiss="modal" class="btn btn-warning" type="button">Batal</button>
									<button id="tambah-simpan-propinsi" class="btn btn-success" type="button">Simpan</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- Tampilan "model-tambah" -->

			<!-- Tampilan "model-tambah" -->
			<div class="modal fade" id="modal-tambah-kota">
				<form id="form-tambah-kota" method="POST" action="<?=base_url()?>alamat/tambah_kota/">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">×</button>
								<h4 class="modal-title">Tambah Data</h4>
							</div>
							<div class="modal-body">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Kota</label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input id="id" name="id" type="hidden">
											<input id="id_propinsi_kota" name="id_propinsi_kota" type="hidden" value="">
											<input id="nama_kota" name="nama_kota" class="required form-control" placeholder="Nama Kota" type="text">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div class="btn-group">
									<button data-dismiss="modal" class="btn btn-warning" type="button">Batal</button>
									<button id="tambah-simpan-kota" class="btn btn-success" type="button">Simpan</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- Tampilan "model-tambah" -->


			<!-- Tampilan "model-tambah" -->
			<div class="modal fade" id="modal-tambah-kecamatan">
				<form id="form-tambah-kecamatan" method="POST" action="<?=base_url()?>alamat/tambah_kecamatan/">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">×</button>
								<h4 class="modal-title">Tambah Data</h4>
							</div>
							<div class="modal-body">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Kecamatan</label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input id="id" name="id" type="hidden">
											<input id="id_kota_kecamatan" name="id_kota_kecamatan" type="hidden" value="">
											<input id="id_propinsi_kecamatan" name="id_propinsi_kecamatan" type="hidden" value="">
											<input id="nama_kecamatan" name="nama_kecamatan" class="required form-control" placeholder="Nama Kecamatan" type="text">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div class="btn-group">
									<button data-dismiss="modal" class="btn btn-warning" type="button">Batal</button>
									<button id="tambah-simpan-kecamatan" class="btn btn-success" type="button">Simpan</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- Tampilan "model-tambah" -->

			<!-- Tampilan "model-tambah" -->
			<div class="modal fade" id="modal-tambah-kelurahan">
				<form id="form-tambah-kelurahan" method="POST" action="<?=base_url()?>alamat/tambah_kecamatan/">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">×</button>
								<h4 class="modal-title">Tambah Data</h4>
							</div>
							<div class="modal-body">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Kelurahan</label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input id="id" name="id" type="hidden">
											<input id="id_kecamatan_kelurahan" name="id_kecamatan_kelurahan" type="hidden" value="">
											<input id="id_kota_kelurahan" name="id_kota_kelurahan" type="hidden" value="">
											<input id="id_propinsi_kelurahan" name="id_propinsi_kelurahan" type="hidden" value="">
											<input id="nama_kelurahan" name="nama_kelurahan" class="required form-control" placeholder="Nama Kelurahan" type="text">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div class="btn-group">
									<button data-dismiss="modal" class="btn btn-warning" type="button">Batal</button>
									<button id="tambah-simpan-kelurahan" class="btn btn-success" type="button">Simpan</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- Tampilan "model-tambah" -->

			<!-- footer content -->
			<footer>
				<div class="pull-right">
				Sistem Informasi Kepegawaian Politeknik Negeri Semarang
				</div>
				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->
		</div>
	</div>
	<?php include(__DIR__ . "/../../load_js.php"); ?>
	<script>
		$(document).ready(function(){
			$('.tanggal').datepicker({
				format : "dd-mm-yyyy",
				autoclose : true
			});

			$('#file_sbakn').bind('change', function() {
				var file_size = this.files[0].size;
				if (file_size>1000000){
					swal ('Size terlalu besar');
					$('#file_sbakn').val('');
				}
			});

			$('#file_skmpk').bind('change', function() {
				var file_size = this.files[0].size;
				if (file_size>1000000){
					swal ('Size terlalu besar');
					$('#file_skmpk').val('');
				}
			});

			$('#file_sttpl').bind('change', function() {
				var file_size = this.files[0].size;
				if (file_size>1000000){
					swal ('Size terlalu besar');
					$('#file_sttpl').val('');
				}
			});

			$('#file_spmt').bind('change', function() {
				var file_size = this.files[0].size;
				if (file_size>1000000){
					swal ('Size terlalu besar');
					$('#file_spmt').val('');
				}
			});

			$('#file_spmj').bind('change', function() {
				var file_size = this.files[0].size;
				if (file_size>1000000){
					swal ('Size terlalu besar');
					$('#file_spmj').val('');
				}
			});

			$('#foto').bind('change', function() {
				var file_size = this.files[0].size;
				if (file_size>2000000){
					swal ('Size terlalu besar');
					$('#foto').val('');
				} else {
					readURL(this);
				}
			});

			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
					$('#PrevFoto').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
				}
			};

			$('#btn-batal').on('click', function(){
				var url = "<?=base_url()?>pegawai/";
				window.location.href = url;
			});

			$('#btn-simpan').on('click', function(){
				$('#btn-simpan').attr('disabled','disabled');
			});

			$('#propinsi').on('change', function() {
				var kode 	= $('#propinsi').val();
				$('#id_propinsi').val(kode);
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>'+'alamat/data_kota/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#kota')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('#kota').selectpicker('destroy').selectpicker();
						}else{
							swal("ERROR", "Load data.", "error");
						}
					},
					error: function(){
						swal("ERROR", "Load data.", "error");
					}
				});
			});

			$('#kota').on('change', function() {
				var kode 	= $('#kota').val();
				$('#id_kota').val(kode);
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>'+'alamat/data_kecamatan/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							document.getElementById('kecamatan').disabled = false;
							$('#kecamatan')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('#kecamatan').selectpicker('destroy').selectpicker();
						}else{
							swal("ERROR", "Load data.", "error");
						}
					},
					error: function(){
						swal("ERROR", "Load data.", "error");
					}
				});
			});

			$('#kecamatan').on('change', function() {
				var kode 	= $('#kecamatan').val();
				$('#id_kecamatan').val(kode);
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>'+'alamat/data_kelurahan/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#kelurahan')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('#kelurahan').selectpicker('destroy').selectpicker();
						}else{
							swal("ERROR", "Load data.", "error");
						}
					},
					error: function(){
						swal("ERROR", "Load data.", "error");
					}
				});
			});

			$('#btn-tambah-propinsi').click(function(){
				$('#form-tambah-propinsi')[0].reset();
				$('#form-tambah-propinsi').attr('action','<?=base_url()?>alamat/tambah_propinsi');
				$('.modal-title').html('Tambah data');
				$('#modal-tambah-propinsi').modal('show');
			});

			$('#tambah-simpan-propinsi').click(function() {
				$('#form-tambah-propinsi').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							swal($('.modal-title').html() + ' Sukses');
							$('#form-tambah-propinsi')[0].reset();
							$('#modal-tambah-propinsi').modal('hide');

							$.ajax({
								type: 		'ajax',
								method: 	'post',
								url: 		'<?=base_url()?>'+'alamat/data_propinsi/',
								async: 		true,
								dataType: 	'json',
								success: 	function(data){
									if(data !== null){
										$('#propinsi')
											.find('option')
											.remove()
											.end()
											.append(data)
										;
										$('#propinsi').selectpicker('destroy').selectpicker();
									}else{
										swal("ERROR", "Load data.", "error");
									}
								},
								error: function(){
									swal("ERROR", "Load data.", "error");
								}
							});

						}else{
							swal($('.modal-title').html() + ' Gagal');
						}
					},
					error: function(){
						swal('ERROR : function(response)');
					}
				}).submit();
			});

			$('#btn-tambah-kota').click(function(){
				if($('#propinsi').val() == ''){
					alert('Pilih Data Propinsi');
				}else{
					$('#form-tambah-kota')[0].reset();
					var propinsi 	= $('#propinsi').val();
					$('#form-tambah-kota').attr('action','<?=base_url()?>alamat/tambah_kota');
					$('.modal-title').html('Tambah data');
					$('#id_propinsi_kota').val(propinsi);
					$('#modal-tambah-kota').modal('show');					
				}
			});

			$('#tambah-simpan-kota').click(function() {
				$('#form-tambah-kota').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							swal($('.modal-title').html() + ' Sukses');
							$('#form-tambah-kota')[0].reset();
							$('#modal-tambah-kota').modal('hide');
			
							var kode 	= $('#propinsi').val();
							$.ajax({
								type: 		'ajax',
								method: 	'post',
								url: 		'<?=base_url()?>'+'alamat/data_kota/' + kode,
								async: 		true,
								dataType: 	'json',
								success: 	function(data){
									if(data !== null){
										document.getElementById('kota').disabled = false;
										$('#kota')
											.find('option')
											.remove()
											.end()
											.append(data)
										;
										$('#kota').selectpicker('destroy').selectpicker();
									}else{
										swal("ERROR", "Load data.", "error");
									}
								},
								error: function(){
									swal("ERROR", "Load data.", "error");
								}
							});
						}else{
							swal($('.modal-title').html() + ' Gagal');
						}
					},
					error: function(){
						swal('ERROR : function(response)');
					}
				}).submit();
			});

			$('#btn-tambah-kecamatan').click(function(){
				if($('#kota').val() == ''){
					alert('Pilih Data Kota');
				}else{
					$('#form-tambah-kecamatan')[0].reset();
					var propinsi 	= $('#propinsi').val();
					var kota 	= $('#kota').val();
					$('#form-tambah-kecamatan').attr('action','<?=base_url()?>alamat/tambah_kecamatan');
					$('.modal-title').html('Tambah data');
					$('#id_propinsi_kecamatan').val(propinsi);
					$('#id_kota_kecamatan').val(kota);
					$('#modal-tambah-kecamatan').modal('show');
				}
			});

			$('#tambah-simpan-kecamatan').click(function() {
				$('#form-tambah-kecamatan').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							swal($('.modal-title').html() + ' Sukses');
							$('#form-tambah-kecamatan')[0].reset();
							$('#modal-tambah-kecamatan').modal('hide');

							var kode 	= $('#kota').val();
							$('#id_kota').val(kode);
							$.ajax({
								type: 		'ajax',
								method: 	'post',
								url: 		'<?=base_url()?>'+'alamat/data_kecamatan/' + kode,
								async: 		true,
								dataType: 	'json',
								success: 	function(data){
									if(data !== null){
										document.getElementById('kecamatan').disabled = false;
										$('#kecamatan')
											.find('option')
											.remove()
											.end()
											.append(data)
										;
										$('#kecamatan').selectpicker('destroy').selectpicker();
									}else{
										swal("ERROR", "Load data.", "error");
									}
								},
								error: function(){
									swal("ERROR", "Load data.", "error");
								}
							});
						}else{
							swal($('.modal-title').html() + ' Gagal');
						}
					},
					error: function(){
						swal('ERROR : function(response)');
					}
				}).submit();
			});

			$('#btn-tambah-kelurahan').click(function(){
				if($('#kecamatan').val() == ''){
					alert('Pilih Data Kecamatan');
				}else{
					$('#form-tambah-kelurahan')[0].reset();
					var propinsi 	= $('#propinsi').val();
					var kota 	= $('#kota').val();
					var kecamatan 	= $('#kecamatan').val();
					$('#form-tambah-kelurahan').attr('action','<?=base_url()?>alamat/tambah_kelurahan');
					$('.modal-title').html('Tambah data');
					$('#id_propinsi_kelurahan').val(propinsi);
					$('#id_kota_kelurahan').val(kota);
					$('#id_kecamatan_kelurahan').val(kecamatan);
					$('#modal-tambah-kelurahan').modal('show');
				}	
			});

			$('#tambah-simpan-kelurahan').click(function() {
				$('#form-tambah-kelurahan').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							swal($('.modal-title').html() + ' Sukses');
							$('#form-tambah-kelurahan')[0].reset();
							$('#modal-tambah-kelurahan').modal('hide');

							var kode 	= $('#kecamatan').val();
							$('#id_kecamatan').val(kode);
							$.ajax({
								type: 		'ajax',
								method: 	'post',
								url: 		'<?=base_url()?>'+'alamat/data_kelurahan/' + kode,
								async: 		true,
								dataType: 	'json',
								success: 	function(data){
									if(data !== null){
										$('#kelurahan')
											.find('option')
											.remove()
											.end()
											.append(data)
										;
										$('#kelurahan').selectpicker('destroy').selectpicker();
									}else{
										swal("ERROR", "Load data.", "error");
									}
								},
								error: function(){
									swal("ERROR", "Load data.", "error");
								}
							});
						}else{
							swal($('.modal-title').html() + ' Gagal');
						}
					},
					error: function(){
						swal('ERROR : function(response)');
					}
				}).submit();
			});

			$('#jurusan').on('change', function() {
				var kode 	= $('#jurusan').val();
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>'+'prodi/data_prodi/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#prodi')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('#prodi').selectpicker('destroy').selectpicker();
						}else{
							swal("ERROR", "Load data.", "error");
						}
					},
					error: function(){
						swal("ERROR", "Load data.", "error");
					}
				});
			});
		});
	</script>
</body>
</html>
