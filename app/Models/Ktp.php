<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ktp extends Model
{
    use HasFactory;
    protected $table = 'ktp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nik',
        'nama',
        'tempat_lahir',
        'tgal_lahir', 
        'alamat', 
        'rt', 
        'rw',
        'id_kelurahan',
        'id_agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
