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
        'id_akun_user'
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
        ->select(
            'kelompok.id',
            'kelompok.nama_kelompok',
            'kelompok.id_akun_user',
            'users.name',
        )
        ->leftJoin('users', 'kelompok.id_akun_user', '=', 'users.id')
        ->get();
    }
}
