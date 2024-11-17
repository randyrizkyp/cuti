@extends('pegawai.templates.main')
@section('content')

<div class="main-content app-content mt-5">
    <div class="side-app">        
        <div class="main-container container-fluid">
           
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">                        
                        <div class="card-body mt-4">
                            <div class="text-center chat-image mb-5" style="margin-left: -5%;">
                                <div class="avatar avatar-xxl chat-profile mb-3 brround" style="margin-left: 5%;">
                                    <a href="/"><img alt="avatar" src="../assets/images/users/7.jpg" class="brround"></a>                                    
                                </div>
                                <div class="main-chat-msg-name">                                    
                                    <h5 class="mb-1 text-dark fw-semibold">{{ Session::get('nama') }}</h5>                                    
                                    <p class="text-muted mt-0 mb-0 pt-0 fs-13">{{ Session::get('nip') }}</p>
                                    <p class="text-muted mt-0 mb-0 pt-0 fs-13">Dinas Komunikasi dan Informatika Kab. Lampung Utara</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ubah Password</label>
                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">                                    
                                    <input class="input100 form-control" type="password" placeholder="Password Sekarang" autocomplete="current-password">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="wrap-input100 validate-input input-group" id="Password-toggle1">                                    
                                    <input class="input100 form-control" type="password" placeholder="Password Baru" autocomplete="new-password">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="wrap-input100 validate-input input-group" id="Password-toggle2">                                    
                                    <input class="input100 form-control" type="password" placeholder="Konfirmasi Password Baru" autocomplete="new-password">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="javascript:void(0)" class="btn btn-primary">Ubah Password</a>
                            <a href="javascript:void(0)" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                    
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ubah Profil</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Alamat Email">
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="number" class="form-control" name="telepon" placeholder="Telepon">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3"></textarea>
                            </div>                                                        
                        </div>
                        <div class="card-footer text-end">
                            <a href="javascript:void(0)" class="btn btn-success my-1">Simpan</a>
                            <a href="javascript:void(0)" class="btn btn-danger my-1">Batal</a>
                        </div>
                    </div>                   
                    
                </div>
            </div>
                        
        </div>        
    </div>
</div>


@endsection

@push('script')
    <script src="/assets/js/show-password.min.js"></script>
@endpush