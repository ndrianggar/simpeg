<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Data Pengalaman Luar Negeri</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<button type="button" id="btn-tambah-kunjungan" class="btn btn-primary">Tambah</button>
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
				<table id="data-kunjungan" class="table table-bordered table-striped table-hover" width="100%">
					<thead>
						<th>No</th>
						<th>Negara</th>
						<th>Tujuan Kunjungan</th>
						<th>Lamanya</th>
						<th>Yang Membiayai</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody id="body-kunjungan">
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Modal kunjungan Luar Negeri -->
	<div class="modal fade" id="modal-kunjungan">
		<div class="modal-dialog">
			<form name="form-kunjungan" id="form-kunjungan" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2><span id="title-luar-negeri">Title</span></h2>
						</div>
					</div>
					<div class="modal-body scroll_modal">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12" >Negara *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" name="kd_kunjungan" id="kd_kunjungan" type="hidden">
									<input class="form-control" name="id_pegawai" id="id_pegawai_kunjungan" type="hidden">
									<input class="form-control" name="negara_kunjungan" id="negara_kunjungan" required="required">

								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Tujuan Kunjungan *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" name="tujuan_kunjungan" id="tujuan_kunjungan" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Tanggal Mulai *</label>
								<div class="col-md-8 col-sm-12 col-xs-12 has-feedback">
									<input id="awal_kunjungan" name="awal_kunjungan" class="form-control has-feedback-right tanggal" value="<?=date('d-m-Y')?>" placeholder="tanggal awal (dd-mm-yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Tanggal Akhir *</label>
								<div class="col-md-8 col-sm-12 col-xs-12 has-feedback">
									<input id="akhir_kunjungan" name="akhir_kunjungan" class="form-control has-feedback-right tanggal" value="<?=date('d-m-Y')?>" placeholder="tanggal akhir (dd-mm-yyyy)" required="required">
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">Yang Membiayai *</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" id="pembiayaan_kunjungan" name="pembiayaan_kunjungan" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="label-control col-md-4 col-sm-12 col-xs-12">File (pdf)</label>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<input class="form-control" type="file" id="file_kunjungan" name="file_kunjungan">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="navbar-right">
							<div class="btn-group">
								<button type="button" id="btn-batal" class="btn btn-warning" data-dismiss="modal">Batal</button>
								<button type="button" id="btn-simpan-kunjungan" class="btn btn-success" >Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Modal kunjungan Luar Negeri -->
</div>