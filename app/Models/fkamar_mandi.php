<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fkamar_mandi extends Model
{
    protected $fillable = [
        'kamar_id','name'
    ];

    public function kamars()
    {
        return $this->hasMany('App\kamar','id_kamar');
    }
}
