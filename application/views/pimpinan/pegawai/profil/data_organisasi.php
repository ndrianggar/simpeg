<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Data Pengalaman Luar Negeri</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<button type="button" id="btn-tambah-organisasi" class="btn btn-primary">Tambah</button>
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
				<table id="data-organisasi" class="table table-bordered table-striped table-hover" width="100%">
					<thead>
						<th>No</th>
						<th>Nama Organisasi</th>
						<th>Kedudukan Dalam Organisasi</th>
						<th>Lamanya</th>
						<th>Tempat</th>
						<th>Pemimpin Organisasi</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Modal Organisasi -->
	<div class="modal fade" id="modal-organisasi">
		<div class="modal-dialog">
			<form name="form-organisasi" id="form-organisasi" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2><span id="title-organisasi">Title</span></h2>
						</div>
					</div>
					<div class="modal-body scroll_modal">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12" >Nama Organisasi</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" name="kd_organisasi" id="kd_organisasi" type="hidden">
									<input class="form-control" name="id_pegawai" id="id_pegawai_organisasi" type="hidden">
									<input class="form-control" name="nama_organisasi" id="nama_organisasi" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Kedudukan Dalam Organisasi</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" name="jabatan_organisasi" id="jabatan_organisasi" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Tanggal Mulai *</label>
								<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
									<input id="awal_organisasi" name="awal_organisasi" class="form-control has-feedback-right tanggal" placeholder="Tanggal Selesai (dd-mm-yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Tanggal Akhir *</label>
								<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
									<input id="akhir_organisasi" name="akhir_organisasi" class="form-control has-feedback-right tanggal" placeholder="Tanggal Selesai (dd-mm-yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Tempat</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" id="tempat_organisasi" name="tempat_organisasi" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Pemimpin</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" id="ketua_organisasi" name="ketua_organisasi" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">File (pdf)</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" type="file" id="file_organisasi" name="file_organisasi">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="navbar-right">
							<div class="btn-group">
								<button type="button" id="btn-batal" class="btn btn-warning" data-dismiss="modal">Batal</button>
								<button type="button" id="btn-simpan-organisasi" class="btn btn-success">Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Modal kunjungan Luar Negeri -->
</div>