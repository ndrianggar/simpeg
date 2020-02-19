<!DOCTYPE html>
<html>
<?php include(__DIR__ . "/../tittle.php"); ?>
<style type="text/css">
	tfoot input {
		width: 100%;
		padding: 3px;
		box-sizing: border-box;
	}

	tfoot {
		display: table-header-group;
	}
</style>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php include(__DIR__ . "/../sidebar.php"); ?>
			<?php include(__DIR__ . "/../top_nav.php"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="row">
							<div class="x_panel">
								<div class="x_title">
									<h2>
										<a href="<?=base_url()?>">
											<i class="fa fa-home"></i>
										</a> \ 
										<a href="<?=base_url()?>pegawai/duk">
											Daftar Urut Kepangkatan (DUK) - Pensiun dan Meninggal Dunia
										</a>
									</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li>
											<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table id="tabel-data" class="table table-bordered table-striped table-hover" style="font-size: 11px;">
										<thead>
											<tr>
												<th rowspan="2" class="text-center" style="vertical-align: middle;">NO</th>
												<th rowspan="2" class="text-center" style="vertical-align: middle;">NAMA</th>
												<th rowspan="2" class="text-center" style="vertical-align: middle;">NIP</th>
												<th colspan="2" class="text-center" style="vertical-align: middle;">PANGKAT</th>
												<th colspan="2" class="text-center" style="vertical-align: middle;">JABATAN</th>
												<th colspan="2" class="text-center" style="vertical-align: middle;">MK GOL</th>
												<th colspan="2" class="text-center" style="vertical-align: middle;">MK<br>SELURUHNYA</th>
												<th colspan="3" class="text-center" style="vertical-align: middle;">LATIHAN JABATAN</th>
												<th colspan="3" class="text-center" style="vertical-align: middle;">PENDIDIKAN</th>											
												<th rowspan="2" class="text-center" style="vertical-align: middle;">USIA<br>(THN)</th>
												<th rowspan="2" class="text-center" style="vertical-align: middle;">KET</th>
											</tr>
											<tr>
												<th class="text-center" style="vertical-align: middle;">GOL<br>RUANG</th>
												<th class="text-center" style="vertical-align: middle;">TMT</th>
												<th class="text-center" style="vertical-align: middle;">NAMA</th>
												<th class="text-center" style="vertical-align: middle;">TMT</th>
												<th class="text-center" style="vertical-align: middle;">THN</th>
												<th class="text-center" style="vertical-align: middle;">BLN</th>
												<th class="text-center" style="vertical-align: middle;">THN</th>
												<th class="text-center" style="vertical-align: middle;">BLN</th>
												<th class="text-center" style="vertical-align: middle;">NAMA</th>
												<th class="text-center" style="vertical-align: middle;">BLN/THN</th>
												<th class="text-center" style="vertical-align: middle;">JAM</th>
												<th class="text-center" style="vertical-align: middle;">NAMA</th>
												<th class="text-center" style="vertical-align: middle;">TAHUN<br>LULUS</th>
												<th class="text-center" style="vertical-align: middle;">TINGKAT<br>IJAZAH</th>
											</tr>
											<tr>
												<th class="text-center" style="vertical-align: middle;">1</th>
												<th class="text-center" style="vertical-align: middle;">2</th>
												<th class="text-center" style="vertical-align: middle;">3</th>
												<th class="text-center" style="vertical-align: middle;">4</th>
												<th class="text-center" style="vertical-align: middle;">5</th>
												<th class="text-center" style="vertical-align: middle;">6</th>
												<th class="text-center" style="vertical-align: middle;">7</th>
												<th class="text-center" style="vertical-align: middle;">8</th>
												<th class="text-center" style="vertical-align: middle;">9</th>
												<th class="text-center" style="vertical-align: middle;">10</th>
												<th class="text-center" style="vertical-align: middle;">11</th>
												<th class="text-center" style="vertical-align: middle;">12</th>
												<th class="text-center" style="vertical-align: middle;">13</th>
												<th class="text-center" style="vertical-align: middle;">14</th>
												<th class="text-center" style="vertical-align: middle;">15</th>
												<th class="text-center" style="vertical-align: middle;">16</th>
												<th class="text-center" style="vertical-align: middle;">17</th>
												<th class="text-center" style="vertical-align: middle;">18</th>
												<th class="text-center" style="vertical-align: middle;">19</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th class="text-center" style="vertical-align: middle;">1</th>
												<th class="text-center" style="vertical-align: middle;">2</th>
												<th class="text-center" style="vertical-align: middle;">3</th>
												<th class="text-center" style="vertical-align: middle;">4</th>
												<th class="text-center" style="vertical-align: middle;">5</th>
												<th class="text-center" style="vertical-align: middle;">6</th>
												<th class="text-center" style="vertical-align: middle;">7</th>
												<th class="text-center" style="vertical-align: middle;">8</th>
												<th class="text-center" style="vertical-align: middle;">9</th>
												<th class="text-center" style="vertical-align: middle;">10</th>
												<th class="text-center" style="vertical-align: middle;">11</th>
												<th class="text-center" style="vertical-align: middle;">12</th>
												<th class="text-center" style="vertical-align: middle;">13</th>
												<th class="text-center" style="vertical-align: middle;">14</th>
												<th class="text-center" style="vertical-align: middle;">15</th>
												<th class="text-center" style="vertical-align: middle;">16</th>
												<th class="text-center" style="vertical-align: middle;">17</th>
												<th class="text-center" style="vertical-align: middle;">18</th>
												<th class="text-center" style="vertical-align: middle;">19</th>
											</tr>
										</tfoot>
										<tbody id="tabel-body">
										</tbody>
									</table>
									<a id="cetak" href="<?=base_url()?>pegawai/cetak_duk_pensiun"><button id="btn-cetak-excel" class="btn btn-success">Cetak Excel</button></a>
								</div>
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
			$('#tabel-data tfoot th').each( function () {
				var title = $(this).text();
				$(this).html( '<input type="text" placeholder="Search ' + title + '" />' );
			} );

			var tabel = $('#tabel-data').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		true,
				"destroy": 		true,
				"lengthMenu": 	[ 25, 50, 75, 100 ],
				"sAjaxSource": 	'<?php echo base_url(); ?>pegawai/data_duk_pensiun',
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "nama"},
									{ "mData"	: "nip_baru"},
									{ "mData"	: "gol_pangkat"},
									{ "mData"	: "tmt_pangkat"},
									{ "mData"	: "nama_jabatan"},
									{ "mData"	: "tmt_jabatan"},
									{ "mData"	: "tahun_pangkat"},
									{ "mData"	: "bulan_pangkat"},
									{ "mData"	: "tahun_mk"},
									{ "mData"	: "bulan_mk"},
									{ "mData"	: "nama_latihan"},
									{ "mData"	: "tahun_latihan"},
									{ "mData"	: "jam_latihan"},
									{ "mData"	: "nama_pend"},
									{ "mData"	: "tahun_pend"},
									{ "mData"	: "jenjang_pend"},
									{ "mData"	: "usia"},
									{ "mData"	: "keterangan"}
								],
				"fixedColumns": true
			});
			
			// Apply the search
			tabel.columns().every( function () {
				var that = this;
 
				$( 'input', this.footer() ).on( 'keyup change', function () {
					if ( that.search() !== this.value ) {
						that
						.search( this.value )
						.draw();
					}
				} );
			} );
		});
	</script>
</body>
</html>
