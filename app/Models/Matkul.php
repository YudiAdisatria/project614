<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Nilai;
use App\Models\Kompetensi;
use App\Models\Kurimatkul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matkul extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_matkul', 'nama_matkul', 'sks', 'id_kompetensi',
    ];

    public function kompetensi(){
                            //class mana, fk class, fk sini
        return $this->belongsTo(Kompetensi::class,'id_kompetensi', 'id');
    }
    public function nilai(){
        return $this->hasMany(Nilai::class,'kode_matkul', 'kode_matkul');
    }
    public function kurimatkul(){
        return $this->hasMany(Kurimatkul::class,'kode_matkul', 'kode_matkul');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

}
