<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['spot_id', 'name', 'image', 'details'];

    // *** Relationships ***

    public function spot() {
        return $this->belongsTo(Spot::class);
    }

    public function boulders() {
        return $this->hasMany(Boulder::class);
    }

    public function climbingRoutes() {
        return $this->hasMany(ClimbingRoute::class);
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
