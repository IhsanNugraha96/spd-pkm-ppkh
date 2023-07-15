@extends('layouts.main')
@section('title','Kelompok Manajemen')

@push('css')
<!-- Styles custom untuk halaman users -->
    <!-- DataTables -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href={{ asset("assets/nprogress/nprogress.css") }} rel="stylesheet">
    <!-- iCheck -->
    <link href={{ asset("assets/iCheck/skins/flat/green.css") }} rel="stylesheet">
    <!-- Datatables -->
    
    <link href={{ asset("assets/datatables.net-bs/css/dataTables.bootstrap.min.css") }} rel="stylesheet">
    <link href={{ asset("assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css") }} rel="stylesheet">
    <link href={{ asset("assets/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css") }} rel="stylesheet">
    <link href={{ asset("assets/datatables.net-responsive-bs/css/responsive.bootstrap.min.css") }} rel="stylesheet">
    <link href={{ asset("assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css") }} rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
@endpush

@section('content')
  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Kelompok Manajemen</h3>
        </div>
      </div>

      <div class="clearfix"></div>
      
      @include('alerts.alert') 
      <div class="row">  
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Data Kelompok</h2>
              <ul class="nav navbar-right panel_toolbox">
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
              <p class="text-muted font-13 m-b-30">
                Berikut merupakan data kelompok dengan disertai nama ketua kelompok dan pembimbingnya. Untuk menambah kelompok baru, mengubah atau menghapus data kelompok, bisa menggunakan tombol yang sudah disediakan.
              </p>

              <div class="container-fluid">    
                <div class="text-right"> 
                  <button type="button"  class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#addGroupModal" {{ ($user->role_id == 1) ? "hidden" : '' }}><i class="fa fa-user-plus"></i> | Add New Group</button>
                </div>
                <table class="table table-striped table-bordered" id="datatable" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Kelompok</th>
                      <th>Ketua Kelompok</th>
                      <th>Pembimbing</th>
                      <th>Action</th>
                    </tr>
                  </thead>                      
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- /page content -->
  @include('kelompok.insert')
  @include('kelompok.edit')
  @include('kelompok.delete')
@endsection
{{-- page scripts --}}
@push('scripts')
    @include('kelompok.script-index')
@endpush
