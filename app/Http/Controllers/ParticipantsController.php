<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participants;
use App\Models\Role;
use App\Models\Agama;
use App\Models\StatusPerkawinan;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Ktp;
use App\Models\Kk;
use App\Models\Indikator;
use App\Models\Kelompok;
use App\Models\AnggotaKelompok;
use App\Models\User;
use App\Models\Family;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\RadomCodeController;

class ParticipantsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $user = User::findById($user->id);
        if ($user->role_id == 1) {    
            $data = Participants::getAll();
            $kelompok = [];
        } elseif ($user->role_id == 2) {
            $data = Participants::getPenerimaPkhByIdPembimbing2(Auth::user()->id);
            $kelompok = Kelompok::getByIdPembimbig(Auth::user()->id);
        } else {
            $kelompok = Kelompok::getByIdKetua(Auth::user()->id);
            ($kelompok == null) ? $data = [] : $data = AnggotaKelompok::getParticipantByIdKelompok($kelompok->id);
        }
        
        $roles = Role::all();
        $list_agama = Agama::all();
        $list_status_kawin = StatusPerkawinan::all();
        $list_provinsi = Provinsi::all();
        $list_kab = Kota::all();
        $list_kec = Kecamatan::all();
        $list_kel = Kelurahan::all();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $id = $data->id;
                    $user = Auth::user();
                    $editButton = "<button type='button' class='btn btn-sm text-warning' data-id='{$id}' data-toggle='modal' data-target='#editParticipantModal' ";
                    $viewButton = "<button type='button' class='btn btn-sm text-info' data-id='{$id}' onclick='viewDetail({$id})' ";
                    $deleteButton = "<button type='button' class='btn btn-sm text-danger' data-id='{$id}' data-toggle='modal' data-target='#deleteParticipantModal' ";
        
                    if ($user->role_id == 1) {
                        $editButton .= "disabled";
                        $deleteButton .= "disabled";
                    }
        
                    $editButton .= "><i class='fa fa-pencil-square-o'></i></button>";
                    $viewButton .= "><i class='fa fa-eye' aria-hidden='true'></i></button>";
                    $deleteButton .= "><i class='fa fa-trash'></i></button>";
        
                    return $viewButton . $editButton . $deleteButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('participant.index', compact('roles','data', 'user', 'list_agama', 'list_status_kawin', 'list_provinsi', 'list_kab', 'list_kec', 'list_kel', 'kelompok'));
    }

    public function viewDetail(Request $request)
    {
        $user = Auth::user();
        $user = User::findById($user->id);
        $data = json_decode(Participants::getParticipantById($request->query('id')), true);
        $roles = Role::all();
        $data = $data[0];
        $data_keluarga = json_decode(Participants::getDatakeluargaByIdKk($data['id_kk']), true);
        $id_participant = $request->query('id');
        $data_kelompok = AnggotaKelompok::getDataKelompokByIdPenerimaPkh($id_participant);
// dd($data_kelompok->nama_kelompok);

        return view('participant.detail.index', compact('roles','data', 'user', 'data_keluarga', 'id_participant', 'data_kelompok'));
    }

    public function viewFormAdd()
    {
        $user = Auth::user();
        $user = User::findById($user->id);
        if ($user->role_id == 2) {
            $kelompok = Kelompok::getByIdPembimbig(Auth::user()->id);
        } else {
            $kelompok = Kelompok::getByIdKetua(Auth::user()->id);
        }
        
        $data = Participants::getAll();
        $roles = Role::all();
        $list_agama = Agama::all();
        $list_status_kawin = StatusPerkawinan::all();
        $list_provinsi = Provinsi::all();
        
        return view('participant.insert', compact('roles','data', 'user', 'list_agama', 'list_status_kawin', 'list_provinsi', 'kelompok'));
    }

    public function insert(Request $request)
    {
        $user = Auth::user();  
        $user = User::findById($user->id); 
        $id_ktp = (new RandomCodeController)->generateRandomString(50, 'KTP');
        $id_kk = (new RandomCodeController)->generateRandomString(50, 'KK');
        $id_idikator = (new RandomCodeController)->generateRandomString(50, 'IDK');
        $id_anggota_kel = (new RandomCodeController)->generateRandomString(50, 'AGK');

        $validator = Validator::make($request->all(), [
            'nik'      => 'required|unique:ktp,id|regex:/^[0-9]+$/|digits:16',
            'kk'      => 'required|regex:/^[0-9]+$/|digits:16',
        ]);

        if ($validator->fails()) {
            //redirect dengan pesan error
            return redirect()->route('participants')->with('error', 'Data gagal disimpan, ada kesalahan validasi pada input Anda.');
        }
        
        // instance model ktp
        $ktp = new Ktp();
        $ktp->id = $id_ktp;
        $ktp->nik = $request->input('nik');
        $ktp->nama = $request->input('name');
        $ktp->tempat_lahir = $request->input('tmp_lahir');
        $ktp->tgal_lahir = $request->input('tgl_lahir');
        $ktp->alamat = $request->input('alamat');
        $ktp->rt = $request->input('rt');
        $ktp->rw = $request->input('rw');
        $ktp->id_kelurahan = $request->input('kel');
        $ktp->id_agama = $request->input('agama');
        $ktp->status_perkawinan = $request->input('kawin');
        $ktp->pekerjaan = $request->input('pekerjaan');
        $ktp->kewarganegaraan = "Indonesia";
        $ktp->created_by = Auth::user()->id;

        // instance model kk
        $kk = new Kk();
        $kk->id = $id_kk;
        $kk->no_kk = $request->input('kk');
        $kk->kepala_keluarga = $request->input('kpl_kk');

        //instance model idikator
        $indikator = new Indikator();
        $indikator->id = $id_idikator;
        $indikator->keluarga_sebelum    = '';
        $indikator->keluarga_setelah    = '';
        $indikator->ekonomi_sebelum     = '';
        $indikator->ekonomi_setelah     = '';
        $indikator->kesehatan_sebelum   = '';
        $indikator->kesehatan_setelah   = '';
        $indikator->pendidikan_sebelum  = '';
        $indikator->pendidikan_setelah  = '';
        $indikator->rumah_sebelum       = '';
        $indikator->rumah_setelah       = '';

        // instance model peserta
        $peserta = new Participants();
        $peserta->id_ktp = $id_ktp;
        $peserta->id_kk = $id_kk;
        $peserta->id_profil = 1;
        $peserta->id_home = 1;
        $peserta->id_indikator = $id_idikator;
        $peserta->tahun_kepesertaan = $request->input('thn_peserta');
        $peserta->nama_ibu = $request->input('ibu');
        $peserta->created_by = Auth::user()->id;
        $peserta->updated_by = Auth::user()->id;

        // Simpan data ke database
        $ktp->save();
        $kk->save();
        $indikator->save();
        $peserta->save();

        // instance model anggota_kelompok
        $anggota_kel = new AnggotaKelompok();
        $anggota_kel->id = $id_anggota_kel;
        $anggota_kel->id_kelompok = $request->kelompok;
        $anggota_kel->id_penerima_pkh = $peserta->id;
        $anggota_kel->status = 1;

        $anggota_kel->save();
        
        return redirect()->route('participants')->with(['success' => 'Data Peserta berhasil ditambahkan']);
    }

    public function edit(Request $request)
    {   
        if ($request->nik != $request->nik_lama) {
            $validator = Validator::make($request->all(), [
                'nik'      => 'required|unique:ktp,id',
            ]);
    
            if ($validator->fails()) {
                //redirect dengan pesan error
                return redirect()->route('participants')->with(['error' => 'NIK sudah ada!']);
            }
        }
              
        $data_peserta = Participants::find($request->data_id);
        if (!$data_peserta) {
            return redirect()->route('participants')->with(['error' => 'Data Peserta tidak ditemukan.']);

        } else {
            $this->updateDataKtp($data_peserta['id_ktp'], $request);
            $this->updateDataKk($data_peserta['id_kk'],$request);
            $this->updateDataPeserta($request);
        }

        if($data_peserta){
            //redirect dengan pesan sukses
            return redirect()->route('participants')->with(['success' => 'Data Keluarga Berhasil Di perbaharui!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('participants')->with(['error' => 'Data Keluarga Gagal Di perbaharui!']);
        }
    }

    public function updateDataPeserta($request)
    {
        $user = Auth::user();
        $user = User::findById($user->id);
        $data_peserta = Participants::find($request->data_id);
        $data_peserta->update([  
            'id'                => $data_peserta['id'],
            'tahun_kepesertaan' => $request->thn_peserta,
            'nama_ibu'          => $request->ibu,
            'updated_by'        => Auth::user()->id
        ]);   
    }

    public function updateDataKtp($id, $request)
    {
        $data_ktp = Ktp::find($id);
        $user = Auth::user();
        $user = User::findById($user->id);
        $data_ktp->update([  
            'nik'           => $request->nik,
            'nama'          => $request->name,
            'tempat_lahir'  => $request->tmp_lahir,
            'tgal_lahir'    => $request->tgl_lahir,
            'alamat'        => $request->alamat,
            'rt'            => $request->rt,
            'rw'            => $request->rw,
            'id_kelurahan'  => $request->kel,
            'id_agama'      => $request->agama,
            'status_perkawinan' => $request->kawin,
            'pekerjaan'     => $request->pekerjaan,
            'kewarganegaraan' => $request->negara,
            'updated_by'    => Auth::user()->id
        ]);
        DB::table('ktp')
        ->where('id', $id) // Filter berdasarkan ID data KTP
        ->update(['nik' => $request->nik]);
    }

    public function updateDataKk($id, $request)
    {
        $data_kk = Kk::find($id);
        DB::table('kk')
        ->where('id', $id) // Filter berdasarkan ID data KTP
        ->update([  
            'no_kk'      => $request->kk,
            'kepala_keluarga'  => $request->kpl_kk
        ]);
    }

    public function getParticipantById(Request $request) 
    {
        if (request()->ajax()) {
            $data = json_decode(Participants::getParticipantById($request->query('id')), true);
            
            if ($data == null) {
                abort(404);
            }
            return response()->json($data, 200);
        }else {
            abort(404);
        }
    }

    // public function delete(Request $request)
    // {
    //     $id = $request->id;
    //     $data_participant = Participants::find($id);
    //     // dd($data_participant['id_kk']);
        
    //     if ($data_participant == null) {
    //         return redirect()->route('participants')->with(['warning', 'Peserta tidak ditemukan.']);
    //     }
    //     else {
    //         $id_kk = $data_participant['id_kk'];
    //         $id_ktp = $data_participant['id_ktp'];
    //         $id_indikator = $data_participant['id_indikator'];
    //         $id_profil = $data_participant['id_profil'];
    //         $id_home = $data_participant['id_home'];

    //         DB::table('anggota_keluarga')->where('id_kk', $id_kk)->delete();
    //         DB::table('kk')->where('id', $id_kk)->delete();
    //         DB::table('ktp')->where('id', $id_ktp)->delete();
    //         DB::table('indikator')->where('id', $id_indikator)->delete();
    //         DB::table('profil_images')->where('id', $id_profil)->delete();
    //         DB::table('home_images')->where('id', $id_home)->delete();

    //         $data_participant->delete();
    //         return redirect()->route('participants')->with(['success' => 'Data Peserta berhasil dihapus!']);
    //     }        
    // }

    public function delete(Request $request)
    {
        $id = $request->id;
        $data_participant = Participants::find($id);
        
        if ($data_participant == null) {
            return redirect()->route('participants')->with(['warning', 'Peserta tidak ditemukan.']);
        }
        else {
            $id_kk = $data_participant['id_kk'];
            $id_ktp = $data_participant['id_ktp'];
            $id_indikator = $data_participant['id_indikator'];
            $id_profil = $data_participant['id_profil'];
            $id_home = $data_participant['id_home'];

            DB::table('anggota_keluarga')->where('id_kk', $id_kk)->delete();
            DB::table('kk')->where('id', $id_kk)->delete();
            DB::table('ktp')->where('id', $id_ktp)->delete();
            DB::table('indikator')->where('id', $id_indikator)->delete();
            DB::table('anggota_kelompok')->where('id_penerima_pkh', $id)->delete();

            if ($data_participant['id_profil'] != "1") {
                DB::table('profil_images')->where('id', $id_profil)->delete();
            }
            if ($data_participant['id_home'] != "1") { 
                DB::table('home_images')->where('id', $id_home)->delete();
            }

            $data_participant->delete();
            return redirect()->route('participants')->with(['success' => 'Data Peserta berhasil dihapus!']);
        }        
    }
}
