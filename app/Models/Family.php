<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Family extends Model
{
    use HasFactory;

    protected $table = 'anggota_keluarga';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_kk', 
        'nik', 
        'nama', 
        'kategori',
        'hub',
        'jenis_kelamin',
        'tanggal_lahir',
        'umur',
        'kelas',
        'nama_fasilitas',
        'id_status_anak',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];


}
