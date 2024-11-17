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
                           Pengusulan Pensiun {{ Session::get('nama_lain') }} &emsp;<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPegawai"><i class="fa fa-plus-circle"></i> Tambah Pengajuan</button>
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
                                          <td>Jenis Pensiun</td>                                          
                                          <td>Doc</td>
                                          <td>Data Anak</td>
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
                                          <td>{{ $dt->jenis_pemberhentian }}</td>                                          
                                          <td class="text-center"><a class="btn btn-success btn-sm" href="/berkaspensiun/{{ $dt->nip }}"><i class="fa fa-search"></i></a></td>
                                          <td class="text-center"><a class="btn btn-primary btn-sm" href="/anak/{{ $dt->nip }}"><i class="fa fa-search"></i></a></td>
                                          <td class="text-center"><a class="btn btn-warning btn-sm" href="/pasangan/{{ $dt->nip }}"><i class="fa fa-search"></i></a></td>                                          
                                          <td class="text-center text-nowrap"> <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $dt->nip }}"><i class="fa fa-trash"></i></button></td>
                                       </tr>

                                       <div class="modal fade" id="delete{{ $dt->nip }}" tabindex="-1" role="dialog">
                                          <div class="modal-dialog" role="document">
                                             <div class="modal-content">      
                                                <div class="modal-body text-center">
                                                      <i class="icon icon-close fs-50 text-danger lh-1 my-4 d-inline-block"></i>            
                                                      <h4 class="text-danger mb-20">Anda Yakin Menghapus Data Usulan ini?</h4>
                                                      <button class="btn btn-default" data-bs-dismiss="modal">Batal</button>&emsp; <a type="submit" class="btn btn-danger pd-x-25" href="/deleteusulan/{{ $dt->nip }}">Hapus</a>
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


<div class="modal fade" id="addPegawai">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-content-demo">
         <div class="modal-header">
               <h6 class="modal-title">Tambah Usulan Pensiun</h6>
               <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
         </div>
         <form class="form-horizontal form-bordered" action="/sessionusulan" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="modal-body">            
            <div class="form-group">
               <label>NIP / Nama</label>
               <select class="form-control select2-show-search form-select" style="width: 100%" id="select_pegawai" name="nippensiun" required oninvalid="this.setCustomValidity('Mohon pilih Pegawai')" oninput="setCustomValidity('')">                                                                
                  @foreach ($pegawai as $pe)
                     <option value="{{ $pe->nip }}">{{ $pe->nip }} - {{ $pe->nama }}</option>
                  @endforeach                     
               </select>                            
            </div>

            <div class="form-group">
               <label>Jenis Pemberhentian</label>
               <select class="form-control select2 form-select" name="jenis_pemberhentian" required oninvalid="this.setCustomValidity('Mohon pilih Jenis Pemberhentian')" oninput="setCustomValidity('')">                                                                                        
                  <option value="BUP">BUP</option>
                  <option value="Meninggal">Meninggal Dunia, Tewas atau Hilang</option>
                  <option value="permintaan">Atas Permintaan Sendiri</option>
                  <option value="tidakcakap">Tidak Cakap Jasmani atau Rohani</option>
                  <option value="pelanggaran">Pelanggaran Disiplin</option>
                  <option value="pidana">Melakukan Tindak Pidana/ Penyelewengan</option>
               </select>
            </div>

            <div class="form-group">
               <label>TMT Pensiun</label>
               <input type="date" name="tmt_pensiun" class="form-control" required oninvalid="this.setCustomValidity('Mohon isi TMT Pensiun')" oninput="setCustomValidity('')">
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
      dropdownParent: $('#addPegawai .modal-content')
   });
});
</script>

@endpush