<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipalities extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function provinces()
    {
        return $this->belongsTo(Provinces::class);
    }

    public function province()
    {
        return $this->belongsTo(Provinces::class);
    }

    public function barangays()
    {
        return $this->hasMany(Barangays::class);
    }


}
