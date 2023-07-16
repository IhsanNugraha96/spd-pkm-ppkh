<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelompok;
use App\Models\AnggotaKelompok;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\RadomCodeController;

class ManagementGroupController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $user = User::findById($user->id);
        $data = Kelompok::getAll();
        $data_akun = User::getAkunKetuaKelompok();
        // dd($data_akun);
        if ($request->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){  
                $id = $data->id;   
                        
                return "
                <button type='button' data-toggle='modal' data-target='#editGroupModal' class='btn btn-sm text-warning' data-id='{$id}'><i class='fa fa-pencil-square-o'></i></button>
                <button type='button' data-toggle='modal' data-target='#deleteGroupModal' class='btn btn-sm text-danger' data-id='{$id}'><i class='fa fa-trash'></i></button>";
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('management_kelompok.index', compact('data', 'user', 'data_akun'));
    }
}
