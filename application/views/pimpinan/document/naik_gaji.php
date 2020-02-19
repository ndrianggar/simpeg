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
									<a href="<?=base_url()?>gaji">
										Data Pengajuan Kenaikan Gaji Berkala
									</a>
								</h2>
								<ul class="nav navbar-right panel_toolbox">
									<li>
										<a href="<?=base_url()?>gaji/form_tambah">
											<button type="button" id="btn-tambah" class="btn btn-primary">Tambah</button>
										</a>
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
											<th>Nomor Surat</th>
											<th>Tanggal</th>
											<th>Nama Pegawai</th>
											<th>Pangkat</th>
											<th>Jabatan</th>
											<th>Gaji Pokok</th>
											<th>Gaji Pokok Baru</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="tabel-body">
									</tbody>
								</table>
							</div>
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
				"sAjaxSource": 	'<?php echo base_url(); ?>gaji/data',
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "nomor_surat"},
									{ "mData"	: "tanggal"},
									{ "mData"	: "nama"},
									{ "mData"	: "pangkat"},
									{ "mData"	: "jabatan"},
									{ "mData"	: "gaji_pokok"},
									{ "mData"	: "gaji_baru"},
									{ "mData"	: "action_pimpinan"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,8] },
									{ width: 30, targets: 0},
									{ width: 70, targets: 8}
								],
				"fixedColumns": true
			});

			$('#btn-tambah').click(function() {
				// $('.modal-title').html('Tambah Data');
				// $('#form-tambah').attr('action','<?=base_url()?>pegawai/tambah');
				// $('#form-tambah')[0].reset();
				// $('#modal-tambah').modal('show');
				// $('#kode_pegawai').focus();
				// $('#kode_pegawai').select();
				var url = "<?=base_url()?>gaji/form_tambah/";
				window.location.href = url;
			});


			$('#tabel-body').on('click', '#btn-hapus', function(){
				var kode 		= $(this).data('kode');
				var nama 	= $(this).data('nama');
				swal({
					title: "Apakah anda yakin?",
					text: "Untuk menghapus data : " + kode + " - " + nama,
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
							url: 		'<?=base_url()?>'+'gaji/hapus/' + kode,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel.ajax.reload();
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


			$('#tabel-body').on('click', '#btn-ubah', function(){
				var kode 	= $(this).data('kode');
				var url = "<?=base_url()?>gaji/form_edit/" + kode;
				window.location.href = url;

			});


			$('#tabel-body').on('click', '#btn-pdf', function(){
				var kode 	= $(this).data('kode');
				var url = "<?=base_url()?>gaji/cetak_pdf/" + kode;
				window.open(url,'_blank');

			});

		});
	</script>
</body>
</html>
