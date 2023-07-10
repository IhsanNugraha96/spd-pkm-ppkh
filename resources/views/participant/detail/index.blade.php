@extends('layouts.main')
@section('title','Detail Peserta')

@push('css')
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
@endpush

@section('content')
  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Detail Peserta</h3>
        </div>
      </div>

      <div class="clearfix"></div>
      
      @include('alerts.alert') 
      <div class="row">  
        <div class="col-md-12 col-sm-12 card">
          <div class="p-1 mb-2 mt-2">
            <center class="font-weight-bold">DATA KELUARGA SANGAT MISKIN (KSM)</center>
            <center class="font-weight-bold">PROGRAM KELUARGA HARAPAN (PKH)</center>
            <hr>
          </div>
          

          <div class="row p-2">
            <div class="col-md-6">
              <table class="p-2 w-50">
                <tr>
                  <td>Nomor Peserta </td>
                  <td>:</td>
                  <td>{{ $data['nik'] }}</td>
                </tr>
  
                <tr>
                  <td>Nama Pengurus</td>
                  <td>:</td>
                  <td>{{ $data['nama'] }}</td>
                </tr>
  
                <tr>
                  <td>Tempat Lahir</td>
                  <td>:</td>
                  <td>{{ $data['tempat_lahir'] . ', '. date('d-m-Y', strtotime($data['tgal_lahir']))}}</td>
                </tr>
  
                <tr>
                  <td>Pekerjaan</td>
                  <td>:</td>
                  <td>{{ $data['pekerjaan'] }}</td>
                </tr>
  
                <tr>
                  <td>Ibu Kandung</td>
                  <td>:</td>
                  <td>{{ $data['nama_ibu'] }}</td>
                </tr>
  
                <tr>
                  <td>Alamat</td>
                  <td>:</td>
                  <td>{{ $data['alamat'] }}</td>
                </tr>
  
                <tr>
                  <td>RT/RW</td>
                  <td>:</td>
                  <td>{{ $data['rt'] .'/'. $data['rw'] }}</td>
                </tr>
  
                <tr>
                  <td>Tahun Kepesertaan</td>
                  <td>:</td>
                  <td>{{ $data['tahun_kepesertaan'] }}</td>
                </tr>
              </table>  
            </div>

            <div class="col-md-2 col-sm-4">
              <button type='button' data-toggle='modal' data-target='#showProfilModal' class='btn'>
                <img src="{{ asset('/images/peserta/'.$data['profil_image']) }}" alt="profil-image" title="" class="w-100">
              </button>
            </div>

            <div class="col-md-4 col-sm-8">
              <button type='button' data-toggle='modal' data-target='#showHomeModal' class='btn'>
                <img src="{{ asset('/images/rumah/'.$data['home_image']) }}" alt="home-image" title="" class="w-100">              
              </button>
              </div>
          </div>
            
          

          {{-- tabel KK /Anggota Keluarga--}}
          <div class="row mt-4 p-2">
            <button type='button' data-toggle='modal' data-target='#addKeluargaModal{{ $data['id_kk'] }}' class='btn btn-sm text-primary' data-id='{$id_penerima_pkh}'><i class='fa fa-plus-circle'> Keluarga</i></button>

            <table class="table table-striped w-100">
              <thead>
                <tr class="text-center">
                  <th>#</th>
                  <th class="text-left">NO ART</th>
                  <th class="text-left">NAMA ART</th>
                  <th>KAT</th>
                  <th>HUB</th>
                  <th>JK</th>
                  <th>TGL LAHIR</th>
                  <th>UMUR</th>
                  <th>KELAS</th>
                  <th class="text-left">NAMA FASILITAS PENDIDIKAN/KESEHATAN</td>
                  <th>AKSI</th>
                </tr>
              </thead>
              
              <tbody
              @php
                $i=1; 
              @endphp
                @foreach ($data_keluarga as $item)
                  <tr>
                    <th>{{ $i }}</th>
                    <td>{{ $item['nik'] }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td class="text-center">{{ $item['kategori'] }}</td>
                    <td class="text-center">{{ $item['hub'] }}</td>
                    <td class="text-center">{{ $item['jenis_kelamin'] == 1 ? 'L' : 'P' }}</td>
                    <td class="text-center">{{ date('d-m-Y', strtotime($item['tanggal_lahir'])) }}</td>
                    <td class="text-center">{{ $item['umur'] }}</td>
                    <td class="text-center">{{ $item['kelas'] }}</td>
                    <td>{{ $item['nama_fasilitas'] }}</td>
                    <td class="text-center">
                      <button type='button' data-toggle='modal' data-target='#editKeluargaModal{{ $item["id"] }}' class='btn btn-sm text-warning' data-id='{$id_penerima_pkh}'><i class='fa fa-pencil-square-o'></i></button>
                      <button type='button' data-toggle='modal' data-target='#deleteKeluargaModal{{ $item["id"] }}' class='btn btn-sm text-danger' data-id='{$id_penerima_pkh}'><i class='fa fa-trash'></i></button>
                    </td>
                  </tr>
                  @php
                    $i++; 
                  @endphp
                @endforeach
              </tbody>
            </table>
          </div>

          <hr class="text-primary">
          {{-- tabel KK /Anggota Keluarga--}}
          <div  class="mb-2">            
            <button type='button' data-toggle='modal' data-target='#editIndikatorModal' class='btn btn-sm text-warning'><i class='fa fa-pencil-square-o'> Indikator</i></button>

            <table class="table table-striped w-100">
              <thead>
                <tr>
                  <th>INDIKATOR</th>
                  <th>KONDISI SEBELUM PKH</th>
                  <th>KONDISI SEKARANG</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>KELUARGA</th>
                  <td>{{ $data['keluarga_sebelum'] }}</td>
                  <td>{{ $data['keluarga_setelah'] }}</td>
                </tr>
                <tr>
                  <th>EKONOMI</th>
                  <td>{{ $data['ekonomi_sebelum'] }}</td>
                  <td>{{ $data['ekonomi_setelah'] }}</td>
                </tr>
                <tr>
                  <th>KESEHATAN</th>
                  <td>{{ $data['kesehatan_sebelum'] }}</td>
                  <td>{{ $data['kesehatan_setelah'] }}</td>
                </tr>
                <tr>
                  <th>PENDIDIKAN</th>
                  <td>{{ $data['pendidikan_sebelum'] }}</td>
                  <td>{{ $data['pendidikan_setelah'] }}</td>
                </tr>
                <tr>
                  <th>RUMAH</th>
                  <td>{{ $data['rumah_sebelum'] }}</td>
                  <td>{{ $data['rumah_setelah'] }}</td>
                </tr>
              </tbody>
              <tbody>

              </tbody>
            </table>
          </div>

        </div>
      </div>
          
    </div>
  </div>
  <!-- /page content -->
  @include('participant.detail.add-family')
  @include('participant.detail.edit-family')
  @include('participant.detail.delete-family')
  @include('participant.detail.edit-indikator')
  @include('participant.detail.picture')
@endsection
{{-- page scripts --}}
@push('scripts')
  @include('participant.detail.script-index')
@endpush
