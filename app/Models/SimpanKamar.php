<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpanKamar extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id','kamar_id'
    ];

    public function kamar()
    {
      return $this->hasOne(kamar::class,'id','kamar_id');
    }
}
