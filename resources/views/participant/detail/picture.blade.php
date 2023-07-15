{{-- Start Picture Modal --}}

<div class="modal fade" id="showProfilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
            @if ($data['profil_image'] == 'no_image.jpg')
              <img src="{{ asset('/images/peserta/'.$data['profil_image']) }}" alt="profil-image" title="" class="w-100">                    
            @else
              <img src="{{ asset('/storage/images/peserta/'.$data['profil_image']) }}" alt="profil-image" title="" class="w-100"> 
            @endif
           
            <form action="{{ route('profil-upload') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group mt-3">
                <input type="text" hidden name="id" value="{{ $data['id_profil'] }}">
                <input type="text" hidden name="id_participant" value="{{ $data['id'] }}">

                <input type="file" class="form-control-file" id="image" name="image" required {{ $user->role_id == 1 ? "hidden" : '' }}>
              </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          @if ($data['profil_image'] != 'no_image.jpg')
            <a href="{{ route('download.profil', ['filename' => $data['profil_image']]) }}" class="btn btn-success">Unduh</a>
          @endif
          <button type="submit" class="btn btn-primary" {{ $user->role_id == 1 ? "hidden" : '' }}>Save</button>
        </form>
        </div>
      </div>
    </div>
</div>


<div class="modal fade" id="showHomeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        @if ($data['home_image'] == 'no_image.jpg')
          <img src="{{ asset('/images/rumah/'.$data['home_image']) }}" alt="home-image" title="" class="w-100">                   
        @else
          <img src="{{ asset('/storage/images/rumah/'.$data['home_image']) }}" alt="home-image" title="" class="w-100"> 
        @endif

        <form action="{{ route('home-upload') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group mt-3">
            <input type="text" hidden name="id" value="{{ $data['id_home'] }}">
            <input type="text" hidden name="id_participant" value="{{ $data['id'] }}">

            <input type="file" class="form-control-file" id="image" name="image" required {{ $user->role_id == 1 ? "hidden" : '' }}>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        @if ($data['home_image'] != 'no_image.jpg')
          <a href="{{ route('download.home', ['filename' => $data['home_image']]) }}" class="btn btn-primary">Unduh</a>
        @endif
        <button type="submit" class="btn btn-primary" {{ $user->role_id == 1 ? "hidden" : '' }}>Save</button>
        </form>
      </div>
      </form>
    </div>
  </div>
</div>
{{-- End Picture Modal --}}