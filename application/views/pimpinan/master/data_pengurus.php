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
									<a href="<?=base_url()?>pengurus">
										Data Pengurus
									</a>
								</h2>
								<ul class="nav navbar-right">
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
											<th>Foto</th>
											<th>NIP</th>
											<th>Nama Pegawai</th>
											<th>Hak Akses</th>
										</tr>
									</thead>
									<tbody id="tabel-body">
									</tbody>
								</table>
							</div>
						</div>

						<!-- Modal organisasi Luar Negeri -->
						<div class="modal fade" id="modal-pegawai">
							<form name="form-pilih" id="form-pilih">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<div class="modal-title">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<span><h2>Data Pegawai</h2></span>
											</div>
										</div>
										<div class="modal-body scroll_modal">
											<table id="tabel-pegawai" width="100%" class="table table-striped table-hover table-bordered dataTable">
												<thead>
													<tr>
														<th>Pilih</th>
														<th>NIP</th>
														<th>Nama Pegawai</th>
													</tr>
												</thead>

												<tbody id="body-pegawai">
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</form>
						</div>
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
				"sAjaxSource": 	'<?php echo base_url(); ?>pengurus/data',
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "foto"},
									{ "mData"	: "nip"},
									{ "mData"	: "nama"},
									{ "mData"	: "hak_akses"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,1] },
									{ width: 30, targets: 0},
									{ width: 100, targets: 1}
								],
				"fixedColumns": true
			});

			var tabel_pegawai = $('#tabel-pegawai').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		true,
				"bPage": 		true,
				"bInfo": 		true,
				"bPaginate": 	true,
				"bFilter": 		true,
				"sAjaxSource": 	'<?php echo base_url(); ?>pengurus/data_user',
				"aoColumns":	[
									{ "mData"	: "pilih"},
									{ "mData"	: "nip"},
									{ "mData"	: "nama"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0] },
									{ width: 100, targets: 0}
								],
				"fixedColumns": true
			});

			$('#btn-tambah').click(function(){
				$('#modal-pegawai').modal('show');
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
							url: 		'<?=base_url()?>'+'pengurus/hapus/' + kode,
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



			$('#tabel-pegawai').on('click', '#btn-pilih', function(){
				var kode 	= $(this).data('id');
				var nama 	= $(this).data('nama');
				swal({
					title: "Apakah anda yakin?",
					text: "Untuk memilih data : " + nama,
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Pilih",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'pengurus/pilih/' + kode,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									$('#modal-pegawai').modal('hide');
									tabel.api().ajax.reload();
									swal("PILIH!", "Pilih data sukses.", "success");
								}else{
									swal("ERROR", "Pilih data gagal.", "error");
								}
							},
							error: function(){
								swal("ERROR", "Pilih data gagal.", "error");
							}
						});
					} else {
						swal("Cancelled", "Pilih data dibatalkan.", "error");
					}
				});	
			});		});
	</script>
</body>
</html>
