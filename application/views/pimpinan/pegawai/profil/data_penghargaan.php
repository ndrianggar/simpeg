<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Data Penghargaan</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<button type="button" id="btn-tambah-penghargaan" class="btn btn-primary">Tambah</button>
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
				<table id="data-penghargaan" class="table table-bordered table-striped table-hover" width="100%">
					<thead>
						<th style="vertical-align: middle;" class="text-center">No.</th>
						<th style="vertical-align: middle;" class="text-center">Nama Bintang / Styalencana Penghargaan</th>
						<th style="vertical-align: middle;" class="text-center">Tahun</th>
						<th style="vertical-align: middle;" class="text-center">Nama Negara / Instansi yang Memberi</th>
						<th style="vertical-align: middle;" class="text-center">Status</th>
						<th style="vertical-align: middle;" class="text-center">Action</th>
					</thead>
					<tbody id="body-penghargaan">
					</tbody>									
				</table>
			</div>
		</div>
	</div>

	<!-- Modal Penghargaan -->
	<div class="modal fade" id="modal-penghargaan">
		<div class="modal-dialog">
			<form name="form-penghargaan" id="form-penghargaan" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2><span id="title-penghargaan">Title</span></h2>
						</div>
					</div>
					<div class="modal-body scroll_modal">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Nama Penghargaan *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" name="kd_penghargaan" id="kd_penghargaan" type="hidden">
									<input class="form-control" name="id_pegawai" id="id_pegawai_penghargaan" type="hidden">
									<input class="form-control" name="nama_penghargaan" id="nama_penghargaan" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Tahun Penghargaan *</label>
								<div class="col-md-8 col-sm-12 col-xs-12 has-feedback">
									<input id="tahun_penghargaan" name="tahun_penghargaan" class="form-control has-feedback-right" placeholder="Tahun Penghargaan (yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Pemberi Penghargaan *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" name="pemberi_penghargaan" id="pemberi_penghargaan" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">File (pdf)</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" type="file" name="file_penghargaan" id="file_penghargaan">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="navbar-right">
							<div class="btn-group">
								<button type="button" id="btn-batal" class="btn btn-warning" data-dismiss="modal">Batal</button>
								<button type="button" id="btn-simpan-penghargaan" class="btn btn-success">Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Modal Penghargaan -->
</div>