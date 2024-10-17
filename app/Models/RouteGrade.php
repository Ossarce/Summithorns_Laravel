<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteGrade extends Model
{
    use HasFactory;

    protected $fillable = ['route_grade'];

    // *** Relationships ***
    public function climbingRoutes() {
        return $this->hasMany(ClimbingRoute::class);
    }
}
