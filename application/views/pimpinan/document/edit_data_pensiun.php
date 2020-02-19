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
									<a href="<?=base_url()?>pensiun">
										Data Pensiun
									</a> \ 
									<a href="#">
										Edit Data Pensiun
									</a>
								</h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<form name="form-tambah" id="form-tambah" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="<?=base_url()?>pensiun/edit">
									<?php foreach ($data_pensiun as $row) { 
										$tujuan_a = $row->tujuan_pensiun;
										$pembukaan_a = $row->pembukaan_pensiun;
									    $lampiran_a = $row->lampiran_pensiun;
										$penutup_a = $row->penutup_pensiun;
										$tembusan_a = $row->tembusan_pensiun;
										$breaks = array("<br />","<br>","<br/>");  
									    $tujuan = str_ireplace($breaks, "", $tujuan_a);  
										$pembukaan = str_ireplace($breaks, "", $pembukaan_a);  
										$lampiran = str_ireplace($breaks, "", $lampiran_a);  
										$penutup = str_ireplace($breaks, "", $penutup_a);  
										$tembusan = str_ireplace($breaks, "", $tembusan_a);  
										?>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Nomor Surat</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input id="kd_pensiun" name="kd_pensiun" class="form-control"  type="hidden" value="<?php echo $row->kd_pensiun; ?>" >
													<input id="nomor_pensiun" name="nomor_pensiun" class="form-control" placeholder="Nomor Surat" required="required" value="<?php echo $row->nomor_pensiun; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Perihal Surat</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input id="perihal_pensiun" name="perihal_pensiun" class="form-control" placeholder="Perihal Surat" required="required" value="<?php echo $row->perihal_pensiun; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Tanggal</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input id="tanggal_pensiun" name="tanggal_pensiun" class="form-control" placeholder="Tanggal" value="<?php echo $row->tanggal_pensiun; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Nama Pegawai</label>
												<div class="col-md-9 col-sm-9 col-xs-12 has-feedback">
													<input id="id_pegawai" name="id_pegawai" class="form-control" type="hidden" value="<?php echo $row->id_pegawai; ?>">
													<input id="nama_pegawai" name="nama_pegawai" class="form-control has-feedback-right" placeholder="Nama Pegawai" value="<?php echo $row->nm_pegawai; ?>">
													<span class="fa fa-search form-control-feedback right" aria-hidden="true" id="cari_pegawai"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">NIP</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input id="nip_pensiun" name="nip_pensiun" class="form-control" placeholder="NIP Pegawai" value="<?php echo $row->nip_baru; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Pangkat</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<select class="form-control selectpicker" data-live-search="true" name="pangkat_pensiun" id="pangkat_pensiun">
													<?php foreach ($pangkat as $row1) { 
														if (($row0->kd_pangkat)==($row1->kd_pangkat)) { ?>
															<option value="<?=$row1->kd_pangkat?>" selected><?=$row1->nm_pangkat?></option>
														<?php } else { ?>
															<option value="<?=$row1->kd_pangkat?>"><?=$row1->nm_pangkat?></option>
													<?php
														}
													} 
													?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Jabatan</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<select class="form-control selectpicker" data-live-search="true" name="jabatan_pensiun" id="jabatan_pensiun">
													<?php foreach ($jabatan as $row2) { 
														if (($row0->kd_jabatan)==($row2->kd_jabatan)) { ?>
															<option value="<?=$row2->kd_jabatan?>" selected><?=$row2->nm_jabatan?></option>
														<?php } else { ?>
															<option value="<?=$row2->kd_jabatan?>"><?=$row2->nm_jabatan?></option>
													<?php
														}
													} 
													?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Penempatan</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input id="penempatan_pensiun" name="penempatan_pensiun" class="form-control" placeholder="Penempatan" value="<?php echo $row->penempatan_pensiun; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Penandatangan</label>
												<div class="col-md-9 col-sm-9 col-xs-12 has-feedback">
													<input id="penandatangan_pegawai" name="penandatangan_pegawai" class="form-control" type="hidden" value="<?php echo $row->penandatangan_pensiun; ?>">
													<input id="nama_penandatangan" name="nama_penandatangan" class="form-control has-feedback-right" placeholder="Nama Penandatangan" value="<?php echo $row->nama; ?>">
													<span class="fa fa-search form-control-feedback right" aria-hidden="true" id="cari_penandatangan"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Jabatan</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<select class="form-control selectpicker" data-live-search="true" name="jabatan_penandatangan_pensiun" id="jabatan_penandatangan_pensiun">
													<?php foreach ($jabatan2 as $row3) { 
														if (($row0->kd_jabatan)==($row3->kd_jabatan)) { ?>
															<option value="<?=$row3->kd_jabatan?>" selected><?=$row3->nm_jabatan?></option>
														<?php } else { ?>
															<option value="<?=$row3->kd_jabatan?>"><?=$row3->nm_jabatan?></option>
													<?php
														}
													} 
													?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Tujuan Pensiun</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<textarea id="tujuan_pensiun" name="tujuan_pensiun" class="form-control" rows="3" placeholder="Tujuan Pensiun" value=""><?=$tujuan?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Pembukaan Pensiun</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<textarea id="pembukaan_pensiun" name="pembukaan_pensiun" class="form-control" rows="3" placeholder="Pembukaan Pensiun" value=""><?=$pembukaan?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Lampiran Pensiun</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<textarea id="lampiran_pensiun" name="lampiran_pensiun" class="form-control" rows="7" placeholder="Lampiran Pensiun" value=""><?=$lampiran?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Penutup</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<textarea id="penutup_pensiun" name="penutup_pensiun" class="form-control" rows="3" placeholder="Penutup" value=""><?=$penutup?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 col-sm-3 col-xs-12 label-control">Tembusan</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<textarea id="tembusan_pensiun" name="tembusan_pensiun" class="form-control" rows="5" placeholder="Tembusan" value=""><?=$tembusan?></textarea>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="btn-group">
												<button type="button" id="btn-prev" class="btn btn-danger">Preview</button>
												<button type="submit" id="btn-simpan" class="btn btn-success">Simpan</button>
												<button type="reset" id="btn-batal" class="btn btn-warning">Batal</button>
											</div>
										</div>
									</div>
									<?php } ?>
								</form>
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
									<th>Kode</th>
									<th>Nama Pegawai</th>
									<th>NIP</th>
									<th>Pangkat</th>
									<th>Jabatan</th>
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
	<div class="modal fade" id="modal-pegawai2">
		<form name="form-pilih2" id="form-pilih2">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<span><h2>Data Pegawai</h2></span>
						</div>
					</div>
					<div class="modal-body scroll_modal">
						<table id="tabel-pegawai2" width="100%" class="table table-striped table-hover table-bordered dataTable">
							<thead>
								<tr>
									<th>Pilih</th>
									<th>Kode</th>
									<th>Nama Pegawai</th>
									<th>Jabatan</th>
								</tr>
							</thead>

							<tbody id="body-pegawai2">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- Modal organisasi Luar Negeri -->
	<?php include(__DIR__ . "/../load_js.php"); ?>
	<script>
		$(document).ready(function(){
			$('.tanggal').datepicker({
				format : "dd-mm-yyyy",
				autoclose : true
			});
			$('#tanggal_pensiun').datepicker({
				format : "dd-mm-yyyy",
				autoclose : true
			});

			$('#nama_pegawai').click(function(){
				$('#modal-pegawai').modal('show');
			});
			$('#nama_pegawai').on('focus', function(){
				$('#modal-pegawai').modal('show');
			});

			$('#cari_pegawai').click(function(){
				$('#modal-pegawai').modal('show');
			});

			$('#nama_penandatangan').click(function(){
				$('#modal-pegawai2').modal('show');
			});
			$('#nama_penandatangan').on('focus', function(){
				$('#modal-pegawai2').modal('show');
			});

			$('#cari_penandatangan').click(function(){
				$('#modal-pegawai2').modal('show');
			});

			var tabel_pegawai = $('#tabel-pegawai').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bPage": 		false,
				"bInfo": 		false,
				"bPaginate": 	false,
				"bFilter": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>pensiun/data_pilih',
				"aoColumns":	[
									{ "mData"	: "pilih"},
									{ "mData"	: "id"},
									{ "mData"	: "nama"},
									{ "mData"	: "nip"},
									{ "mData"	: "pangkat"},
									{ "mData"	: "jabatan"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0] },
									{ width: 50, targets: 0}
								],
				"fixedColumns": true
			});

			var tabel_pegawai = $('#tabel-pegawai2').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bPage": 		false,
				"bInfo": 		false,
				"bPaginate": 	false,
				"bFilter": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>pensiun/data_pilih2',
				"aoColumns":	[
									{ "mData"	: "pilih"},
									{ "mData"	: "id"},
									{ "mData"	: "nama"},
									{ "mData"	: "jabatan"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0] },
									{ width: 50, targets: 0}
								],
				"fixedColumns": true
			});
			$('#btn-batal').on('click', function(){
				var url = "<?=base_url()?>pensiun/";
				window.location.href = url;

			});

			$('#btn-simpan').click(function() {
				$('#form-tambah').attr('target','');
				$('#form-tambah').attr('action','<?=base_url()?>pensiun/edit').submit();
				$('#form-tambah').attr('target','_blank');
				$('#form-tambah').attr('action','<?=base_url()?>pensiun/data_prev').submit();
			});

			$('#btn-prev').click(function() {
				$('#form-tambah').attr('target','_blank');
				$('#form-tambah').attr('action','<?=base_url()?>pensiun/data_prev').submit();
				
			});

			//menampilkan data pegawai ke input
			$('#tabel-pegawai').on('click', '#btn-pilih', function(){
				$('#form-pilih').attr('action','<?=base_url()?>pensiun/data_pilih');
				$('#id_pegawai').val($(this).data('id'));
				$('#nama_pegawai').val($(this).data('nama'));
				$('#nip_pensiun').val($(this).data('nip'));
				var kode 	= $('#id_pegawai').val();
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>pensiun/data_pangkat/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#pangkat_pensiun')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('#pangkat_pensiun').selectpicker('destroy').selectpicker();
						}else{
							swal("ERROR", "Load data.", "error");
						}
					},
					error: function(){
						swal("ERROR", "Load data.", "error");
					}
				});
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>pensiun/data_jabatan/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#jabatan_pensiun')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('#jabatan_pensiun').selectpicker('destroy').selectpicker();
						}else{
							swal("ERROR", "Load data.", "error");
						}
					},
					error: function(){
						swal("ERROR", "Load data.", "error");
					}
				});
				$('#modal-pegawai').modal('hide');
			});

			//menampilkan data pegawai ke input
			$('#tabel-pegawai2').on('click', '#btn-pilih2', function(){
				$('#form-pilih2').attr('action','<?=base_url()?>pensiun/data_pilih2');
				$('#penandatangan_pegawai').val($(this).data('id'));
				$('#nama_penandatangan').val($(this).data('nama'));
				var kode 	= $('#penandatangan_pegawai').val();
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>pensiun/data_jabatan2/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#jabatan_penandatangan_pensiun')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('#jabatan_penandatangan_pensiun').selectpicker('destroy').selectpicker();
						}else{
							swal("ERROR", "Load data.", "error");
						}
					},
					error: function(){
						swal("ERROR", "Load data.", "error");
					}
				});
				$('#modal-pegawai2').modal('hide');
			});

		});
	</script>
</body>
</html>
