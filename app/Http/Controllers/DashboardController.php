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

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $user = User::findById($user->id);
        $data_akun = User::all();
        $data_pembimbing = User::where('role_id', '2')->get();
        $data_ketua = User::where('role_id', '3')->get();
        $data_penerima_pkh = Participants::getAll();
        $data_kelompok = Kelompok::all();
        
        
        $data_peserta_setiap_pembimbing = [];
        $i = 0;
        foreach ($data_pembimbing as $item) { 
            $data_peserta_setiap_pembimbing[$i] = Participants::getPenerimaPkhByIdPembimbing($item->id);
            $i++;
        }
        
        return view('dashboard/index', compact('data_akun', 'data_penerima_pkh', 'data_kelompok', 'data_pembimbing', 'data_ketua', 'user', 'data_peserta_setiap_pembimbing'));
    }
}
