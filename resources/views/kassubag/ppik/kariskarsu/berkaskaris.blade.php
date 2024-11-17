@extends('kassubag.templates.main')
@section('content')
<div class="main-content app-content mt-5">
    <div class="side-app">
        <div class="main-container container-fluid">        
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pengajuan Karis Karsu</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Permohonan</label>
                                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" value="{{ $pegawai->nama }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">NIP</label>
                                        <input type="number" class="form-control" value="{{ $pegawai->nip }}" readonly>
                                    </div>                                                                                                            

                                    <div class="form-group">
                                        <label class="form-label">Pangkat/Gol.Ruang/TMT</label>
                                        <input type="text" class="form-control" value="{{ $pegawai->pangkat }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Unit Kerja</label>
                                        <input type="text" class="form-control" value="{{ $pegawai->nama_pd }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Unit Organisasi</label>
                                        <input type="text" class="form-control" value="{{ $pegawai->unit_organisasi }}" readonly>
                                    </div>                                                          
                                </div>

                                <div class="col-md-7">

                                    <div class="table-responsive">
                                        <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th width="50%">Nama Dokumen</th>
                                                    <th width="40%">File</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>                                                                                                                                             
                                                <tr>
                                                    <td>1</td>
                                                    <td>Pengantar OPD</td>
                                                    <td>@if($berkas->pengantar)<a class="btn btn-success btn-sm" title="Lihat File" target="_blank" href="/{{ $berkas->pengantar }}"><i class="fa fa-file"></i> Lihat File</a>@endif</td>                                                    
                                                </tr>                                                
                                                <tr>
                                                    <td>2</td>
                                                    <td>SK CPNS</td>
                                                    <td>@if($berkas->sk_cpns)<a class="btn btn-success btn-sm" title="Lihat File" target="_blank" href="/{{ $berkas->sk_cpns }}"><i class="fa fa-file"></i> Lihat File</a>@endif</td>                                                    
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>SK PNS</td>
                                                    <td>@if($berkas->sk_pns)<a class="btn btn-success btn-sm" title="Lihat File" target="_blank" href="/{{ $berkas->sk_pns }}"><i class="fa fa-file"></i> Lihat File</a>@endif</td>                                                    
                                                </tr>                                                
                                                <tr>
                                                    <td>4</td>
                                                    <td>Surat Nikah</td>
                                                    <td>@if($berkas->suratnikah)<a class="btn btn-success btn-sm" title="Lihat File" target="_blank" href="/{{ $berkas->suratnikah }}"><i class="fa fa-file"></i> Lihat File</a>@endif</td>                                                    
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Foto Suami Istri</td>
                                                    <td>@if($berkas->fotosuamiistri)<a class="btn btn-success btn-sm" title="Lihat File" target="_blank" href="/{{ $berkas->fotosuamiistri }}"><i class="fa fa-file"></i> Lihat File</a>@endif</td>                                                    
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Formulir Perkawinan</td>
                                                    <td>@if($berkas->formulirkawin)<a class="btn btn-success btn-sm" title="Lihat File" target="_blank" href="/{{ $berkas->formulirkawin }}"><i class="fa fa-file"></i> Lihat File</a>@endif</td>                                                    
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="form-footer mt-4 offset-5">
                                <a href="/pengajuanpensiun" class="btn btn-default">Kembali</a>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Konfirmasi Pengajuan Berkas</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/konfirmberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                        
            <div class="col-md-12">                
                <h5 class="text-center">Anda Yakin Berkas Sudah Sesuai Persyaratan?</h5>                
            </div>

            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Submit, Ajukan</button>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="modal fade" id="addPasfoto">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload Pas Foto</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="pasfoto">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Pas Foto</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen Pas Foto')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addDpcp">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload DPCP</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="dpcp">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">DPCP</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen DPCP')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addPengantar">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload Pengantar OPD</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="pengantar">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Pengantar OPD</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen Pengantar OPD')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addSkcpns">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload SK CPNS</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="sk_cpns">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">SK CPNS</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen SK CPNS')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addSkpns">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload SK PNS</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="sk_pns">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">SK PNS</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen SK PNS')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addSkpangkat">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload SK Pangkat Terakhir</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="sk_pangkat">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">SK Pangkat Terakhir</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen SK Pangkat Terakhir')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addSkberkala">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload SK Berkala</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="sk_berkala">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">SK Berkala</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen SK Berkala')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addKarpeg">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload Karpeg</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="karpeg">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Karpeg</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen Karpeg')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addSkp">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload SKP</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="skp">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">SKP</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen SKP')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addSuratnikah">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload Surat Nikah</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="suratnikah">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Surat Nikah</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen Surat Nikah')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addKartukeluarga">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload Kartu Keluarga</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="kartukeluarga">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Kartu Keluarga</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen Kartu Keluarga')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addAkte">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload Akte Kelahiran</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="aktekelahiran">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Akte Kelahiran</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen Akte Kelahiran')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addSknipbaru">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload SK NIP Baru</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="sk_nipbaru">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">SK NIP Baru</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen SK NIP Baru')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="modal fade" id="addAktamati">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload Akta Mati Cerai</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="akta_maticerai">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Akta Mati Cerai</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen Akta Mati Cerai')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addSuratdisiplin">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload Surat Pernyataan Hukuman Disiplin</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="sp_hukdis">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Surat Pernyataan Hukuman Disiplin</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen Surat Pernyataan Hukuman Disiplin')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addSuratpidana">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload Surat Pernyataan Bebas Pidana</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="sp_pidana">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Surat Pernyataan Bebas Pidana</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen Surat Pernyataan Bebas Pidana')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addSuratpmk">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload Surat Keterangan Penambahan Masa Kerja</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" action="/insertberkas" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">            
            <input type="hidden" class="form-control" name="kategori" value="sk_pmk">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Surat Keterangan Penambahan Masa Kerja</label>
                    <input type="file" class="form-control" name="file" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen Surat Keterangan Penambahan Masa Kerja')" oninput="setCustomValidity('')">
                </div>
            </div>
            </div>
            <div class="modal-footer">               
            <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection