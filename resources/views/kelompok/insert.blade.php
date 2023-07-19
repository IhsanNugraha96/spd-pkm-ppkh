<div class="modal fade" id="addGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="exampleModalLabel">Add New Group</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="needs-validation" action="{{ route('kelompok.add') }}" method="POST">
            @csrf

            <div class="form-row">
              <div class="col mb-3">
                <label for="validationCustomUsername">Nama Kelompok</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomName" name="name" placeholder="Name" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Harap Masukkan nama kelompok.
                  </div>
                </div>
              
                <label for="akun">Akun Ketua Kelompok</label>
                <div class="input-group">
                    <select class="form-control" id="akun" name="akun" aria-describedby="inputGroupPrepend" required>
                        <option value="" selected disabled>--select ketua--</option>
                        @foreach ($data_akun as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
</div>