<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Data Hukuman Disiplin</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<!-- <button type="button" id="btn-tambah-hukuman" class="btn btn-primary">Tambah</button> -->
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
				<table id="data-hukuman" class="table table-bordered table-striped table-hover" width="100%">
					<thead>
						<tr>
							<th rowspan="2" style="vertical-align: middle;" class="text-center">No.</th>
							<th rowspan="2" style="vertical-align: middle;" class="text-center">Jenis Hukuman</th>
							<th rowspan="2" style="vertical-align: middle;" class="text-center">Sanksi</th>
							<th colspan="3" style="vertical-align: middle;" class="text-center">Surat Keputusan</th>
							<!-- <th rowspan="2" style="vertical-align: middle;" class="text-center">Action</th> -->
						</tr>
						<tr>
							<th style="vertical-align: middle;" class="text-center">Pejabat</th>
							<th style="vertical-align: middle;" class="text-center">Nomor</th>
							<th style="vertical-align: middle;" class="text-center">TMT</th>
						</tr>
					</thead>
					<tbody id="body-hukuman">
					</tbody>									
				</table>
			</div>
		</div>
	</div>

	<!-- Modal hukuman -->
	<div class="modal fade" id="modal-hukuman">
		<div class="modal-dialog">
			<form name="form-hukuman" id="form-hukuman" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2><span id="title-hukuman">Title</span></h2>
						</div>
					</div>
					<div class="modal-body scroll_modal">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Jenis Hukuman *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" name="kd_hukuman" id="kd_hukuman" type="hidden">
									<input class="form-control" name="id_pegawai" id="id_pegawai_hukuman" type="hidden">
									<input class="form-control" name="jenis_hukuman" id="jenis_hukuman" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Sanksi *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" name="sanksi_hukuman" id="sanksi_hukuman" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Pejabat SK *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input id="pejabat_hukuman" name="pejabat_hukuman" class="form-control" placeholder="Pejabat SK" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Nomor SK *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input id="nomor_hukuman" name="nomor_hukuman" class="form-control" placeholder="Nomor SK" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Tanggal SK *</label>
								<div class="col-md-8 col-sm-12 col-xs-12 has-feedback">
									<input id="tanggal_hukuman" name="tanggal_hukuman" class="form-control has-feedback-right tanggal" placeholder="Tanggal SK (dd-mm-yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">File (pdf)</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" type="file" name="file_hukuman" id="file_hukuman">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="navbar-right">
							<div class="btn-group">
								<button type="button" id="btn-batal" class="btn btn-warning" data-dismiss="modal">Batal</button>
								<button type="button" id="btn-simpan-hukuman" class="btn btn-success">Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Modal hukuman -->
</div>