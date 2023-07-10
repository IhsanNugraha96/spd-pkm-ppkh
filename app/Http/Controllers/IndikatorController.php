<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Indikator;

class IndikatorController extends Controller
{
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelseb'    => 'required',
            'kelset'    => 'required',
            'ekseb'     => 'required',
            'ekset'     => 'required',
            'keseb'     => 'required',
            'keset'     => 'required',
            'penseb'    => 'required',
            'penset'    => 'required',
            'ruseb'     => 'required',
            'ruset'     => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with(['error' => 'Harap mengisi data dengan benar!']);

        }

        // Get existing data dalam tabel 'anggota_keluarga'
        $data = Indikator::find($request->id);
        if (!$data) {
            return back()->with(['error' => 'Data tidak ditemukan.']);
        } else {
            $data->update([ 
                "keluarga_sebelum"   => $request->kelseb,
                "keluarga_setelah"   => $request->kelset,
                "ekonomi_sebelum"    => $request->ekseb,
                "ekonomi_setelah"    => $request->ekset,
                "kesehatan_sebelum"  => $request->keseb,
                "kesehatan_setelah"  => $request->keset,
                "pendidikan_sebelum" => $request->penseb,
                "pendidikan_setelah" => $request->penset,
                "rumah_sebelum"      => $request->ruseb,
                "rumah_setelah"      => $request->ruset,
            ]);

            if($data){
                return back()->with(['success' => 'Data Keluarga Berhasil Di perbaharui!']);
            }else{
                return back()->with(['error' => 'Data Keluarga Gagal Di perbaharui!']);
            }
        }
        
    }
}
