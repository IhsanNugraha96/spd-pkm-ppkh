<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelompok;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\RadomCodeController;

class KelompokController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
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
        return view('kelompok.index', compact('data', 'user', 'data_akun'));
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|Regex:/\A(?!.*[:;]-\))[ -~]+\z/',
            'akun'     => 'required'
        ]);

        if ($validator->fails()) {
            //redirect dengan pesan error
            return redirect()->route('kelompok')->with(['error' => 'Harap mengisi data dengan benar!']);
        }

        
        $id_kelompok = (new RandomCodeController)->generateRandomString(50, 'KLP-');
        $data = Kelompok::create([
            'id'            => $id_kelompok,
            'nama_kelompok' => $request->name,
            'id_akun_user'  => $request->akun,
        ]);

        if($data){
            //redirect dengan pesan sukses
            return redirect()->route('kelompok')->with(['success' => 'Kelompok Berhasil Ditambahkan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('kelompok')->with(['error' => 'Kelompok Gagal Ditambahkan!']);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'akun_edit'     => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('kelompok')->with(['error' => 'Harap mengisi data dengan benar!']);
        }

        $kelompok = Kelompok::find($request->data_id);
        $kelompok->nama_kelompok = $request->name;
        $kelompok->id_akun_user  = $request->akun_edit;
        
        $kelompok->save();
        return redirect()->route('kelompok')->with(['success' => 'Data Kelompok berhasil diperbaharui!']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $kelompok = Kelompok::find($id);
        // dd($kelompok);
        if ($kelompok == null) {
            return redirect()->route('kelompok')->with(['warning', 'Kelompok tidak ditemukan.']);
        }
        else {
            DB::table('anggota_kelompok')
                ->where('id_kelompok', $id)
                ->delete();

            $kelompok->delete();
            return redirect()->route('kelompok')->with(['success' => 'Kelompok berhasil dihapus!']);
        }        
    }

    public function getById(Request $request) 
    {
        if (request()->ajax()) {
            $data = Kelompok::select('kelompok.id', 'kelompok.nama_kelompok', 'kelompok.id_akun_user', 'users.name')
                ->Join('users', 'kelompok.id_akun_user', 'users.id')
                ->where('kelompok.id', $request->id)->get();
            if ($data == null) {
                abort(404);
            }
            return response()->json($data, 200);
        }else {
            abort(404);
        }
    }
}
