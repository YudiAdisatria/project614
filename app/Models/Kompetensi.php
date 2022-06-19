<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Matkul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kompetensi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'profil', 'deskripsi',
    ];

    public function matkul(){
                            //class mana, fk class, fk sini
        return $this->hasMany(Matkul::class,'id_kompetensi');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }
}
