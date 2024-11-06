<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'avatar',
        'is_private',
        'location',
        'bio',
        'website',
        'instagram',
        'facebook',
        'x',
    ];

    // *** Helper Methods ***

    public function setImage($image) {
        if($this->image) {
            $this->deleteImage();
        }
        $this->image = $image;
    }

    public function deleteImage() {
        if($this->image && Storage::disk('public')->exists('images/profiles/avatars/' . $this->image)) {
            Storage::disk('public')->delete('images/profiles/avatars/' . $this->image);
        }
    }

    public function delete()
    {
        $this->deleteImage();
        return parent::delete();
    }

    // *** Relationships ***

    public function user() {
        return $this->belongsTo(User::class);
    }
}
