@extends('admin.templates.main')
@section('content')

<!--app-content open-->
<div class="main-content app-content mt-5">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">                        
            <!-- Row -->
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Import Cuti</h3>
                    </div>
                    <div class="card-body">                
                        <form class="form-horizontal" action="/import" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row col-md-12">
                                <div class="col-md-1">     
                                    <label class="form-label" for="file">Pilih File:</label>
                                </div>
                                <div class="col-md-4">     
                                    <input class="form-control" type="file" name="file" required>
                                </div>
                                <div class="col-md-1">     
                                    <button class="form-control btn-primary" type="submit">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>                    
        <!-- CONTAINER CLOSED -->
    </div>
</div>
<!--app-content closed-->

@endsection


@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



@endpush