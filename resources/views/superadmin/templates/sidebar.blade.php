<!--APP-SIDEBAR-->
<div class="sticky">
	<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
	<div class="app-sidebar">
		<div class="side-header">
			<a class="header-brand1 text-dark" style="font-weight: bold;" href="/user"><img src="storage/image/lampura.png" style="width: 30px;" class="header-brand-img all-logo" alt="logo"> SIDAK</a>
		</div>		

		<div class="main-sidemenu">			
			<ul class="side-menu">
				<li class="nav-link leading-none d-flex">
					<span class="avatar avatar-lg brround cover-image" data-bs-image-src="../assets/images/users/17.jpg"></span>
					<span class="side-menu__label" style="padding-left: 5px; font-weight: bold;">{{ Str::upper(Session::get('nama')) }}<br><a style="font-size: 10px;">Admin BKPSDM</a></span>
				</li>
				

				<li class="sub-category">
					<h3>Menu Utama</h3>
				</li>

				<li class="slide">
					<a class="side-menu__item has-link" data-bs-toggle="slide" href="/admin"><i
							class="side-menu__icon fe fe-home"></i><span
							class="side-menu__label">Beranda</span></a>
				</li>				

				<li class="slide">
					<a class="side-menu__item has-link" data-bs-toggle="slide" href="/dataasn"><i
							class="side-menu__icon fe fe-file-text"></i><span
							class="side-menu__label">Data Mandiri ASN</span></a>
				</li>
							

				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
							class="side-menu__icon fe fe-check-square"></i><span
							class="side-menu__label">Manajemen User</span><i
							class="angle fe fe-chevron-right"></i>
					</a>
					<ul class="slide-menu">
						<li class="panel sidetab-menu">							
							<div class="panel-body tabs-menu-body p-0 border-0">
								<div class="tab-content">
									<div class="tab-pane active">
										<ul class="sidemenu-list">											
											<li><a href="/manajpegawai" class="slide-item"> Pegawai</a></li>
											<li><a href="/manajkup" class="slide-item"> Kassubag UP</a></li>
											<li><a href="/manajadmin" class="slide-item"> Admin BKPSDM</a></li>
										</ul>										
									</div>									
								</div>
							</div>
						</li>
					</ul>
				</li>

				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
							class="side-menu__icon fe fe-check-square"></i><span
							class="side-menu__label">Master Data</span><i
							class="angle fe fe-chevron-right"></i>
					</a>
					<ul class="slide-menu">
						<li class="panel sidetab-menu">							
							<div class="panel-body tabs-menu-body p-0 border-0">
								<div class="tab-content">
									<div class="tab-pane active">
										<ul class="sidemenu-list">											
											<li><a href="/jabatan" class="slide-item"> Jabatan</a></li>
											<li><a href="/opd" class="slide-item"> OPD</a></li>
										</ul>										
									</div>
								</div>
							</div>
						</li>
					</ul>
				</li>
							
				<li class="slide">
					<a class="side-menu__item has-link" data-bs-toggle="slide" href="/data"><i
							class="side-menu__icon fe fe-file-text"></i><span
							class="side-menu__label">Pengumuman</span></a>
				</li>				
				<li class="slide">
					<a class="side-menu__item has-link" data-bs-toggle="slide" href="/profiluser"><i
							class="side-menu__icon fe fe-user"></i><span
							class="side-menu__label">Profil</span></a>
				</li>
				<li class="slide">
					<a class="side-menu__item has-link" data-bs-toggle="slide" href="/bantuan"><i
						class="side-menu__icon fe fe-help-circle"></i><span class="side-menu__label">Bantuan</span></a>
				</li>

				<div class="sub-category" style="width: 250px;">
					BKPSDM Kab. Lampung Utara.
				</div>											
			</ul>
			<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
					width="24" height="24" viewBox="0 0 24 24">
					<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
				</svg></div>
		</div>
	</div>
</div>
<!--/APP-SIDEBAR-->
