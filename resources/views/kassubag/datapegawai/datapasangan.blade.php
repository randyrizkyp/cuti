@extends('pegawai.templates.main')
@section('content')

<!--app-content open-->
<div class="main-content app-content mt-5">
   <div class="side-app">        
      <div class="main-container container-fluid">                                    
         
         <div class="row row-sm">
               <div class="col-lg-12">

                  <div class="card">
                     <div class="card-header">
                           <button class="btn btn-default btn-sm me-1" onclick="window.history.go(-1); return false;"><i class="fa fa-arrow-left"></i> Kembali</button> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPasangan"><i class="fa fa-plus-circle"></i> Tambah Pasangan</button>
                     </div>
                     <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-striped table-bordered" id="basic-datatable">
                                 <thead>
                                       <tr>
                                          <td width="10px">No</td>
                                          <td>NIK</td>
                                          <td>Nama</td>
                                          <td>Tanggal Lahir</td>
                                          <td>Tanggal Nikah</td>
                                          <td>Istri/Suami Ke</td>
                                          <td>Status</td>                 
                                          <td width="20px">Opsi</td>                         
                                       </tr>
                                 </thead>
                                 <tbody>
                                       @foreach($pasangan as $dt)
                                       <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $dt->nik }}</td>
                                          <td>{{ $dt->nama }}</td>
                                          <td>{{ date("d M Y", strtotime($dt->tgllahir)) }}</td>
                                          <td>{{ date("d M Y", strtotime($dt->tglnikah)) }}</td>
                                          <td>{{ $dt->istrisuamike }}</td>
                                          <td>{{ $dt->status }}</td>                                                                                    
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


<div class="modal fade" id="addPasangan">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-content-demo">
         <div class="modal-header">
            <h6 class="modal-title">Tambah Data Pasangan</h6>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <form class="form-horizontal" action="/tambahpasangan" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="modal-body">
         <input type="hidden" class="form-control" name="nip" value="{{ $pegawai->nip }}">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">NIK</label>
                  <input type="number" class="form-control" name="nik" required oninvalid="this.setCustomValidity('Mohon isi NIK')" oninput="setCustomValidity('')">
               </div>               
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">Nama</label>
                  <input type="text" class="form-control" name="nama" required oninvalid="this.setCustomValidity('Mohon isi Nama Pasangan')" oninput="setCustomValidity('')">
               </div>              
            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control" name="tgllahir" required oninvalid="this.setCustomValidity('Mohon isi Tanggal Lahir')" oninput="setCustomValidity('')">
               </div>               
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">Tanggal Nikah</label>
                  <input type="date" class="form-control" name="tglnikah" required oninvalid="this.setCustomValidity('Mohon isi Tanggal Nikah')" oninput="setCustomValidity('')">
               </div>              
            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">Istri / Suami Ke</label>
                  <select class="form-control select2 form-select" style="width: 100%" name="istrisuamike" required oninvalid="this.setCustomValidity('Mohon pilih Istri / Suami Ke-')" oninput="setCustomValidity('')">
                     <option value="1">Pertama</option>
                     <option value="2">Kedua</option>
                     <option value="3">Ketiga</option>
                     <option value="4">Keempat</option>
                  </select>
               </div>               
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">Status</label>
                  <select class="form-control select2 form-select" style="width: 100%" name="status" required oninvalid="this.setCustomValidity('Mohon pilih Status Pasangan')" oninput="setCustomValidity('')">
                     <option value="Hidup">Hidup</option>
                     <option value="Mati">Mati</option>                     
                  </select>
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


@foreach($pasangan as $up)
<div class="modal fade" id="update{{ $up->id }}">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-content-demo">
         <div class="modal-header">
               <h6 class="modal-title">Ubah Data Pasangan</h6>
               <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
         </div>
         <form class="form-horizontal" action="/ubahpasangan" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="modal-body">
         <input type="hidden" class="form-control" name="nip" value="{{ $pegawai->nip }}">         
         <input type="hidden" value="{{ $up->id }}" name="id" class="form-control">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">NIK</label>
                  <input type="number" class="form-control" name="nik" value="{{ $up->nik }}" required oninvalid="this.setCustomValidity('Mohon isi NIK')" oninput="setCustomValidity('')">
               </div>               
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">Nama</label>
                  <input type="text" class="form-control" name="nama" value="{{ $up->nama }}" required oninvalid="this.setCustomValidity('Mohon isi Nama Pasangan')" oninput="setCustomValidity('')">
               </div>              
            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control" name="tgllahir" value="{{ $up->tgllahir }}" required oninvalid="this.setCustomValidity('Mohon isi Tanggal Lahir')" oninput="setCustomValidity('')">
               </div>               
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">Tanggal Nikah</label>
                  <input type="date" class="form-control" name="tglnikah" value="{{ $up->tglnikah }}" required oninvalid="this.setCustomValidity('Mohon isi Tanggal Nikah')" oninput="setCustomValidity('')">
               </div>              
            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">Istri / Suami Ke</label>
                  <select class="form-control select2 form-select" style="width: 100%" name="istrisuamike" required oninvalid="this.setCustomValidity('Mohon pilih Istri / Suami Ke-')" oninput="setCustomValidity('')">
                     <option value="1" {{ $up->istrisuamike == '1' ? 'selected' : '' }}>Pertama</option>
                     <option value="2" {{ $up->istrisuamike == '2' ? 'selected' : '' }}>Kedua</option>
                     <option value="3" {{ $up->istrisuamike == '3' ? 'selected' : '' }}>Ketiga</option>
                     <option value="4" {{ $up->istrisuamike == '4' ? 'selected' : '' }}>Keempat</option>
                  </select>
               </div>               
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">Status</label>
                  <select class="form-control select2 form-select" style="width: 100%" name="status" required oninvalid="this.setCustomValidity('Mohon pilih Status Pasangan')" oninput="setCustomValidity('')">
                     <option value="Hidup" {{ $up->status == 'Hidup' ? 'selected' : '' }}>Hidup</option>
                     <option value="Mati" {{ $up->status == 'Mati' ? 'selected' : '' }}>Mati</option>                     
                  </select>
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
               <h4 class="text-danger mb-20">Anda Yakin Menghapus Data Pasangan ini?</h4>
               <button class="btn btn-default" data-bs-dismiss="modal">Batal</button>&emsp; <a type="submit" class="btn btn-danger pd-x-25" href="/hapuspasangan/{{ $up->id }}">Hapus</a>
         </div>         
      </div>
   </div>
</div>


@endforeach


@endsection