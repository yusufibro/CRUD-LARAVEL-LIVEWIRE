<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = ['id_mahasiswa','nama_mahasiswa'];

    protected $guarded = [];

    public function nilai()
    {
         return $this->hasMany('App\Models\Nilai', 'id_nilai', 'nilai');
    }
}
