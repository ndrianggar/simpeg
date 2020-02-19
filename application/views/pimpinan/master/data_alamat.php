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
									<a href="">
										Data Provinsi
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
											<th>Nama Provinsi</th>
											<th>Detail</th>
										</tr>
									</thead>
									<tbody id="tabel-body">
									</tbody>
								</table>
							</div>
						</div>
					
						<!-- Tampilan "model-tambah" -->
						<div class="modal fade" id="modal-tambah">
							<form id="form-tambah" method="POST" action="<?=base_url()?>alamat/tambah_propinsi/">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">×</button>
											<h4 class="modal-title">Tambah Data</h4>
										</div>
										<div class="modal-body">
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Propinsi</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="id" name="id" type="hidden">
														<input id="nama_propinsi" name="nama_propinsi" class="required form-control" placeholder="Nama Propinsi" type="text">
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
				"sAjaxSource": 	'<?php echo base_url(); ?>alamat/data',
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "nama"},
									{ "mData"	: "detail"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,2] },
									{ width: 30, targets: 0},
									{ width: 50, targets: 2}
									
								],
				"fixedColumns": true
			});

			$('#tabel-body').on('click', '#btn-detail', function(){
				var kode 	= $(this).data('kd');
				var url = "<?=base_url()?>alamat/detail/"+kode;
				window.location.href = url;
			});

			$('#btn-tambah').click(function(){
				$('#form-tambah').attr('action','<?=base_url()?>alamat/tambah_propinsi');
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
				$('#form-tambah').attr('action','<?=base_url()?>alamat/edit_propinsi');
				$('#id').val($(this).data('kd'));
				$('#nama_propinsi').val($(this).data('nama'));
				$('#modal-tambah').modal('show');
			});


			$('#tabel-body').on('click', '#btn-hapus', function(){
				var kode 	= $(this).data('kd');
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
							url: 		'<?=base_url()?>'+'alamat/hapus_propinsi/' + kode,
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
