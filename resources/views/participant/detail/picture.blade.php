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
            <img src="{{ asset('/images/peserta/'.$data['profil_image']) }}" alt="profil-image" title="" class="w-100">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          @if ($data['profil_image'] != 'no_image.jpg')
            <a href="{{ route('download.profil', ['filename' => $data['profil_image']]) }}" class="btn btn-primary">Unduh</a>
          @endif
          
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
          <img src="{{ asset('/images/rumah/'.$data['home_image']) }}" alt="home-image" title="" class="w-100">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        @if ($data['home_image'] != 'no_image.jpg')
          <a href="{{ route('download.home', ['filename' => $data['home_image']]) }}" class="btn btn-primary">Unduh</a>
        @endif
        
      </div>
      </form>
    </div>
  </div>
</div>
{{-- End Picture Modal --}}