<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participants;
use App\Models\Role;
use App\Models\User;
use App\Models\AnggotaKelompok;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PDF;

class EksportController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->query('id'));
        $data = json_decode(Participants::getParticipantById($request->query('id')), true);
        $roles = Role::all();
        $data = $data[0];
        $data_keluarga = json_decode(Participants::getDatakeluargaByIdKk($data['id_kk']), true);
        $data_kelompok = AnggotaKelompok::getDataKelompokByIdPenerimaPkh($request->query('id'));
 
        $pdf = PDF::loadview('eksport.detail-peserta', ['data' => $data, 'roles' => $roles, 'data_keluarga' => $data_keluarga, 'data_kelompok' => $data_kelompok]);
        $pdf->setPaper('A4', 'potrait');
        // return view('eksport.detail-peserta', compact('data', 'roles', 'data_keluarga'));
        return $pdf->download('data-'.$data['nama'].'.pdf');
    }
}
