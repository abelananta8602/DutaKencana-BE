<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'number_phone',
        'date_birth',
        'parents_name',
        'school',
        'school_address',
    ];
}
