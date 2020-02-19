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
									<a href="<?=base_url()?>riwayat_singkat">
										Daftar Riwayat Hidup Singkat
									</a>
								</h2>
								<ul class="nav navbar-right panel_toolbox">
									<li>
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
											<th>NIP</th>
											<th>Nama Pegawai</th>
											<th>Status</th>
											<th>Jenis</th>
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
				"sAjaxSource": 	'<?php echo base_url(); ?>riwayat_singkat/data',
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "nip"},
									{ "mData"	: "nama"},
									{ "mData"	: "status"},
									{ "mData"	: "jenis"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,5] },
									{ width: 30, targets: 0},
									{ width: 30, targets: 5}
								],
				"fixedColumns": true
			});


			$('#tabel-body').on('click', '#btn-cetak', function(){
				var kode 	= $(this).data('id');
				var url = "<?=base_url()?>riwayat_singkat/cetak/" + kode;
				window.open(url,'_blank');

			});

		});
	</script>
</body>
</html>
