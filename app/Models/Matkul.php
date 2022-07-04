<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Nilai;
use App\Models\Kurikulum;
use App\Models\Kompetensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matkul extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_matkul', 'nama_matkul', 'sks', 'id_kompetensi', 'kode_kurikulum'
    ];

    public function kompetensi(){
                            //class mana, fk class, fk sini
        return $this->belongsTo(Kompetensi::class,'id_kompetensi', 'id');
    }
    public function nilai(){
        return $this->hasMany(Nilai::class,'kode_matkul', 'kode_matkul');
    }
    public function kurikulum(){
        return $this->hasMany(Kurikulum::class,'kode_kurikulum', 'kode_kurikulum');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

}
