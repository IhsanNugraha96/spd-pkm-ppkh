<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title  text-white" id="exampleModalLabel">Edit User Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="needs-validation" action="{{ route('user.edit') }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="data_id" id="data_id">{{-- untuk ambil id --}}

            <div class="form-row">
              <div class="col mb-3">
                <label for="validationCustomName">Name</label>
                <div class="input-group">
                  <input type="text" class="form-control modalEditInput" id="name" name="name" placeholder="Name" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a name.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col mb-3">
                <label for="validationCustomEmail">Email</label>
                <div class="input-group">
                  <input type="email" class="form-control modalEditInput" id="email" name="email" placeholder="Email" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert valid email.
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