@extends('kassubag.templates.main')
@section('content')

<!--app-content open-->
<div class="main-content app-content mt-5">
    <div class="side-app">        
        <div class="main-container container-fluid">                                    
            
            <div class="row row-sm">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header">
                            DAFTAR ASN {{ Session::get('nama_lain') }} &emsp;<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPegawai"><i class="fa fa-plus-circle"></i> Tambah ASN</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <td width="10px">No</td>
                                            <td>Nama</td>
                                            <td>NIP</td>
                                            <td>Pangkat</td>
                                            <td>Jabatan</td>
                                            <td>Unit organisasi</td>
                                            <td>Foto</td>
                                            <td width="20px">Opsi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pegawai as $dt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dt->nama }}</td>
                                            <td>{{ $dt->nip }}</td>
                                            <td>{{ $dt->pangkat }}</td>
                                            <td>{{ $dt->jabatan }}</td>
                                            <td>{{ $dt->unit_organisasi }}</td>
                                            @if($dt->foto)                                                
                                            <td class="align-middle text-center"><img alt="image" class="avatar avatar-md br-7" src="/storage/avatar/{{ $dt->foto }}"></td>
                                            @else
                                            <td class="align-middle text-center"><img alt="image" class="avatar avatar-md br-7" src="/assets/images/users/15.jpg"></td>        
                                            @endif                                            
                                            <td class="text-center text-nowrap">
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#update{{ $dt->id }}"><i class="fa fa-edit"></i></button> <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $dt->id }}"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>                      
        </div>        
    </div>
</div>
<!--app-content closed-->


<div class="modal fade" id="addPegawai">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Data Pegawai ASN</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertpegawai" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Nama</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nama" required oninvalid="this.setCustomValidity('Mohon isi Nama Lengkap ASN')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">NIP</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="nip" required oninvalid="this.setCustomValidity('Mohon isi NIP')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Jenis Kelamin</label>
                        <div class="col-md-9">                           
                            <select class="form-control select2 form-select" name="jenkel" required oninvalid="this.setCustomValidity('Mohon pilih Jenis Kelamin')" oninput="setCustomValidity('')">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Pangkat</label>
                        <div class="col-md-9">                            
                            <select class="form-control select2-show-search form-select" style="width: 100%" id="select_pangkat" name="pangkat" required oninvalid="this.setCustomValidity('Mohon pilih Pangkat')" oninput="setCustomValidity('')">                                                                
                                @foreach ($pangkat as $pa)
                                    <option value="{{ $pa->pangkat }}">{{ $pa->pangkat }} {{ $pa->golongan }}</option>
                                @endforeach                     
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Jabatan</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="jabatan" required oninvalid="this.setCustomValidity('Mohon isi Jabatan')" oninput="setCustomValidity('')">
                        </div>
                    </div>                    
                </div>
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Jenis Jabatan</label>
                        <div class="col-md-9">                            
                            <select class="form-control select2 form-select" name="jenis_jbt" required oninvalid="this.setCustomValidity('Mohon pilih Jenis Jabatan')" oninput="setCustomValidity('')">                                
                                <option value="Struktural">Struktural</option>
                                <option value="Fungsional">Fungsional</option>
                                <option value="Pelaksana/Staf PNS">Pelaksana/Staf PNS</option>
                            </select>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Unit Kerja</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" readonly value="{{ Session::get('nama_pd') }}">
                        </div>
                    </div>                
                </div>
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Unit Organisasi</label>
                        <div class="col-md-9">
                            <select class="form-control select2 form-select" name="kode_unit" required oninvalid="this.setCustomValidity('Mohon pilih Unit Organisasi')" oninput="setCustomValidity('')">                                                                
                                @foreach ($unor as $un)
                                    <option value="{{ $un->kode_unit }}">{{ $un->unor }}</option>
                                @endforeach                     
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Email</label>
                        <div class="col-md-9">
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>                
                </div>
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Telepon</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="telepon">
                        </div>
                    </div>
                </div>
            </div>
            

            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>


@foreach($pegawai as $up)
<div class="modal fade updatepegawai" id="update{{ $up->id }}">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Data Pegawai ASN</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/updatepegawai" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
            <input type="hidden" value="{{ $up->id }}" name="id_pegawai" class="form-control">
            <div class="row">
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Nama</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nama" value="{{ $up->nama }}" required oninvalid="this.setCustomValidity('Mohon isi Nama Lengkap ASN')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">NIP</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="nip" value="{{ $up->nip }}" required oninvalid="this.setCustomValidity('Mohon isi NIP')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Jenis Kelamin</label>
                        <div class="col-md-9">                                                       
                            <select class="form-control select2 form-select" name="jenkel" required oninvalid="this.setCustomValidity('Mohon pilih Jenis Kelamin')" oninput="setCustomValidity('')">                                                                                                
                                <option value="Laki-laki" {{ $up->jenkel == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $up->jenkel == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Pangkat</label>
                        <div class="col-md-9">                            
                            <select class="form-control select2 form-select" name="pangkat" required oninvalid="this.setCustomValidity('Mohon pilih Pangkat')" oninput="setCustomValidity('')">                                                                
                                @foreach ($pangkat as $pa)
                                    <option value="{{ $pa->pangkat }}" {{ $up->pangkat == $pa->pangkat ? 'selected' : '' }}>{{ $pa->pangkat }}</option>
                                @endforeach                     
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Jabatan</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="jabatan" value="{{ $up->jabatan }}" required oninvalid="this.setCustomValidity('Mohon isi Jabatan')" oninput="setCustomValidity('')">
                        </div>
                    </div>                    
                </div>
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Jenis Jabatan</label>
                        <div class="col-md-9">                            
                            <select class="form-control select2 form-select" name="jenis_jbt" required oninvalid="this.setCustomValidity('Mohon pilih Jenis Jabatan')" oninput="setCustomValidity('')">                                
                                <option value="Struktural" {{ $up->jenis_jbt == 'Struktural' ? 'selected' : '' }}>Struktural</option>
                                <option value="Fungsional" {{ $up->jenis_jbt == 'Fungsional' ? 'selected' : '' }}>Fungsional</option>
                                <option value="Pelaksana/Staf PNS" {{ $up->jenis_jbt == 'Pelaksana/Staf PNS' ? 'selected' : '' }}>Pelaksana/Staf PNS</option>
                            </select>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Unit Kerja</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" readonly value="{{ Session::get('nama_pd') }}">
                        </div>
                    </div>                
                </div>
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Unit Organisasi</label>
                        <div class="col-md-9">
                            <select class="form-control select2 form-select" name="kode_unit" required oninvalid="this.setCustomValidity('Mohon pilih Unit Organisasi')" oninput="setCustomValidity('')">                                                                
                                @foreach ($unor as $un)
                                    <option value="{{ $un->kode_unit }}" {{ $up->kode_unit == $un->kode_unit ? 'selected' : '' }}>{{ $un->unor }}</option>
                                @endforeach                     
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Email</label>
                        <div class="col-md-9">
                            <input type="email" class="form-control" name="email" value="{{ $up->email }}">
                        </div>
                    </div>                
                </div>
                <div class="col-md-6">
                    <div class=" row mb-4">
                        <label class="col-md-3 form-label">Telepon</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="telepon" value="{{ $up->telepon }}">
                        </div>
                    </div>
                </div>
            </div>

            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="modal fade" id="delete{{ $up->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">      
            <div class="modal-body text-center">
                <i class="icon icon-close fs-50 text-danger lh-1 my-4 d-inline-block"></i>            
                <h4 class="text-danger mb-20">Anda Yakin Menghapus Data Pegawai ini?</h4>
                <button class="btn btn-default" data-bs-dismiss="modal">Batal</button>&emsp; <a type="submit" class="btn btn-danger pd-x-25" href="/deletepegawai/{{ $up->id }}">Hapus</a>
            </div>         
        </div>
    </div>
</div>



@endforeach


@endsection

@push('script')

<script>
$(document).ready(function() {
    $("#select_pangkat").select2({
        dropdownParent: $('#addPegawai .modal-content')
    });   
});
</script>

@endpush