<!DOCTYPE html>
<html>
<?php include(__DIR__ . "/../../../tittle.php"); ?>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php include(__DIR__ . "/../../sidebar.php"); ?>
			<?php include(__DIR__ . "/../../top_nav.php"); ?>

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
											<p>
												<?=$status['status']?>
											</p>
											<p>
												<?=$status['action_user']?>
											</p>
												
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
	<?php include(__DIR__ . "/../../../load_js.php"); ?>
	<script>
		$(document).ready(function(){
			var id_peg 		= $('#id_pegawai').val();

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
									{ "mData"	: "status"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,3,7,9] },
									{ className: "text-right", "targets": 4 },
									{ width: 30, targets: 0}
								],
				"fixedColumns": true
			});

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
									{ "mData"	: "status"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,2,4,7,10] },
									{ className: "text-right", "targets": 3 },
									{ width: 30, targets: 0}
								],
				"fixedColumns": true
			});

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
									{ "mData"	: "action_user"}
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
									{ "mData"	: "action_user"}
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
									{ "mData"	: "action_user"}
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
									{ "mData"	: "action_user"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,8,9] },
									{ width: 30, targets: 0},
									{ width: 80, targets: 9}
								],
				"fixedColumns": true
			});

			$('#btn-tambah-pendidikan').on('click',function(){
				$('#form-pendidikan')[0].reset();
				var pegawai 	= $('#id_pegawai').val();
				$('#title-pendidikan').html('Tambah Data Pendidikan Formal');
				$('#form-pendidikan').attr('action','<?=base_url()?>pendidikan/tambah_user')
				$('#id_pegawai_pendidikan').val(pegawai);
				$('#modal-pendidikan').modal('show');
			});

			$('#data-pendidikan').on('click','#btn-ubah',function(){
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
				$('#form-pendidikan').attr('action','<?=base_url()?>pendidikan/edit_user')
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
							url: 		'<?=base_url()?>'+'pendidikan/hapus_user/' + kd + '/' + pegawai,
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

			//--Kursus--//

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
									{ "mData"	: "action_user"}
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
				$('#form-kursus')[0].reset();
				$('#id_jenis_kursus').change();
				var pegawai 	= $('#id_pegawai').val();
				$('#title-kursus').html('Tambah Data Pendidikan Non-Formal');
				$('#form-kursus').attr('action','<?=base_url()?>kursus/tambah_user')
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
				$('#form-kursus').attr('action','<?=base_url()?>kursus/edit_user')
				$('#title-kursus').html('Ubah Data Pendidikan Non-Formal');
				$('#modal-kursus').modal('show');
			});

			$('#data-kursus').on('click','#btn-hapus',function(){
				var kd 		= $(this).data('kode');
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
							url: 		'<?=base_url()?>'+'kursus/hapus_user/' + kd + '/' + pegawai,
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
									{ "mData"	: "action_user"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,4,5] },
									{ width: 30, targets: 0},
									{ width: 50, targets: 5}
								],
				"fixedColumns": true
			});

			$('#btn-tambah-penghargaan').click(function(){
				var pegawai 	= $('#id_pegawai').val(); 
				$('#form-penghargaan')[0].reset();
				$('#id_pegawai_penghargaan').val(pegawai);
				$('#form-penghargaan').attr('action','<?=base_url()?>penghargaan/tambah_user');
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

			$('#body-penghargaan').on('click', '#btn-ubah', function(){
				$('.modal-title').html('Ubah Data');
				$('#form-penghargaan').attr('action','<?=base_url()?>penghargaan/edit_user');
				$('#kd_penghargaan').val($(this).data('kd'));
				$('#id_pegawai_penghargaan').val($(this).data('pegawai'));
				$('#nama_penghargaan').val($(this).data('nama'));
				$('#tahun_penghargaan').val($(this).data('tahun'));
				$('#pemberi_penghargaan').val($(this).data('pemberi'));
				$('#modal-penghargaan').modal('show');
				$('#nama').focus();
				$('#nama').select();
			});

			$('#body-penghargaan').on('click', '#btn-hapus', function(){
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
							url: 		'<?=base_url()?>'+'penghargaan/hapus_user/' + kd + '/' + pegawai,
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

			//-- Data kunjungan Luar Negeri --//

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
									{ "mData"	: "action_user"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,5,6] },
									{ width: 30, targets: 0},
									{ width: 50, targets: [5,6]}
								],
				"fixedColumns": true
			});

			$('#btn-tambah-kunjungan').on('click',function(){
				var pegawai 	= $('#id_pegawai').val(); 
				$('#form-kunjungan')[0].reset();
				$('#id_pegawai_kunjungan').val(pegawai);
				$('#form-kunjungan').attr('action','<?=base_url()?>luar_negri/tambah_user');
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
			
			$('#body-kunjungan').on('click', '#btn-ubah', function(){
				$('#title-kunjungan').html('Ubah Data Pengalaman Luar Negeri');
				$('#form-kunjungan').attr('action','<?=base_url()?>luar_negri/edit_user');
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

			$('#body-kunjungan').on('click', '#btn-hapus', function(){
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
							url: 		'<?=base_url()?>'+'luar_negri/hapus_user/' + kd + '/' + pegawai,
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
				var pegawai 	= $('#id_pegawai').val(); 
				$('#form-keluarga')[0].reset();
				$('#id_pegawai_keluarga').val(pegawai);
				$('#form-keluarga').attr('action','<?=base_url()?>keluarga/tambah_user');
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
						swal('Error');
					}
				}).submit();
			});

			$('#data-keluarga').on('click', '#btn-ubah', function(){
				$('#form-keluarga')[0].reset();
				$('#title-keluarga').html('Ubah Data keluarga');
				$('#form-keluarga').attr('action','<?=base_url()?>keluarga/edit_user');
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

			$('#data-keluarga').on('click','#btn-hapus',function(){
				var kd 		= $(this).data('kode');
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
							url: 		'<?=base_url()?>'+'keluarga/hapus_user/' + kd + '/' + pegawai,
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
				$('#form-organisasi')[0].reset();
				$('#id_pegawai_organisasi').val(pegawai);
				$('#form-organisasi').attr('action','<?=base_url()?>organisasi/tambah_user');
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
						swal('Error');
					}
				}).submit();
			});
			
			$('#data-organisasi').on('click', '#btn-ubah', function(){
				$('#title-organisasi').html('Ubah Data Organisasi');
				$('#form-organisasi').attr('action','<?=base_url()?>organisasi/edit_user');
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

			$('#data-organisasi').on('click','#btn-hapus',function(){
				var kd 		= $(this).data('kode');
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
							url: 		'<?=base_url()?>'+'organisasi/hapus_user/' + kd + '/' + pegawai,
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
				$('#form-suratlain')[0].reset();
				$('#id_pegawai_suratlain').val(pegawai);
				$('#form-suratlain').attr('action','<?=base_url()?>suratlain/tambah_user');
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
						swal('Error');
					}
				}).submit();
			});
			
			$('#data-suratlain').on('click', '#btn-ubah', function(){
				$('#title-suratlain').html('Ubah Data Surat Lain-Lain');
				$('#form-suratlain').attr('action','<?=base_url()?>suratlain/edit_user');
				$('#kd_suratlain').val($(this).data('kd'));
				$('#id_pegawai_suratlain').val($(this).data('pegawai'));
				$('#nama_suratlain').val($(this).data('nama'));
				$('#tempat_suratlain').val($(this).data('tempat'));
				$('#tanggal_suratlain').val($(this).data('tanggal'));
				$('#keterangan_suratlain').val($(this).data('keterangan'));
				$('#modal-suratlain').modal('show');
				$('#nama_suratlain').focus();
				$('#nama_suratlain').select();
			});

			$('#data-suratlain').on('click','#btn-hapus',function(){
				var kd 		= $(this).data('kode');
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
							url: 		'<?=base_url()?>'+'suratlain/hapus_user/' + kd + '/' + pegawai,
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
									{ "mData"	: "tanggal"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,5] },
									{ width: 30, targets: 0},
									{ width: 50, targets: 5}
								],
				"fixedColumns": true
			});

			//-- Data Hukuman --//

			$('#btn-edit-pegawai').on('click', function(){
				var kode =	$('#id_pegawai').val();
				var url = "<?=base_url()?>pegawai/form_edit_profil/" + kode;
				window.location.href = url;
			});

		});
	</script>
</body>
</html>
