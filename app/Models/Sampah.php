<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sampah extends Model
{
    protected $table = 'sampah'; 
    protected $fillable = ['nama', 'harga_kg', 'satuan', 'foto'];

}
