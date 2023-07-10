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
// dd($data);
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
        // dd($data);
        $roles = Role::all();
        $data = $data[0];
        $data_keluarga = json_decode(Participants::getDatakeluargaByIdKk($data['id_kk']), true);

        return view('participant.detail.index', compact('roles','data', 'user', 'data_keluarga'));
    }

}
