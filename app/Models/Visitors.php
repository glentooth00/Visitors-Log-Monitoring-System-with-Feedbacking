<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    use HasFactory;
    protected $table = 'visitors';
    protected $casts = [
        'visit_date' => 'datetime',  // or 'date' if it's a date without time
    ];
    protected $guarded = [];

    // In Visitor model (Visitor.php)

    public function province()
    {
        return $this->belongsTo(Provinces::class, 'province_id');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipalities::class, 'municipality_id');
    }

    public function barangay()
    {
        return $this->belongsTo(Barangays::class, 'barangay_id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'visitor_id', 'id'); // Adjust foreign and local keys as per your schema
    }




}
