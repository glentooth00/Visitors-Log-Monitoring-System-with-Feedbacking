<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function municipalities()
    {
        return $this->hasMany(Municipalities::class);
    }

}
