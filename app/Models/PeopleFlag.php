<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleFlag extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'flag_id', 'distance'];
}

