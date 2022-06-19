<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Matkul;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim', 'kode_matkul', 'nilai',
    ];

    public function mahasiswa(){
                            //class mana, fk class, fk sini
        return $this->belongsTo(Mahasiswa::class,'nim', 'nim');
    }
    public function matkul(){
        return $this->belongsTo(Matkul::class,'kode_matkul', 'kode_matkul');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }
}
