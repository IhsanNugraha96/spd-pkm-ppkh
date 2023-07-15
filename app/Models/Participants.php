<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Participants extends Model
{
    use HasFactory;

    protected $table = 'penerima_pkh';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_ktp',
        'id_kk',
        'id_profil', 
        'id_home', 
        'id_indikator',
        'tahun_kepesertaan',
        'nama_ibu',
        'created_by',
        'updated_by'
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
        return DB::table('penerima_pkh')
        ->select(
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
        ->leftJoin('ktp', 'penerima_pkh.id_ktp', '=', 'ktp.id')
        ->leftJoin('users', 'penerima_pkh.updated_by', '=', 'users.id')
        ->get();
    }

    public function getParticipantById($id)
    {
        return DB::table('penerima_pkh')
        ->select(
            'penerima_pkh.id',
            'penerima_pkh.id_ktp',
            'penerima_pkh.id_profil',
            'penerima_pkh.id_home',
            'penerima_pkh.id_kk',
            'penerima_pkh.id_indikator',
            'penerima_pkh.nama_ibu',
            'penerima_pkh.tahun_kepesertaan',
            'penerima_pkh.created_at',
            'penerima_pkh.created_by',
            'penerima_pkh.updated_at',
            'penerima_pkh.updated_by',
            'ktp.nama',
            'ktp.nik',
            'ktp.tempat_lahir',
            'ktp.tgal_lahir',
            'ktp.alamat',
            'ktp.rt',
            'ktp.rw',
            'ktp.id_kelurahan',
            'ktp.id_agama',
            'ktp.status_perkawinan',
            'ktp.pekerjaan',
            'ktp.kewarganegaraan',
            'users.name',
            'kk.no_kk',
            'kk.kepala_keluarga',
            'profil_images.profil_image',
            'home_images.home_image',
            'indikator.keluarga_sebelum',
            'indikator.keluarga_setelah',
            'indikator.ekonomi_sebelum',
            'indikator.ekonomi_setelah',
            'indikator.kesehatan_sebelum',
            'indikator.kesehatan_setelah',
            'indikator.pendidikan_sebelum',
            'indikator.pendidikan_setelah',
            'indikator.rumah_sebelum',
            'indikator.rumah_setelah',
            'm_kelurahan.id_kecamatan',
            'm_kelurahan.nama_kelurahan',
            'm_kecamatan.id_kota',
            'm_kecamatan.nama_kecamatan',
            'm_kota.id_provinsi',
            'm_kota.nama_kota',
            'm_provinsi.nama_provinsi',
            'm_agama.nama_agama',
            'm_status_kawin.nama_status_kawin',
        )
        ->join('ktp', 'penerima_pkh.id_ktp', '=', 'ktp.id')
        ->join('users', 'penerima_pkh.updated_by', '=', 'users.id')
        ->join('kk', 'penerima_pkh.id_kk', '=', 'kk.id')
        ->join('profil_images', 'penerima_pkh.id_profil', '=', 'profil_images.id')
        ->join('home_images', 'penerima_pkh.id_home', '=', 'home_images.id')
        ->join('indikator', 'penerima_pkh.id_indikator', '=', 'indikator.id')
        ->join('m_kelurahan', 'ktp.id_kelurahan', '=', 'm_kelurahan.id')
        ->join('m_kecamatan', 'm_kelurahan.id_kecamatan', '=', 'm_kecamatan.id')
        ->join('m_kota', 'm_kecamatan.id_kota', '=', 'm_kota.id')
        ->join('m_provinsi', 'm_kota.id_provinsi', '=', 'm_provinsi.id')
        ->join('m_agama', 'ktp.id_agama', '=', 'm_agama.id')
        ->join('m_status_kawin', 'ktp.status_perkawinan', 'm_status_kawin.id')
        ->where('penerima_pkh.id', $id)
        ->get();
    }

    public function getDatakeluargaByIdKk($id_kk)
    {
        return DB::table('anggota_keluarga')
        ->where('id_kk', $id_kk)
        ->get();
    }

    public function getPenerimaPkhByIdPembimbing($id)
    {
        return DB::table('penerima_pkh')
        ->join('anggota_kelompok', 'penerima_pkh.id', '=', 'anggota_kelompok.id_penerima_pkh')
        ->join('kelompok', 'anggota_kelompok.id_kelompok', '=', 'kelompok.id')
        ->join('ktp', 'penerima_pkh.id_ktp', 'ktp.id')
        ->join('users', 'penerima_pkh.updated_by', '=', 'users.id')
        ->where('kelompok.id_akun_pembimbing', $id)
        ->get();
    }
}
