<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kamar extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function fkamar()
    {
      return $this->hasMany(fkamar::class);
    }

    public function kmandi()
    {
      return $this->hasMany(fkamar_mandi::class);
    }

    public function fbersama()
    {
      return $this->hasMany(fbersama::class);
    }

    public function fparkir()
    {
      return $this->hasMany(fparkir::class);
    }

    public function area()
    {
      return $this->hasMany(area::class);
    }

    public function fotoKamar()
    {
      return $this->hasMany(fotokamar::class);
    }


    public function payment()
    {
      return $this->hasOne('App\Models\payment','kamar_id');
    }

    public function provinsi()
    {
      return $this->hasOne('App\Models\Province','id','province_id');
    }

    public function province()
    {
      return $this->hasMany('App\Models\Province','id','province_id');
    }

    public function regencies()
    {
      return $this->hasOne('App\Models\regency','id','regency_id');
    }

    public function district()
    {
      return $this->hasOne('App\Models\District','id','district_id');
    }

    public function alamat()
    {
     return $this->hasOne(Alamat::class);
    }

    public function transaksi()
    {
      return $this->hasMany(Transaction::class);
    }

    public function favorite()
    {
      return $this->hasOne(SimpanKamar::class);
    }

    public function promo()
    {
      return $this->hasOne(Promo::class,'kamar_id');
    }

    public function reviews()
    {
      return $this->hasMany(Review::class, 'kamar_id');
    }

}
