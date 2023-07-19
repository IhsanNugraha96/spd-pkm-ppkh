<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilImages;
use App\Models\Participants;
use App\Models\Home;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\RadomCodeController;
use App\Http\Requests\ImageUploadRequest;

class PictureController extends Controller
{
    public function downloadProfil($filename)
    {
        $path = public_path('storage/images/peserta/' . $filename);
        
        if (!File::exists($path) || $filename == 'no_image.jpg') {
            abort(404);
        }

        $headers = [
            'Content-Type' => 'image/jpeg/jpg/png', // jenis gambar yang bisa diunduh
        ];

        return response()->download($path, $filename, $headers);
    }

    public function downloadHome($filename)
    {
        $path = public_path('storage/images/rumah/' . $filename);
        
        if (!File::exists($path) || $filename == 'no_image.jpg') {
            abort(404);
        }

        $headers = [
            'Content-Type' => 'image/jpeg/jpg/png', // jenis gambar yang bisa diunduh
        ];

        return response()->download($path, $filename, $headers);
    }

    public function uploadProfil(Request  $request)
    {   
        $user = Auth::user();
        $user = User::findById($user->id);
        $id_profil = (new RandomCodeController)->generateRandomString(50, 'FOTO-');
        
       $file = $request->file('image');

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|file|max:2028',
        ]);

        if ($validator->fails()) {
            return back()->with(['error' => 'Harap unggah foto dengan ukuran dibawah 2MB!']);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs('public/images/peserta', $request->id_participant.'-'.$file->getClientOriginalName());
        }

        if ($request->id == 1) {
            $profil = new ProfilImages();
            $profil->id = $id_profil;
            $profil->profil_image = $request->id_participant.'-'.$file->getClientOriginalName();
            $profil->created_by = Auth::user()->id;
            $profil->updated_by = Auth::user()->id;

            $participant = Participants::find($request->id_participant);
            $participant->id_profil = $id_profil;

            $profil->save();
            $participant->save();

        } else {
            $profil = ProfilImages::find($request->id);
            unlink("storage/images/peserta/".$profil->profil_image);

            $profil->profil_image = $request->id_participant.'-'.$file->getClientOriginalName();
            $profil->updated_by = Auth::user()->id;

            $profil->save();
        }
        return back()
            ->with(['success' => 'Foto berhasil di unggah!'])
            ->with('image', $imagePath); 
    }

    public function uploadHome(Request $request)
    {
        $user = Auth::user();
        $user = User::findById($user->id);
        $id_home = (new RandomCodeController)->generateRandomString(50, 'HOME-');
        
       $file = $request->file('image');

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|file|max:2028',
        ]);

        if ($validator->fails()) {
            return back()->with(['error' => 'Harap unggah foto dengan ukuran dibawah 2MB!']);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs('public/images/rumah', $request->id_participant.'-'.$file->getClientOriginalName());
        }

        if ($request->id == 1) {
            $rumah = new Home();
            $rumah->id = $id_home;
            $rumah->home_image = $request->id_participant.'-'.$file->getClientOriginalName();
            $rumah->created_by = Auth::user()->id;
            $rumah->updated_by = Auth::user()->id;

            $participant = Participants::find($request->id_participant);
            $participant->id_home = $id_home;

            $rumah->save();
            $participant->save();

        } else {
            $rumah = Home::find($request->id);
            unlink("storage/images/rumah/".$rumah->home_image);

            $rumah->home_image = $request->id_participant.'-'.$file->getClientOriginalName();
            $rumah->updated_by = Auth::user()->id;

            $rumah->save();
        }
        return back()
            ->with(['success' => 'Foto rumah berhasil di unggah!'])
            ->with('image', $imagePath); 
    }

}
