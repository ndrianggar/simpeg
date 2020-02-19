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
									<a href="<?=base_url()?>prodi">
										Data ProdiSubdiv
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
											<th>No</th>
											<th>JurBagSatPusNit</th>
											<th>Kode ProdiSubdiv</th>
											<th>Nama ProdiSubdiv</th>
											<th>Alias ProdiSubdiv</th>
											<th>Jenjang Pendidikan</th>
											<!-- <th>Action</th> -->
										</tr>
									</thead>
									<tbody id="tabel-body">
									</tbody>
								</table>
							</div>
						</div>
					
						<!-- Tampilan "model-tambah" -->
						<div class="modal fade" id="modal-tambah">
							<form id="form-tambah" method="POST" action="<?=base_url()?>prodi/tambah/">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">×</button>
											<h4 class="modal-title">Tambah Data</h4>
										</div>
										<div class="modal-body">
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">JurBagSatPusNit</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<select id="tambah-jurusan" name="tambah-jurusan" class="form-control selectpicker" data-live-search="true">
															<option value="0">-- Pilih JurBagSatPusNit --</option>
															<?php
																foreach ($jurusan as $jurusan) {
															?>	
															<option value="<?=$jurusan->id_jurusan?>"><?=$jurusan->nm_jurusan?></option>
															<?php
																}
															?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Kode ProdiSubdiv</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="tambah-id" name="tambah-id" type="hidden">
														<input id="tambah-kode" name="tambah-kode" class="required form-control" placeholder="Kode ProdiSubdiv" type="text">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama ProdiSubdiv</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="tambah-nama" name="tambah-nama" class="required form-control" placeholder="Nama ProdiSubdiv" type="text">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Alias ProdiSubdiv</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="tambah-alias" name="tambah-alias" class="required form-control" placeholder="Alias ProdiSubdiv" type="text">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Jenjang Pendidikan</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<select id="tambah-jenjang" name="tambah-jenjang"  class="form-control selectpicker" data-live-search="true">
															<option value="0">-- Pilih Jenjang Pendidikan --</option>
															<?php
																foreach ($jenjang as $jenjang) {
															?>	
															<option value="<?=$jenjang->id_jenjang?>"><?=$jenjang->nm_jenjang?></option>
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
				"sAjaxSource": 	'<?php echo base_url(); ?>prodi/data',
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "jurusan"},
									{ "mData"	: "kode"},
									{ "mData"	: "nama"},
									{ "mData"	: "alias"},
									{ "mData"	: "jenjang"}
									// { "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0] },
									{ width: 30, targets: 0}
									// { width: 50, targets: 6}
								],
				"fixedColumns": true
			});

			$('#modal-tambah').on('shown.bs.modal', function () {
				$('.chosen-select').chosen('destroy').chosen();
			});

			$('#btn-tambah').click(function(){
				$('#form-tambah').attr('action','<?=base_url()?>prodi/tambah');
				$('.modal-title').html('Tambah data');
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
				$('#form-tambah').attr('action','<?=base_url()?>prodi/edit');
				$('#tambah-id').val($(this).data('id'));
				$('#tambah-kode').val($(this).data('kode'));
				$('#tambah-nama').val($(this).data('nama'));
				$('#tambah-alias').val($(this).data('alias'));
				$('#tambah-jurusan').val($(this).data('jurusan'));
				$('#tambah-jenjang').val($(this).data('jenjang'));
				$('#modal-tambah').modal('show');
			});

			$('#tabel-body').on('click', '#btn-hapus', function(){
				var kode 	= $(this).data('id');
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
							url: 		'<?=base_url()?>'+'prodi/hapus/' + kode,
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
