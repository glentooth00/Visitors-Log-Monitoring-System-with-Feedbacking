<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangays extends Model
{
    use HasFactory;

    protected $guarded = [];




    public function province()
    {
        return $this->belongsTo(Provinces::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipalities::class);
    }



}
