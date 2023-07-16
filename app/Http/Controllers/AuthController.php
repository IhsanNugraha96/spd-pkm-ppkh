<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return back();
        }
        return view('auth/login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $user = User::findById($user->id);
            $username = $user->name;
            return redirect()->route('dashboard')->with('success', 'Welcome back '.$username.'!');
        } 
        
        return back()->with(['error' => 'Harap memasukkan data dengan benar!']);
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda berhasil logout!');
    }
}
