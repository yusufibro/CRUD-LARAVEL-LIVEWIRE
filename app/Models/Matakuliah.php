<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
   use HasFactory;

   protected $table = 'matakuliahs';
   protected $fillable = ['id_matakuliah','nama_matakuliah'];
   protected $guarded = [];

   public function nilai()
   {
        return $this->hasMany('App\Models\Nilai', 'id_nilai', 'nilai');
   }
    
}
