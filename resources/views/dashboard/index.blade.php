@extends('layouts.main')
@section('title','Dashboard')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row" style="display: inline-block;" >
  @include('alerts.alert')
  <div class="tile_count">
    @if ($user->role_id == 1)
      <div class="col-md-3 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Akun</span>
        <div class="count ">{{ count($data_akun) }}</div>
        <span class="count_bottom"><i class="green">Akun</i></span>
      </div>
    @endif
    
    <div class="col-md-3 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-users"></i> Total Kelompok</span>
      <div class="count blue">{{ count($data_kelompok) }}</div>
      <span class="count_bottom"><i class="green">Kelompok</i></span>
    </div>
    <div class="col-md-3 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Pembimbing</span>
      <div class="count blue">{{ count($data_pembimbing) }}</div>
      <span class="count_bottom"><i class="green">Pembimbing</i></span>
    </div>
    <div class="col-md-3 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Ketua Kelompok</span>
      <div class="count blue">{{ count($data_ketua) }}</div>
      <span class="count_bottom"><i class="green">Ketua Kelompok</i></span>
    </div>
    <div class="col-md-3 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Peserta</span>
      <div class="count blue">{{ count($data_penerima_pkh) }}</div>
      <span class="count_bottom"><i class="green">Peserta Penerima PKH</i></span>
    </div>
  </div>
</div>
  <!-- /top tiles -->

<div class="row mb-3">
  <div class="col-md-8 col-sm-12 ">
    <div class="x_panel tile">
      <div class="x_title">
        <h2>Diagram data peserta pada setiap pembimbing</h2>
        <br>
        <div class="clearfix"></div>
      </div>
  
      <div class="x_content">
        @php
            $i = 0;
        @endphp
        @foreach ($data_pembimbing as $item)
          <div class="widget_summary">
            <div class="w_left w_25">
              <span>{{ $item->name }}</span>
            </div>
            <div class="w_center w_55">
              <div class="progress">
                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{ count($data_peserta_setiap_pembimbing[$i]) }}" aria-valuemin="0" aria-valuemax="{{ count($data_penerima_pkh) }}" style="width: {{ (count($data_peserta_setiap_pembimbing[$i])/count($data_penerima_pkh))*100 }}%;">
                  <span class="sr-only">100% Complete</span>
                </div>
              </div>
            </div>
            <div class="w_right w_20">
              <span>{{ count($data_peserta_setiap_pembimbing[$i]) }}</span>
            </div>
            <div class="clearfix"></div>
          </div>
          @php
              $i++;
          @endphp
        @endforeach
      </div>
    </div>
  </div>

  
  <div class="col-md-4 col-sm-12 ">    
    <img src="{{ asset('/images/ilustrasi.png') }}" alt="" class="w-100">
  </div>

  </div>

  <div class="row mb-3 text-center">
    <div class="col-sm-12">
      <img src="{{ asset('/images/logo2.png') }}" alt="">
    </div>
  </div>

  <br/>

</div>
<!-- /page content -->

<script>
  $(document).ready(function(){
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 3000);
    });
</script>
@endsection

        
