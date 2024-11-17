@extends('kassubag.templates.main')
@section('content')

<!--app-content open-->
<div class="main-content app-content mt-5">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">                        
            <!-- Row -->
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <div class="card text-white bg-primary" style="min-height: 100px; max-height: 100px;">
                        <div class="card-body">
                            <h4 class="card-title">Pengajuan Pensiun</h4>
                            <a class="mb-0 text-white" href="#"><span class="float-end">Selengkapnya <i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-md-3 col-lg-3">
                    <div class="card text-white bg-secondary" style="min-height: 100px; max-height: 100px;">
                        <div class="card-body">
                            <h4 class="card-title">Pengajuan Karis Karsu</h4>
                            <a class="mb-0 text-white" href="#"><span class="float-end">Selengkapnya <i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
                <!-- COL END -->                         
            </div>
                        
        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>
<!--app-content closed-->


@endsection