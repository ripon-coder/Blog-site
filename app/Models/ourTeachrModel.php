<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ourTeachrModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'designation',
        'image',
        'fb',
        'twitter',
        'instragram',
        'status',
    ];
}
