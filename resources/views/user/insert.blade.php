<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="needs-validation" action="{{ route('user.add') }}" method="POST" novalidate>
            @csrf

            <div class="form-row">
              <div class="col mb-3">
                <label for="validationCustomUsername">Name</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomName" name="name" placeholder="Name" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a name.
                  </div>
                </div>

                
                <label for="validationCustomEmail">Email</label>
                <div class="input-group">
                    <input type="email" class="form-control" id="validationCustomEmail" name="email" placeholder="Email" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                      Please insert a email.
                    </div>
                </div>
              
                <label for="validationCustomRolename">User Role</label>
                <div class="input-group">
                    <select class="form-control" id="validationCustomRolename" name="role" aria-describedby="inputGroupPrepend" required>
                        <option value="" selected disabled>--select role--</option>
                        @foreach ($roles as $item)
                            <option value="{{ $item['id'] }}">{{ $item['role_name'] }}</option>
                        @endforeach
                    </select>

                    <div class="invalid-feedback">
                    Please choose a role name.
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