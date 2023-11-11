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
                <label for="nik">No. ART<small style="color:red"> (Maks. 16 digit angka)</small></label>
                <input type="text" class="form-control" id="nik" name="nik" value="{{ $item['nik'] }}" maxlength="16" required>
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
                  <option value="1" {{ $item['kategori'] == 1 ? 'selected' : '' }}>Disabilitas</option>
                  <option value="2" {{ $item['kategori'] == 2 ? 'selected' : '' }}>Balita</option>
                  <option value="3" {{ $item['kategori'] == 3 ? 'selected' : '' }}>TK</option>
                  <option value="4" {{ $item['kategori'] == 4 ? 'selected' : '' }}>SD</option>
                  <option value="5" {{ $item['kategori'] == 5 ? 'selected' : '' }}>SMP</option>
                  <option value="5" {{ $item['kategori'] == 6 ? 'selected' : '' }}>SMA</option>
                  <option value="5" {{ $item['kategori'] == 7 ? 'selected' : '' }}>Lansia</option>
                </select>
              </div>
            </div>

            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="hub">Hubungan</label>
                <select  class="custom-select" name="hub" id="hub" required>
                  <option class="text-gray" disabled>Pilih hubungan</option>
                  <option value="1" {{ $item['hub'] == 1 ? 'selected' : '' }}>Kepala Keluarga</option>
                  <option value="2" {{ $item['hub'] == 2 ? 'selected' : '' }}>Suami</option>
                  <option value="3" {{ $item['hub'] == 3 ? 'selected' : '' }}>Istri</option>
                  <option value="4" {{ $item['hub'] == 4 ? 'selected' : '' }}>Anak</option>
                  <option value="5" {{ $item['hub'] == 5 ? 'selected' : '' }}>Menantu</option>
                  <option value="6" {{ $item['hub'] == 6 ? 'selected' : '' }}>Cucu</option>
                  <option value="7" {{ $item['hub'] == 7 ? 'selected' : '' }}>Orang Tua</option>
                  <option value="8" {{ $item['hub'] == 8 ? 'selected' : '' }}>Mertua</option>
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
                <input type="date" class="form-control" id="tgl" name="tgl" value="{{ $item['tanggal_lahir'] }}" onchange="hitungUmur()" required>
              </div>
            </div>

            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="umur">Umur</label>
                <input type="number" class="form-control" id="umur" name="umur" value="{{ $item['umur'] }}" required>
              </div>
            </div>

            <div class="form-row mb-2" id="input-kelas" hidden="true">
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

<script>
  function hitungUmur()
  {
    // Dapatkan elemen input tanggal dan elemen input umur
    var inputTanggal = document.getElementById('tgl');
    var inputUmur = document.getElementById('umur');

    // Dapatkan nilai tanggal lahir dari elemen input tanggal
    var tanggalLahir = new Date(inputTanggal.value);

    // Dapatkan tanggal saat ini
    var tanggalSekarang = new Date();

    // Hitung selisih tahun antara tanggal lahir dan tanggal saat ini
    var selisihTahun = tanggalSekarang.getFullYear() - tanggalLahir.getFullYear();

    // Periksa apakah ulang tahun telah berlalu
    if (tanggalSekarang.getMonth() < tanggalLahir.getMonth() || (tanggalSekarang.getMonth() === tanggalLahir.getMonth() && tanggalSekarang.getDate() < tanggalLahir.getDate())) {
      selisihTahun--;
    }

    // Tampilkan umur dalam elemen input umur
    inputUmur.value = selisihTahun;
  }
</script>

<script>
  // Fungsi ini akan dipanggil setiap kali pilihan kategori berubah
  function toggleKelasInput() {
    // Dapatkan elemen input kategori dan input kelas
    var inputKategori = document.getElementById('kat');
    var inputKelas = document.getElementById('input-kelas');

    // Dapatkan nilai pilihan kategori yang dipilih
    var selectedKategori = inputKategori.value;

    // Periksa apakah pilihan kategori adalah TK, SD, SMP, atau SMA
    if (selectedKategori === '3' || selectedKategori === '4' || selectedKategori === '5' || selectedKategori === '6') {
      // Jika ya, tampilkan input kelas dan buka
      inputKelas.style.display = 'block';
      inputKelas.removeAttribute('hidden');
    } else {
      // Jika tidak, sembunyikan input kelas dan kembalikan ke nilai awal
      inputKelas.style.display = 'none';
      inputKelas.setAttribute('hidden', 'true');
      inputKelas.value = '0'; // Setel nilai kelas ke 0 atau sesuai yang Anda inginkan
    }
  }

  // Tambahkan event listener ke input kategori untuk memanggil fungsi saat perubahan terjadi
  var inputKategori = document.getElementById('kat');
  inputKategori.addEventListener('change', toggleKelasInput);

  // Panggil fungsi saat halaman dimuat untuk mengatur status awal
  toggleKelasInput();
</script>
