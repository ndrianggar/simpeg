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
								<?php
									foreach ($pegawai as $pegawai) {
								?>
								<h2>
									<a href="<?=base_url()?>">
										<i class="fa fa-home"></i>
									</a> \ 
									<a href="<?=base_url()?>pegawai">
										Data Pegawai
									</a> \ 
									<a href="<?=base_url()?>pegawai/detail/<?=$pegawai->id_pegawai?>">
										<?=$pegawai->gelar_depan . ' ' . $pegawai->nm_pegawai  . ' ' . $pegawai->gelar_belakang?>
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
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="col-md-4 col-sm-12 col-xs-12" style="align-content: center;vertical-align: middle;">
										<input id="id_pegawai" type="hidden" value="<?=$pegawai->id_pegawai?>">
										<center>
											<img src="<?=base_url() . 'assets/foto/' . $pegawai->foto_pegawai ?>" style="height: auto;width: 240px;">
											<br>
											<span><h4><b><?=$pegawai->gelar_depan . ' ' . $pegawai->nm_pegawai . ' ' . $pegawai->gelar_belakang?></b></h4></span>
											<p>
											<?=$pegawai->nm_jenis . ' ( ' . $pegawai->nama_status . ' )'?>
											<br>
											<?=$pegawai->nm_jurusan?>
											<br>
											<?=$pegawai->nm_prodi?>
											</p>
											<p>
												<?=$status['status']?>
											</p>
											<p>
												<?=$status['action']?>
											</p>
										</center>
									</div>
									<div class="col-md-4 col-sm-12 col-xs-12">
										<table>
											<tr>
												<td><b>Nama Pegawai</b></td>
												<td width="20" class="text-center">:</td>
												<td><?=$pegawai->gelar_depan . ' ' . $pegawai->nm_pegawai . ' ' . $pegawai->gelar_belakang?></td>
											</tr>
											<tr>
												<td><b>NIP Baru</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->nip_baru?></td>
											</tr>
											<tr>
												<td><b>NIP Lama</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->nip_lama?></td>
											</tr>
											<tr>
												<td><b>Tempat Lahir</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->tempat_lahir?></td>
											</tr>
											<tr>
												<td><b>Tanggal Lahir</b></td>
												<td class="text-center">:</td>
												<td><?=date('d-m-Y',strtotime($pegawai->tanggal_lahir))?></td>
											</tr>
											<tr>
												<td><b>Jenis Kelamin</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->jenis_kelamin?></td>
											</tr>
											<tr>
												<td><b>Agama</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->nm_agama?></td>
											</tr>
											<tr>
												<td><b>Golongan Darah</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->golongan_darah?></td>
											</tr>
											<tr>
												<td><b>Status Pernikahan</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->status_perkawinan?></td>
											</tr>
											<tr>
												<td><b>Email</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->email_pegawai?></td>
											</tr>
											<tr>
												<td><b>EKTP</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->ektp_pegawai?></td>
											</tr>
											<tr>
												<td><b>NPWP</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->npwp_pegawai?></td>
											</tr>
											<tr>
												<td style="vertical-align: top;"><b>Alamat</b></td>
												<td class="text-center" style="vertical-align: top;">:</td>
												<td><?=
														$pegawai->alamat_jalan .'<br>'.
														'Kelurahan ' . $pegawai->nama_kelurahan .'<br>'.
														'Kecamatan ' . $pegawai->nama_kecamatan .'<br>'.
														'Kota ' . $pegawai->nama_kota .' - ' . $pegawai->nama_propinsi .'<br>';
													?>	
												</td>
											</tr>
											<tr>
												<td><b>Handphone 1</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->hp1_pegawai?></td>
											</tr>
											<tr>
												<td><b>Handphone 2</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->hp2_pegawai?></td>
											</tr>
											<tr>
												<td><b>Telepon</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->hp2_pegawai?></td>
											</tr>
										</table>
									</div>
									<div class="col-md-4 col-sm-12 col-xs-12">
										<table>
											<tr>
												<td><b>Tinggi Badan</b></td>
												<td class="text-center" width="20">:</td>
												<td><?=$pegawai->hp2_pegawai?> Cm</td>
											</tr>
											<tr>
												<td><b>Berat Badan</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->hp2_pegawai?> Kg</td>
											</tr>
											<tr>
												<td><b>Rambut</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->hp2_pegawai?></td>
											</tr>
											<tr>
												<td><b>Bentuk Muka</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->hp2_pegawai?></td>
											</tr>
											<tr>
												<td><b>Warna Kulit</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->hp2_pegawai?></td>
											</tr>
											<tr>
												<td><b>Ciri Khas</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->hp2_pegawai?></td>
											</tr>
											<tr>
												<td><b>Cacat Tubuh</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->hp2_pegawai?></td>
											</tr>
											<tr>
												<td><b>Hobi</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->hp2_pegawai?></td>
											</tr>
											<tr>
												<td><b>TMT Polines</b></td>
												<td class="text-center">:</td>
												<td><?=date("d-m-Y",strtotime($pegawai->tmt_polines))?></td>
											</tr>
											<tr>
												<td><b>TMT CPNS</b></td>
												<td class="text-center">:</td>
												<td><?=date("d-m-Y",strtotime($pegawai->tmt_cpns))?></td>
											</tr>
											<tr>
												<td><b>TMT PNS</b></td>
												<td class="text-center">:</td>
												<td><?=date("d-m-Y",strtotime($pegawai->tmt_pns))?></td>
											</tr>
											<tr>
												<td><b>Nomor Karpeg</b></td>
												<td class="text-center">:</td>
												<td><?=$pegawai->no_sk?></td>
											</tr>
											<tr>
												<td><b>Nomor S.BAKN</b></td>
												<td class="text-center">:</td>
												<td>
													<?=$pegawai->no_sbakn?>
													<button class="badge bg-red">
														<i class="fa fa-file-pdf-o"></i>
													</button>		
												</td>
											</tr>
											<tr>
												<td><b>Tanggal S.BAKN</b></td>
												<td class="text-center">:</td>
												<td><?=date("d-m-Y",strtotime($pegawai->tgl_sbakn))?></td>
											</tr>
											<tr>
												<td><b>Nomor SK.MPK</b></td>
												<td class="text-center">:</td>
												<td>
													<?=$pegawai->no_skmpk?>
													<button class="badge bg-red">
														<i class="fa fa-file-pdf-o"></i>
													</button>		
												</td>
											</tr>
											<tr>
												<td><b>Tanggal SK.MPK</b></td>
												<td class="text-center">:</td>
												<td><?=date("d-m-Y",strtotime($pegawai->tgl_skmpk))?></td>
											</tr>
											<tr>
												<td><b>Nomor SPMT</b></td>
												<td class="text-center">:</td>
												<td>
													<?=$pegawai->no_spmt?>
													<button class="badge bg-red">
														<i class="fa fa-file-pdf-o"></i>
													</button>		
												</td>
											</tr>
											<tr>
												<td><b>Tanggal SPMT</b></td>
												<td class="text-center">:</td>
												<td><?=date("d-m-Y",strtotime($pegawai->tgl_spmt))?></td>
											</tr>
											<tr>
												<td><b>Nomor SPMJ</b></td>
												<td class="text-center">:</td>
												<td>
													<?=$pegawai->no_spmj?>
													<button class="badge bg-red">
														<i class="fa fa-file-pdf-o"></i>
													</button>		
												</td>
											</tr>
											<tr>
												<td><b>Tanggal SPMJ</b></td>
												<td class="text-center">:</td>
												<td><?=date("d-m-Y",strtotime($pegawai->tgl_spmj))?></td>
											</tr>
										</table>
									</div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<!-- <form name="form-detail" id="form-detail" class="form-horizontal form-label-left" > -->
							<div class="" role="tabpanel" data-example-id="togglable-tabs">
								<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
									<li role="presentation" class="active">
										<a href="#tab_content1" id="profile-tab1" role="tab" data-toggle="tab" aria-expanded="true">Pendidikan</a>
									</li>
									<li role="presentation" class="">
										<a href="#tab_content2" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">
											Pangkat dan Jabatan
											<!-- <span class="badge bg-red">1</span> -->
										</a>
									</li>
									<li role="presentation" class="">
										<a href="#tab_content3" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Penghargaan</a>
									</li>
									<li role="presentation" class="">
										<a href="#tab_content4" role="tab" id="profile-tab4" data-toggle="tab" aria-expanded="false">Pengalaman Luar Negeri</a>
									</li>
									<li role="presentation" class="">
										<a href="#tab_content5" role="tab" id="profile-tab5" data-toggle="tab" aria-expanded="false">Keluarga</a>
									</li>
									<li role="presentation" class="">
										<a href="#tab_content6" role="tab" id="profile-tab6" data-toggle="tab" aria-expanded="false">Organisasi</a>
									</li>
									<li role="presentation" class="">
										<a href="#tab_content7" role="tab" id="profile-tab7" data-toggle="tab" aria-expanded="false">Lain-lain</a>
									</li>
									<li role="presentation" class="">
										<a href="#tab_content8" role="tab" id="profile-tab8" data-toggle="tab" aria-expanded="false">Hukuman Disiplin</a>
									</li>
								</ul>
								<div id="myTabContent" class="tab-content">
									<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
										<?php include "data_pendidikan.php"; ?>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
										<?php include "data_kepangkatan.php"; ?>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
										<?php include "data_penghargaan.php"; ?>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
										<?php include "data_pengalaman_ln.php"; ?>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
										<?php include "data_keluarga.php"; ?>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="profile-tab">
										<?php include "data_organisasi.php"; ?>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="profile-tab">
										<?php include "data_lain2.php"; ?>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab_content8" aria-labelledby="profile-tab">
										<?php include "data_hukuman.php"; ?>
									</div>
								</div>
							</div>
						<!-- </form> -->
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
			var id_peg 		= $('#id_pegawai').val();

			var tabel_keluarga = $('#data-keluarga').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bPage": 		false,
				"bInfo": 		false,
				"bPaginate": 	false,
				"bFilter": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>keluarga/data_keluarga/' + id_peg,
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "nama"},
									{ "mData"	: "hubungan"},
									{ "mData"	: "jk"},
									{ "mData"	: "tempat"},
									{ "mData"	: "tanggal"},
									{ "mData"	: "nikah"},
									{ "mData"	: "alamat"},
									{ "mData"	: "pekerjaan"},
									{ "mData"	: "status"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,1,5,6,9,10] },
									{ width: 30, targets: 0},
									{ width: 50, targets: 10}
								],
				"fixedColumns": true
			});

			var tabel_organisasi = $('#data-organisasi').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bPage": 		false,
				"bPaginate": 	false,
				"bFilter": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>organisasi/data/' + id_peg,
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "nama"},
									{ "mData"	: "jabatan"},
									{ "mData"	: "lama"},
									{ "mData"	: "tempat"},
									{ "mData"	: "ketua"},
									{ "mData"	: "status"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,6,7] },
									{ width: 30, targets: 0},
									{ width: 50, targets: 7}
								],
				"fixedColumns": true
			});

			var tabel_suratlain = $('#data-suratlain').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bPage": 		false,
				"bPaginate": 	false,
				"bFilter": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>suratlain/data/' + id_peg,
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "nama"},
									{ "mData"	: "tanggal"},
									{ "mData"	: "tempat"},
									{ "mData"	: "keterangan"},
									{ "mData"	: "status"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,5,6] },
									{ width: 30, targets: 0},
									{ width: 50, targets: 6}
								],
				"fixedColumns": true
			});

			$('#tahun_penghargaan').datepicker({
				format : "yyyy",
				autoclose : true
			});

			//--Pendidikan--//

			var tabel_pendidikan= $('#data-pendidikan').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bPage": 		false,
				"bInfo": 		false,
				"bPaginate": 	false,
				"bFilter": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>pendidikan/data/' + id_peg,
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "jenjang"},
									{ "mData"	: "nama"},
									{ "mData"	: "jurusan"},
									{ "mData"	: "tahun"},
									{ "mData"	: "ijazah"},
									{ "mData"	: "tempat"},
									{ "mData"	: "tandatangan"},
									{ "mData"	: "status"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,8,9] },
									{ width: 30, targets: 0},
									{ width: 80, targets: 9}
								],
				"fixedColumns": true
			});

			$('#btn-tambah-pendidikan').on('click',function(){
				var pegawai 	= $('#id_pegawai').val();
				enable_pendidikan();
				$('#form-pendidikan')[0].reset();
				$('#title-pendidikan').html('Tambah Data Pendidikan Formal');
				$('#form-pendidikan').attr('action','<?=base_url()?>pendidikan/tambah')
				$('#id_pegawai_pendidikan').val(pegawai);
				$('#modal-pendidikan').modal('show');
			});

			$('#data-pendidikan').on('click','#btn-ubah',function(){
				enable_pendidikan();
				$('#form-pendidikan')[0].reset();
				$('#id_pegawai_pendidikan').val($(this).data('pegawai'));
				$('#id_jenjang_pendidikan').val($(this).data('jenjang')).change();
				$('#kode_pendidikan').val($(this).data('kode'));
				$('#nama_pendidikan').val($(this).data('nama'));
				$('#jurusan_pendidikan').val($(this).data('jurusan'));
				$('#awal_pendidikan').val($(this).data('awal'));
				$('#akhir_pendidikan').val($(this).data('akhir'));
				$('#ijazah_pendidikan').val($(this).data('ijazah'));
				$('#tempat_pendidikan').val($(this).data('tempat'));
				$('#kepala_pendidikan').val($(this).data('kepala'));
				$('#form-pendidikan').attr('action','<?=base_url()?>pendidikan/edit')
				$('#title-pendidikan').html('Ubah Data Pendidikan Formal');
				$('#modal-pendidikan').modal('show');
			});

			$('#btn-simpan-pendidikan').click(function() {
				$('#form-pendidikan').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							tabel_pendidikan.ajax.reload();
							swal('Sukses');
							$('#form-pendidikan')[0].reset();
							$('#modal-pendidikan').modal('hide');
						}else{
							swal('Gagal');
						}
					},
					error: function(){
						swal('Error');
					}
				}).submit();
			});

			$('#data-pendidikan').on('click','#btn-ganti',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				var sts 	= $(this).data('status');
				swal({
					title: "Ubah status?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#428bca",
					confirmButtonText: "Ubah",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: true
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'pendidikan/edit_sts/' + kd + '/' + pegawai + '/' + sts,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_pendidikan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					}
				});	
			});

			$('#data-pendidikan').on('click','#btn-hapus',function(){
				var kd 		= $(this).data('kode');
				var nama 	= $(this).data('nama');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Apakah anda yakin?",
					text: "Untuk menghapus data : " + nama,
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Hapus",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'pendidikan/hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_pendidikan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-pendidikan').on('click','#btn-terima-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Tambah Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'pendidikan/terima_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_pendidikan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-pendidikan').on('click','#btn-tolak-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Tambah Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'pendidikan/tolak_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_pendidikan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-pendidikan').on('click','#btn-terima-edit',function(){
				var kd 		= $(this).data('kode');
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>'+'pendidikan/data_tmp/' + kd,
					async: 		true,
					dataType: 	'json',
					success: 	function(response){
						if (response=='false'){
							//data kosong
							swal ('Data tidak ditemukan');
						} else {
							$('#form-pendidikan')[0].reset();
							disable_pendidikan();
							$('#id_pegawai_pendidikan').val(	response[0]['id_pegawai']				);
							$('#id_jenjang_pendidikan').val(	response[0]['id_jenjang'] 			).change();
							$('#kode_pendidikan').val(			response[0]['kd_pendidikan']		);
							$('#nama_pendidikan').val(			response[0]['nama_pendidikan']		);
							$('#jurusan_pendidikan').val(		response[0]['jurusan_pendidikan']	);
							$('#awal_pendidikan').val(			response[0]['awal']					);
							$('#akhir_pendidikan').val(			response[0]['akhir']				);
							$('#ijazah_pendidikan').val(		response[0]['ijazah_pendidikan']	);
							$('#tempat_pendidikan').val(		response[0]['tempat_pendidikan']	);
							$('#kepala_pendidikan').val(		response[0]['kepala_pendidikan']	);
							$('#form-pendidikan').attr('action','<?=base_url()?>pendidikan/terima_edit')
							$('#title-pendidikan').html('Terima Pengajuan Ubah Data Pendidikan Formal');
							$('#lihat_file_pendidikan').attr('href','<?=base_url()?>assets/pdf/' + response[0]['file_pendidikan']);
							$('#modal-pendidikan').modal('show');
						}
					},
					error: function(){
						swal("Error");
					}
				});
			});

			$('#data-pendidikan').on('click','#btn-tolak-edit',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Edit Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'pendidikan/tolak_edit/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_pendidikan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-pendidikan').on('click','#btn-terima-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'pendidikan/terima_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_pendidikan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-pendidikan').on('click','#btn-tolak-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'pendidikan/tolak_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_pendidikan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			//--Pendidikan--//

			//--Kursus --//

			var tabel_kursus = $('#data-kursus').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bPage": 		false,
				"bInfo": 		false,
				"bPaginate": 	false,
				"bFilter": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>kursus/data/' + id_peg,
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "jenis"},
									{ "mData"	: "nama"},
									{ "mData"	: "tahun"},
									{ "mData"	: "ijazah"},
									{ "mData"	: "tempat"},
									{ "mData"	: "tandatangan"},
									{ "mData"	: "durasi"},
									{ "mData"	: "status"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,8,9] },
									{ className: "text-right", "targets": 7 },
									{ width: 30, targets: 0},
									{ width: 80, targets: [8,9]}
								],
				"fixedColumns": true 
			});

			$('#btn-tambah-kursus').on('click',function(){
				var pegawai 	= $('#id_pegawai').val();
				enable_kursus();
				$('#form-kursus')[0].reset();
				$('#id_jenis_kursus').change();
				$('#title-kursus').html('Tambah Data Pendidikan Non-Formal');
				$('#form-kursus').attr('action','<?=base_url()?>kursus/tambah')
				$('#id_pegawai_kursus').val(pegawai);
				$('#modal-kursus').modal('show');
			});

			$('#btn-simpan-kursus').click(function() {
				$('#form-kursus').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							tabel_kursus.ajax.reload();
							swal('Sukses');
							$('#form-kursus')[0].reset();
							$('#modal-kursus').modal('hide');
						}else{
							swal('Gagal');
						}
					},
					error: function(){
						swal('Error');
					}
				}).submit();
			});

			$('#data-kursus').on('click','#btn-ubah',function(){
				enable_kursus();
				$('#form-kursus')[0].reset();
				$('#id_pegawai_kursus').val($(this).data('pegawai'));
				$('#id_jenis_kursus').val($(this).data('jenis')).change();
				$('#kode_kursus').val($(this).data('kode'));
				$('#nama_kursus').val($(this).data('nama'));
				$('#awal_kursus').val($(this).data('awal'));
				$('#akhir_kursus').val($(this).data('akhir'));
				$('#ijazah_kursus').val($(this).data('ijazah'));
				$('#tempat_kursus').val($(this).data('tempat'));
				$('#kepala_kursus').val($(this).data('kepala'));
				$('#durasi_kursus').val($(this).data('durasi'));
				$('#form-kursus').attr('action','<?=base_url()?>kursus/edit')
				$('#title-kursus').html('Ubah Data Pendidikan Non-Formal');
				$('#modal-kursus').modal('show');
			});

			$('#data-kursus').on('click','#btn-hapus',function(){
				var kd 		= $(this).data('kode');
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
							url: 		'<?=base_url()?>'+'kursus/hapus/' + kd,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_kursus.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-kursus').on('click','#btn-terima-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Tambah Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'kursus/terima_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_kursus.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-kursus').on('click','#btn-tolak-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Tambah Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'kursus/tolak_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_kursus.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-kursus').on('click','#btn-terima-edit',function(){
				var kd 		= $(this).data('kode');
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>'+'kursus/data_tmp/' + kd,
					async: 		true,
					dataType: 	'json',
					success: 	function(response){
						if (response=='false'){
							//data kosong
							swal ('Data tidak ditemukan');
						} else {
							$('#form-kursus')[0].reset();
							disable_kursus();
							$('#id_jenis_kursus').val(		response[0]['id_jenis_kursus']	).change();
							$('#id_pegawai_kursus').val(	response[0]['id_pegawai']		);
							$('#kode_kursus').val(			response[0]['kd_kursus']		);
							$('#nama_kursus').val(			response[0]['nama_kursus']		);
							$('#awal_kursus').val(			response[0]['awal']				);
							$('#akhir_kursus').val(			response[0]['akhir']			);
							$('#ijazah_kursus').val(		response[0]['ijazah_kursus']	);
							$('#tempat_kursus').val(		response[0]['tempat_kursus']	);
							$('#kepala_kursus').val(		response[0]['kepala_kursus']	);
							$('#durasi_kursus').val(		response[0]['durasi_kursus']	);
							$('#form-kursus').attr('action','<?=base_url()?>kursus/terima_edit')
							$('#title-kursus').html('Terima Pengajuan Ubah Data Pendidikan NonFormal');
							$('#lihat_file_kursus').attr('href','<?=base_url()?>assets/pdf/' + response[0]['file_kursus']);
							$('#modal-kursus').modal('show');
						}
					},
					error: function(){
						swal("Error");
					}
				});
			});

			$('#data-kursus').on('click','#btn-tolak-edit',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Edit Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'kursus/tolak_edit/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_kursus.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-kursus').on('click','#btn-terima-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'kursus/terima_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_kursus.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-kursus').on('click','#btn-tolak-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'kursus/tolak_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_kursus.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			//--Kursus--//

			//--Pangkat--//

			var tabel_pangkat = $('#data-pangkat').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bPage": 		false,
				"bInfo": 		false,
				"bPaginate": 	false,
				"bFilter": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>riwayat_pangkat/data/' + id_peg,
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "pangkat"},
									{ "mData"	: "golongan"},
									{ "mData"	: "tmt"},
									{ "mData"	: "gaji"},
									{ "mData"	: "pejabat"},
									{ "mData"	: "nomor"},
									{ "mData"	: "tanggal"},
									{ "mData"	: "dasar"},
									{ "mData"	: "pmk"},
									{ "mData"	: "status"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,3,7,10,11] },
									{ className: "text-right", "targets": [4,9] },
									{ width: 30, targets: 0},
									{ width: 90, targets: 11}
								],
				"fixedColumns": true
			});

			$('#btn-tambah-pangkat').on('click',function(){
				$('#form-pangkat')[0].reset();
				var pegawai 	= $('#id_pegawai').val();
				$('#title-pangkat').html('Tambah Data Riwayat Pangkat');
				$('#form-pangkat').attr('action','<?=base_url()?>riwayat_pangkat/tambah')
				$('#id_pegawai_pangkat').val(pegawai);
				$('#modal-pangkat').modal('show');
			});

			$('#btn-simpan-pangkat').click(function() {
				$('#form-pangkat').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							tabel_pangkat.ajax.reload();
							swal('Sukses');
							$('#form-pangkat')[0].reset();
							$('#modal-pangkat').modal('hide');
						}else{
							swal('Gagal');
						}
					},
					error: function(){
						swal('ERROR : function(response)');
					}
				}).submit();
			});

			$('#data-pangkat').on('click','#btn-ubah',function(){
				$('#kd_riwayat_pangkat').val(	$(this).data('kode')	);
				$('#id_pegawai_pangkat').val(	$(this).data('pegawai')	);
				$('#kd_pangkat').val(			$(this).data('pangkat')	);
				$('#tmt_pangkat').val(			$(this).data('tmt')		);
				$('#gaji_pangkat').val(			$(this).data('gaji')	);
				$('#pejabat_sk').val(			$(this).data('pejabat')	);
				$('#nomor_sk').val(				$(this).data('nomor')	);
				$('#tanggal_sk').val(			$(this).data('tanggal')	);
				$('#dasar_pangkat').val(		$(this).data('dasar')	);
				$('#pmk').val(					$(this).data('pmk')	);
				$('#form-pangkat').attr('action','<?=base_url()?>riwayat_pangkat/edit')
				$('#title-pangkat').html('Ubah Data Riwayat Pangkat');
				$('#modal-pangkat').modal('show');
			});

			$('#data-pangkat').on('click','#btn-ganti',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				var sts 	= $(this).data('status');
				swal({
					title: "Ubah status?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#428bca",
					confirmButtonText: "Ubah",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: true
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'riwayat_pangkat/edit_sts/' + kd + '/' + pegawai + '/' + sts,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_pangkat.ajax.reload();
									swal("SUKSES!", "Ubah data sukses.", "success");
								}else{
									swal("ERROR", "Ubah data gagal.", "error");
								}
							},
							error: function(){
								swal("ERROR", "Ubah data gagal.", "error");
							}
						});
					}
				});	
			});

			$('#data-pangkat').on('click','#btn-hapus',function(){
				var kd 		= $(this).data('kode');
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
							url: 		'<?=base_url()?>'+'riwayat_pangkat/hapus/' + kd,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_pangkat.ajax.reload();
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

			//--Pangkat--//

			//--Jabatan--//

			var tabel_jabatan = $('#data-jabatan').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bPage": 		false,
				"bInfo": 		false,
				"bPaginate": 	false,
				"bFilter": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>riwayat_jabatan/data/' + id_peg,
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "jabatan"},
									{ "mData"	: "tmt"},
									{ "mData"	: "gaji"},
									{ "mData"	: "lantik"},
									{ "mData"	: "pejabat"},
									{ "mData"	: "nomor"},
									{ "mData"	: "tanggal"},
									{ "mData"	: "nomor"},
									{ "mData"	: "nomor"},
									{ "mData"	: "status"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,2,4,7,10,11] },
									{ className: "text-right", "targets": 3 },
									{ width: 30, targets: 0},
									{ width: 50, targets: 11}
								],
				"fixedColumns": true
			});

			$('#btn-tambah-jabatan').on('click',function(){
				$('#form-jabatan')[0].reset();
				var pegawai 	= $('#id_pegawai').val();
				$('#title-jabatan').html('Tambah Data Riwayat Jabatan');
				$('#form-jabatan').attr('action','<?=base_url()?>riwayat_jabatan/tambah')
				$('#id_pegawai_jabatan').val(pegawai);
				$('#modal-jabatan').modal('show');
			});

			$('#kd_jenis').on('change', function() {
				var kode 	= $('#kd_jenis').val();
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>'+'jabatan/data_jenis/' + kode,
					async: 		true,
					dataType: 	'json',
					success: 	function(data){
						if(data !== null){
							$('#kd_jabatan')
								.find('option')
								.remove()
								.end()
								.append(data)
							;
							$('.chosen-select').chosen('destroy').chosen();
						}else{
							swal("ERROR", "Load data.", "error");
						}
					},
					error: function(){
						swal("ERROR", "Load data.", "error");
					}
				});
			});

			$('#btn-simpan-jabatan').click(function() {
				$('#form-jabatan').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							tabel_jabatan.ajax.reload();
							swal('Sukses');
							$('#form-jabatan')[0].reset();
							$('#modal-jabatan').modal('hide');
						}else{
							swal('Gagal');
						}
					},
					error: function(){
						swal('ERROR : function(response)');
					}
				}).submit();
			});

			$('#data-jabatan').on('click','#btn-ubah',function(){
				$('#kd_riwayat_jabatan').val(	$(this).data('kode')	);
				$('#id_pegawai_jabatan').val(	$(this).data('pegawai')	);
				$('#kd_jabatan').val(			$(this).data('jabatan')	);
				$('#tmt_jabatan').val(			$(this).data('tmt')		);
				$('#gaji_jabatan').val(			$(this).data('gaji')	);
				$('#pejabat_sk_jabatan').val(	$(this).data('pejabat')	);
				$('#nomor_sk_jabatan').val(		$(this).data('nomor')	);
				$('#tanggal_sk_jabatan').val(	$(this).data('tanggal')	);
				$('#form-jabatan').attr('action','<?=base_url()?>riwayat_jabatan/edit')
				$('#title-jabatan').html('Ubah Data Riwayat Jabatan');
				$('#modal-jabatan').modal('show');
			});

			$('#data-jabatan').on('click','#btn-ganti',function(){
				var kd 		= $(this).data('kode');
				var sts 	= $(this).data('status');
				swal({
					title: "Ubah status?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#428bca",
					confirmButtonText: "Ubah",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: true
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'riwayat_jabatan/edit_sts/' + kd + '/' + sts,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_jabatan.ajax.reload();
									swal("SUKSES!", "Ubah data sukses.", "success");
								}else{
									swal("ERROR", "Ubah data gagal.", "error");
								}
							},
							error: function(){
								swal("ERROR", "Ubah data gagal.", "error");
							}
						});
					}
				});	
			});

			$('#data-jabatan').on('click','#btn-hapus',function(){
				var kd 		= $(this).data('kode');
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
							url: 		'<?=base_url()?>'+'riwayat_jabatan/hapus/' + kd,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_jabatan.ajax.reload();
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

			//--Jabatan--//

			//--Penghargaan--//

			var tabel_penghargaan = $('#data-penghargaan').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bPage": 		false,
				"bInfo": 		false,
				"bPaginate": 	false,
				"bFilter": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>penghargaan/data/' + id_peg,
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "nama"},
									{ "mData"	: "tahun"},
									{ "mData"	: "pemberi"},
									{ "mData"	: "status"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,4,5] },
									{ width: 30, targets: 0},
									{ width: 50, targets: [4,5]}
								],
				"fixedColumns": true
			});

			$('#btn-tambah-penghargaan').click(function(){
				enable_penghargaan();
				var pegawai 	= $('#id_pegawai').val(); 
				$('#form-penghargaan')[0].reset();
				$('#id_pegawai_penghargaan').val(pegawai);
				$('#form-penghargaan').attr('action','<?=base_url()?>penghargaan/tambah');
				$('#title-penghargaan').html('Tambah Data Penghargaan');
				$('#modal-penghargaan').modal('show');
			});

			$('#btn-simpan-penghargaan').click(function() {
				$('#form-penghargaan').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							tabel_penghargaan.ajax.reload();
							swal('Sukses');
							$('#form-penghargaan')[0].reset();
							$('#modal-penghargaan').modal('hide');
						}else{
							swal('Gagal');
						}
					},
					error: function(){
						swal('Error');
					}
				}).submit();
			});

			$('#data-penghargaan').on('click', '#btn-ubah', function(){
				enable_penghargaan();
				$('.modal-title').html('Ubah Data');
				$('#form-penghargaan').attr('action','<?=base_url()?>penghargaan/edit');
				$('#kd_penghargaan').val($(this).data('kd'));
				$('#id_pegawai_penghargaan').val($(this).data('pegawai'));
				$('#nama_penghargaan').val($(this).data('nama'));
				$('#tahun_penghargaan').val($(this).data('tahun'));
				$('#pemberi_penghargaan').val($(this).data('pemberi'));
				$('#modal-penghargaan').modal('show');
				$('#nama').focus();
				$('#nama').select();
			});

			$('#data-penghargaan').on('click', '#btn-hapus', function(){
				var kd 		= $(this).data('kd');
				var nama 	= $(this).data('nama');
				var pegawai = $(this).data('pegawai');
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
							url: 		'<?=base_url()?>'+'penghargaan/hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_penghargaan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-penghargaan').on('click','#btn-terima-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Tambah Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'penghargaan/terima_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_penghargaan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-penghargaan').on('click','#btn-tolak-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Tambah Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'penghargaan/tolak_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_penghargaan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-penghargaan').on('click','#btn-terima-edit',function(){
				var kd 		= $(this).data('kode');
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>'+'penghargaan/data_tmp/' + kd,
					async: 		true,
					dataType: 	'json',
					success: 	function(response){
						if (response=='false'){
							//data kosong
							swal ('Data tidak ditemukan');
						} else {
							$('#form-penghargaan')[0].reset();
							disable_penghargaan();
							$('#id_pegawai_penghargaan').val(	response[0]['id_pegawai']			);
							$('#kd_penghargaan').val(			response[0]['kd_penghargaan']		);
							$('#nama_penghargaan').val(			response[0]['nama_penghargaan']		);
							$('#tahun_penghargaan').val(		response[0]['tahun_penghargaan']	);
							$('#pemberi_penghargaan').val(		response[0]['pemberi_penghargaan']	);
							$('#form-penghargaan').attr('action','<?=base_url()?>penghargaan/terima_edit')
							$('#lihat_file_penghargaan').attr('href','<?=base_url()?>assets/pdf/' + response[0]['file_penghargaan']);
							$('#modal-penghargaan').modal('show');
						}
					},
					error: function(){
						swal("Error");
					}
				});
			});

			$('#data-penghargaan').on('click','#btn-tolak-edit',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Edit Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'penghargaan/tolak_edit/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_penghargaan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-penghargaan').on('click','#btn-terima-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'penghargaan/terima_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_penghargaan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-penghargaan').on('click','#btn-tolak-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'penghargaan/tolak_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_penghargaan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			//--Penghargaan--//

			//--Luar Negeri--//

			var tabel_kunjungan = $('#data-kunjungan').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bPage": 		false,
				"bPaginate": 	false,
				"bFilter": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>luar_negri/data/' + id_peg,
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "negara"},
									{ "mData"	: "tujuan"},
									{ "mData"	: "lama"},
									{ "mData"	: "pembiayaan"},
									{ "mData"	: "status"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,5,6]},
									{ width: 30, targets: 0},
									{ width: 50, targets: [5,6]}
								],
				"fixedColumns": true
			});

			$('#btn-tambah-kunjungan').on('click',function(){
				var pegawai 	= $('#id_pegawai').val(); 
				$('#form-kunjungan')[0].reset();
				$('#id_pegawai_kunjungan').val(pegawai);
				$('#form-kunjungan').attr('action','<?=base_url()?>luar_negri/tambah');
				$('#title-kunjungan').html('Tambah Data Pengalaman Luar Negeri');
				$('#modal-kunjungan').modal('show');
			});

			$('#btn-simpan-kunjungan').click(function() {
				$('#form-kunjungan').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							tabel_kunjungan.ajax.reload();
							swal('Sukses');
							$('#form-kunjungan')[0].reset();
							$('#modal-kunjungan').modal('hide');
						}else{
							swal('Gagal');
						}
					},
					error: function(){
						swal('Error');
					}
				}).submit();
			});
			
			$('#data-kunjungan').on('click', '#btn-ubah', function(){
				enable_kunjungan();
				$('#title-kunjungan').html('Ubah Data Pengalaman Luar Negeri');
				$('#form-kunjungan').attr('action','<?=base_url()?>luar_negri/edit');
				$('#kd_kunjungan').val($(this).data('kd'));
				$('#id_pegawai_kunjungan').val($(this).data('pegawai'));
				$('#negara_kunjungan').val($(this).data('negara'));
				$('#tujuan_kunjungan').val($(this).data('tujuan'));
				$('#awal_kunjungan').val($(this).data('awal'));
				$('#akhir_kunjungan').val($(this).data('akhir'));
				$('#pembiayaan_kunjungan').val($(this).data('pembiayaan'));
				$('#modal-kunjungan').modal('show');
				$('#negara').focus();
				$('#negara').select();
			});

			$('#data-kunjungan').on('click', '#btn-hapus', function(){
				var kd 		= $(this).data('kd');
				var negara 	= $(this).data('negara');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Apakah anda yakin?",
					text: "Untuk menghapus data : " + kd + " - " + negara,
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
							url: 		'<?=base_url()?>'+'luar_negri/hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_kunjungan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-kunjungan').on('click','#btn-terima-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Tambah Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'luar_negri/terima_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_kunjungan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-kunjungan').on('click','#btn-tolak-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Tambah Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'luar_negri/tolak_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_kunjungan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-kunjungan').on('click','#btn-terima-edit',function(){
				var kd 		= $(this).data('kode');
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>'+'luar_negri/data_tmp/' + kd,
					async: 		true,
					dataType: 	'json',
					success: 	function(response){
						if (response=='false'){
							//data kosong
							swal ('Data tidak ditemukan');
						} else {
							$('#form-kunjungan')[0].reset();
							disable_kunjungan();
							$('#id_pegawai_kunjungan').val(	response[0]['id_pegawai']		);
							$('#kd_kunjungan').val(			response[0]['kd_kunjungan']		);
							$('#negara_kunjungan').val(		response[0]['negara']			);
							$('#tujuan_kunjungan').val(		response[0]['tujuan_kunjungan']	);
							$('#awal_kunjungan').val(		response[0]['awal']				);
							$('#akhir_kunjungan').val(		response[0]['akhir']			);
							$('#pembiayaan_kunjungan').val(	response[0]['pembiayaan_kunjungan']	);
							$('#form-kunjungan').attr('action','<?=base_url()?>luar_negri/terima_edit')
							$('#lihat_file_kunjungan').attr('href','<?=base_url()?>assets/pdf/' + response[0]['file_kunjungan']);
							$('#modal-kunjungan').modal('show');
						}
					},
					error: function(){
						swal("Error");
					}
				});
			});

			$('#data-kunjungan').on('click','#btn-tolak-edit',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Edit Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'luar_negri/tolak_edit/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_kunjungan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-kunjungan').on('click','#btn-terima-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'luar_negri/terima_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_kunjungan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-kunjungan').on('click','#btn-tolak-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'luar_negri/tolak_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_kunjungan.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			//-- Data kunjungan Luar Negeri --//

			//-- Data Keluarga --//

			$('#hubungan').on('change',function(){
				var hub 	= $('#hubungan').val();
				if ((hub=='01')||(hub=='02')) {
					$('.nikah').attr('Style','Display: block;');
				} else {
					$('.nikah').attr('Style','Display: none;');
				}
			});

			$('#status_cerai').on('change',function(){
				var status 	= $('#status_cerai').val();
				if (status=='Ya') {
					$('.cerai').attr('Style','Display: block;');
				} else {
					$('.cerai').attr('Style','Display: none;');
				}
			});

			$('#status_hidup').on('change',function(){
				var status 	= $('#status_hidup').val();
				if (status=='Meninggal') {
					$('.meninggal').attr('Style','Display: block;');
				} else {
					$('.meninggal').attr('Style','Display: none;');
				}
			});

			$('#foto_keluarga').bind('change', function() {
				var file_size = this.files[0].size;
				if (file_size>2000000){
					swal ('Size terlalu besar');
					$('#foto_keluarga').val('');
				} else {
					readURL(this);
				}
			});

			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
					$('#PrevFoto').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
				}
			};

			$('#btn-tambah-keluarga').on('click',function(){
				enable_keluarga();
				var pegawai 	= $('#id_pegawai').val(); 
				$('#form-keluarga')[0].reset();
				$('#id_pegawai_keluarga').val(pegawai);
				$('#form-keluarga').attr('action','<?=base_url()?>keluarga/tambah');
				$('#title-keluarga').html('Tambah Data Keluarga');
				$('#modal-keluarga').modal('show');
			});

			$('#btn-simpan-keluarga').click(function() {
				$('#form-keluarga').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							tabel_keluarga.ajax.reload();
							swal('Sukses');
							$('#form-keluarga')[0].reset();
							$('#modal-keluarga').modal('hide');
						}else{
							swal('Gagal');
						}
					},
					error: function(){
						swal('ERROR : function(response)');
					}
				}).submit();
			});

			$('#data-keluarga').on('click', '#btn-ubah', function(){
				enable_keluarga();
				$('#title-keluarga').html('Ubah Data keluarga');
				$('#form-keluarga').attr('action','<?=base_url()?>keluarga/edit');
				$('#hubungan').val($(this).data('kd_hubungan'));
				$('#kode').val($(this).data('kd'));
				$('#id_pegawai_keluarga').val($(this).data('pegawai'));
				$('#nama').val($(this).data('nama'));
				$('#gelar_depan').val($(this).data('gelar_depan'));
				$('#gelar_belakang').val($(this).data('gelar_belakang'));
				$('#jenis_dokumen').val($(this).data('jenis_keluarga'));
				$('#nomor_dokumen').val($(this).data('ektp_keluarga'));
				$('#jenis_kelamin').val($(this).data('ketua'));
				$('#agama').val($(this).data('kd_agama'));
				$('#tempat_lahir').val($(this).data('tempat_lahir'));
				$('#tanggal_lahir').val($(this).data('tanggal_lahir'));
				$('#akte_lahir').val($(this).data('akte_kelahiran'));
				$('#tanggal_nikah').val($(this).data('tanggal_nikah'));
				$('#akte_nikah').val($(this).data('akte_nikah'));
				$('#status_cerai').val($(this).data('status_cerai'));
				$('#tanggal_cerai').val($(this).data('tanggal_cerai'));
				$('#akte_cerai').val($(this).data('akte_cerai'));
				$('#alamat').val($(this).data('alamat_keluarga'));
				$('#handphone').val($(this).data('hp_keluarga'));
				$('#telepon').val($(this).data('telp_keluarga'));
				$('#email').val($(this).data('email_keluarga'));
				$('#status_perkawinan').val($(this).data('ketua'));
				$('#pekerjaan').val($(this).data('pekerjaan_keluarga'));
				$('#keterangan').val($(this).data('keterangan_keluarga'));
				$('#status_hidup').val($(this).data('status_hidup'));
				$('#tanggal_meninggal').val($(this).data('tanggal_meninggal'));
				$('#akte_meninggal').val($(this).data('akte_meninggal'));
				$('#modal-keluarga').modal('show');
				$('#nama_keluarga').focus();
				$('#nama_keluarga').select();
			});

			$('#data-keluarga').on('click', '#btn-hapus', function(){
				var kd 		= $(this).data('kode');
				var nama 	= $(this).data('nama');
				swal({
					title: "Apakah anda yakin?",
					text: "Untuk menghapus data : " + kd + " - " + nama,
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
							url: 		'<?=base_url()?>'+'keluarga/hapus/' + kd,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_keluarga.ajax.reload();
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

			$('#data-keluarga').on('click','#btn-terima-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Tambah Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'keluarga/terima_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_keluarga.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-keluarga').on('click','#btn-tolak-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Tambah Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'keluarga/tolak_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_keluarga.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-keluarga').on('click','#btn-terima-edit',function(){
				var kd 		= $(this).data('kode');
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>'+'keluarga/data_tmp/' + kd,
					async: 		true,
					dataType: 	'json',
					success: 	function(response){
						if (response=='false'){
							//data kosong
							swal ('Data tidak ditemukan');
						} else {
							$('#form-keluarga')[0].reset();
							disable_keluarga();
							$('#hubungan').val(					response[0]['nm_hubungan']				);
							$('#kode').val(						response[0]['kd_keluarga']				);
							$('#id_pegawai_keluarga').val(		response[0]['kd_pegawai']				);
							$('#nama').val(						response[0]['nama_keluarga']				);
							$('#gelar_depan').val(				response[0]['gelar_depan']				);
							$('#gelar_belakang').val(			response[0]['gelar_belakang']				);
							$('#jenis_dokumen').val(			response[0]['jenis_keluarga']				);
							$('#nomor_dokumen').val(			response[0]['ektp_keluarga']				);
							$('#jenis_kelamin').val(			response[0]['jenis_kelamin']				);
							$('#agama').val(					response[0]['nm_agama']				);
							$('#tempat_lahir').val(				response[0]['tempat_lahir']				);
							$('#tanggal_lahir').val(			response[0]['tgl_lahir']				);
							$('#akte_lahir').val(				response[0]['akte_kelahiran']				);
							$('#tanggal_nikah').val(			response[0]['tanggal_nikah']				);
							$('#akte_nikah').val(				response[0]['akte_nikah']				);
							$('#status_cerai').val(				response[0]['status_cerai']				);
							$('#tanggal_cerai').val(			response[0]['tanggal_cerai']				);
							$('#akte_cerai').val(				response[0]['akte_cerai']				);
							$('#alamat').val(					response[0]['alamat_keluarga']				);
							$('#handphone').val(				response[0]['hp_keluarga']				);
							$('#telepon').val(					response[0]['telp_keluarga']				);
							$('#email').val(					response[0]['email_keluarga']				);
							$('#status_perkawinan').val(		response[0]['status_perkawinan']				);
							$('#pekerjaan').val(				response[0]['pekerjaan_keluarga']				);
							$('#keterangan').val(				response[0]['keterangan_keluarga']				);
							$('#status_hidup').val(				response[0]['status_hidup']				);
							$('#tanggal_meninggal').val(		response[0]['tanggal_meninggal']				);
							$('#akte_meninggal').val(			response[0]['akte_meninggal']				);
							$('#form-keluarga').attr('action','<?=base_url()?>keluarga/terima_edit')
							$('#title-keluarga').html('Terima Pengajuan Ubah Data keluarga');
							$('#modal-keluarga').modal('show');
						}
					},
					error: function(){
						swal("Error");
					}
				});
			});

			$('#data-keluarga').on('click','#btn-tolak-edit',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Edit Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'keluarga/tolak_edit/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_keluarga.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-keluarga').on('click','#btn-terima-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'keluarga/terima_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_keluarga.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-keluarga').on('click','#btn-tolak-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'keluarga/tolak_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_keluarga.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			//-- Data Keluarga --//

			//-- Data Organisasi --//

			$('#btn-tambah-organisasi').on('click',function(){
				var pegawai 	= $('#id_pegawai').val(); 
				enable_organisasi();
				$('#form-organisasi')[0].reset();
				$('#id_pegawai_organisasi').val(pegawai);
				$('#form-organisasi').attr('action','<?=base_url()?>organisasi/tambah');
				$('#title-organisasi').html('Tambah Data Organisasi');
				$('#modal-organisasi').modal('show');
			});

			$('#btn-simpan-organisasi').click(function() {
				$('#form-organisasi').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							tabel_organisasi.ajax.reload();
							swal('Sukses');
							$('#form-organisasi')[0].reset();
							$('#modal-organisasi').modal('hide');
						}else{
							swal('Gagal');
						}
					},
					error: function(){
						swal('ERROR : function(response)');
					}
				}).submit();
			});
			
			$('#data-organisasi').on('click', '#btn-ubah', function(){
				enable_organisasi();
				$('#title-organisasi').html('Ubah Data Organisasi');
				$('#form-organisasi').attr('action','<?=base_url()?>organisasi/edit');
				$('#kd_organisasi').val($(this).data('kd'));
				$('#id_pegawai_organisasi').val($(this).data('pegawai'));
				$('#nama_organisasi').val($(this).data('nama'));
				$('#jabatan_organisasi').val($(this).data('jabatan'));
				$('#awal_organisasi').val($(this).data('awal'));
				$('#akhir_organisasi').val($(this).data('akhir'));
				$('#tempat_organisasi').val($(this).data('tempat'));
				$('#ketua_organisasi').val($(this).data('ketua'));
				$('#modal-organisasi').modal('show');
				$('#nama_organisasi').focus();
				$('#nama_organisasi').select();
			});

			$('#data-organisasi').on('click', '#btn-hapus', function(){
				var kd 		= $(this).data('kode');
				var nama 	= $(this).data('nama');
				swal({
					title: "Apakah anda yakin?",
					text: "Untuk menghapus data : " + kd + " - " + nama,
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
							url: 		'<?=base_url()?>'+'organisasi/hapus/' + kd,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_organisasi.ajax.reload();
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

			$('#data-organisasi').on('click','#btn-terima-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Tambah Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'organisasi/terima_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_organisasi.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-organisasi').on('click','#btn-tolak-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Tambah Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'organisasi/tolak_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_organisasi.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-organisasi').on('click','#btn-terima-edit',function(){
				var kd 		= $(this).data('kode');
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>'+'organisasi/data_tmp/' + kd,
					async: 		true,
					dataType: 	'json',
					success: 	function(response){
						if (response=='false'){
							//data kosong
							swal ('Data tidak ditemukan');
						} else {
							$('#form-organisasi')[0].reset();
							disable_organisasi();
							$('#id_pegawai_organisasi').val(	response[0]['id_pegawai']				);
							$('#kd_organisasi').val(			response[0]['kd_organisasi']		);
							$('#nama_organisasi').val(			response[0]['nama_organisasi']		);
							$('#jabatan_organisasi').val(		response[0]['jabatan_organisasi']	);
							$('#awal_organisasi').val(			response[0]['awal']					);
							$('#akhir_organisasi').val(			response[0]['akhir']				);
							$('#tempat_organisasi').val(		response[0]['tempat_organisasi']	);
							$('#ketua_organisasi').val(		response[0]['ketua_organisasi']	);
							$('#form-organisasi').attr('action','<?=base_url()?>organisasi/terima_edit')
							$('#title-organisasi').html('Terima Pengajuan Ubah Data Organisasi');
							$('#lihat_file_organisasi').attr('href','<?=base_url()?>assets/pdf/' + response[0]['file_organisasi']);
							$('#modal-organisasi').modal('show');
						}
					},
					error: function(){
						swal("Error");
					}
				});
			});

			$('#data-organisasi').on('click','#btn-tolak-edit',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Edit Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'organisasi/tolak_edit/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_organisasi.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-organisasi').on('click','#btn-terima-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'organisasi/terima_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_organisasi.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-organisasi').on('click','#btn-tolak-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'organisasi/tolak_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_organisasi.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			//-- Data Organisasi --//

			//-- Data Surat Lain-Lain --//

			$('#btn-tambah-suratlain').on('click',function(){
				var pegawai 	= $('#id_pegawai').val(); 
				enable_suratlain();
				$('#form-suratlain')[0].reset();
				$('#id_pegawai_suratlain').val(pegawai);
				$('#form-suratlain').attr('action','<?=base_url()?>suratlain/tambah');
				$('#title-suratlain').html('Tambah Data Surat Lain-Lain');
				$('#modal-suratlain').modal('show');
			});

			$('#btn-simpan-suratlain').click(function() {
				$('#form-suratlain').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							tabel_suratlain.ajax.reload();
							swal('Sukses');
							$('#form-suratlain')[0].reset();
							$('#modal-suratlain').modal('hide');
						}else{
							swal('Gagal');
						}
					},
					error: function(){
						swal('ERROR : function(response)');
					}
				}).submit();
			});
			
			$('#data-suratlain').on('click', '#btn-ubah', function(){
				enable_suratlain();
				$('#title-suratlain').html('Ubah Data Surat Lain-Lain');
				$('#form-suratlain').attr('action','<?=base_url()?>suratlain/edit');
				$('#id_suratlain').val($(this).data('id'));
				$('#id_pegawai_suratlain').val($(this).data('pegawai'));
				$('#nama_suratlain').val($(this).data('nama'));
				$('#tempat_suratlain').val($(this).data('tempat'));
				$('#tanggal_suratlain').val($(this).data('tanggal'));
				$('#keterangan_suratlain').val($(this).data('keterangan'));
				$('#modal-suratlain').modal('show');
				$('#nama_suratlain').focus();
				$('#nama_suratlain').select();
			});

			$('#data-suratlain').on('click', '#btn-hapus', function(){
				var id 		= $(this).data('id');
				var nama 	= $(this).data('nama');
				swal({
					title: "Apakah anda yakin?",
					text: "Untuk menghapus data : " + id + " - " + nama,
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
							url: 		'<?=base_url()?>'+'suratlain/hapus/' + kd,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_suratlain.ajax.reload();
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

			$('#data-suratlain').on('click','#btn-terima-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Tambah Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'suratlain/terima_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_suratlain.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-suratlain').on('click','#btn-tolak-tambah',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Tambah Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'suratlain/tolak_tambah/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_suratlain.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-suratlain').on('click','#btn-terima-edit',function(){
				var kd 		= $(this).data('kode');
				$.ajax({
					type: 		'ajax',
					method: 	'post',
					url: 		'<?=base_url()?>'+'suratlain/data_tmp/' + kd,
					async: 		true,
					dataType: 	'json',
					success: 	function(response){
						if (response=='false'){
							//data kosong
							swal ('Data tidak ditemukan');
						} else {
							$('#form-suratlain')[0].reset();
							disable_suratlain();
							$('#id_pegawai_suratlain').val(	response[0]['id_pegawai']				);
							$('#kd_suratlain').val(			response[0]['id_surat_lain']		);
							$('#nama_suratlain').val(			response[0]['nama_surat_lain']		);
							$('#tanggal_suratlain').val(		response[0]['tanggal_surat_lain']	);
							$('#tempat_suratlain').val(			response[0]['tempat_surat_lain']					);
							$('#keterangan_suratlain').val(		response[0]['keterangan_surat_lain']	);
							$('#form-suratlain').attr('action','<?=base_url()?>suratlain/terima_edit')
							$('#title-suratlain').html('Terima Pengajuan Ubah Data Surat lain');
							$('#lihat_file_suratlain').attr('href','<?=base_url()?>assets/pdf/' + response[0]['file_surat_lain']);
							$('#modal-suratlain').modal('show');
						}
					},
					error: function(){
						swal("Error");
					}
				});
			});

			$('#data-suratlain').on('click','#btn-tolak-edit',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Edit Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'suratlain/tolak_edit/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_suratlain.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-suratlain').on('click','#btn-terima-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Terima Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Terima",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'suratlain/terima_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_suratlain.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			$('#data-suratlain').on('click','#btn-tolak-hapus',function(){
				var kd 		= $(this).data('kode');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Tolak Pengajuan Hapus Data?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'suratlain/tolak_hapus/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_suratlain.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});
			//-- Data Surat Lain-Lain --//

			//-- Data Hukuman --//

			var tabel_hukuman = $('#data-hukuman').DataTable({
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"bPage": 		false,
				"bPaginate": 	false,
				"bFilter": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>hukuman/data/' + id_peg,
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "jenis"},
									{ "mData"	: "sanksi"},
									{ "mData"	: "pejabat"},
									{ "mData"	: "nomor"},
									{ "mData"	: "tanggal"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,6] },
									{ width: 30, targets: 0},
									{ width: 50, targets: 6}
								],
				"fixedColumns": true
			});

			$('#btn-tambah-hukuman').on('click',function(){
				var pegawai 	= $('#id_pegawai').val(); 
				$('#form-hukuman')[0].reset();
				$('#id_pegawai_hukuman').val(pegawai);
				$('#form-hukuman').attr('action','<?=base_url()?>hukuman/tambah');
				$('#title-hukuman').html('Tambah Data Surat Lain-Lain');
				$('#modal-hukuman').modal('show');
			});

			$('#btn-simpan-hukuman').click(function() {
				$('#form-hukuman').ajaxForm({
					success: 	function(response){
						if(response=='true'){
							tabel_hukuman.ajax.reload();
							swal('Sukses');
							$('#form-hukuman')[0].reset();
							$('#modal-hukuman').modal('hide');
						}else{
							swal('Gagal');
						}
					},
					error: function(){
						swal('Error');
					}
				}).submit();
			});
			
			$('#data-hukuman').on('click', '#btn-ubah', function(){
				$('#title-hukuman').html('Ubah Data Surat Lain-Lain');
				$('#form-hukuman').attr('action','<?=base_url()?>hukuman/edit');
				$('#kd_hukuman').val($(this).data('kode'));
				$('#id_pegawai_hukuman').val($(this).data('pegawai'));
				$('#jenis_hukuman').val($(this).data('jenis'));
				$('#sanksi_hukuman').val($(this).data('sanksi'));
				$('#pejabat_hukuman').val($(this).data('pejabat'));
				$('#nomor_hukuman').val($(this).data('nomor'));
				$('#tanggal_hukuman').val($(this).data('tanggal'));
				$('#modal-hukuman').modal('show');
				$('#jenis_hukuman').focus();
				$('#jenis_hukuman').select();
			});

			$('#data-hukuman').on('click', '#btn-hapus', function(){
				var id 		= $(this).data('kode');
				var nama 	= $(this).data('nama');
				var pegawai = $(this).data('pegawai');
				swal({
					title: "Apakah anda yakin?",
					text: "Untuk menghapus data : " + id + " - " + nama,
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
							url: 		'<?=base_url()?>'+'hukuman/hapus/' + id + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel_hukuman.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

			//-- Data Hukuman --//

			$('#btn-edit-pegawai').on('click', function(){
				var kode =	$('#id_pegawai').val();
				var url = "<?=base_url()?>pegawai/form_edit/" + kode;
				window.location.href = url;
			});

			$('#btn-terima-edit-pegawai').on('click',function(){
				var kd 		= $('#id_pegawai').val();
				var url = "<?=base_url()?>pegawai/form_terima_edit/" + kd;
				window.location.href = url;
			});

			$('#btn-tolak-edit-pegawai').on('click',function(){
				var kd 		= $('#id_pegawai').val();
				var pegawai = $('#id_pegawai').val();
				swal({
					title: "Tolak Pengajuan Edit Data?",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Tolak",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'pegawai/tolak_edit/' + kd + '/' + pegawai,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
								if(response==true){
									tabel.ajax.reload();
									swal("Sukses");
								}else{
									swal("Gagal");
								}
							},
							error: function(){
								swal("Error");
							}
						});
					} else {
						swal("Cancelled");
					}
				});	
			});

		});


		
		function disable_pendidikan(){
			$('#id_jenjang_pendidikan').attr('disabled','disabled');
			$('#nama_pendidikan').attr('disabled','disabled');
			$('#jurusan_pendidikan').attr('disabled','disabled');
			$('#awal_pendidikan').attr('disabled','disabled');
			$('#akhir_pendidikan').attr('disabled','disabled');
			$('#ijazah_pendidikan').attr('disabled','disabled');
			$('#tempat_pendidikan').attr('disabled','disabled');
			$('#kepala_pendidikan').attr('disabled','disabled');
			$('#file_pendidikan').attr('style','display:none;');
			$('#lihat_file_pendidikan').attr('style','display:block;');
		};

		function enable_pendidikan(){
			$('#id_jenjang_pendidikan').removeAttr('disabled');
			$('#nama_pendidikan').removeAttr('disabled');
			$('#jurusan_pendidikan').removeAttr('disabled');
			$('#awal_pendidikan').removeAttr('disabled');
			$('#akhir_pendidikan').removeAttr('disabled');
			$('#ijazah_pendidikan').removeAttr('disabled');
			$('#tempat_pendidikan').removeAttr('disabled');
			$('#kepala_pendidikan').removeAttr('disabled');
			$('#file_pendidikan').attr('style','display:block;');
			$('#lihat_file_pendidikan').attr('style','display:none;');
		};

		function disable_kursus(){
			$('#id_jenis_kursus').attr('disabled','disabled');
			$('#nama_kursus').attr('disabled','disabled');
			$('#awal_kursus').attr('disabled','disabled');
			$('#akhir_kursus').attr('disabled','disabled');
			$('#ijazah_kursus').attr('disabled','disabled');
			$('#tempat_kursus').attr('disabled','disabled');
			$('#kepala_kursus').attr('disabled','disabled');
			$('#durasi_kursus').attr('disabled','disabled');
			$('#file_kursus').attr('style','display:none;');
			$('#lihat_file_kursus').attr('style','display:block;');
		};

		function enable_kursus(){
			$('#id_jenis_kursus').removeAttr('disabled');
			$('#nama_kursus').removeAttr('disabled');
			$('#awal_kursus').removeAttr('disabled');
			$('#akhir_kursus').removeAttr('disabled');
			$('#ijazah_kursus').removeAttr('disabled');
			$('#tempat_kursus').removeAttr('disabled');
			$('#kepala_kursus').removeAttr('disabled');
			$('#durasi_kursus').removeAttr('disabled');
			$('#file_kursus').attr('style','display:block;');
			$('#lihat_file_kursus').attr('style','display:none;');
		};

		function disable_penghargaan(){
			$('#nama_penghargaan').attr('disabled','disabled');
			$('#tahun_penghargaan').attr('disabled','disabled');
			$('#pemberi_penghargaan').attr('disabled','disabled');
			$('#file_penghargaan').attr('style','display:none;');
			$('#lihat_file_penghargaan').attr('style','display:block;');
		};

		function enable_penghargaan(){
			$('#nama_penghargaan').removeAttr('disabled');
			$('#tahun_penghargaan').removeAttr('disabled');
			$('#pemberi_penghargaan').removeAttr('disabled');
			$('#file_penghargaan').attr('style','display:block;');
			$('#lihat_file_penghargaan').attr('style','display:none;');
		};

		function disable_kunjungan(){
			$('#negara_kunjungan').attr('disabled','disabled');
			$('#tujuan_organisasi').attr('disabled','disabled');
			$('#awal_kunjungan').attr('disabled','disabled');
			$('#akhir_kunjungan').attr('disabled','disabled');
			$('#pembiayaan_kunjungan').attr('disabled','disabled');
			$('#file_kunjungan').attr('style','display:none;');
			$('#lihat_file_kunjungan').attr('style','display:block;');
		};

		function enable_kunjungan(){
			$('#negara_kunjungan').removeAttr('disabled');
			$('#tujuan_organisasi').removeAttr('disabled');
			$('#awal_kunjungan').removeAttr('disabled');
			$('#akhir_kunjungan').removeAttr('disabled');
			$('#pembiayaan_kunjungan').removeAttr('disabled');
			$('#file_kunjungan').attr('style','display:block;');
			$('#lihat_file_kunjungan').attr('style','display:none;');
		};

		function disable_organisasi(){
			$('#nama_organisasi').attr('disabled','disabled');
			$('#jabatan_organisasi').attr('disabled','disabled');
			$('#awal_organisasi').attr('disabled','disabled');
			$('#akhir_organisasi').attr('disabled','disabled');
			$('#tempat_organisasi').attr('disabled','disabled');
			$('#ketua_organisasi').attr('disabled','disabled');
			$('#file_organisasi').attr('style','display:none;');
			$('#lihat_file_organisasi').attr('style','display:block;');
		};

		function enable_organisasi(){
			$('#nama_organisasi').removeAttr('disabled');
			$('#jabatan_organisasi').removeAttr('disabled');
			$('#awal_organisasi').removeAttr('disabled');
			$('#akhir_organisasi').removeAttr('disabled');
			$('#tempat_organisasi').removeAttr('disabled');
			$('#ketua_organisasi').removeAttr('disabled');
			$('#file_organisasi').attr('style','display:block;');
			$('#lihat_file_organisasi').attr('style','display:none;');
		};

		function disable_suratlain(){
			$('#nama_suratlain').attr('disabled','disabled');
			$('#jabatan_suratlain').attr('disabled','disabled');
			$('#tanggal_suratlain').attr('disabled','disabled');
			$('#tempat_suratlain').attr('disabled','disabled');
			$('#keterangan_suratlain').attr('disabled','disabled');
			$('#file_suratlain').attr('style','display:none;');
			$('#lihat_file_suratlain').attr('style','display:block;');
		};

		function enable_suratlain(){
			$('#nama_suratlain').removeAttr('disabled');
			$('#jabatan_suratlain').removeAttr('disabled');
			$('#tanggal_suratlain').removeAttr('disabled');
			$('#tempat_suratlain').removeAttr('disabled');
			$('#keterangan_suratlain').removeAttr('disabled');
			$('#file_suratlain').attr('style','display:block;');
			$('#lihat_file_suratlain').attr('style','display:none;');
		};

		function disable_keluarga(){
			$('#hubungan').attr('disabled','disabled');
			$('#nama').attr('disabled','disabled');
			$('#gelar_depan').attr('disabled','disabled');
			$('#gelar_belakang').attr('disabled','disabled');
			$('#jenis_dokumen').attr('disabled','disabled');
			$('#nomor_dokumen').attr('disabled','disabled');
			$('#jenis_kelamin').attr('disabled','disabled');
			$('#agama').attr('disabled','disabled');
			$('#tempat_lahir').attr('disabled','disabled');
			$('#tanggal_lahir').attr('disabled','disabled');
			$('#akte_lahir').attr('disabled','disabled');
			$('#tanggal_nikah').attr('disabled','disabled');
			$('#akte_nikah').attr('disabled','disabled');
			$('#status_cerai').attr('disabled','disabled');
			$('#tanggal_cerai').attr('disabled','disabled');
			$('#akte_cerai').attr('disabled','disabled');
			$('#alamat').attr('disabled','disabled');
			$('#handphone').attr('disabled','disabled');
			$('#telepon').attr('disabled','disabled');
			$('#email').attr('disabled','disabled');
			$('#status_perkawinan').attr('disabled','disabled');
			$('#pekerjaan').attr('disabled','disabled');
			$('#keterangan').attr('disabled','disabled');
			$('#status_hidup').attr('disabled','disabled');
			$('#tanggal_meninggal').attr('disabled','disabled');
			$('#akte_meninggal').attr('disabled','disabled');
			$('#foto_keluarga').attr('disabled','disabled');
			$('#PrevFoto').attr('disabled','disabled');
		};

		function enable_keluarga(){
			$('#hubungan').removeAttr('disabled');
			$('#nama').removeAttr('disabled');
			$('#gelar_depan').removeAttr('disabled');
			$('#gelar_belakang').removeAttr('disabled');
			$('#jenis_dokumen').removeAttr('disabled');
			$('#nomor_dokumen').removeAttr('disabled');
			$('#jenis_kelamin').removeAttr('disabled');
			$('#agama').removeAttr('disabled');
			$('#tempat_lahir').removeAttr('disabled');
			$('#tanggal_lahir').removeAttr('disabled');
			$('#akte_lahir').removeAttr('disabled');
			$('#tanggal_nikah').removeAttr('disabled');
			$('#akte_nikah').removeAttr('disabled');
			$('#status_cerai').removeAttr('disabled');
			$('#tanggal_cerai').removeAttr('disabled');
			$('#akte_cerai').removeAttr('disabled');
			$('#alamat').removeAttr('disabled');
			$('#handphone').removeAttr('disabled');
			$('#telepon').removeAttr('disabled');
			$('#email').removeAttr('disabled');
			$('#status_perkawinan').removeAttr('disabled');
			$('#pekerjaan').removeAttr('disabled');
			$('#keterangan').removeAttr('disabled');
			$('#status_hidup').removeAttr('disabled');
			$('#tanggal_meninggal').removeAttr('disabled');
			$('#akte_meninggal').removeAttr('disabled');
			$('#foto_keluarga').removeAttr('disabled');
			$('#PrevFoto').removeAttr('disabled');
		};

	</script>
</body>
</html>
