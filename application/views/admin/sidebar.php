<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
		<div class="navbar nav_title" style="border: 0;">
			<a id="logo_site" href="<?=base_url()?>" class="site_title">
				<img src="<?=base_url()?>assets/images/logo2.gif" width="45px" height="45px">
				<span> Simpeg Polines</span>
			</a>
		</div>
		<div class="clearfix"></div>

		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			<div class="menu_section">
				<ul class="nav side-menu">
					<li>
						<a href="<?=base_url()?>user"><i class="fa fa-dashboard"></i>Dashboard</a>
					</li>
					<li>
						<a><i class="fa fa-database"></i>Master Data<span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="<?=base_url()?>agama"			>Agama</a></li>
							<li><a href="<?=base_url()?>alamat"			>Alamat</a></li>
							<li><a href="<?=base_url()?>jenjang"		>Jenjang Pendidikan</a></li>
							<li><a href="<?=base_url()?>jenis_kursus"	>Jenis Pend. Non-Formal</a></li>
							<li><a href="<?=base_url()?>status"			>Status Pegawai</a></li>
							<li><a href="<?=base_url()?>jenis"			>Jenis Pegawai</a></li>
							<li><a href="<?=base_url()?>jurusan"		>JurBagSatPusNit</a></li>
							<li><a href="<?=base_url()?>prodi"			>ProdiSubDiv</a></li>
							<li><a href="<?=base_url()?>pangkat"		>Pangkat</a></li>
							<li><a href="<?=base_url()?>eselon"			>Eselon</a></li>
							<li><a href="<?=base_url()?>jabatan"		>Jabatan</a></li>
							<li><a href="<?=base_url()?>penempatan"		>Penempatan</a></li>
							<li><a href="<?=base_url()?>peraturan"		>Peraturan</a></li>
							<li><a href="<?=base_url()?>pengurus"		>Pengurus</a></li>
							<li><a href="<?=base_url()?>reset"			>Pengaturan User</a></li>
						</ul>
					</li>
					<li>
						<a><i class="fa fa-users"></i>Pegawai<span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="<?=base_url()?>pegawai"	>Semua Data Pegawai</a></li>
							<?php 
								$submenu 	= $this->db->query("SELECT * FROM t_jenis WHERE sts_jenis<>'1' ORDER BY kd_jenis;");
								foreach ($submenu->result() as $submenu) {
									echo '<li><a href="' 	. base_url() 		. 
										 'pegawai/group/' 	. $submenu->id_jenis 	. 
										 '">' 				. $submenu->nm_jenis 	.
										 '</a></li>';
								}
							?>
							<!-- <li><a href="<?=base_url()?>pensiun"	>Data Pegawai Pensiun</a></li> -->
							<li><a href="<?=base_url()?>pensiunan"	>Data Pegawai Pensiun</a></li>
							<li><a href="<?=base_url()?>meninggal"	>Data Pegawai Meninggal</a></li>
						</ul>
					</li>
					<li>
						<a><i class="fa fa-file-text-o"></i>Dokumen<span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="<?=base_url()?>naik_pangkat"	>Kenaikan Pangkat</a></li>
							<li><a href="<?=base_url()?>gaji"			>Kenaikan Gaji Berkala</a></li>
							<li><a href="<?=base_url()?>pensiun"		>Pengajuan Pensiun</a></li>
							<li><a>Daftar Urut Kepangkatan<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu">
								<li class="sub_menu"><a href="<?=base_url()?>pegawai/duk_jenis"		>Berdasarkan Jenis</a></li>
								<li class="sub_menu"><a href="<?=base_url()?>pegawai/duk_jurusan"	>Berdasarkan Jurusan</a></li>
								<li class="sub_menu"><a href="<?=base_url()?>pegawai/duk_pensiun"	>Pensiun dan Meninggal</a></li>
							</ul>
                        </li>
							<li><a href="<?=base_url()?>riwayat_hidup"	>Daftar Riwayat Hidup</a></li>
							<li><a href="<?=base_url()?>riwayat_singkat">Daftar Riwayat Hidup Singkat</a></li>
						</ul>
					</li>
					<li>
						<a href="<?=base_url()?>setting"><i class="fa fa-key"></i>Setting User</a>
					</li>
					<!-- <li>
						<a href="<?=base_url()?>pertanyaan"><i class="fa fa-comments-o"></i>Pertanyaan</a>
					</li> -->
				</ul>
			</div>
		</div>
		<!-- /sidebar menu -->

	</div>
</div>