<!--APP-SIDEBAR-->
<div class="sticky">
	<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
	<div class="app-sidebar">
		<div class="side-header">
			<a class="header-brand1 text-dark" style="font-weight: bold;" href="/user"><img src="/storage/image/lampura.png" style="width: 30px;" class="header-brand-img all-logo" alt="logo"> E-Cuti</a>
		</div>		

		<div class="main-sidemenu">			
			<ul class="side-menu">
				<li class="nav-link leading-none d-flex">
					<span class="avatar avatar-lg brround cover-image" data-bs-image-src="/assets/images/users/17.jpg"></span>
					<span class="side-menu__label" style="padding-left: 5px; font-weight: bold;">{{ Str::upper(Session::get('nama')) }}</span>
				</li>
				<li class="nav-link leading-none d-flex">
					<span class="side-menu__label" style="padding-left: 5px;">NIP: {{ Session::get('nip') }}</span>
				</li>
				<li class="nav-link leading-none d-flex">
					<span class="side-menu__label" style="padding-left: 5px; word-wrap: break-word; white-space: pre-line;">{{ Session::get('unker') }}</span>
				</li>
				<li class="sub-category">
					<h3>Menu Utama</h3>
				</li>
				<li class="slide">
					<a class="side-menu__item has-link" data-bs-toggle="slide" href="/user"><i
							class="side-menu__icon fe fe-home"></i><span
							class="side-menu__label">Beranda</span></a>
				</li>
				<li class="slide">
					<a class="side-menu__item has-link" data-bs-toggle="slide" href="/pengajuan"><i
							class="side-menu__icon fe fe-file-text"></i><span
							class="side-menu__label">Pengajuan Cuti</span></a>
				</li>

				@if(Session::get('jenis_jbt') == 'Struktural')
				<li class="slide">
					<a class="side-menu__item has-link" data-bs-toggle="slide" href="/cutibawahan"><i
							class="side-menu__icon fe fe-check-square"></i><span
							class="side-menu__label">Cuti Bawahan</span></a>
				</li>
				@endif

				<li class="slide">
					<a class="side-menu__item has-link" data-bs-toggle="slide" href="/bantuan"><i
						class="side-menu__icon fe fe-help-circle"></i><span class="side-menu__label">Bantuan</span></a>
				</li>
			
													
			</ul>
			<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
					width="24" height="24" viewBox="0 0 24 24">
					<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
				</svg></div>
		</div>
	</div>
</div>
<!--/APP-SIDEBAR-->
