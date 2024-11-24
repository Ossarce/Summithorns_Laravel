<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Boulder extends Model
{
    use HasFactory;

    protected $fillable = ['zone_id', 'name', 'image', 'grade_id', 'setter_id', 'details', 'line'];

    // *** Helper Methods ***

    public function getGradeName() {
        return $this->grade ? $this->grade->boulder_grade : 'Sin Grado';
    }

    public function getSetterName() {
        return $this->setter ? $this->setter->username : 'Desconocido';
    }

    public function setImage($image) {
        if($this->image) {
            $this->deleteImage();
        }
        $this->image = $image;
    }

    public function deleteImage() {
        if($this->image && Storage::disk('s3')->exists('images/spots/zones/boulders/' . $this->image)) {
            Storage::disk('s3')->delete('images/spots/zones/boulders/' . $this->image);
        }
    }

    public function delete() {
        $this->deleteImage();
        return parent::delete();
    }

    // *** Relationships ***

    public function zone() {
        return $this->belongsTo(Zone::class);
    }

    public function grade() {
        return $this->belongsTo(BoulderGrade::class, 'grade_id');
    }

    public function setter() {
        return $this->belongsTo(User::class, 'setter_id');
    }
}
