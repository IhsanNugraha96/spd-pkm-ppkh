@php
    $selectedProvinsi = 0;
    $selectedAgama = 0;
    $selectedStatusKawin = 0;
@endphp
<div class="modal fade" id="editParticipantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title  text-white" id="exampleModalLabel">Edit Data Partisipan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="needs-validation" action="{{ route('participant.edit') }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="data_id" id="data_id" value="">{{-- untuk ambil id --}}
            <div class="text-danger font-weight-bold">KTP</div><hr>

            <div class="form-row">
              <div class="col">
                <label for="nik">NIK/No Peserta</label>
                <div class="input-group">
                  <input type="text" class="form-control modalEditInput" id="nik_lama" name="nik_lama" value="" hidden>
                  <input type="text" class="form-control modalEditInput" id="nik" name="nik" placeholder="masukkan nik" aria-describedby="inputGroupPrepend" value="" required style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    Harap masukkan NIK.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="name">Nama</label>
                <div class="input-group">
                  <input type="text" class="form-control modalEditInput" id="name" name="name" placeholder="masukkan nama" aria-describedby="inputGroupPrepend" value="" required style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    Harap masukkan nama.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="tmp_lahir">Tempat Lahir</label>
                <div class="input-group">
                  <input type="text" class="form-control modalEditInput" id="tmp_lahir" name="tmp_lahir" placeholder="masukkan tempat lahir" aria-describedby="inputGroupPrepend" value="" required style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    Harap masukkan tempat lahir.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <div class="input-group">
                  <input type="date" class="form-control modalEditInput" id="tgl_lahir" name="tgl_lahir" placeholder="masukkan tanggal lahir" aria-describedby="inputGroupPrepend" value="" required style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    Harap masukkan tanggal lahir.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="provinsi">Provinsi</label>
                <div class="input-group">
                  <select class="custom-select" id="provinsi" name="provinsi" aria-label="Example select with button addon" style="font-size: 0.875rem;">
                    <option disabled>pilih provinsi</option>
                    @foreach ($list_provinsi as $item)
                      <option value="{{ $item->id }}"{{ $item->id == $selectedProvinsi ? 'selected' : '' }}>
                        {{ ucwords(strtolower($item->nama_provinsi)) }} 
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="kota">Kabupaten/Kota</label>
                <div class="input-group">
                  <select class="custom-select select2" id="kota" name="kota" aria-label="Example select with button addon" style="font-size: 0.875rem;">
                    <option id="placeKota" disabled>pilih kota</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="kec">Kecamatan</label>
                <div class="input-group">
                  <select class="custom-select select2" id="kec" name="kec" aria-label="Example select with button addon" style="font-size: 0.875rem;">
                    <option id="placeKecamatan" disabled>pilih kecamatan</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="kel">Kelurahan</label>
                <div class="input-group">
                  <select class="custom-select select2" id="kel" name="kel" aria-label="Example select with button addon" style="font-size: 0.875rem;">
                    <option id="placeKelurahan" disabled>pilih kelurahan</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="alamat">Alamat Lengkap</label>
                <div class="input-group">
                  <input type="text" class="form-control modalEditInput" id="alamat" name="alamat" placeholder="masukkan alamat" aria-describedby="inputGroupPrepend" value="" required style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    Harap masukkan alamat lengkap.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="rt">RT</label>
                <div class="input-group">
                  <input type="text" class="form-control modalEditInput" id="rt" name="rt" placeholder="rt" aria-describedby="inputGroupPrepend" value="" maxlength="3" required style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    harap masukkan rt.
                  </div>
                </div>
              </div>

              <div class="col">
                <label for="rw">RW</label>
                <div class="input-group">
                  <input type="text" class="form-control modalEditInput" id="rw" name="rw" placeholder="rw" aria-describedby="inputGroupPrepend" value="" required style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    Harap masukkan rw.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="agama">Agama</label>
                <div class="input-group">
                  <select class="custom-select" id="agama" name="agama" aria-label="Example select with button addon" style="font-size: 0.875rem;">
                    <option disabled>pilih agama</option>
                    @foreach ($list_agama as $item)
                      <option value="{{ $item->id }}"{{ $item->id == $selectedAgama ? 'selected' : '' }}>
                        {{ $item->nama_agama }} 
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="kawin">Status Perkawinan</label>
                <div class="input-group">
                  <select class="custom-select" id="kawin" name="kawin" aria-label="Example select with button addon"  style="font-size: 0.875rem;">
                    <option disabled>pilih status perkawinan</option>
                    @foreach ($list_status_kawin as $item)
                      <option value="{{ $item->id }}"{{ $item->id_id == $selectedStatusKawin ? 'selected' : '' }}>
                        {{ $item->nama_status_kawin }} 
                      </option>
                    @endforeach
                  </select>

                  {{-- <input type="text" class="form-control modalEditInput" id="kawin" name="kawin" placeholder="masukkan status perkawinan" aria-describedby="inputGroupPrepend" value="" required style="font-size: 0.875rem;"> --}}
                  <div class="invalid-feedback">
                    Harap masukkan status perkawinan.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="pekerjaan">Pekerjaan</label>
                <div class="input-group">
                  <input type="text" class="form-control modalEditInput" id="pekerjaan" name="pekerjaan" placeholder="masukkan pekerjaan" aria-describedby="inputGroupPrepend" value="" required style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    Harap masukkan pekerjaan.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col mb-3">
                <label for="negara">Kewarganegaraan</label>
                <div class="input-group">
                  <input type="text" class="form-control modalEditInput" id="negara" name="negara" placeholder="masukkan kewarganegaraan" aria-describedby="inputGroupPrepend" value="" required style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    Harap masukkan kewarganegaraan.
                  </div>
                </div>
              </div>
            </div>

            <div class="text-danger font-weight-bold mt-2">KK</div><hr>

            <div class="form-row">
              <div class="col">
                <label for="kk">No Kartu Keluarga</label>
                <div class="input-group">
                  <input type="text" class="form-control modalEditInput" id="kk_lama" name="kk_lama" value="" hidden>
                  <input type="text" class="form-control modalEditInput" id="kk" name="kk" placeholder="masukkan no KK" aria-describedby="inputGroupPrepend" value="" required style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    Harap masukkan no KK.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col mb-3">
                <label for="kpl_kk">Kepala Keluarga</label>
                <div class="input-group">
                  <input type="text" class="form-control modalEditInput" id="kpl_kk" name="kpl_kk" placeholder="masukkan kepala keluarga" aria-describedby="inputGroupPrepend" value="" required  style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    Harap masukkan kepala keluarga.
                  </div>
                </div>
              </div>
            </div>

            <div class="text-danger font-weight-bold mt-2">Data Lainnya</div><hr>

            <div class="form-row">
              <div class="col">
                <label for="thn_peserta">Tahun Kepesertaan</label>
                <div class="input-group">
                  <input type="number" class="form-control modalEditInput" id="thn_peserta" name="thn_peserta" placeholder="masukkan tahun kepesertaan" aria-describedby="inputGroupPrepend" value="" maxlength="4" required style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    Harap masukkan tahun kepesertaan.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="ibu">Nama Ibu</label>
                <div class="input-group">
                  <input type="text" class="form-control modalEditInput" id="ibu" name="ibu" placeholder="masukkan nama ibu" aria-describedby="inputGroupPrepend" value="" required style="font-size: 0.875rem;">
                  <div class="invalid-feedback">
                    Harap masukkan nama ibu.
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