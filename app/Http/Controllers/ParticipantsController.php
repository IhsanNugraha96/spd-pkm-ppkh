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
        $data = Participants::getAll();
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
            ->addColumn('action', function($data){  
                $id = $data->id;   
                        
                return "
                <button type='button' class='btn btn-sm text-info' data-id='{$id}' onclick='viewDetail({$id})'><i class='fa fa-eye' aria-hidden='true'></i></button>
                <button type='button' data-toggle='modal' data-target='#editParticipantModal' class='btn btn-sm text-warning' data-id='{$id}'><i class='fa fa-pencil-square-o'></i></button>
                <button type='button' data-toggle='modal' data-target='#deleteParticipantModal' class='btn btn-sm text-danger' data-id='{$id}'><i class='fa fa-trash'></i></button>";
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('participant.index', compact('roles','data', 'user', 'list_agama', 'list_status_kawin', 'list_provinsi', 'list_kab', 'list_kec', 'list_kel'));
    }

    public function viewDetail(Request $request)
    {
        $user = Auth::user();
        $data = json_decode(Participants::getParticipantById($request->query('id')), true);
        $roles = Role::all();
        $data = $data[0];
        $data_keluarga = json_decode(Participants::getDatakeluargaByIdKk($data['id_kk']), true);

        return view('participant.detail.index', compact('roles','data', 'user', 'data_keluarga'));
    }

    public function viewFormAdd()
    {
        $user = Auth::user();
        $data = Participants::getAll();
        $roles = Role::all();
        $list_agama = Agama::all();
        $list_status_kawin = StatusPerkawinan::all();
        $list_provinsi = Provinsi::all();
        
        return view('participant.insert', compact('roles','data', 'user', 'list_agama', 'list_status_kawin', 'list_provinsi'));
    }

    public function insert(Request $request)
    {
        $user = Auth::user();   
        
        $id_ktp = (new RandomCodeController)->generateRandomString(50, 'KTP');
        $id_kk = (new RandomCodeController)->generateRandomString(50, 'KK');
        $id_idikator = (new RandomCodeController)->generateRandomString(50, 'IDK');

        $validator = Validator::make($request->all(), [
            'nik'      => 'required|unique:ktp,id',
        ]);

        if ($validator->fails()) {
            //redirect dengan pesan error
            return redirect()->route('participants')->with(['error' => 'NIK sudah ada!']);
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
        $ktp->kewarganegaraan = $request->input('negara');
        $ktp->created_by = $user->id;

        // instance model kk
        $kk = new Kk();
        $kk->id = $id_kk;
        $kk->no_kk = $request->input('kk');
        $kk->kepala_keluarga = $request->input('kpl_kk');

        //instance model idikator
        $indikator = new Indikator();
        $indikator->id = $id_idikator;
        $indikator->keluarga_sebelum    = 'keluarga_sebelum';
        $indikator->keluarga_setelah    = 'keluarga_setelah';
        $indikator->ekonomi_sebelum     = 'ekonomi_sebelum';
        $indikator->ekonomi_setelah     = 'ekonomi_setelah';
        $indikator->kesehatan_sebelum   = 'kesehatan_sebelum';
        $indikator->kesehatan_setelah   = 'kesehatan_setelah';
        $indikator->pendidikan_sebelum  = 'pendidikan_sebelum';
        $indikator->pendidikan_setelah  = 'pendidikan_setelah';
        $indikator->rumah_sebelum       = 'rumah_sebelum';
        $indikator->rumah_setelah       = 'rumah_setelah';

        // instance model peserta
        $peserta = new Participants();
        $peserta->id_ktp = $id_ktp;
        $peserta->id_kk = $id_kk;
        $peserta->id_profil = 1;
        $peserta->id_home = 1;
        $peserta->id_indikator = $id_idikator;
        $peserta->tahun_kepesertaan = $request->input('thn_peserta');
        $peserta->nama_ibu = $request->input('ibu');
        $peserta->created_by = $user->id;
        $peserta->updated_by = $user->id;
        
        // Simpan data ke database
        $ktp->save();
        $kk->save();
        $indikator->save();
        $peserta->save();
        
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
        $data_peserta = Participants::find($request->data_id);
        $data_peserta->update([  
            'id'                => $data_peserta['id'],
            'tahun_kepesertaan' => $request->thn_peserta,
            'nama_ibu'          => $request->ibu,
            'updated_by'        => $user->id
        ]);   
    }

    public function updateDataKtp($id, $request)
    {
        $data_ktp = Ktp::find($id);
        $user = Auth::user();
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
            'updated_by'    => $user->id
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
}
