<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Matkul;
use App\Models\Kurikulum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurimatkul extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_kurikulum', 'kode_matkul',
    ];

    public function matkul(){
            //class mana, fk class, fk sini
        return $this->belongsTo(Matkul::class,'kode_matkul', 'kode_matkul');
    }
    public function kurikulum(){
        //class mana, fk class, fk sini
        return $this->belongsTo(Kurikulum::class, 'kode_kurikulum', 'kode_kurikulum');
    }


    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }
}
