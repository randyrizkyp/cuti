@extends('superadmin.templates.main')
@section('content')

<!--app-content open-->
<div class="main-content app-content mt-5">
    <div class="side-app">         
         

      <div class="row row-sm">
         <div class="col-lg-12">
             <div class="card">
                 <div class="card-header">
                     <h3 class="card-title">Daftar Hukuman Disiplin Ringan</h3>
                     {{-- <a href="javascript:void(0)" class="btn btn-primary">Tambah Data</a> --}}
                     <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largemodal">Tambah Data</button>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                             <thead>
                                 <tr>
                                     <th class="wd-15p border-bottom-0">No</th>
                                     <th class="wd-15p border-bottom-0">Nama Pegawai</th>
                                     <th class="wd-20p border-bottom-0">NIP</th>
                                     <th class="wd-15p border-bottom-0">Kategori</th>
                                     <th class="wd-15p border-bottom-0">Sidak</th>
                                     <th class="wd-15p border-bottom-0">Tanggal Sidak</th>
                                     <th class="wd-10p border-bottom-0">Surat Teguran ke-1</th>
                                     <th class="wd-10p border-bottom-0">Surat Teguran ke-2</th>
                                     <th class="wd-10p border-bottom-0">Surat Teguran ke-3</th>                                                                          
                                     <th class="wd-25p border-bottom-0">Opsi</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr>
                                     <td>1</td>
                                     <td>Ferdy Ramadhan</td>
                                     <td>199502022020121008</td>
                                     <td>Hukuman Disiplin Ringan</td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                 </tr>                               
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>



    </div>
</div>
<!--app-content closed-->


<div class="modal fade" id="largemodal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-xl" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">Modal title</h5>
               <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
             </button>
           </div>
           <div class="modal-body">
               <p>Modal body text goes here.</p>
           </div>
           <div class="modal-footer">
               <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button class="btn btn-primary">Save changes</button>
           </div>
       </div>
   </div>
</div>


@endsection