<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'x', 'y'];

    public function flags()
    {
        return $this->belongsToMany(Flag::class, 'people_flags')
            ->withPivot('distance');
    }
}
