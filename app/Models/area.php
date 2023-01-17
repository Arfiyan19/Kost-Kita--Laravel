<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    protected $fillable = [
        'idarea','area_name'
    ];


    public function kamars()
    {
        return $this->hasMany('App\Models\kamar','id_kamar');
    }
}
