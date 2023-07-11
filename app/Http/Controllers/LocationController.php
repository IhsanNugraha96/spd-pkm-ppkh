<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function getListKotaByProv(Request $request)
    {
        if (request()->ajax()) {
            $validator = Validator::make($request->all(), [
                'id'   => 'integer'
            ]);
            if ($validator->fails()) {
                return redirect()->route('participants')->with('error', 'Kota tidak ditemukan');
            }

            $kota = Kota::select('id', 'nama_kota')
                ->where('id_provinsi', $request->id)
                ->orderBy('nama_kota', 'ASC')
                ->get();

            if (!$kota) {
                abort(404);
            }
            
            return response()->json($kota, 200);
        } else {
            abort(403);
        }
    }

    public function getListKecamatanByKota(Request $request)
    {
        if (request()->ajax()) {
            $validator = Validator::make($request->all(), [
                'id'   => 'integer'
            ]);
            if ($validator->fails()) {
                return redirect()->route('participants')->with('error', 'Kecamatan tidak ditemukan');
            }

            $kec = Kecamatan::select('id', 'nama_kecamatan')
                ->where('id_kota', $request->id)
                ->orderBy('nama_kecamatan', 'ASC')
                ->get();

            if (!$kec) {
                abort(404);
            }
            
            return response()->json($kec, 200);
        } else {
            abort(403);
        }
    }

    public function getListKelurahanByKec(Request $request)
    {
        if (request()->ajax()) {
            $validator = Validator::make($request->all(), [
                'id'   => 'integer'
            ]);
            if ($validator->fails()) {
                return redirect()->route('participants')->with('error', 'Kelurahan tidak ditemukan');
            }

            $kel = Kelurahan::select('id', 'nama_kelurahan')
                ->where('id_kecamatan', $request->id)
                ->orderBy('nama_kelurahan', 'ASC')
                ->get();

            if (!$kel) {
                abort(404);
            }
            
            return response()->json($kel, 200);
        } else {
            abort(403);
        }
    }
}
