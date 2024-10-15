<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Spot extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'image', 'bus', 'car', 'bike', 'description'];

    // *** Helper Methods ***

    // La validación está comentada por el momento de llegar a utilizar APIs o similares se puede desconmentar
    // public static function validate($data) {
    //     return validator($data, [
    //         'name' => 'required|string|max:255',
    //         'image' => 'required|string|',
    //         'description' => 'required|string|min:50'
    //     ])->validate();
    // }

    public function setImage($image)
    {
        if($this->image) {
            $this->deleteImage();
        }
        $this->image = $image;
    }

    public function deleteImage()
    {
        if($this->image && Storage::disk('public')->exists('images/spots/' . $this->image)) {
            Storage::disk('public')->delete('images/spots/' . $this->image);
        }
    }

    public function delete()
    {
        $this->deleteImage();
        return parent::delete();
    }

    // *** Relationships ***
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function zones() {
        return $this->hasMany(Zone::class);
    }
}
