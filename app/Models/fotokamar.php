<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fotokamar extends Model
{
    protected $fillable = [
        'kamar_id','foto_kamar'
    ];

    public function kamars()
    {
        return $this->hasMany('App\Models\kamar','id_kamar');
    }
}
