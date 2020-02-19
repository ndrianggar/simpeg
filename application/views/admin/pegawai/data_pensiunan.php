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
									<a href="<?=base_url()?>pensiunan">
										Data Pegawai Pensiun
									</a>
								</h2>
								<ul class="nav navbar-right panel_toolbox">
									<li>
										<button id="btn-tambah" class="btn btn-primary">Tambah</button>
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
											<th>Foto</th>
											<th>Biodata Pegawai</th>
											<th>Keterangan</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="tabel-body">
									</tbody>
								</table>
							</div>
						</div>

						<!-- modal tambah/edit -->
						<div class="modal fade" id="modal-tambah">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<form name="form-tambah" id="form-tambah" method="POST" action="<?=base_url()?>pensiunan/tambah">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">×</button>
											<h4 class="modal-title">Tambah Data</h4>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="row">
													<div class="row">
														<div class="col-md-12 col-sm-12 col-xs-12">
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-horizontal">
																	<div class="form-group">
																		<label class="control-label col-md-4 col-sm-4 col-xs-12">NIP Pegawai</label>
																		<div class="col-md-8 col-sm-8 col-xs-12">
																			<input id="id_pegawai" name="id_pegawai" class=" form-control" type="hidden">
																			<select id="nip" name="nip" class="form-control selectpicker" data-live-search="true" title="-- Pilih NIP Pegawai --">
																				<?php 
																					foreach ($nip as $nip) {
																						echo '<option value="' . $nip->id_pegawai . '">'. $nip->kd_pegawai .'</option>';
																					}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Pegawai</label>
																		<div class="col-md-8 col-sm-8 col-xs-12">
																			<input id="nama_pegawai" name="nama_pegawai" class=" form-control" placeholder="Nama Pegawai" type="text">
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-4 col-sm-4 col-xs-12 control-label">Pangkat</label>
																		<div class="col-md-8 col-sm-8 col-xs-12">
																			<input id="pangkat" name="pangkat" class=" form-control" placeholder="Pangkat" type="text">
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-4 col-sm-4 col-xs-12 control-label">Golongan</label>
																		<div class="col-md-8 col-sm-8 col-xs-12">
																			<input id="golongan" name="golongan" class=" form-control" placeholder="Golongan" type="text">
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-4 col-sm-4 col-xs-12 control-label">Jabatan</label>
																		<div class="col-md-8 col-sm-8 col-xs-12">
																			<input id="jabatan" name="jabatan" class=" form-control" placeholder="Jabatan" type="text">
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-4 col-sm-4 col-xs-12 control-label">Penempatan</label>
																		<div class="col-md-8 col-sm-8 col-xs-12">
																			<input id="penempatan" name="penempatan" class=" form-control" placeholder="Penempatan" type="text">
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-4 col-sm-4 col-xs-12 control-label">JurBagSatPusNit</label>
																		<div class="col-md-8 col-sm-8 col-xs-12">
																			<input id="jurusan" name="jurusan" class=" form-control" placeholder="JurBagSatPusNit" type="text">
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-4 col-sm-4 col-xs-12 control-label">ProdiSubDiv</label>
																		<div class="col-md-8 col-sm-8 col-xs-12">
																			<input id="prodi" name="prodi" class=" form-control" placeholder="ProdiSubDiv" type="text">
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-horizontal">
																	<div class="form-group ">
																		<label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Pensiun</label>
																		<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
																			<input id="tanggal_pensiunan" name="tanggal_pensiunan" class="form-control has-feedback-right tanggal" placeholder="Tanggal Pensiun (dd-mm-yyyy)">
																			<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
																		</div>
																	</div>
																	<div class="form-group ">
																		<label class="control-label col-md-4 col-sm-4 col-xs-12">SK Pensiun</label>
																		<div class="col-md-8 col-sm-8 col-xs-12">
																			<input id="sk_pensiunan" name="sk_pensiunan" class="form-control" placeholder="SK Pensiun">
																		</div>
																	</div>
																	<div class="form-group ">
																		<label class="control-label col-md-4 col-sm-4 col-xs-12">File Pensiun</label>
																		<div class="col-md-8 col-sm-8 col-xs-12">
																			<input id="file_pensiunan" name="file_pensiunan" class="form-control" type="File" accept="application/pdf">
																		</div>
																	</div>
																	<div class="form-group ">
																		<label class="control-label col-md-4 col-sm-4 col-xs-12">Keterangan </label>
																		<div class="col-md-8 col-sm-8 col-xs-12">
																			<textarea id="keterangan" name="keterangan" class="form-control" rows="4" placeholder="Keterangan"></textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<div class="navbar-right">
												<div class="btn-group">
													<button type="button" id="btn-batal" class="btn btn-warning" data-dismiss="modal">Batal</button>
													<button type="button" id="tambah-simpan" class="btn btn-success">Simpan</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- /modal tambah/edit -->
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

			var tabel = $('#tabel-data').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"lengthMenu": 	[ 25, 50, 75, 100 ],
				"sAjaxSource": 	'<?php echo base_url(); ?>pensiunan/data/',
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "foto"},
									{ "mData"	: "nama"},
									{ "mData"	: "keterangan"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,1,4] },
									{ width: 30, targets: 0},
									{ width: 100, targets: 1},
									{ width: 50, targets: 4}
								],
				"fixedColumns": true
			});


			$('#btn-tambah').click(function() {
				$('#form-tambah').attr('action','<?=base_url()?>pensiunan/tambah');
				$('.modal-title').html('Tambah Data');
				$('#form-tambah')[0].reset();
				$('#modal-tambah').modal('show');
			});
			
			$('#tabel-body').on('click', '#btn-edit', function(){
				$('.modal-title').html('Ubah Data');
				$('#form-tambah').attr('action','<?=base_url()?>pensiunan/tambah');
				$('#nama_pegawai').val($(this).data('nama'));
				$('#id_pegawai').val($(this).data('id'));
				$('#pangkat').val($(this).data('pangkat'));
				$('#jabatan').val($(this).data('jabatan'));
				$('#golongan').val($(this).data('golongan'));
				$('#penempatan').val($(this).data('penempatan'));
				$('#jurusan').val($(this).data('jurusan'));
				$('#prodi').val($(this).data('prodi'));
				$('#tanggal_pensiunan').val($(this).data('tgl'));
				var tanggal_pensiunan = $(this).data('tgl');
				$('#tanggal_pensiunan').datepicker('update', tanggal_pensiunan);
				$('#sk_pensiunan').val($(this).data('sk'));
				$('#keterangan').val($(this).data('keterangan'));
				$('#modal-tambah').modal('show');
			});

			$('#tambah-simpan').click(function() {
				$('#tambah-simpan').attr('disabled','disabled');
				$('#form-tambah').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							tabel.ajax.reload();
							swal($('.modal-title').html() + ' Sukses');
							$('#modal-tambah').modal('hide');
							$('#tambah-simpan').removeAttr('disabled');
							$('#form-tambah')[0].reset();
						}else{
							swal($('.modal-title').html() + ' Gagal');
						}
					},
					error: function(){
						swal('ERROR : function(response)');
					}
				}).submit();
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
							url: 		'<?=base_url()?>'+'pegawai/hapus/' + kode,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response.success){
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

			$('#nip').on('change',function(){
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					dataType: 	'json',
					url: 		'<?=base_url()?>'+'pensiunan/data_pensiunan/' + $('#nip').val() ,
					async: 		true,
					success: 	function(response){
						$('#nama_pegawai').val(response.nm_pegawai);
						$('#id_pegawai').val(response.id_pegawai);
						$('#pangkat').val(response.nm_pangkat);
						$('#jabatan').val(response.nm_jabatan);
						$('#prodi').val(response.nm_prodi);
						$('#jurusan').val(response.nm_jurusan);
						$('#golongan').val(response.gol_pangkat);
						$('#penempatan').val(response.nm_penempatan);
					},
					error: function(){
						swal("Error");
					}
				});
			});

			// $('#tabel-body').on('click', '#btn-edit', function(){
			// 	var kode =	$(this).data('id');
			// 	var url = "<?=base_url()?>pegawai/form_edit/" + kode;
			// 	window.location.href = url;
			// });

			// $('#tabel-body').on('click','#btn-terima-edit',function(){
			// 	var kd 		= $(this).data('id');
			// 	var url = "<?=base_url()?>pegawai/form_terima_edit/" + kd;
			// 	window.location.href = url;
			// });

			// $('#tabel-body').on('click','#btn-tolak-edit',function(){
			// 	var kd 		= $(this).data('id');
			// 	var pegawai = $(this).data('id');
			// 	swal({
			// 		title: "Tolak Pengajuan Edit Data?",
			// 		type: "info",
			// 		showCancelButton: true,
			// 		confirmButtonColor: "#DD6B55",
			// 		confirmButtonText: "Tolak",
			// 		cancelButtonText: "Cancel",
			// 		closeOnConfirm: false,
			// 		closeOnCancel: false
			// 	},
			// 	function(isConfirm){
			// 		if (isConfirm) {
			// 			$.ajax({
			// 				type: 		'ajax',
			// 				method: 	'post',
			// 				url: 		'<?=base_url()?>'+'pegawai/tolak_edit/' + kd + '/' + pegawai,
			// 				async: 		true,
			// 				dataType: 	'json',
			// 				success: 	function(response){
			// 					if(response==true){
			// 						tabel.ajax.reload();
			// 						swal("Sukses");
			// 					}else{
			// 						swal("Gagal");
			// 					}
			// 				},
			// 				error: function(){
			// 					swal("Error");
			// 				}
			// 			});
			// 		} else {
			// 			swal("Cancelled");
			// 		}
			// 	});	
			// });

		});
	</script>
</body>
</html>
