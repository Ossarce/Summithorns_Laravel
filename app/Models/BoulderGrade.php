<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoulderGrade extends Model
{
    use HasFactory;

    protected $fillable = ['boulder_grade'];

    // *** Relationships ***
    public function boulders() {
        return $this->hasMany(Boulder::class);
    }
}
