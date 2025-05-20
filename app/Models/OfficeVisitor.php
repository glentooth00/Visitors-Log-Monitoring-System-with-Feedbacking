<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeVisitor extends Model
{
    protected $table = 'feedback';

    protected $guarded = [

    ];

    protected $casts = [
        'offices' => 'array',
    ];
}
