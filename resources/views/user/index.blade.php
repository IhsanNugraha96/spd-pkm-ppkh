@extends('layouts.main')
@section('title','User Account')

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
          <h3>User Accounts</h3>
        </div>
      </div>

      <div class="clearfix"></div>
      
      @include('alerts.alert') 
      <div class="row">  
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Data Account</h2>
              <ul class="nav navbar-right panel_toolbox">
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
              <p class="text-muted font-13 m-b-30">
                The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
              </p>

              <div class="container-fluid">    
                <div class="text-right">
                      @if (Auth::user()->role_id == 1) 
                        <button type="button"  class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#addUserModal"><i class="fa fa-user-plus"></i> | Add New User</button>
                      @elseif (Auth::user()->role_id == 2) 
                        <button type="button"  class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#addUserModal"><i class="fa fa-user-plus"></i> | Add New Leader Group</button>
                      @endif   
                  
                </div>
                <table class="table table-striped table-bordered" id="datatable" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Last Update</th>
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
  @include('user.insert')
  @include('user.edit')
  @include('user.delete')
@endsection
{{-- page scripts --}}
@push('scripts')
    @include('user.script-index')
@endpush
