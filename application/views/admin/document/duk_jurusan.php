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
						<div class="row">
							<div class="x_panel">
								<div class="x_title">
									<h2>
										<a href="<?=base_url()?>">
											<i class="fa fa-home"></i>
										</a> \ 
										<a href="<?=base_url()?>pegawai/duk">
											Daftar Urut Kepangkatan (DUK) 
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
									<div class="form-horizontal col-md-6 col-sm-6 col-xs-12">
										<div class="row">
										<div class="row">
											<div class="form-group">
												<label class="label-control col-md-4 col-sm-12 col-xs-12">Jurusan</label>
												<div class="col-md-8 col-sm-12 col-xs-12">
													<select id="id_jurusan" name="nm_jurusan" class="form-control selectpicker">
														<option value="Semua">Semua</option>
														<?php
														foreach ($jurusan as $jurusan) {
															echo '<option value="' . $jurusan->id_jurusan . '">' . $jurusan->nm_jurusan . '</option>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
										</div>
									</div>
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
										<tbody id="tabel-body">
										</tbody>
									</table>
									<a id="cetak" href="<?=base_url()?>pegawai/cetak_duk_jurusan/Semua"><button id="btn-cetak-excel" class="btn btn-success">Cetak Excel</button></a>
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
			$('#tabel-data').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		true,
				"destroy": 		true,
				"lengthMenu": 	[ 25, 50, 75, 100 ],
				"sAjaxSource": 	'<?php echo base_url(); ?>pegawai/data_duk_jurusan/' + $('#id_jurusan').val(),
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
				// "columnDefs": 	[
				// 					{ className: "text-center", "targets": [0,8] },
				// 					{ width: 20, targets: 0},
				// 					{ width: 70, targets: 8}
				// 				],
				"fixedColumns": true
			});

			$('#id_jurusan').on('change',function(){
				$('#cetak').attr('href','<?=base_url()?>pegawai/cetak_duk_jurusan/'+ $(this).val());
				$('#tabel-data').DataTable({
					"bProcessing": 	true,
					"bAutoWidth": 	true,
					"bSort": 		true,
					"destroy": 		true,
					"lengthMenu": 	[ 25, 50, 75, 100 ],
					"sAjaxSource": 	'<?php echo base_url(); ?>pegawai/data_duk_jurusan/' + $(this).val(),
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
					// "columnDefs": 	[
					// 					{ className: "text-center", "targets": [0,8] },
					// 					{ width: 20, targets: 0},
					// 					{ width: 70, targets: 8}
					// 				],
					"fixedColumns": true
				});
			})
		});
	</script>
</body>
</html>
