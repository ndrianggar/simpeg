<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Riwayat Pangkat</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<button type="button" id="btn-tambah-pangkat" class="btn btn-primary">Tambah</button>
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
				<table id="data-pangkat" class="table table-bordered table-striped table-hover" width="100%">
					<thead>
						<tr>
							<th rowspan="2" style="text-align: center; vertical-align: middle;">No.</th>
							<th rowspan="2" style="text-align: center; vertical-align: middle;">Pangkat</th>
							<th rowspan="2" style="text-align: center; vertical-align: middle;">Golongan</th>
							<th rowspan="2" style="text-align: center; vertical-align: middle;">TMT Pangkat</th>
							<th rowspan="2" style="text-align: center; vertical-align: middle;">Gaji Pokok</th>
							<th colspan="3" style="text-align: center; vertical-align: middle;">Surat Keputusan</th>
							<th rowspan="2" style="text-align: center; vertical-align: middle;">Dasar Peraturan</th>
							<th rowspan="2" style="text-align: center; vertical-align: middle;">PMK</th>
							<th rowspan="2" style="text-align: center; vertical-align: middle;">Status</th>
							<th rowspan="2" style="text-align: center; vertical-align: middle;">Action</th>
						</tr>
						<tr>
							<th style="text-align: center; vertical-align: middle;">Pejabat</th>
							<th style="text-align: center; vertical-align: middle;">Nomor</th>
							<th style="text-align: center; vertical-align: middle;">TMT</th>
						</tr>
					</thead>
					<tbody>
					</tbody>									
				</table>
			</div>
		</div>
	</div>

	<!-- Modal Riwayat Kepangkatan -->
	<div class="modal fade" id="modal-pangkat">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="form-pangkat" id="form-pangkat" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
					<div class="modal-header">
						<div class="modal-title">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2><span id="title-pangkat">Title</span></h2>
						</div>
					</div>
					<div class="modal-body">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Pangkat *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input id="id_pegawai_pangkat" name="id_pegawai" type="hidden">
									<input id="kd_riwayat_pangkat" name="kd_riwayat_pangkat" type="hidden">
									<select id="kd_pangkat" name="kd_pangkat" class="form-control selectpicker" data-live-search="true" required="required" title="-- Pilih Pangkat --">
										<?php
										foreach ($pangkat as $pangkat) {
											echo '<option value="' . $pangkat->id_pangkat . '">' . $pangkat->nm_pangkat . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Berlaku TMT *</label>
								<div class="col-md-8 col-sm-12 col-xs-12 has-feedback">
									<input id="tmt_pangkat" name="tmt_pangkat" class="form-control has-feedback-right tanggal" placeholder="Berlaku TMT (dd-mm-yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Gaji Pokok *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input id="gaji_pangkat" name="gaji_pangkat" class="form-control angka_saja" type="number" value="0" style="text-align: right;" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Pejabat SK *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input id="pejabat_sk" name="pejabat_sk" class="form-control" placeholder="Pejabat SK" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Nomor SK *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input id="nomor_sk" name="nomor_sk" class="form-control" placeholder="Nomor SK" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Tanggal SK *</label>
								<div class="col-md-8 col-sm-12 col-xs-12 has-feedback">
									<input id="tanggal_sk" name="tanggal_sk" class="form-control has-feedback-right tanggal" placeholder="Tanggal SK (dd-mm-yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">File SK</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input id="file_sk" name="file_sk" class="form-control" type="File" accept="application/pdf">
									<a id="lihat_file_sk_pangkat" class="form-control" href="" target="_blank">Lihat File</a>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Dasar Peraturan *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input id="dasar_pangkat" name="dasar_pangkat" class="form-control" placeholder="Dasar Peraturan" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">PMK (Bulan) *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input id="pmk" name="pmk" class="form-control" placeholder="PMK (Bulan)" required="required">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="navbar-right">
							<div class="btn-group">
								<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
								<button type="button" id="btn-simpan-pangkat" class="btn btn-success">Simpan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal Riwayat Kepangkatan -->

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Riwayat Jabatan</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<button type="button" id="btn-tambah-jabatan" class="btn btn-primary">Tambah</button>
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
				<table id="data-jabatan" class="table table-bordered table-striped table-hover" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">No.</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">Jabatan</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">TMT Jabatan</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">Tunjangan</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">TMT Pelantikan</th>
							<th colspan="3" class="text-center" style="vertical-align: middle;">Surat Keputusan</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">SPMT</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">SPMJ</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">Status</th>
							<th rowspan="2" class="text-center" style="vertical-align: middle;">Action</th>
						</tr>
						<tr>
							<th class="text-center">Pejabat</th>
							<th class="text-center">Nomor</th>
							<th class="text-center">TMT</th>
							<!-- <th class="text-center">Nomor</th>
							<th class="text-center">TMT</th>
							<th class="text-center">Nomor</th>
							<th class="text-center">TMT</th> -->
						</tr>
					</thead>
					<tbody>
					</tbody>									
				</table>
			</div>
		</div>
	</div>

	<!-- Modal Riwayat Jabatan -->
	<div class="modal fade" id="modal-jabatan">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="form-jabatan" id="form-jabatan" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
					<div class="modal-header">
						<div class="modal-title">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2><span id="title-jabatan">Title</span></h2>
						</div>
					</div>
					<div class="modal-body">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">Jenis Jabatan *</label>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<select id="kd_jenis" name="kd_jenis" class="form-control selectpicker" data-live-search="true" required="required" title="-- Pilih Jenis Jabatan --">
										<?php
										foreach ($jenis as $jenis) {
											echo '<option value="' . $jenis->kd_jenis . '">' . $jenis->nm_jenis . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">Jabatan *</label>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input id="id_pegawai_jabatan" name="id_pegawai" type="hidden">
									<input id="kd_riwayat_jabatan" name="kd_riwayat_jabatan" type="hidden">
									<select id="kd_jabatan" name="kd_jabatan" class="form-control selectpicker" data-live-search="true" required="required" title="-- Pilih Jabatan --">
										<option value="">-- Pilih Jabatan --</option>
										<?php
										foreach ($jabatan as $jabatan) {
											echo '<option value="' . $jabatan->kd_jabatan . '">' . $jabatan->nm_jabatan . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">TMT Jabatan *</label>
								<div class="col-md-9 col-sm-12 col-xs-12 has-feedback">
									<input id="tmt_jabatan" name="tmt_jabatan" class="form-control has-feedback-right tanggal" value="<?=date('d-m-Y')?>" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">Tunjangan *</label>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input id="gaji_jabatan" name="gaji_jabatan" type="number" class="form-control angka_saja" value="0" style="text-align: right;" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">TMT Pelantikan *</label>
								<div class="col-md-9 col-sm-12 col-xs-12 has-feedback">
									<input id="tmt_pelantikan" name="tmt_pelantikan" class="form-control has-feedback-right tanggal" value="<?=date('d-m-Y')?>" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">Penempatan *</label>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<select id="id_penempatan" name="id_penempatan" class="form-control selectpicker" data-live-search="true" required="required" title="-- Pilih Penempatan --">
										<?php
										foreach ($penempatan as $penempatan) {
											echo '<option value="' . $penempatan->id_penempatan . '">' . $penempatan->nm_penempatan . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">Pejabat SK *</label>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input id="pejabat_sk_jabatan" name="pejabat_sk" class="form-control" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">Nomor SK *</label>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input id="nomor_sk_jabatan" name="nomor_sk" class="form-control" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">Tanggal SK *</label>
								<div class="col-md-9 col-sm-12 col-xs-12 has-feedback">
									<input id="tanggal_sk_jabatan" name="tanggal_sk" class="form-control has-feedback-right tanggal" value="<?=date('d-m-Y')?>" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-4 col-xs-12">File SK</label>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input id="file_sk_jabatan" name="file_sk" class="form-control" type="File" accept="application/pdf">
									<a id="lihat_file_sk_jabatan" class="form-control" href="" target="_blank">Lihat File</a>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">Nomor SPMT *</label>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input id="nomor_spmt_jabatan" name="nomor_spmt" class="form-control" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">Tanggal SPMT *</label>
								<div class="col-md-9 col-sm-12 col-xs-12 has-feedback">
									<input id="tanggal_spmt_jabatan" name="tanggal_spmt" class="form-control has-feedback-right tanggal" value="<?=date('d-m-Y')?>" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-4 col-xs-12">File SPMT</label>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input id="file_spmt_jabatan" name="file_spmt" class="form-control" type="File" accept="application/pdf">
									<a id="lihat_file_spmt_jabatan" class="form-control" href="" target="_blank">Lihat File</a>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">Nomor SPMJ *</label>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input id="nomor_spmj_jabatan" name="nomor_spmj" class="form-control" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-12 col-xs-12">Tanggal SPMJ *</label>
								<div class="col-md-9 col-sm-12 col-xs-12 has-feedback">
									<input id="tanggal_spmj_jabatan" name="tanggal_spmj" class="form-control has-feedback-right tanggal" value="<?=date('d-m-Y')?>" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-3 col-sm-4 col-xs-12">File SPMJ</label>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input id="file_spmj_jabatan" name="file_spmj" class="form-control" type="File" accept="application/pdf">
									<a id="lihat_file_spmj_jabatan" class="form-control" href="" target="_blank">Lihat File</a>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="navbar-right">
							<div class="btn-group">
								<button type="button" id="btn-batal" class="btn btn-warning" data-dismiss="modal">Batal</button>
								<button type="button" id="btn-simpan-jabatan" class="btn btn-success">Simpan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal Riwayat Pekerjaan -->
</div>