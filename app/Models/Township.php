<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','district_id', 'active'];

    //Relacion uno a muchos (inversa)
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
