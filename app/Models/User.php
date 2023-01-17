<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','credit','no_wa'
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

    public function kamar()
    {
        return $this->hasOne(kamar::class);
    }

    public function dataRekening()
    {
      return $this->hasOne(DataRekening::class);
    }

    public function payment()
    {
      return $this->hasOne(payment::class);
    }

    public function transaksi()
    {
      return $this->hasMany(Transaction::class,'pemilik_id','id');
    }

    public function testimoni()
    {
      return $this->hasOne(Testimoni::class);
    }

    public function simpanKamar()
    {
      return $this->hasOne(SimpanKamar::class);
    }

    public function simpanKamars()
    {
      return $this->hasMany(SimpanKamar::class)->limit(4);
    }

}
