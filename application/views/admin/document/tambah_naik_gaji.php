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
									</a> \
									<a href="<?=base_url()?>gaji\form_tambah">
										Tambah Data
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
								<form name="form-tambah"  id="form-tambah" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="<?=base_url()?>gaji/tambah">
									<?php 
									$hal = '';
									$tujuan = '';
									$pembukaan = '';
									$catatan = '';
									$dasar_skp = '';
									$salinan = '';
									$kenaikan_gaji = '';
									$penutup = '';
									foreach ($data_terakhir as $row) { 
									
										$hal_a = $row->hal_surat;
										$tujuan_a = $row->tujuan_surat;
										$pembukaan_a = $row->pembukaan_surat;
									    $catatan_a = $row->catatan_surat;
										$dasar_skp_a = $row->dasar_surat;
										$salinan_a = $row->salinan;
										$kenaikan_gaji_a = $row->hingga_memperoleh;
										$penutup_a = $row->penutup_surat;
									
										$breaks = array("<br />","<br>","<br/>");  
									
									    $hal = str_ireplace($breaks, "", $hal_a);  
										$tujuan = str_ireplace($breaks, "", $tujuan_a);  
										$pembukaan = str_ireplace($breaks, "", $pembukaan_a);  
										$catatan = str_ireplace($breaks, "", $catatan_a);  
										$dasar_skp = str_ireplace($breaks, "", $dasar_skp_a);  
										$salinan = str_ireplace($breaks, "", $salinan_a);  
										$kenaikan_gaji = str_ireplace($breaks, "", $kenaikan_gaji_a);  
										$penutup = str_ireplace($breaks, "", $penutup_a);  
									}
									?>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Nomor Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="kd_naik_gaji" name="kd_naik_gaji" class="form-control"  type="hidden">
													<input id="nomor_surat" name="nomor_surat" class="form-control" placeholder="Nomor Surat" >
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tanggal Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="tanggal_surat" name="tanggal_surat" class="form-control has-feedback-right tanggal" placeholder="Tanggal Surat (dd-mm-yyyy)" >
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Nama Pegawai</label>
												<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
													<input id="id_pegawai" name="id_pegawai" class="form-control" type="hidden">
													<input id="nama_pegawai" name="nama_pegawai" class="form-control has-feedback-right" placeholder="Nama Pegawai">
													<span class="fa fa-search form-control-feedback right" aria-hidden="true" id="cari_pegawai"></span>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">NIP</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="nip_pangkat" name="nip_pangkat" class="form-control" placeholder="NIP Pegawai">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Pangkat</label>
												<div class="col-md-8 col-sm-4 col-xs-12">
													<select id="pangkat_pegawai" name="pangkat_pegawai" class="form-control selectpicker" data-live-search="true">
														<option value="">-- Pilih Pangkat --</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Jabatan</label>
												<div class="col-md-8 col-sm-4 col-xs-12">
													<select id="jabatan_pegawai" name="jabatan_pegawai" class="form-control selectpicker" data-live-search="true">
														<option value="">-- Pilih Jabatan --</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Kantor/Tempat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="kantor" name="kantor" class="form-control" placeholder="Kantor/Tempat">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Gaji Pokok</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="gaji_pokok" name="gaji_pokok" class="form-control" placeholder="Gaji Pokok">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control"></label>
												<label class="col-md-8 col-sm-8 col-xs-12 label-control">Isi Dasar SKP</label>
											</div>
											
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Oleh Pejabat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="oleh_pejabat" name="oleh_pejabat" class="form-control" placeholder="Oleh Pejabat">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tanggal SKP</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="tanggal_skp" name="tanggal_skp" class="form-control has-feedback-right tanggal" placeholder="Tanggal SKP (dd-mm-yyyy)" >
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Nomor SKP</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="nomor_pejabat" name="nomor_pejabat" class="form-control" placeholder="Nomor SKP">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tanggal Berlaku Gaji</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="tanggal_berlaku" name="tanggal_berlaku" class="form-control has-feedback-right tanggal" placeholder="Tanggal SKP (dd-mm-yyyy)" >
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Masa Kerja Pada Tanggal tsb</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="masa_kerja" name="masa_kerja" class="form-control" placeholder="Masa Kerja Pada Tanggal tsb">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control"></label>
												<label class="col-md-8 col-sm-8 col-xs-12 label-control">Kenaikan Gaji Berkala</label>
											</div>
											
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Gaji Pokok Baru</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="gaji_baru" name="gaji_baru" class="form-control" placeholder="Gaji Pokok Baru">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tunjangan Jabatan</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="tunjangan_jabatan" name="tunjangan_jabatan" class="form-control" placeholder="Tunjangan Jabatan">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Berdasarkan Masa Kerja</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="masa_kerja_baru" name="masa_kerja_baru" class="form-control" placeholder="Berdasarkan Masa Kerja">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Dalam Golongan</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="golongan" name="golongan" class="form-control" placeholder="Dalam Golongan">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tanggal Mulai</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="tanggal_mulai" name="tanggal_mulai" class="form-control has-feedback-right tanggal" placeholder="Tanggal Mulai (dd-mm-yyyy)" >
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control"></label>
												<label class="col-md-8 col-sm-8 col-xs-12 label-control">Penandatangan</label>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Penandatangan</label>
												<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
													<input id="penandatangan_pegawai" name="penandatangan_pegawai" class="form-control" type="hidden">
													<input id="nama_penandatangan" name="nama_penandatangan" class="form-control has-feedback-right" placeholder="Nama Penandatangan">
													<span class="fa fa-search form-control-feedback right" aria-hidden="true" id="cari_penandatangan"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">NIP</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="nip_penandatangan" name="nip_penandatangan" class="form-control" placeholder="NIP Pegawai">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Jabatan</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<select id="penandatangan_jabatan" name="penandatangan_jabatan" class="form-control selectpicker" data-live-search="true">
														<option value="">-- Pilih Jabatan --</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control"></label>
												<label class="col-md-8 col-sm-8 col-xs-12 label-control">Bagian Surat </label>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Perihal Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="hal_surat" name="hal_surat" class="form-control" rows="3" placeholder="Perihal Surat"><?=$hal?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Catatan Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="catatan_surat" name="catatan_surat" class="form-control" rows="3" placeholder="Catatan Surat"><?=$catatan?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tujuan Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="tujuan_surat" name="tujuan_surat" class="form-control" rows="3" placeholder="Tujuan Surat"><?=$tujuan?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Pembukaan Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="pembukaan_surat" name="pembukaan_surat" class="form-control" rows="3" placeholder="Pembukaan Surat"><?=$pembukaan?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Dasar SKP</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="dasar_surat" name="dasar_surat" class="form-control" rows="3" placeholder="Dasar SKP"><?=$dasar_skp?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Kenaikan Gaji Berkala</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="hingga_memperoleh" name="hingga_memperoleh" class="form-control" rows="7" placeholder="Kenaikan Gaji Berkala"><?=$kenaikan_gaji?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Penutup Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="penutup_surat" name="penutup_surat" class="form-control" rows="3" placeholder="Penutup Surat"><?=$penutup?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Salinan Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="salinan" name="salinan" class="form-control" rows="5" placeholder="Salinan Surat"><?=$salinan?></textarea>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="btn-group">
												<button type="button" id="btn-prev" class="btn btn-danger">Preview</button>
												<button type="submit" id="btn-simpan" class="btn btn-success">Simpan</button>
												<button type="button" id="btn-batal" class="btn btn-warning">Batal</button>
											</div>
										</div>
									</div>
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

			$('#jabatan_lama_pangkat').on('change', function(){
				var kode 	= $('#id_pegawai').val();
				var tmt 	= $('#jabatan_lama_pangkat').val();
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>gaji/data_jabatan_tmt/' + kode +'/'+ tmt,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#tmt_jabatan_lama_pangkat').val($(this).data('jabatan')).change();
					
						}else{
							swal("ERROR", "Load data.", "error");
						}
					},
					error: function(){
						swal("ERROR", "Load data.", "error");
					}
				});
			});

			var tabel_pegawai = $('#tabel-pegawai').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		true,
				"bPage": 		true,
				"bInfo": 		true,
				"bPaginate": 	true,
				"bFilter": 		true,
				"sAjaxSource": 	'<?php echo base_url(); ?>gaji/data_pilih',
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
				"bSort": 		true,
				"bPage": 		true,
				"bInfo": 		true,
				"bPaginate": 	true,
				"bFilter": 		true,
				"sAjaxSource": 	'<?php echo base_url(); ?>gaji/data_pilih2',
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
				var url = "<?=base_url()?>gaji/";
				window.location.href = url;

			});

			// $('#btn-prev').on('click', function(){
			// 	var url = "<?=base_url()?>gaji/data_prev/";
			// 	window.location.href = url;

			// });
			$('#btn-simpan').click(function() {
				$('#btn-simpan').attr('disabled','disabled');
				$('#form-tambah').attr('target','');
				$('#form-tambah').attr('action','<?=base_url()?>gaji/tambah').submit();
				$('#form-tambah').attr('target','_blank');
				$('#form-tambah').attr('action','<?=base_url()?>gaji/data_prev').submit();
			});

			$('#btn-prev').click(function() {
				$('#form-tambah').attr('target','_blank');
				$('#form-tambah').attr('action','<?=base_url()?>gaji/data_prev').submit();
				
			});


			//menampilkan data pegawai ke input
			$('#tabel-pegawai').on('click', '#btn-pilih', function(){
				$('#form-pilih').attr('action','<?=base_url()?>gaji/data_pilih');
				$('#id_pegawai').val($(this).data('id'));
				$('#nama_pegawai').val($(this).data('nama'));
				$('#nip_pangkat').val($(this).data('nip'));
			
				var kode 	= $('#id_pegawai').val();
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>gaji/data_pangkat/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#pangkat_pegawai')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('#pangkat_pegawai').selectpicker('destroy').selectpicker();
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
					url: 		'<?=base_url()?>gaji/data_jabatan/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#jabatan_pegawai')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('#jabatan_pegawai').selectpicker('destroy').selectpicker();
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
				$('#form-pilih2').attr('action','<?=base_url()?>gaji/data_pilih2');
				$('#penandatangan_pegawai').val($(this).data('id'));
				$('#nama_penandatangan').val($(this).data('nama'));
				$('#nip_penandatangan').val($(this).data('nip'));
				var kode 	= $('#penandatangan_pegawai').val();
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>gaji/data_jabatan2/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#penandatangan_jabatan')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('#penandatangan_jabatan').selectpicker('destroy').selectpicker();
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
			// $('#id_pegawai').on('change', function() {
			// 	var kode 	= $('#id_pegawai').val();
				
			// 	$.ajax({
			// 		type: 		'ajax',
			// 		method: 	'post',
			// 		url: 		'<?=base_url()?>gaji/data_pangkat/' + kode,
			// 		async: 		true,
			// 		dataType: 	'json',
			// 		success: 	function(data){
			// 			if(data !== null){
			// 				$('#pangkat_pensiun')
			// 					.find('option')
			// 					.remove()
			// 					.end()
			// 					.append(data)
			// 				;
			// 				$('.chosen-select').chosen('destroy').chosen();
			// 			}else{
			// 				swal("ERROR", "Load data.", "error");
			// 			}
			// 		},
			// 		error: function(){
			// 			swal("ERROR", "Load data.", "error");
			// 		}
			// 	});
			// });
		});
	</script>
</body>
</html>
