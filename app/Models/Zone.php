<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['spot_id', 'name', 'image', 'details'];

    // *** Helper Methods ***

    public function setImage($image) {
        if($this->image) {
            $this->deleteImage();
        }
        $this->image = $image;
    }

    public function deleteImage() {
        if($this->image && Storage::disk('s3')->exists('images/spots/zones/' . $this->image)) {
            Storage::disk('s3')->delete('images/spots/zones/' . $this->image);
        }
    }

    public function delete() {
        $this->deleteImage();
        return parent::delete();
    }

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
}
