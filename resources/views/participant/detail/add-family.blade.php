<div class="modal fade" id="addKeluargaModal{{ $data['id_kk'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h4>Tambah Keluarga</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="needs-validation modal-delete" action="{{ route('family.add') }}" method="POST">
            @method('post')
            @csrf
  
            <input type="hidden" name="id_kk" class="id_kk" id="id_kk" value="{{ $data['id_kk'] }}">{{-- untuk menyimpan id kk --}}
            
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="nik">No. ART/NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" maxlength="50" placeholder="masukkan nik" required>
              </div>
            </div>
  
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="nama">Nama ART</label>
                <input type="text" class="form-control" id="nama" name="nama" maxlength="125"  placeholder="masukkan nama" required>
              </div>
            </div>
  
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="kat">Kategori</label>
                <select  class="custom-select" name="kat" id="kat" required>
                  <option selected class="text-gray" disabled>Pilih kategori</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
            </div>
  
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="hub">Hubungan</label>
                <select  class="custom-select" name="hub" id="hub" required>
                  <option selected class="text-gray" disabled>Pilih hubungan</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
            </div>
  
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="jk">Jenis Kelamin</label>
                <select  class="custom-select" name="jk" id="jk" required>
                  <option selected class="text-gray" disabled>Pilih jenis kelamin</option>
                  <option value="1">Laki-laki</option>
                  <option value="2">Perempuan</option>
                </select>
              </div>
            </div>
  
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="tgl">Tgl Lahir</label>
                <input type="date" class="form-control text-gray" id="tgl" name="tgl" required>
              </div>
            </div>
  
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="umur">Umur</label>
                <input type="number" class="form-control text-gray" id="umur" name="umur" placeholder="masukkan umur" required>
              </div>
            </div>
  
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="kelas">Kelas</label>
                <input type="number" class="form-control" id="kelas" name="kelas" placeholder="masukkan kelas" required>
              </div>
            </div>
  
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="fasilitas">Nama Fasilitas</label>
                <input type="text" class="form-control" id="fasilitas" name="fasilitas" maxlength="125" placeholder="masukkan nama fasilitas" required>
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