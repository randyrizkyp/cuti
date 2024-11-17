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
                           <button class="btn btn-default btn-sm me-1" onclick="window.history.go(-1); return false;"><i class="fa fa-arrow-left"></i> Kembali</button> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAnak"><i class="fa fa-plus-circle"></i> Tambah Anak</button>
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
                                          <td>Status</td>
                                          <td>Nama Ibu/Ayah</td>
                                          <td width="20px">Opsi</td>
                                       </tr>
                                 </thead>
                                 <tbody>
                                       @foreach($dataanak as $dt)
                                       <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $dt->nik }}</td>
                                          <td>{{ $dt->nama }}</td>
                                          <td>{{ date("d M Y", strtotime($dt->tgllahir)) }}</td>
                                          <td>{{ $dt->status }}</td>
                                          <td>{{ $dt->ibuayah }}</td>
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


<div class="modal fade" id="addAnak">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-content-demo">
         <div class="modal-header">
               <h6 class="modal-title">Tambah Data Anak</h6>
               <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
         </div>
         <form class="form-horizontal" action="/tambahanak" method="POST" enctype="multipart/form-data">
         @csrf
         <input type="hidden" class="form-control" name="nip" value="{{ $pegawai->nip }}">         
         <div class="modal-body">
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
                  <input type="text" class="form-control" name="nama" required oninvalid="this.setCustomValidity('Mohon isi Nama Anak')" oninput="setCustomValidity('')">
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
                  <label class="form-label">Status</label>
                  <select class="form-control select2 form-select" style="width: 100%" name="status" required oninvalid="this.setCustomValidity('Mohon pilih Status Anak')" oninput="setCustomValidity('')">
                     <option value="Anak Kandung">Anak Kandung</option>
                     <option value="Anak Angkat">Anak Angkat</option>
                  </select>
               </div>              
            </div>
         </div>            
         <div class="form-group">
            <label class="form-label">Nama Ibu/Ayah</label>
            <input type="text" class="form-control" name="ibuayah" required oninvalid="this.setCustomValidity('Mohon isi Nama Anak')" oninput="setCustomValidity('')">
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


@foreach($dataanak as $up)
<div class="modal fade" id="update{{ $up->id }}">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-content-demo">
         <div class="modal-header">
               <h6 class="modal-title">Ubah Data Anak</h6>
               <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
         </div>
         <form class="form-horizontal" action="/ubahanak" method="POST" enctype="multipart/form-data">
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
                  <input type="text" class="form-control" name="nama" value="{{ $up->nama }}" required oninvalid="this.setCustomValidity('Mohon isi Nama Anak')" oninput="setCustomValidity('')">
               </div>              
            </div>
         </div>a

         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control" name="tgllahir" value="{{ $up->tgllahir }}" required oninvalid="this.setCustomValidity('Mohon isi Tanggal Lahir')" oninput="setCustomValidity('')">
               </div>               
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label class="form-label">Status</label>
                  <select class="form-control select2 form-select" style="width: 100%" name="status" required oninvalid="this.setCustomValidity('Mohon pilih Status Anak')" oninput="setCustomValidity('')">
                     <option value="Anak Kandung" {{ $up->status == 'Anak Kandung' ? 'selected' : '' }}>Anak Kandung</option>
                     <option value="Anak Angkat" {{ $up->status == 'Anak Angkat' ? 'selected' : '' }}>Anak Angkat</option>
                  </select>
               </div>              
            </div>
         </div>            
         <div class="form-group">
            <label class="form-label">Nama Ibu/Ayah</label>
            <input type="text" class="form-control" name="ibuayah" value="{{ $up->ibuayah }}" required oninvalid="this.setCustomValidity('Mohon isi Nama Ibu / Ayah')" oninput="setCustomValidity('')">
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
               <h4 class="text-danger mb-20">Anda Yakin Menghapus Data Anak ini?</h4>
               <button class="btn btn-default" data-bs-dismiss="modal">Batal</button>&emsp; <a type="submit" class="btn btn-danger pd-x-25" href="/hapusanak/{{ $up->id }}">Hapus</a>
         </div>         
      </div>
   </div>
</div>


@endforeach


@endsection