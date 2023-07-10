<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Indikator extends Model
{
    use HasFactory;
    protected $table = 'indikator';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'keluarga_sebelum', 
        'keluarga_setelah', 
        'ekonomi_sebelum', 
        'ekonomi_setelah',
        'kesehatan_sebelum',
        'kesehatan_setelah',
        'pendidikan_sebelum',
        'pendidikan_setelah',
        'rumah_sebelum',
        'rumah_setelah',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
