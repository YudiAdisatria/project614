<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Matkul;
use App\Models\Kurimatkul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurikulum extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_kurikulum', 'nama_kurikulum', 
    ];

    public function matkul(){
                            //class mana, fk class, fk sini
        return $this->hasMany(Matkul::class,'kode_kurikulum');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }
}
