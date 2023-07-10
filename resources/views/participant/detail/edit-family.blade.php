@foreach ($data_keluarga as $item)
  <div class="modal fade" id="editKeluargaModal<?= $item["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h4>Edit Indikator</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="needs-validation modal-delete" action="{{ route('family.update') }}" method="POST">
            @method('put')
            @csrf

            <input type="hidden" name="id_anggota_keluarga" class="id_anggota_keluarga" id="id_anggota_keluarga" value="{{ $item['id'] }}">{{-- untuk menyimpan id --}}
            
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="nik">No. ART</label>
                <input type="text" class="form-control" id="nik" name="nik" value="{{ $item['nik'] }}" maxlength="50" required>
              </div>
            </div>

            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="nama">Nama ART</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $item['nama'] }}" maxlength="125" required>
              </div>
            </div>

            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="kat">Kategori</label>
                <select  class="custom-select" name="kat" id="kat" required>
                  <option selected class="text-gray" disabled>Pilih kategori</option>
                  <option value="1" {{ $item['kategori'] == 1 ? 'selected' : '' }}>1</option>
                  <option value="2" {{ $item['kategori'] == 2 ? 'selected' : '' }}>2</option>
                  <option value="3" {{ $item['kategori'] == 3 ? 'selected' : '' }}>3</option>
                  <option value="4" {{ $item['kategori'] == 4 ? 'selected' : '' }}>4</option>
                  <option value="5" {{ $item['kategori'] == 5 ? 'selected' : '' }}>5</option>
                </select>
              </div>
            </div>

            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="hub">Hubungan</label>
                <select  class="custom-select" name="hub" id="hub" required>
                  <option class="text-gray" disabled>Pilih hubungan</option>
                  <option value="1" {{ $item['hub'] == 1 ? 'selected' : '' }}>1</option>
                  <option value="2" {{ $item['hub'] == 1 ? 'selected' : '' }}>2</option>
                  <option value="3" {{ $item['hub'] == 1 ? 'selected' : '' }}>3</option>
                </select>
              </div>
            </div>

            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="jk">Jenis Kelamin</label>
                <select  class="custom-select" name="jk" id="jk" required>
                  <option selected class="text-gray" disabled>Pilih jenis kelamin</option>
                  <option value="1" {{ $item['jenis_kelamin'] == 1 ? 'selected' : '' }}>Laki-laki</option>
                  <option value="2" {{ $item['jenis_kelamin'] == 2 ? 'selected' : '' }}>Perempuan</option>
                </select>
              </div>
            </div>

            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="tgl">Tgl Lahir</label>
                <input type="date" class="form-control" id="tgl" name="tgl" value="{{ $item['tanggal_lahir'] }}" required>
              </div>
            </div>

            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="umur">Umur</label>
                <input type="number" class="form-control" id="umur" name="umur" value="{{ $item['umur'] }}" required>
              </div>
            </div>

            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="kelas">Kelas</label>
                <input type="number" class="form-control" id="kelas" name="kelas" value="{{ $item['kelas'] }}" required>
              </div>
            </div>

            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="fas">Nama Fasilitas</label>
                <input type="text" class="form-control" id="fas" name="fas" value="{{ $item['nama_fasilitas'] }}" maxlength="125" required>
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
@endforeach