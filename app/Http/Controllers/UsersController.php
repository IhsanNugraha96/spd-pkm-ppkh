<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\CheckAdminRole;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware([CheckAdminRole::class]);
    }
    
    public function index(Request $request){
        $user = Auth::user();
        $data = User::get()->where('role_id', '!=', '1');
        $roles = Role::all();
        
        if ($request->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('roled', function($data){
                return $data->role_id == 1 ? 'Admin' : "User";
            })
            ->addColumn('action', function($data){  
                $id = $data->id;   
                        
                return "<button type='button' data-toggle='modal' data-target='#editUserModal' class='btn btn-sm btn-warning text-white' data-id='{$id}'>Edit</button>
                <button type='button' data-toggle='modal' data-target='#deleteUserModal' class='btn btn-sm btn-danger text-white' data-id='{$id}'>Delete</button>";
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('user.index', compact('data', 'user', 'roles'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect('/login')->with('success', 'Registration successfull! Please login!');
    }

    public function add(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name'      => 'required|Regex:/\A(?!.*[:;]-\))[ -~]+\z/',
            'email'     => 'required|unique:users,email|Regex:/\A(?!.*[:;]-\))[ -~]+\z/',
            'role'      => 'required'
        ]);

        if ($validator->fails()) {
            //redirect dengan pesan error
            return redirect()->route('user.index')->with(['error' => 'Harap mengisi data dengan benar!']);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make('5776Ppkh'),
            'image_id' => '1',
            'role_id'  => $request->role,
        ]);

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('user.index')->with(['success' => 'User Berhasil Ditambahkan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('user.index')->with(['error' => 'User Gagal Ditambahkan!']);
        }
    }

    public function edit(Request $request)
    {
        $dataUser   = User::findById($request->data_id);
        $checkEmail = User::where('email', $request->input('email'))->exists();

        if ($checkEmail && $dataUser->email != $request->input('email')) {
            return redirect()->route('user.index')->with(['warning' => 'email sudah digunakan!']);
        }

        $result = User::where('id', $request->data_id)->update(['name' => $request->input('name'), 'email' => $request->input('email')]);

        if ($result) {
            return redirect()->route('user.index')->with(['success' => 'User Berhasil Diperbaharui!']);
        } else {
            return redirect()->route('user.index')->with(['warning' => 'Data Gagal diupdate!']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        
        if ($user == null) {
            return redirect()->route('user.index')->with(['warning', 'User not found.']);
        }
        else {
            $user->delete();
            return redirect()->route('user.index')->with(['success' => 'User account berhasil dihapus!']);
        }        
    }

    public function getUserById(Request $request) 
    {
        if (request()->ajax()) {
            $data = User::select('id', 'name', 'email')->where('id', $request->id)->get();
            if ($data == null) {
                abort(404);
            }
            return response()->json($data, 200);
        }else {
            abort(404);
        }
    }

    public function getKetuaKelompok(Request $request)
    {
        if (request()->ajax()) {
            $data = User::getAkunKetuaKelompok();
            if ($data == null) {
                abort(404);
            }
            return response()->json($data, 200);
        }else {
            abort(404);
        }
    }
}
