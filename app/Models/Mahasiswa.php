<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Nilai;
use App\Models\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim', 'nama', 'ttl', 'nirl', 'tahun_masuk',
        'tanggal_lulus',
    ];

    public function nilai(){
        return $this->hasMany(Nilai::class,'nim', 'nim');
    }
    public function report(){
        return $this->hasMany(Report::class,'nim', 'nim');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }
}
