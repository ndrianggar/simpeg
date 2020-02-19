<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Data Anggota Keluarga</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<!-- <button type="button" id="btn-tambah-keluarga" class="btn btn-primary">Tambah</button> -->
					</li>
					<li>
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
				</div>
			<div class="x_content">
				<table id="data-keluarga" class="table table-bordered table-striped table-hover" width="100%">
					<thead>
						<th style="text-align: center; vertical-align: middle;">No.</th>
						<th style="text-align: center; vertical-align: middle;">Nama Lengkap</th>
						<th style="text-align: center; vertical-align: middle;">Hubungan</th>
						<th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
						<th style="text-align: center; vertical-align: middle;">Tempat Lahir</th>
						<th style="text-align: center; vertical-align: middle;">Tanggal Lahir</th>
						<th style="text-align: center; vertical-align: middle;">Tanggal Menikah</th>
						<th style="text-align: center; vertical-align: middle;">Alamat</th>
						<th style="text-align: center; vertical-align: middle;">Pekerjaan</th>
						<th style="text-align: center; vertical-align: middle;">Status</th>
						<!-- <th style="text-align: center; vertical-align: middle;">Action</th> -->
					</thead>
					<tbody>
					</tbody>									
				</table>
			</div>
		</div>
	</div>

	<!-- Modal Keluarga -->
	<div class="modal fade" id="modal-keluarga">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form name="form-keluarga" id="form-keluarga" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
					<div class="modal-header">
						<div class="modal-title">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<span><h2>Tambah Anggota Keluarga</h2></span>
						</div>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="row">
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-horizontal">
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Hubungan Keluarga</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<select id="hubungan" name="hubungan" class="form-control selectpicker"  title="-- Pilih Hubungan Keluarga --">
															<?php 
																foreach ($hubungan as $hubungan) {
																	echo '<option value="' . $hubungan->kd_hubungan . '">'. $hubungan->nm_hubungan .'</option>';
																}
															?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Nama Lengkap</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="id_pegawai_keluarga" name="id_pegawai" type="hidden">
														<input id="kode" name="kode" type="hidden">
														<input id="nama" name="nama" class="form-control" placeholder="Nama Lengkap" required="required">
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Gelar Depan</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="gelar_depan" name="gelar_depan" placeholder="Gelar Depan" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Gelar Belakang</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="gelar_belakang" name="gelar_belakang" placeholder="Gelar Belakang" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Jenis Dokumen</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<select id="jenis_dokumen" name="jenis_dokumen" class="form-control selectpicker"  title="-- Pilih Jenis Dokumen --">
															<option value="KTP">KTP</option>
															<option value="SIM">SIM</option>
															<option value="Pasport">Pasport</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Nomor Dokumen</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="nomor_dokumen" name="nomor_dokumen" class="form-control" placeholder="Nomor Dokumen" required="required">
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Jenis Kelamin</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<select id="jenis_kelamin" name="jenis_kelamin" class="form-control selectpicker"  title="-- Pilih Jenis Kelamin --">
															<option value="Laki-laki">Laki-laki</option>
															<option value="Perempuan">Perempuan</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Agama</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<select id="agama" name="agama" class="form-control selectpicker"  title="-- Pilih Agama --">
															<?php 
																foreach ($agama as $agama) {
																	echo '<option value="' . $agama->kd_agama . '">'. $agama->nm_agama .'</option>';
																}
															?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Tempat Lahir</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required="required">
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Tanggal Lahir</label>
													<div class="col-md-7 col-sm-8 col-xs-12 has-feedback">
														<input id="tanggal_lahir" name="tanggal_lahir" class="form-control has-feedback-right tanggal" placeholder="Tanggal Lahir (dd-mm-yyyy)" required="required">
														<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Akte Kelahiran</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="akte_lahir" name="akte_lahir" class="form-control" placeholder="Akte Kelahiran" required="required">
													</div>
												</div>
												<div class="form-group nikah" style="display: none;">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Tanggal Menikah</label>
													<div class="col-md-7 col-sm-8 col-xs-12 has-feedback">
														<input id="tanggal_nikah" name="tanggal_nikah" class="form-control has-feedback-right tanggal" placeholder="Tanggal Menikah (dd-mm-yyyy)">
														<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
													</div>
												</div>
												<div class="form-group nikah" style="display: none;">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Akte Nikah</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="akte_nikah" name="akte_nikah" class="form-control" placeholder="Akte Nikah">
													</div>
												</div>
												<div class="form-group nikah" style="display: none;">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Status Perceraian</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<select id="status_cerai" name="status_cerai" class="form-control selectpicker" title="-- Pilih Status Perceraian --">
															<option value="Ya">Ya</option>
															<option value="Tidak">Tidak</option>
														</select>
													</div>
												</div>
												<div class="form-group cerai" style="display: none;">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Tanggal Bercerai</label>
													<div class="col-md-7 col-sm-8 col-xs-12 has-feedback">
														<input id="tanggal_cerai" name="tanggal_cerai" class="form-control has-feedback-right tanggal" placeholder="Tanggal Cerai (dd-mm-yyyy)">
														<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
													</div>
												</div>
												<div class="form-group cerai" style="display: none;">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Akte Cerai</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="akte_cerai" name="akte_cerai" class="form-control" placeholder="Akte Cerai">
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Alamat</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<textarea id="alamat" name="alamat" class="form-control" rows="2" placeholder="Alamat" required="required"></textarea>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-horizontal">
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Nomor HP</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="handphone" name="handphone" class="form-control" placeholder="Nomor HP">
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Telepon</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="telepon" name="telepon" class="form-control" placeholder="Telepon">
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Email</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="email" name="email" class="form-control" placeholder="email">
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Status Perkawinan</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<select id="status_perkawinan" name="status_perkawinan" class="form-control selectpicker"  title="-- Pilih Status Pernikahan --">
															<option value="Belum Menikah">Belum Menikah</option>
															<option value="Menikah">Menikah</option>
															<option value="Duda">Duda</option>
															<option value="Janda">Janda</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Pekerjaan</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="pekerjaan" name="pekerjaan" class="form-control" placeholder="Pekerjaan">
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Keterangan</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<textarea id="keterangan" name="keterangan" class="form-control" rows="2" placeholder="Keterangan"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Status Hidup</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<select id="status_hidup" name="status_hidup" class="form-control selectpicker"  title="-- Pilih Status Hidup --">
															<option value="Hidup">Hidup</option>
															<option value="Meninggal">Meninggal</option>
														</select>
													</div>
												</div>
												<div class="form-group meninggal" style="display: none;">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Tanggal Meninggal</label>
													<div class="col-md-7 col-sm-8 col-xs-12 has-feedback">
														<input id="tanggal_meninggal" name="tanggal_meninggal" class="form-control has-feedback-right tanggal" placeholder="Tanggal Meninggal (dd-mm-yyyy)">
														<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
													</div>
												</div>
												<div class="form-group meninggal" style="display: none;">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Akte Meninggal</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="akte_meninggal" name="akte_meninggal" class="form-control" placeholder="Akte Meninggal">
													</div>
												</div>
												<div class="form-group">
													<label class="label-control col-md-5 col-sm-4 col-xs-12">Foto</label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<input id="foto_keluarga" name="foto_keluarga" class="form-control" type="file" accept="image/x-png,image/jpeg">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-5 col-sm-4 col-xs-12 label-control"></label>
													<div class="col-md-7 col-sm-8 col-xs-12">
														<img id="PrevFoto" src="<?=base_url()?>assets/images/user.png" style="height: 200px">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="navbar-right">
							<div class="btn-group">
								<button type="button" id="btn-batal-keluarga" class="btn btn-warning" data-dismiss="modal">Batal</button>
								<button type="button" id="btn-simpan-keluarga" class="btn btn-success">Simpan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal Keluarga -->
</div>