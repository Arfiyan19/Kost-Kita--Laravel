<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\kamar;

class fkamar extends Model
{
    protected $fillable = [
        'kamar_id','name'
    ];

    public function kamar()
    {
        return $this->belongsTo(kamar::class);
    }
}
