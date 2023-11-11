<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path('assets/bootstrap/dist/css/bootstrap.min.css') }} ">

    <style>
        .teks {
            font-size: 12px;
        }
    </style>
</head>
<body>
    
    <div class="row mr-2">  
        <div class="col-md-12 col-sm-12">
            <div class="mb-2">
                <center class="font-weight-bold">DATA KELUARGA SANGAT MISKIN (KSM)</center>
                <center class="font-weight-bold">PROGRAM KELUARGA HARAPAN (PKH)</center>
                <hr>
            </div>
        </div>
    </div> 
    
        <div class="row mt-4 ml-1">

            <div style="display: inline-block; width: 47%;">
              <table class="">
                <tr>
                  <td class="teks">Nomor Peserta </td>
                  <td class="teks">:</td>
                  <td class="teks">{{ $data['nik'] }}</td>
                </tr>
    
                <tr>
                  <td class="teks">Nama Pengurus</td>
                  <td class="teks">:</td>
                  <td class="teks">{{ $data['nama'] }}</td>
                </tr>
    
                <tr>
                  <td class="teks">Tempat Lahir</td>
                  <td class="teks">:</td>
                  <td class="teks">{{ $data['tempat_lahir'] . ', '. date('d-m-Y', strtotime($data['tgal_lahir']))}}</td>
                </tr>
    
                <tr>
                  <td class="teks">Pekerjaan</td>
                  <td class="teks">:</td>
                  <td class="teks">{{ $data['pekerjaan'] }}</td>
                </tr>
    
                <tr>
                  <td class="teks">Ibu Kandung</td>
                  <td class="teks">:</td>
                  <td class="teks">{{ $data['nama_ibu'] }}</td>
                </tr>
    
                <tr>
                  <td class="teks">Alamat</td>
                  <td class="teks">:</td>
                  <td class="teks">{{ $data['alamat'] }}</td>
                </tr>
    
                <tr>
                  <td class="teks">RT/RW</td>
                  <td class="teks">:</td>
                  <td class="teks">{{ $data['rt'] .'/'. $data['rw'] }}</td>
                </tr>
    
                <tr>
                  <td class="teks">Tahun Kepesertaan</td>
                  <td class="teks">:</td>
                  <td class="teks">{{ $data['tahun_kepesertaan'] }}</td>
                </tr>

                <tr>
                  <td class="teks">Nama Kelompok</td>
                  <td class="teks">:</td>
                  <td class="teks">{{ $data_kelompok->nama_kelompok }}</td>
                </tr>

                <tr>
                  <td class="teks">Ketua Kelompok</td>
                  <td class="teks">:</td>
                  <td class="teks">{{ $data_kelompok->name }}</td>
                </tr>

              </table>  
            </div>
    
            <div style="display: inline-block; width: 20%;">
                  @if ($data['profil_image'] == 'no_image.jpg')
                    <img src="{{ public_path('/images/peserta/'.$data['profil_image']) }}" class="w-100">                    
                  @else
                    <img src="{{ public_path('/storage/images/peserta/'.$data['profil_image']) }}" class="w-100"> 
                  @endif
            </div>
      
            <div style="display: inline-block; width: 30%;">
                @if ($data['home_image'] == 'no_image.jpg')
                  <img src="{{ public_path('/images/rumah/'.$data['home_image']) }}" class="w-100">                   
                @else
                  <img src="{{ public_path('/storage/images/rumah/'.$data['home_image']) }}" class="w-100"> 
                @endif             
            </div>

        </div>
    
        {{-- tabel KK /Anggota Keluarga--}}
        <div class="row mt-4 py-2 mr-3">
            <div class="col-md-12">
              <table class="table table-striped table-bordered">
                    <tr class="text-center">
                        <td class="teks" scope="col">#</td>
                        <td class="teks text-left" scope="col">NO ART</td>
                        <td class="teks text-left" scope="col">NAMA ART</td>
                        <td class="teks" scope="col">KAT</td>
                        <td class="teks" scope="col">HUB</td>
                        <td class="teks" scope="col">JK</td>
                        <td class="teks" scope="col">TGL LAHIR</td>
                        <td class="teks" scope="col">UMUR</td>
                        <td class="teks" scope="col">KELAS</td>
                        <td class="teks text-left" scope="col">NAMA FASILITAS PENDIDIKAN/KESEHATAN</td>
                    </tr>

                    @php
                    $i=1; 
                    @endphp
                      @foreach ($data_keluarga as $item)
                      <tr>
                        <th class="teks">{{ $i }}</th>
                        <td class="teks">{{ $item['nik'] }}</td>
                        <td class="teks">{{ $item['nama'] }}</td>
                        <td class="teks text-center">{{ $item['kategori'] }}</td>
                        <td class="teks text-center">{{ $item['hub'] }}</td>
                        <td class="teks text-center">{{ $item['jenis_kelamin'] == 1 ? 'L' : 'P' }}</td>
                        <td class="teks text-center">{{ date('d-m-Y', strtotime($item['tanggal_lahir'])) }}</td>
                        <td class="teks text-center">{{ $item['umur'] }}</td>
                        <td class="teks text-center">{{ $item['kelas'] }}</td>
                        <td class="teks">{{ $item['nama_fasilitas'] }}</td>
                      </tr>
                      @php
                      $i++; 
                      @endphp
                      @endforeach

                </table>
            </div>
        </div>
    
          <hr class="text-primary">
          {{-- tabel KK /Anggota Keluarga--}}
          <div  class="mb-2">            
            <table class="table table-striped table-bordered w-100">
                <tr>
                  <th class="teks">INDIKATOR</th>
                  <th class="teks">KONDISI SEBELUM PKH</th>
                  <th class="teks">KONDISI SEKARANG</th>
                </tr>
                
                <tr>
                  <th class="teks">KELUARGA</th>
                  <td class="teks">{{ $data['keluarga_sebelum'] }}</td>
                  <td class="teks">{{ $data['keluarga_setelah'] }}</td>
                </tr>
                <tr>
                  <th class="teks">EKONOMI</th>
                  <td class="teks">{{ $data['ekonomi_sebelum'] }}</td>
                  <td class="teks">{{ $data['ekonomi_setelah'] }}</td>
                </tr>
                <tr>
                  <th class="teks">KESEHATAN</th>
                  <td class="teks">{{ $data['kesehatan_sebelum'] }}</td>
                  <td class="teks">{{ $data['kesehatan_setelah'] }}</td>
                </tr>
                <tr>
                  <th class="teks">PENDIDIKAN</th>
                  <td class="teks">{{ $data['pendidikan_sebelum'] }}</td>
                  <td class="teks">{{ $data['pendidikan_setelah'] }}</td>
                </tr>
                <tr>
                  <th class="teks">RUMAH</th>
                  <td class="teks">{{ $data['rumah_sebelum'] }}</td>
                  <td class="teks">{{ $data['rumah_setelah'] }}</td>
                </tr>
            </table>
          </div>
    
        </div>
      </div>

</body>
</html>
