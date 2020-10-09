<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilais';
    protected $fillable = ['id_nilai','id_mahasiswa','id_matakuliah','nilai'];
    protected $guarded = [];
 
    public function post()
    {
        return $this->belongsTo('App\Models\Post','id_mahasiswa','nama_mahasiswa');
    }
    
    public function matakuliah()
    {
         return $this->belongsTo('App\Models\Matakuliah', 'id_matakuliah', 'nama_matakuliah');
    }

}
