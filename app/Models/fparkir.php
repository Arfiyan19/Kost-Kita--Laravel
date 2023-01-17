<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fparkir extends Model
{
    protected $fillable = [
        'kamar_id','name'
    ];


    public function kamars()
    {
        return $this->hasMany('App\Models\kamar','id_kamar');
    }
}
