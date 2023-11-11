<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RadomCodeController;
use App\Models\Family;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kk'     => 'required',
            'nik'       => 'required|unique:ktp,id|regex:/^[0-9]+$/|digits:16',
            'nama'      => 'required',
            'kat'       => 'required',
            'hub'       => 'required',
            'jk'        => 'required',
            'tgl'       => 'required',
            'umur'      => 'required',
            'fasilitas' => 'required',
        ]);

        if ($validator->fails()) {
            //redirect dengan pesan error
            return back()->with(['error' => 'Data gagal disimpan, ada kesalahan validasi pada input Anda.']);
        }

        // Cari apakah data dengan 'nik' yang diberikan sudah ada dalam tabel 'anggota_keluarga'
        $existingUser = Family::where('nik', $request->nik)->first();

        if ($existingUser) {
            // Jika 'nik' sudah ada, redirect atau berikan pesan sesuai kebutuhan
            return back()->with(['error' => 'NIK sudah terdaftar.']);
        } else {
            $code = (new RandomCodeController)->generateRandomString(50, 'FAM-');
            // Jika 'nik' belum ada, tambahkan data ke dalam tabel 'anggota_keluarga'
            $user = Family::create([
                'id'            => $code,
                'id_kk'         => $request->id_kk, 
                'nik'           => $request->nik, 
                'nama'          => $request->nama, 
                'kategori'      => $request->kat,
                'hub'           => $request->hub,
                'jenis_kelamin' => $request->jk,
                'tanggal_lahir' => $request->tgl,
                'umur'          => $request->umur,
                'kelas'         => $request->kelas,
                'nama_fasilitas'=> $request->fasilitas,
                'id_status_anak'=> null,
            ]);

            if($user){
                //redirect dengan pesan sukses
                return back()->with(['success' => 'Data Keluarga Berhasil Ditambahkan!']);
            }else{
                //redirect dengan pesan error
                return back()->with(['error' => 'Data Keluarga Gagal Ditambahkan!']);
            }
        } 
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik'       => 'required|Regex:/^\d+$/|unique:ktp,id|regex:/^[0-9]+$/|digits:16',
            'nama'      => 'required',
            'kat'       => 'required',
            'hub'       => 'required',
            'jk'        => 'required',
            'tgl'       => 'required',
            'umur'      => 'required',
            'kelas'     => 'required',
            'fas'       => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with(['error' => 'Harap mengisi data dengan benar!']);
        }

        // Get existing data dalam tabel 'anggota_keluarga'
        $data = Family::find($request->id_anggota_keluarga);
        
        if (!$data) {
            return back()->with(['error' => 'Data tidak ditemukan.']);

        } else {
            $data->update([ 
                'nik'           => $request->nik, 
                'nama'          => $request->nama, 
                'kategori'      => $request->kat,
                'hub'           => $request->hub,
                'jenis_kelamin' => $request->jk,
                'tanggal_lahir' => $request->tgl,
                'umur'          => $request->umur,
                'kelas'         => $request->kelas,
                'nama_fasilitas'=> $request->fas,
            ]);

            if($data){
                return back()->with(['success' => 'Data Keluarga Berhasil Di perbaharui!']);
            }else{
                return back()->with(['error' => 'Data Keluarga Gagal Di perbaharui!']);
            }
        }
        
    }

    public function destroy(Request $request)
    {
        $family = Family::find($request->id_anggota_keluarga);
        
        if ($family == null) {
            return back()->with(['warning', 'Data Keluarga tidak ditemukan.']);
        }
        else {
            $family->delete();
            return back()->with(['success' => 'Data Keluarga berhasil dihapus!']);
        } 
    }
}
