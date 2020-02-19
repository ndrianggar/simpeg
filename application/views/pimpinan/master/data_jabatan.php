<!DOCTYPE html>
<html>
<?php include(__DIR__ . "/../tittle.php"); ?>
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
									<a href="<?=base_url()?>jabatan">
										Data Jabatan
									</a>
								</h2>
								<ul class="nav navbar-right">
									<li>
										<!-- <button type="button" id="btn-tambah" class="btn btn-primary">Tambah</button> -->
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
								<table id="tabel-data" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="text-center" style="vertical-align: middle;">No</th>
											<th class="text-center" style="vertical-align: middle;">Jenis Jabatan</th>
											<th class="text-center" style="vertical-align: middle;">Nama Jabatan</th>
											<th class="text-center" style="vertical-align: middle;">Nama Eselon</th>
											<th class="text-center" style="vertical-align: middle;">Kelas Jabatan</th>
											<th class="text-center" style="vertical-align: middle;">Tunjangan</th>
											<th class="text-center" style="vertical-align: middle;">Dasar Tunjangan</th>
										</tr>
									</thead>
									<tbody id="tabel-body">
									</tbody>
								</table>
							</div>
						</div>
					
						<!-- Tampilan "model-tambah" -->
						<div class="modal fade" id="modal-tambah">
							<form id="form-tambah" data-parsley-validate method="POST" action="<?=base_url()?>jabatan/tambah/">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">×</button>
											<h4 class="modal-title">Tambah Data</h4>
										</div>
										<div class="modal-body">
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Jenis Jabatan *</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="tambah-kode" name="tambah-kode" type="hidden">
														<select id="tambah-jenis" name="tambah-jenis"  class="form-control selectpicker" data-live-search="true" required="required">
															<?php
																foreach ($jenis as $jenis) {
															?>	
															<option value="<?=$jenis->kd_jenis?>"><?=$jenis->nm_jenis?></option>
															<?php
																}
															?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Jabatan *</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="tambah-nama" name="tambah-nama" class="required form-control" placeholder="Nama Jabatan" required="required">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Eselon</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<select id="tambah-eselon" name="tambah-eselon"  class="form-control selectpicker" data-live-search="true">
															<?php
																foreach ($eselon as $eselon) {
															?>	
															<option value="<?=$eselon->kd_eselon?>"><?=$eselon->nm_eselon?></option>
															<?php
																}
															?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Kelas Jabatan *</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="tambah-kelas" name="tambah-kelas" type="number" class="required form-control angka_saja" placeholder="Kelas Jabatan" type="number" required="required" style="text-align: right;">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Tunjangan Jabatan *</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="tunjangan" name="tunjangan" type="number" class="required form-control ribuan" placeholder="Tunjangan Jabatan" type="number" required="required" style="text-align: right;">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Dasar Peraturan</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<select id="peraturan" name="peraturan"  class="form-control selectpicker" data-live-search="true">
															<?php
																foreach ($peraturan as $peraturan) {
															?>	
															<option value="<?=$peraturan->kd_peraturan?>"><?=$peraturan->nm_peraturan?></option>
															<?php
																}
															?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<div class="btn-group">
												<button data-dismiss="modal" class="btn btn-warning" type="button">Batal</button>
												<button id="tambah-simpan" class="btn btn-success" type="button">Simpan</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- Tampilan "model-tambah" -->
					</div>
				</div>
			</div>
			<!-- /page content -->

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
	<?php include(__DIR__ . "/../load_js.php"); ?>

	<script>
		$(document).ready(function(){
			var tabel = $('#tabel-data').dataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"lengthMenu": 	[ 25, 50, 75, 100 ],
				"sAjaxSource": 	'<?php echo base_url(); ?>jabatan/data',
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "jenis"},
									{ "mData"	: "nama"},
									{ "mData"	: "eselon"},
									{ "mData"	: "kelas"},
									{ "mData"	: "tunjangan"},
									{ "mData"	: "dasar"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0] },
									{ className: "text-right", "targets": [4,5] },
									{ width: 30, targets: 0}
									
								],
				"fixedColumns": true
			});

			$('#modal-tambah').on('shown.bs.modal', function () {
				$('.chosen-select').chosen('destroy').chosen();
			});

			$('#btn-tambah').click(function(){
				$('#form-tambah').attr('action','<?=base_url()?>jabatan/tambah');
				$('.modal-title').html('Tambah data');
				$('#form-tambah')[0].reset();
				$('#modal-tambah').modal('show');
			});

			$('#tambah-simpan').click(function() {
				$('#form-tambah').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							tabel.api().ajax.reload();
							swal($('.modal-title').html() + ' Sukses');
							$('#form-tambah')[0].reset();
							$('#modal-tambah').modal('hide');
						}else{
							swal($('.modal-title').html() + ' Gagal');
						}
					},
					error: function(){
						swal('ERROR : function(response)');
					}
				}).submit();
			});

			$('#tabel-body').on('click', '#btn-ubah', function(){
				$('.modal-title').html('Ubah Data');
				$('#form-tambah').attr('action','<?=base_url()?>jabatan/edit');
				$('#tambah-kode').val($(this).data('kode'));
				$('#tambah-jenis').val($(this).data('jenis'));
				$('#tambah-nama').val($(this).data('nama'));
				$('#tambah-eselon').val($(this).data('eselon'));
				$('#tambah-kelas').val($(this).data('kelas'));
				$('#tunjangan').val($(this).data('tunjangan'));
				$('#peraturan').val($(this).data('peraturan'));
				$('#modal-tambah').modal('show');
			});

			$('#tabel-body').on('click', '#btn-hapus', function(){
				var kode 	= $(this).data('kode');
				var nama 	= $(this).data('nama');
				swal({
					title: "Apakah anda yakin?",
					text: "Untuk menghapus data : " + nama,
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Delete",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'jabatan/hapus/' + kode,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel.api().ajax.reload();
									swal("Deleted!", "Hapus data sukses.", "success");
								}else{
									swal("ERROR", "Hapus data gagal.", "error");
								}
							},
							error: function(){
								swal("ERROR", "Hapus data gagal.", "error");
							}
						});
					} else {
						swal("Cancelled", "Hapus data dibatalkan.", "error");
					}
				});	
			});
		});
	</script>
</body>
</html>
