<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;

use App\Models\User;
use App\Models\Role;
use App\Models\ProfilImages;
use App\Http\Controllers\RadomCodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\CheckAdminRole;
use App\Mail\AccountCreatedMail;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        // $this->middleware([CheckAdminRole::class]);
    }
    
    public function index(Request $request){
        $user = Auth::user();
        $user = User::findById($user->id);
        $data = User::orderBy('role_id', 'ASC')->get();
        $roles = Role::all();
        
        if ($request->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('roled', function($data){
                if ($data->role_id == 1) { return 'Admin';} 
                if ($data->role_id == 2) { return 'Pendamping';} 
                if ($data->role_id == 3) { return 'Ketua Kelompok';} 
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

        $password = (new RandomCodeController)->generateRandomString(8, '');
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($password),
            'image_id' => '0',
            'role_id'  => $request->role,
        ]);

        if($user){
            //redirect dengan pesan sukses
            Mail::to($request->email)->send(new AccountCreatedMail($request->email, $password));
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

    public function profil()
    {
        $user = Auth::user();
        $user = User::findById($user->id);
        $data = User::get();
        $roles = Role::all();
        
        return view('user.profil.index', compact('user', 'roles'));
    }

    public function profilEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|Regex:/\A(?!.*[:;]-\))[ -~]+\z/',
        ]);

        if ($validator->fails()) {
            //redirect dengan pesan error
            return back()->with(['error' => 'Harap mengisi data dengan benar!']);
        }

        $dataUser   = User::find($request->id);
        $checkEmail = User::where('email', $request->input('email'))->exists();

        if ($checkEmail && $dataUser->email != $request->input('email')) {
            return back()->with(['error' => 'email sudah digunakan!']);
        }


        if ($request->image != null) {
            $id_profil = (new RandomCodeController)->generateRandomString(50, 'FOTO-');
        
            $file = $request->file('image');

            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg|file|max:2028',
            ]);

            if ($validator->fails()) {
                return back()->with(['error' => 'Harap unggah foto dengan ukuran dibawah 2MB!']);
            }

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->storeAs('public/images/peserta', $request->id.'-'.$file->getClientOriginalName());
            }
            
            if ($dataUser->image_id == '0') {
                $profil = new ProfilImages();
                $profil->id = $id_profil;
                $profil->profil_image = $request->id.'-'.$file->getClientOriginalName();
                $profil->created_by = $request->id;
                $profil->updated_by = $request->id;

                $dataUser->image_id = $id_profil;

                $profil->save();

            } else {
                $profil = ProfilImages::find($dataUser->image_id);
                unlink("storage/images/peserta/".$profil->profil_image);

                $profil->profil_image = $request->id.'-'.$file->getClientOriginalName();
                $profil->updated_by = $request->id;

                $profil->save();
            }
        }       
        
        $dataUser->name = $request->name;
        $dataUser->email = $request->email;
        $dataUser->save();

        return back()
        ->with(['success' => 'Akun berhasil dipebaharui!']);
    }

    public function profilEditPassword(Request $request)
    {
        $dataUser   = User::find($request->id);

        if (!Hash::check($request->pass1, $dataUser->password)) 
        {
            return back()->with(['error' => 'Password lama tidak sesuai!']);
        } 

        if ($request->pass2 != $request->pass3) {
            return back()->with(['error' => 'Password baru tidak sama!']);
        } else {
            $dataUser->password = Hash::make($request->pass2);
            $dataUser->save();
        }
        
        return back()->with(['success' => 'Password berhasil dipebaharui!']);
    }
}
