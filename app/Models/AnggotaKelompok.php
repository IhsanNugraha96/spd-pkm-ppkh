<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AnggotaKelompok extends Model
{
    use HasFactory;
    protected $table = 'anggota_kelompok';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_kelompok', 
        'id_penerima_pkh', 
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    public function getParticipantByIdKelompok($id)
    {
        return DB::table('anggota_kelompok')
        ->select(
            'anggota_kelompok.id',
            'anggota_kelompok.id_kelompok',
            'anggota_kelompok.id_penerima_pkh',
            'anggota_kelompok.status',
            'penerima_pkh.id',
            'penerima_pkh.id_ktp',
            'penerima_pkh.id_profil',
            'penerima_pkh.id_home',
            'penerima_pkh.id_kk',
            'penerima_pkh.id_indikator',
            'penerima_pkh.created_at',
            'penerima_pkh.created_by',
            'penerima_pkh.updated_at',
            'penerima_pkh.updated_by',
            'ktp.nama',
            'ktp.nik',
            'ktp.tempat_lahir',
            'ktp.tgal_lahir',
            'ktp.alamat',
            'ktp.id_kelurahan',
            'ktp.id_agama',
            'ktp.status_perkawinan',
            'ktp.pekerjaan',
            'ktp.kewarganegaraan',
            'users.name'
        )
        ->leftJoin('penerima_pkh', 'anggota_kelompok.id_penerima_pkh', 'penerima_pkh.id')
        ->leftJoin('ktp', 'penerima_pkh.id_ktp', '=', 'ktp.id')
        ->leftJoin('users', 'penerima_pkh.updated_by', '=', 'users.id')
        ->where('anggota_kelompok.id_kelompok', $id)
        ->get();
    }

    public function getDataKelompokByIdPenerimaPkh($id)
    {
        return DB::table('anggota_kelompok')
        ->select('kl.id', 'kl.nama_kelompok', 'kl.id_akun_user', 'kl.id_akun_pembimbing', 'u1.name', 'u2.name AS pembimbing')
        ->leftJoin('kelompok AS kl', 'anggota_kelompok.id_kelompok', '=', 'kl.id')
        ->leftJoin('users AS u1', 'kl.id_akun_user', '=', 'u1.id')
        ->leftJoin('users AS u2', 'kl.id_akun_pembimbing', '=', 'u2.id')
        ->where('anggota_kelompok.id_penerima_pkh', $id)
        ->first();

    }

}
