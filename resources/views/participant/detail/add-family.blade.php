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
                <label for="nik">No. ART/NIK<small style="color:red"> (Maks. 16 digit angka)</small></label>
                <input type="text" class="form-control" id="nik" name="nik" maxlength="16" placeholder="masukkan nik" required>
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
                  <option value="1">Disabilitas</option>
                  <option value="2">Balita</option>
                  <option value="3">TK</option>
                  <option value="4">SD</option>
                  <option value="5">SMP</option>
                  <option value="6">SMA</option>
                  <option value="7">Lansia</option>
                </select>
              </div>
            </div>
  
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="hub">Hubungan</label>
                <select  class="custom-select" name="hub" id="hub" required>
                  <option selected class="text-gray" disabled>Pilih hubungan</option>
                  <option value="1">Kepala Keluarga</option>
                  <option value="2">Suami</option>
                  <option value="3">Istri</option>
                  <option value="4">Anak</option>
                  <option value="5">Menantu</option>
                  <option value="6">Cucu</option>
                  <option value="7">Orang Tua</option>
                  <option value="8">Mertua</option>
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
                <input type="date" class="form-control text-gray" id="tgl" name="tgl" onchange="hitungUmur()" required>
              </div>
            </div>
  
            <div class="form-row mb-2">
              <div class="col mb-2 mt-2">
                <label for="umur">Umur</label>
                <input type="number" class="form-control text-gray" id="umur" name="umur" placeholder="masukkan umur" required readonly>
              </div>
            </div>
  
            <div class="form-row mb-2" id="input-kelas" hidden="true">
              <div class="col mb-2 mt-2">
                <label for="kelas">Kelas</label>
                <input type="number" class="form-control" id="kelas" name="kelas" placeholder="masukkan kelas" value="0" required>
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
  