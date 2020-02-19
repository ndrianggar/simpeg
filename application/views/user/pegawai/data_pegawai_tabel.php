<!DOCTYPE html>
<html>
<?php include(__DIR__ . "/../../tittle.php"); ?>
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
									<a href="<?=base_url()?>pegawai/user">
										Data Saya
									</a>
									<?php
										if (empty($group)){
											?>
											<span id="group" data-group="0"></span>
											<?php
										} else {
											?>
											\
											<a id='group' href="<?=base_url()?>pegawai\group\<?=$group['id_group']?>" data-group="<?=$group['id_group']?>">
												<?=$group['nm_group']?>
											</a>
											<?php
										}
									?>
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
								<table id="tabel-data" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>No</th>
											<th>Foto</th>
											<th>Biodata Pegawai</th>
											<th>Pangkat dan Jabatan</th>
											<th>Status</th>
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
							<div class="modal-dialog modal-lg" style="height: 100%;">
								<div class="modal-content">
									<div class="modal-header">
										<div class="modal-title">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<span><h2>Tambah Data Pegawai</h2></span>
										</div>
									</div>
									<div class="modal-body">
										<form name="form-tambah" id="form-tambah" data-parsley-validate method="POST" class="form-horizontal" enctype="multipart/form-data">
											<div class="" role="tabpanel" data-example-id="togglable-tabs">
												<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
													<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Biodata</a>
													</li>
													<li role="presentation" class=""><a href="#tab_content2" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Document</a>
													</li>
													<li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Alamat</a>
													</li>
													<li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Ciri Fisik</a>
													</li>
												</ul>
												<div id="myTabContent" class="tab-content">
													<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
														<div class="row">
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Kode Pagawai *</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="id_pegawai" name="id_pegawai" class="form-control" placeholder="Id Pegawai" type="hidden">
																		<input id="kode_pegawai" name="kode_pegawai" class="form-control" placeholder="Kode Pegawai" required="required">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Nama Pagawai *</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="nama_pegawai" name="nama_pegawai" class="form-control" placeholder="Nama Pegawai">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Gelar Depan</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="gelar_depan" name="gelar_depan" class="form-control" placeholder="Gelar Depan">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Gelar Belakang</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="gelar_belakang" name="gelar_belakang" class="form-control" placeholder="Gelar Belakang">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Jenis Kelamin *</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
																			<option value="Laki-laki">Laki-laki</option>
																			<option value="Perempuan">Perempuan</option>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tempat Lahir *</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tanggal Lahir *</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="<?=date('Y-m-d')?>">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Golongan Darah</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="golongan_darah" name="golongan_darah" class="form-control" placeholder="Golongan Darah">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Agama</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<select id="agama" name="agama" class="form-control">
																			<?php
																			foreach ($agama as $agama) {
																			 	echo '<option value="' . $agama->kd_agama . '">' . $agama->nm_agama . '</option>';
																			} 
																			?>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Status Pernikahan</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<select id="status_pernikahan" name="status_pernikahan" class="form-control">
																			<option value="Laki-laki">Belum Menikah</option>
																			<option value="Menikah">Menikah</option>
																			<option value="Janda">Janda</option>
																			<option value="Duda">Duda</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Handphone 1</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="no_hp1" name="no_hp1" class="form-control" placeholder="Handphone 1">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Handphone 2</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="no_hp2" name="no_hp2" class="form-control" placeholder="Handphone 2">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Telepon</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="telepon" name="telepon" class="form-control" placeholder="Telepon">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Email *</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="email" name="email" class="form-control" placeholder="Email">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Hobi</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="hobi" name="hobi" class="form-control" placeholder="Hobi">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Foto *</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="foto" name="userfile" type="file" class="form-control" accept="image/x-png,image/jpeg">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control"></label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<img id="PrevFoto" src="<?=base_url()?>assets/images/user.png" style="max-height: 180px">
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="home-tab">
														<div class="row">
															<div class="col-md-6 col-sm-12 col-xs-12">
																
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Status Pagawai</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<select id="status_pegawai" name="status_pegawai" class="form-control">
																			<?php
																			foreach ($jenis as $jenis) {
																			 	echo '<option value="' . $jenis->id_jenis . '">' . $jenis->nm_jenis . '</option>';
																			} 
																			?>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">NIP Lama</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="nip_lama" name="nip_lama" class="form-control">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">NIP Baru</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="nip_baru" name="nip_baru" class="form-control">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">EKTP</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="ektp" name="ektp" class="form-control">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">NPWP</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="npwp" name="npwp" class="form-control">
																	</div>
																</div>
															</div>
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">TMT Polines</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="tmt_polines" name="tmt_polines" class="form-control" value="<?=date('Y-m-d')?>" type="date">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">TMT CPNS</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="tmt_cpns" name="tmt_cpns" class="form-control" value="<?=date('Y-m-d')?>">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">TMT PNS</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="tmt_pns" name="tmt_pns" class="form-control" value="<?=date('Y-m-d')?>">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">NO KARPEG</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="no_sk" name="no_sk" class="form-control">
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
														<div class="row">
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Propinsi</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<select id="propinsi" name="propinsi" class="chosen-select form-control">
																			<?php
																			foreach ($propinsi as $propinsi) {
																				 echo '<option value="' . $propinsi->kd_propinsi . '">' . $propinsi->nm_propinsi . '</option>';
																			} 
																			?>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Kota</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<select id="kota" name="kota" class="form-control">
																			<option value="">-- Pilih Kota --</option>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Kecamatan</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<select id="kecamatan" name="kecamatan" class="form-control">
																			<option value="">-- Pilih Kecamatan --</option>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Kelurahan</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<select id="kelurahan" name="kelurahan" class="form-control">
																			<option value="">-- Pilih Kelurahan --</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Jalan/Desa</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<textarea id="jalan" name="jalan" class="form-control" rows="7"></textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
														<div class="row">
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Tinggi Badan (Cm)</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="tinggi" name="tinggi" class="form-control" type="number">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Berat Badan (Kg)</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="berat" name="berat" class="form-control" type="number">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Rambut</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="rambut" name="rambut" class="form-control">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Bentuk Muka</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="muka" name="muka" class="form-control">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Warna Kulit</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<input id="kulit" name="kulit" class="form-control">
																	</div>
																</div>
															</div>
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Ciri Khas</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<textarea id="ciri" name="ciri" class="form-control" rows="4"></textarea>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-md-4 col-sm-4 col-xs-12 label-control">Cacat Tubuh</label>
																	<div class="col-md-8 col-sm-8 col-xs-12">
																		<textarea id="cacat" name="cacat" class="form-control" rows="4"></textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<div class="navbar-right">
											<div class="btn-group">
												<button type="button" id="btn-batal" class="btn btn-warning" data-dismiss="modal">Batal</button>
												<button type="button" id="btn-simpan" class="btn btn-success">Simpan</button>
											</div>
										</div>
									</div>
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
	<?php include(__DIR__ . "/../../load_js.php"); ?>
	<script>
		$(document).ready(function(){
			var group = $('#group').data('group');

			var tabel = $('#tabel-data').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		true,
				"lengthMenu": 	[ 25, 50, 75, 100 ],
				"sAjaxSource": 	'<?php echo base_url(); ?>pegawai/data_user/',
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "foto"},
									{ "mData"	: "nama"},
									{ "mData"	: "jabatan"},
									{ "mData"	: "status"},
									{ "mData"	: "action_user"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,1] },
									{ width: 30, targets: 0},
									{ width: 100, targets: 1},
									{ width: 50, targets: 4}
								],
				"fixedColumns": true
			});

			$('#btn-tambah').click(function() {
				var url = "<?=base_url()?>pegawai/form_tambah/";
				window.location.href = url;
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

			$('#tabel-body').on('click', '#btn-edit', function(){
				var kode =	$(this).data('id');
				var url = "<?=base_url()?>pegawai/form_edit_user/" + kode;
				window.location.href = url;
			});
		});
	</script>
</body>
</html>
