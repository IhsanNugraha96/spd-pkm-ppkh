@php
    $id_ketua = 0;
@endphp
<div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title  text-white" id="exampleModalLabel">Edit Kelompok</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="needs-validation" action="{{ route('kelompok.edit') }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="data_id" id="data_id">{{-- untuk ambil id --}}

            <div class="form-row">
                <div class="col mb-3">
                  <label for="validationCustomUsername">Nama Kelompok</label>
                  <div class="input-group">
                    <input type="text" class="name form-control" id="name" name="name" placeholder="Name" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                      Harap Masukkan nama kelompok.
                    </div>
                  </div>
                
                  <label for="akun">Akun Ketua Kelompok</label>
                  <div class="input-group">
                      <select class="akun_edit form-control" id="akun_edit" name="akun_edit" aria-describedby="inputGroupPrepend" required>
                          <option value="" disabled>--select ketua--</option>
                          @foreach ($data_akun_edit as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $id_ketua ? 'selected' : '' }}>{{ $item->name }}</option>
                          @endforeach
                      </select>
  
                      <div class="invalid-feedback">
                      Harap memilih akun.
                      </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="closeBtn" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="saveBtn" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
</div>