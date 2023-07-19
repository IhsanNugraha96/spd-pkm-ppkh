<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'remember_token', 'image_id', 'role_id', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function findById($id)
    {
        return DB::table('users')
        ->leftJoin('profil_images', 'users.image_id', '=', 'profil_images.id')
        ->where('users.id', $id)
        ->first();
    }

    public function findByEmail($email)
    {
        return DB::table('users')->where('email', $email)->get();
    }

    public function getAkunKetuaKelompok()
    {
        return DB::table('users')->where('role_id', 3)->get();
    }

    public function getAkunKetuaKelompokByIdPendamping($id)
    {
        return DB::table('users')
        ->select('kelompok.*', 'users.*')
        ->leftJoin('kelompok', 'kelompok.id_akun_user', 'users.id')
        // ->where('kelompok.id_akun_pembimbing', $id)
        ->where('users.role_id', 3)
        ->whereNull('kelompok.id_akun_user')
        ->get();
    }

    public function getAkunKetuaKelompokByIdPendamping2($id)
    {
        return DB::table('users')
        ->select('kelompok.*', 'users.*')
        ->leftJoin('kelompok', 'kelompok.id_akun_user', 'users.id')
        ->where('users.role_id', 3)
        ->get();
    }
}
