<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form class="needs-validation modal-delete" action="{{ route('user.delete') }}" method="POST" novalidate>
            @method('delete')
            @csrf
  
            <input type="hidden" name="id" class="id" id="id" value="">{{-- untuk menyimpan id --}}
            
            <div class="form-row">
              <div class="col mb-2 mt-2">
                <i class="fa fa-exclamation-triangle fa-3x mb-2 text-danger"></i>
                <h4>Yakin ingin menghapus data ini?</h4>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
        </form>
      </div>
    </div>
  </div>