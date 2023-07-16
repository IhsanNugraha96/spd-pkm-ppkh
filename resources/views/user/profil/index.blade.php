@extends('layouts.main')
@section('title','Profil')

@push('css')
<!-- Styles custom untuk halaman users -->
@endpush

@section('content')
  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Akun</h3>
        </div>
      </div>

      <div class="clearfix"></div>
      
      @include('alerts.alert') 
      <div class="row mt-4">  
        <div class="col-md-3 col-sm-12 ">
            <div class="card">
                @if ($user->profil_image == 'users.png')
                    <img class="img-responsive avatar-view w-100" src="{{ asset('/images/peserta/'.$user->profil_image) }}" alt="profil-image" title="">                    
                @else
                    <img class="img-responsive avatar-view w-100" src="{{ asset('/storage/images/peserta/'.$user->profil_image) }}" alt="profil-image" title="">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $user->email }}</p>
                  <a class="btn btn-sm btn-warning text-white" onclick="showFormEdit()">Edit Profile</a>
                  <a class="btn btn-sm btn-warning text-white" onclick="showFormEditPassword()">Edit Password</a>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-sm-12 ">
            <div class="card mb-3" id="card-profil" hidden>
                <div class="card-header bg-secondary text-white">
                    Form Edit
                </div>
                <div class="card-body">
                    <form action="{{ route('profil.edit') }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" hidden name="id" value="{{ Auth::user()->id }}">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="masukkan nama" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="masukkan email" required>
                        </div>

                        <div class="form-group mt-3">
                          <label for="email">Foto Profil</label>
                          <input type="file" class="form-control-file" id="image" name="image">
                        </div>

                        <hr>
                        <a class="btn btn-sm btn-secondary text-white" onclick="closeFormEdit()">Batal</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </form>
                </div>
            </div>

            <div class="card" id="card-password" hidden>
                <div class="card-header bg-secondary text-white">
                    Edit Password
                </div>
                <div class="card-body">
                    <form action="{{ route('profil.edit-password') }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="pass1">Password Lama</label>
                            <input type="text" hidden name="id" value="{{ Auth::user()->id }}">
                            <input type="password" class="form-control" id="pass1" name="pass1" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="pass2">Password Baru</label>
                            <input type="password" class="form-control" id="pass2" name="pass2" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="pass3">Ulangi Password Baru</label>
                            <input type="password" class="form-control" id="pass3" name="pass3" required>
                        </div>

                        <hr>
                        <a class="btn btn-sm btn-secondary text-white" onclick="closeFormEditPassword()">Batal</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
  </div>
  <!-- /page content -->
@endsection
{{-- page scripts --}}
@push('scripts')
    @include('user.profil.script-index')
@endpush
