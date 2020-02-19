<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Pendidikan Formal</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<button type="button" id="btn-tambah-pendidikan" class="btn btn-primary">Tambah</button>
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
				<table id="data-pendidikan" Class="table table-bordered table-striped table-hover">
					<thead>
						<th>No.</th>
						<th>Jenjang</th>
						<th>Nama Pendidikan</th>
						<th>Jurusan</th>
						<th>Tahun</th>
						<th>Ijazah</th>
						<th>Tempat</th>
						<th>Penandatangan</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
					</tbody>									
				</table>
			</div>
		</div>
	</div>

	<!-- Modal Tambah Pendidikan -->
	<div class="modal fade" id="modal-pendidikan">
		<div class="modal-dialog">
			<form name="form-pendidikan" id="form-pendidikan" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2><span id="title-pendidikan">Tambah Data Pendidikan Formal</span></h2>
						</div>
					</div>
					<div class="modal-body">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Jenjang Pendidikan *</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="id_pegawai_pendidikan" name="id_pegawai" class="form-control" type="hidden">
									<select id="id_jenjang_pendidikan" name="id_jenjang" class="form-control selectpicker" required="required" title="-- Pilih Jenjang Pendidikan --">
										<?php
										foreach ($jenjang as $jenjang) {
											echo '<option value="' . $jenjang->id_jenjang . '">' . $jenjang->nm_jenjang . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Nama Pendidikan *</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="kode_pendidikan" name="kode_pendidikan" type="hidden">
									<input id="nama_pendidikan" name="nama_pendidikan" class="form-control" placeholder="Nama Pendidikan" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Jurusan Pendidikan</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="jurusan_pendidikan" name="jurusan_pendidikan" class="form-control" placeholder="Jurusan Pendidikan">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Tanggal Mulai *</label>
								<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
									<input id="awal_pendidikan" name="awal_pendidikan" class="form-control has-feedback-right tanggal" placeholder="Tanggal Mulai (dd-mm-yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Tanggal Selesai *</label>
								<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
									<input id="akhir_pendidikan" name="akhir_pendidikan" class="form-control has-feedback-right tanggal" placeholder="Tanggal Selesai (dd-mm-yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Nomor Ijazah *</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="ijazah_pendidikan" name="ijazah_pendidikan" class="form-control" placeholder="Nomor Ijazah" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Tempat *</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="tempat_pendidikan" name="tempat_pendidikan" class="form-control" placeholder="Tempat" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Penanda Tangan *</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="kepala_pendidikan" name="kepala_pendidikan" class="form-control" placeholder="Penanda Tangan" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">File (pdf)</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="file_pendidikan" name="file_pendidikan" class="form-control" type="File" accept="application/pdf">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="navbar-right">
							<div class="btn-group">
								<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
								<button type="button" id="btn-simpan-pendidikan" class="btn btn-success">Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Modal Tambah Pendidikan-->

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Pendidikan NonFormal</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<button type="button" id="btn-tambah-kursus" class="btn btn-primary">Tambah</button>
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
				<table id="data-kursus" Class="table table-bordered table-striped table-hover">
					<thead>
						<th>No.</th>
						<th>Jenis</th>
						<th>Nama Pendidikan</th>
						<th>Durasi</th>
						<th>Ijazah</th>
						<th>Tempat</th>
						<th>Penyelenggara</th>
						<th>Durasi (Jam)</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
					</tbody>									
				</table>
			</div>
		</div>
	</div>

	<!-- Modal Tambah Kursus -->
	<div class="modal fade" id="modal-kursus">
		<div class="modal-dialog">
			<form name="form-kursus" id="form-kursus" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2><span id="title-kurus">Tambah Data Pendidikan Non-Formal</span></h2>
						</div>
					</div>
					<div class="modal-body scroll_modal">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Jenis Pendidikan *</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<select id="id_jenis_kursus" name="id_jenis_kursus" class="form-control selectpicker" title="--Pilih Jenis--" required="required">
										<?php
										foreach ($jenis_kursus as $jenis_kursus) {
											echo '<option value="' . $jenis_kursus->id_jenis_kursus . '">' . $jenis_kursus->nm_jenis_kursus . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Nama Pendidikan *</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="kode_kursus" name="kode_kursus" type="hidden">
									<input id="id_pegawai_kursus" name="id_pegawai" type="hidden">
									<input id="nama_kursus" name="nama_kursus" class="form-control" placeholder="Nama Pendidikan" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Tanggal Mulai *</label>
								<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
									<input id="awal_kursus" name="awal_kursus" class="form-control has-feedback-right tanggal" placeholder="Tanggal Mulai (dd-mm-yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Tanggal Selesai *</label>
								<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
									<input id="akhir_kursus" name="akhir_kursus" class="form-control has-feedback-right tanggal" placeholder="Tanggal Mulai (dd-mm-yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Nomor Ijazah *</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="ijazah_kursus" name="ijazah_kursus" class="form-control" placeholder="Nomor Ijazah" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Tempat *</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="tempat_kursus" name="tempat_kursus" class="form-control" placeholder="Tempat" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Penyelenggara *</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="kepala_kursus" name="kepala_kursus" class="form-control" placeholder="Penyelenggara" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">Durasi (Jam) *</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="durasi_kursus" name="durasi_kursus" class="form-control" placeholder="Durasi (Jam)" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-4 col-xs-12">File (pdf)</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="file_kursus" name="file_kursus" class="form-control" type="File" accept="application/pdf">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="navbar-right">
							<div class="btn-group">
								<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
								<button type="button" id="btn-simpan-kursus" class="btn btn-success">Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Modal Tambah Kursus -->
</div>