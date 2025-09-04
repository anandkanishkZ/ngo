<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'image',
        'max_participants',
        'registration_required',
    ];

    protected $casts = [
        'date' => 'date',
        'registration_required' => 'boolean',
    ];
}
