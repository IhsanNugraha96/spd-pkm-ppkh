<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kelompok extends Model
{
    use HasFactory;
    protected $table = 'kelompok';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nama_kelompok', 
        'id_akun_user',
        'id_akun_pembimbing'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function getAll()
    {
        return DB::table('kelompok')
        ->select('kelompok.id', 'kelompok.nama_kelompok', 'kelompok.id_akun_user', 'kelompok.id_akun_pembimbing', 'u1.name', 'u2.name AS pembimbing')
        ->leftJoin('users AS u1', 'kelompok.id_akun_user', '=', 'u1.id')
        ->leftJoin('users AS u2', 'kelompok.id_akun_pembimbing', '=', 'u2.id')
        ->get();
    }

    public function getByIdPembimbig($id)
    {
        return DB::table('kelompok')
        ->select('kelompok.id', 'kelompok.nama_kelompok', 'kelompok.id_akun_user', 'kelompok.id_akun_pembimbing', 'u1.name', 'u2.name AS pembimbing')
        ->leftJoin('users AS u1', 'kelompok.id_akun_user', '=', 'u1.id')
        ->leftJoin('users AS u2', 'kelompok.id_akun_pembimbing', '=', 'u2.id')
        ->where('kelompok.id_akun_pembimbing', $id)
        ->get();

    }

    public function getByIdKetua($id)
    {
        return DB::table('kelompok')
        ->select('kelompok.id', 'kelompok.nama_kelompok', 'kelompok.id_akun_user', 'kelompok.id_akun_pembimbing', 'u1.name', 'u2.name AS pembimbing')
        ->leftJoin('users AS u1', 'kelompok.id_akun_user', '=', 'u1.id')
        ->leftJoin('users AS u2', 'kelompok.id_akun_pembimbing', '=', 'u2.id')
        ->where('kelompok.id_akun_user', $id)
        ->first();

    }
}
