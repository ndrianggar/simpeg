<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Data Surat Lain-Lain</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<button type="button" id="btn-tambah-suratlain" class="btn btn-primary">Tambah</button>
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
				<table id="data-suratlain" class="table table-bordered table-striped table-hover" width="100%">
					<thead>
						<th style="vertical-align: middle;" class="text-center">No.</th>
						<th style="vertical-align: middle;" class="text-center">Nama Surat</th>
						<th style="vertical-align: middle;" class="text-center">Tanggal</th>
						<th style="vertical-align: middle;" class="text-center">Tempat</th>
						<th style="vertical-align: middle;" class="text-center">Keterangan</th>
						<th style="vertical-align: middle;" class="text-center">Status</th>
						<th style="vertical-align: middle;" class="text-center">Action</th>
					</thead>
					<tbody>
					</tbody>									
				</table>
			</div>
		</div>
	</div>

	<!-- Modal Penghargaan -->
	<div class="modal fade" id="modal-suratlain">
		<div class="modal-dialog">
			<form name="form-suratlain" id="form-suratlain" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2><span id="title-suratlain">Title</span></h2>
						</div>
					</div>
					<div class="modal-body scroll_modal">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Nama Surat *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" name="id_suratlain" id="kd_suratlain" type="hidden">
									<input class="form-control" name="id_pegawai" id="id_pegawai_suratlain" type="hidden">
									<input class="form-control" name="nama_suratlain" id="nama_suratlain" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Tanggal Surat *</label>
								<div class="col-md-8 col-sm-12 col-xs-12 has-feedback">
									<input id="tanggal_suratlain" name="tanggal_suratlain" class="form-control has-feedback-right tanggal" placeholder="Tanggal Surat (dd-mm-yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Tempat *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" name="tempat_suratlain" id="tempat_suratlain" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Keterangan </label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<textarea id="keterangan_suratlain" name="keterangan_suratlain" class="form-control" rows="3"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">File (pdf)</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" type="file" name="file_suratlain" id="file_suratlain">
									<a id="lihat_file_suratlain" class="form-control" href="" target="_blank">Lihat File</a>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="navbar-right">
							<div class="btn-group">
								<button type="button" id="btn-batal" class="btn btn-warning" data-dismiss="modal">Batal</button>
								<button type="button" id="btn-simpan-suratlain" class="btn btn-success">Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Modal Penghargaan -->
</div>