<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['id','name', 'active'];

    //Relacion uno a muchos
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
