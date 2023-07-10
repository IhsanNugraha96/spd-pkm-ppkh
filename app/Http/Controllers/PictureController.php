<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\RadomCodeController;

class PictureController extends Controller
{
    public function downloadProfil($filename)
    {
        $path = public_path('images/peserta/' . $filename);
        
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
        $path = public_path('images/rumah/' . $filename);
        
        if (!File::exists($path) || $filename == 'no_image.jpg') {
            abort(404);
        }

        $headers = [
            'Content-Type' => 'image/jpeg/jpg/png', // jenis gambar yang bisa diunduh
        ];

        return response()->download($path, $filename, $headers);
    }

}
