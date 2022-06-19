<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim', 'uname_pembuat',
    ];

    public function user(){
                            //class mana, fk class, fk sini
        return $this->belongsTo(User::class,'username', 'uname_pembuat');
    }
    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'nim', 'nim');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }
}
