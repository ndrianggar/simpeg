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
									<a href="<?=base_url()?>naik_pangkat">
										Data Naik Pangkat
									</a> \ 
									<a href="#">
										Tambah Data Naik Pangkat
									</a>
								</h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<form name="form-tambah"  id="form-tambah" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data" action="<?=base_url()?>naik_pangkat/edit">
									<?php 
									$hal = '';
									$tujuan = '';
									$pembukaan = '';
									$salam_persetujuan = '';
									$persetujuan = '';
									$salam_pertimbangan = '';
									$Pertimbangan = '';
									$penutup = '';
									$tembusan = '';
									foreach ($data_naik_pangkat as $row) { 
										$hal_a = $row->hal_pangkat;
										$tujuan_a = $row->tujuan_pangkat;
										$pembukaan_a = $row->pembukaan_pangkat;
									    $salam_persetujuan_a = $row->salam_persetujuan_pangkat;
										$persetujuan_a = $row->persetujuan_pangkat;
										$salam_pertimbangan_a = $row->salam_pertimbangan_pangkat;
										$pertimbangan_a = $row->pertimbangan_pangkat;
										$penutup_a = $row->penutup_pangkat;
										$tembusan_a = $row->tembusan_pangkat;
										$breaks = array("<br />","<br>","<br/>");  
									    $hal = str_ireplace($breaks, "", $hal_a);  
										$tujuan = str_ireplace($breaks, "", $tujuan_a);  
										$pembukaan = str_ireplace($breaks, "", $pembukaan_a);  
										$salam_persetujuan = str_ireplace($breaks, "", $salam_persetujuan_a);  
										$persetujuan = str_ireplace($breaks, "", $persetujuan_a);  
										$salam_pertimbangan = str_ireplace($breaks, "", $salam_pertimbangan_a);  
										$pertimbangan = str_ireplace($breaks, "", $pertimbangan_a);  
										$penutup = str_ireplace($breaks, "", $penutup_a);  
										$tembusan = str_ireplace($breaks, "", $tembusan_a);  
									}
									?>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Nomor Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="kd_naik_pangkat" name="kd_naik_pangkat" class="form-control"  type="hidden" value="<?php echo $row->kd_naik_pangkat; ?>">
													<input id="nomor_pangkat" name="nomor_pangkat" class="form-control" placeholder="Nomor Surat"  value="<?php echo $row->nomor_pangkat; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Penandatangan</label>
												<div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
													<input id="id_pegawai" name="id_pegawai" class="form-control" type="hidden" value="<?php echo $row->id_pegawai; ?>">
													<input id="nama_pegawai" name="nama_pegawai" class="form-control has-feedback-right" placeholder="Nama Penandatangan" value="<?php echo $row->nm_pegawai; ?>">
													<span class="fa fa-search form-control-feedback right" aria-hidden="true" id="cari_pegawai"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">NIP</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="nip_pangkat" name="nip_pangkat" class="form-control" placeholder="NIP Pegawai" value="<?php echo $row->nip_baru; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">NIDN</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="nidn_pangkat" name="nidn_pangkat" class="form-control" placeholder="NIDN" value="<?php echo $row->nidn_pangkat; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Pangkat, Golongan, Ruang, TMT Lama</label>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<select class="form-control selectpicker" data-live-search="true" name="pgrt_lama_pangkat" id="pgrt_lama_pangkat">
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
												<div class="col-md-4 col-sm-4 col-xs-12">
													<input id="tmt_pgrt_lama_pangkat" name="tmt_pgrt_lama_pangkat" class="form-control has-feedback-right tanggal" placeholder="TMT Pangkat (dd-mm-yyyy)"  value="<?php echo $row->tmt_pgrt_lama_pangkat; ?>">
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Jabatan TMT Lama</label>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<select class="form-control selectpicker" data-live-search="true" name="jabatan_lama_pangkat" id="jabatan_lama_pangkat">
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
												<div class="col-md-4 col-sm-4 col-xs-12">
													<input id="tmt_jabatan_lama_pangkat" name="tmt_jabatan_lama_pangkat" class="form-control has-feedback-right tanggal" placeholder="TMT Jabatan (dd-mm-yyyy)"  value="<?php echo $row->tmt_jabatan_lama_pangkat; ?>">
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Unit Kerja</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="unit_kerja_pangkat" name="unit_kerja_pangkat" class="form-control" placeholder="Unit Kerja" value="<?php echo $row->unit_kerja_pangkat; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Jumlah Usulan Angka Kredit </label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="usulan_angka_kredit_pangkat" name="usulan_angka_kredit_pangkat" class="form-control" placeholder="Jumlah Usulan Angka Kredit" value="<?php echo $row->usulan_angka_kredit_pangkat; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control"></label>
												<label class="col-md-8 col-sm-8 col-xs-12 label-control">Menjadi </label>
											</div>
											
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Jabatan TMT Baru</label>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<select class="form-control selectpicker" data-live-search="true" name="jabatan_baru_pangkat" id="jabatan_baru_pangkat">
													<?php foreach ($d_jabatan as $row7) { 
														if (($row->jabatan_baru_pangkat)==($row7->kd_jabatan)) { ?>
															<option value="<?=$row7->kd_jabatan?>" selected><?=$row7->nm_jabatan?></option>
														<?php } else { ?>
															<option value="<?=$row7->kd_jabatan?>"><?=$row7->nm_jabatan?></option>
													<?php
														}
													} 
													?>
													</select>
												</div>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<input id="tmt_jabatan_baru_pangkat" name="tmt_jabatan_baru_pangkat" class="form-control has-feedback-right tanggal" placeholder="TMT Jabatan (dd-mm-yyyy)"  value="<?php echo $row->tmt_jabatan_baru_pangkat; ?>">
													<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Mata Kuliah</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="mata_kuliah_pangkat" name="mata_kuliah_pangkat" class="form-control" placeholder="Mata Kuliah" value="<?php echo $row->mata_kuliah_pangkat; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Pangkat, Golongan, Ruang, TMT Baru</label>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<select class="form-control selectpicker" data-live-search="true" name="pgrt_baru_pangkat" id="pgrt_lama_pangkat">
													<?php foreach ($d_pangkat as $row6) { 
														if (($row->pgrt_baru_pangkat)==($row6->kd_pangkat)) { ?>
															<option value="<?=$row6->kd_pangkat?>" selected><?=$row6->nm_pangkat?></option>
														<?php } else { ?>
															<option value="<?=$row6->kd_pangkat?>"><?=$row6->nm_pangkat?></option>
													<?php
														}
													} 
													?>
													</select>
												</div>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<input id="tmt_pgrt_baru_pangkat" name="tmt_pgrt_baru_pangkat" class="form-control has-feedback-right tanggal" placeholder="TMT Pangkat (dd-mm-yyyy)"  value="<?php echo $row->tmt_pgrt_baru_pangkat; ?>">
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
													<input id="penandatangan_pegawai" name="penandatangan_pegawai" class="form-control" type="hidden" value="<?php echo $row->penandatangan_pegawai; ?>">
													<input id="nama_penandatangan" name="nama_penandatangan" class="form-control has-feedback-right" placeholder="Nama Penandatangan" value="<?php echo $row->nama; ?>">
													<span class="fa fa-search form-control-feedback right" aria-hidden="true" id="cari_penandatangan"></span>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">NIP</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input id="nip_penandatangan" name="nip_penandatangan" class="form-control" placeholder="NIP Pegawai" value="<?php echo $row->nip; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Jabatan</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<select class="form-control selectpicker" data-live-search="true" name="penandatangan_jabatan" id="penandatangan_jabatan">
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
												<label class="col-md-4 col-sm-4 col-xs-12 label-control"></label>
												<label class="col-md-8 col-sm-8 col-xs-12 label-control">Bagian Surat </label>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Perihal Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="hal_pangkat" name="hal_pangkat" class="form-control" rows="3" placeholder="Perihal Surat"><?=$hal?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tujuan Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="tujuan_pangkat" name="tujuan_pangkat" class="form-control" rows="3" placeholder="Tujuan Surat"><?=$tujuan?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Pembukaan Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="pembukaan_pangkat" name="pembukaan_pangkat" class="form-control" rows="3" placeholder="Pembukaan Surat"><?=$pembukaan?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Salam Persetujuan Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="salam_persetujuan_pangkat" name="salam_persetujuan_pangkat" class="form-control" rows="3" placeholder="Salam Persetujuan Surat"><?=$salam_persetujuan?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Persetujuan Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="persetujuan_pangkat" name="persetujuan_pangkat" class="form-control" rows="7" placeholder="Persetujuan Surat"><?=$persetujuan?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Salam Pertimbangan Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="salam_pertimbangan_pangkat" name="salam_pertimbangan_pangkat" class="form-control" rows="3" placeholder="Salam Pertimbangan Surat"><?=$salam_pertimbangan?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Pertimbangan Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="pertimbangan_pangkat" name="pertimbangan_pangkat" class="form-control" rows="7" placeholder="Pertimbangan Surat"><?=$pertimbangan?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Penutup Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="penutup_pangkat" name="penutup_pangkat" class="form-control" rows="3" placeholder="Penutup Surat"><?=$penutup?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tembusan Surat</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<textarea id="tembusan_pangkat" name="tembusan_pangkat" class="form-control" rows="5" placeholder="Tembusan Surat"><?=$tembusan?></textarea>
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
				"sAjaxSource": 	'<?php echo base_url(); ?>naik_pangkat/data_pilih',
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
				"sAjaxSource": 	'<?php echo base_url(); ?>naik_pangkat/data_pilih2',
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

			// $('#btn-prev').on('click', function(){
			// 	var url = "<?=base_url()?>naik_pangkat/data_prev/";
			// 	window.location.href = url;

			// });
		
			$('#btn-simpan').click(function() {
				$('#form-tambah').attr('target','');
				$('#form-tambah').attr('action','<?=base_url()?>naik_pangkat/edit').submit();
				$('#form-tambah').attr('target','_blank');
				$('#form-tambah').attr('action','<?=base_url()?>naik_pangkat/data_prev').submit();
			});

			$('#btn-prev').click(function() {
				$('#form-tambah').attr('target','_blank');
				$('#form-tambah').attr('action','<?=base_url()?>naik_pangkat/data_prev').submit();
				
			});

			$('#btn-batal').on('click', function(){
				var url = "<?=base_url()?>naik_pangkat/";
				window.location.href = url;

			});

			//menampilkan data pegawai ke input
			$('#tabel-pegawai').on('click', '#btn-pilih', function(){
				$('#form-pilih').attr('action','<?=base_url()?>naik_pangkat/data_pilih');
				$('#id_pegawai').val($(this).data('id'));
				$('#nama_pegawai').val($(this).data('nama'));
				$('#nip_pangkat').val($(this).data('nip'));
			
				var kode 	= $('#id_pegawai').val();
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>naik_pangkat/data_pangkat/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#pgrt_lama_pangkat')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('#pgrt_lama_pangkat').selectpicker('destroy').selectpicker();
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
					url: 		'<?=base_url()?>naik_pangkat/data_jabatan/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#jabatan_lama_pangkat')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('#jabatan_lama_pangkat').selectpicker('destroy').selectpicker();
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
				$('#form-pilih2').attr('action','<?=base_url()?>naik_pangkat/data_pilih2');
				$('#penandatangan_pegawai').val($(this).data('id'));
				$('#nama_penandatangan').val($(this).data('nama'));
				$('#nip_penandatangan').val($(this).data('nip'));
				var kode 	= $('#penandatangan_pegawai').val();
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>naik_pangkat/data_jabatan2/' + kode,
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


		});
	</script>
</body>
</html>
