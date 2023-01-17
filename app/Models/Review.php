<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable =[
      'user_id','pemilik_id','kamar_id','rating','ulasan','transaksi_id'
    ];
}
