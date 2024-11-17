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
                           Pengusulan Karis Karsu {{ Session::get('nama_lain') }} &emsp;<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUsulan"><i class="fa fa-plus-circle"></i> Tambah Pengajuan</button>
                     </div>
                     <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-striped table-bordered" id="basic-datatable">
                                 <thead>
                                       <tr>
                                          <td width="10px">No</td>                                          
                                          <td>NIP</td>
                                          <td>Nama</td>
                                          <td>Unit Kerja</td>                                                                    
                                          <td>Doc</td>                                          
                                          <td>Data Suami/Istri</td>                                          
                                          <td width="10px">Opsi</td>
                                       </tr>
                                 </thead>
                                 <tbody>
                                       @foreach($usulan as $dt)
                                       <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $dt->nip }}</td>
                                          <td>{{ $dt->nama }}</td>
                                          <td>{{ $dt->unit_kerja }}</td>                                                                                                                                                              
                                          <td class="text-center"><a class="btn btn-primary btn-sm" href="/berkaskaris/{{ $dt->nip }}"><i class="fa fa-search"></i></a></td>
                                          <td class="text-center"><a class="btn btn-warning btn-sm" href="/pasangan/{{ $dt->nip }}"><i class="fa fa-search"></i></a></td>                                          
                                          <td class="text-center text-nowrap"><button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $dt->nip }}"><i class="fa fa-trash"></i></button></td>
                                       </tr>

                                       <div class="modal fade" id="delete{{ $dt->nip }}" tabindex="-1" role="dialog">
                                          <div class="modal-dialog" role="document">
                                             <div class="modal-content">      
                                                <div class="modal-body text-center">
                                                      <i class="icon icon-close fs-50 text-danger lh-1 my-4 d-inline-block"></i>            
                                                      <h4 class="text-danger mb-20">Anda Yakin Menghapus Data Usulan Karis Karsu ini?</h4>
                                                      <button class="btn btn-default" data-bs-dismiss="modal">Batal</button>&emsp; <a type="submit" class="btn btn-danger pd-x-25" href="/deletekaris/{{ $dt->nip }}">Hapus</a>
                                                </div>         
                                             </div>
                                          </div>
                                       </div>

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


<div class="modal fade" id="addUsulan">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-content-demo">
         <div class="modal-header">
               <h6 class="modal-title">Tambah Usulan Karis Karsu</h6>
               <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
         </div>
         <form class="form-horizontal form-bordered" action="/insertkaris" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="modal-body">            
            <div class="form-group">
               <label>NIP / Nama</label>
               <select class="form-control select2-show-search form-select" style="width: 100%" id="select_pegawai" name="nip" required oninvalid="this.setCustomValidity('Mohon pilih Pegawai')" oninput="setCustomValidity('')">                                                                
                  @foreach ($pegawai as $pe)
                     <option value="{{ $pe->nip }}">{{ $pe->nip }} - {{ $pe->nama }}</option>
                  @endforeach                     
               </select>                            
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

@endsection

@push('script')

<script>
$(document).ready(function() {
   $("#select_pegawai").select2({
      dropdownParent: $('#addUsulan .modal-content')
   });
});
</script>

@endpush