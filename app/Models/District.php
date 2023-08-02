<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','province_id', 'active'];

    //Relacion uno a muchos (inversa)
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    //Relacion uno a muchos
    public function townships()
    {
        return $this->hasMany(Township::class);
    }
}
