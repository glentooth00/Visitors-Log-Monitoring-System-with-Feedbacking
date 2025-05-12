<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeFeedback extends Model
{
    use HasFactory;

    // Specify the table name if it is not the plural form of the model name
    protected $table = 'office_feedback';

    // Define the fillable columns for mass assignment
    protected $fillable = [
        'visitor_id',
        'office_name',
        'rating',
    ];

    // Define the relationship with the Visitor model
    public function visitor()
    {
        return $this->belongsTo(Visitors::class);
    }
}
