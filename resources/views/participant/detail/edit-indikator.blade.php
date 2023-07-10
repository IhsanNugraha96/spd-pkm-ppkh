<div class="modal fade" id="editIndikatorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h4>Edit Indikator</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="needs-validation modal-delete" action="{{ route('indikator.update') }}" method="POST">
            @method('put')
            @csrf
  
            <input type="hidden" name="id" class="id" id="id" value="{{ $data['id_indikator'] }}">{{-- untuk menyimpan id --}}
            
            <b>1. Keluarga</b>
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="kelseb">Kondisi Sebelum</label>
                <input type="text" class="form-control" id="kelseb" name="kelseb" value="{{ $data['keluarga_sebelum'] }}" required>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
  
              <div class="col mb-2 mt-2">
                <label for="kelset">Kondisi Sekarang</label>
                <input type="text" class="form-control" id="kelset" name="kelset" value="{{ $data['keluarga_setelah'] }}" required>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
            </div>
  
            <b>2. Ekonomi</b>
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="ekseb">Kondisi Sebelum</label>
                <input type="text" class="form-control" id="ekseb" name="ekseb" value="{{ $data['ekonomi_sebelum'] }}" required>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
  
              <div class="col mb-2 mt-2">
                <label for="ekset">Kondisi Sekarang</label>
                <input type="text" class="form-control" id="ekset" name="ekset" value="{{ $data['ekonomi_setelah'] }}" required>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
            </div>
  
            <b>3. Kesehatan</b>
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="keseb">Kondisi Sebelum</label>
                <input type="text" class="form-control" id="keseb" name="keseb" value="{{ $data['kesehatan_sebelum'] }}" required>
                <div class="invalid-tooltip">
                  Looks good!
                </div>
              </div>
  
              <div class="col mb-2 mt-2">
                <label for="keset">Kondisi Sekarang</label>
                <input type="text" class="form-control" id="keset" name="keset" value="{{ $data['kesehatan_setelah'] }}" required>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
            </div>
  
            <b>4. Pendidikan</b>
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="penseb">Kondisi Sebelum</label>
                <input type="text" class="form-control" id="penseb" name="penseb" value="{{ $data['pendidikan_sebelum'] }}" required>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
  
              <div class="col mb-2 mt-2">
                <label for="penset">Kondisi Sekarang</label>
                <input type="text" class="form-control" id="penset" name="penset" value="{{ $data['pendidikan_setelah'] }}" required>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
            </div>
  
            <b>5. Rumah</b>
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="ruseb">Kondisi Sebelum</label>
                <input type="text" class="form-control" id="ruseb" name="ruseb" value="{{ $data['rumah_sebelum'] }}" required>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
  
              <div class="col mb-2 mt-2">
                <label for="ruset">Kondisi Sekarang</label>
                <input type="text" class="form-control" id="ruset" name="ruset" value="{{ $data['rumah_setelah'] }}" required>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>