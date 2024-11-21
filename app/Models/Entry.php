<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'title', 'image', 'description'];

    // *** Helper Methods ***

    public function setImage($image)
    {
        if($this->image) {
            $this->deleteImage();
        }

        $this->image = $image;
    }

    public function deleteImage()
    {
        if($this->image && Storage::disk('s3')->exists('images/blog/' . $this->image)) {
            Storage::disk('s3')->delete('images/blog/' . $this->image);
        }
    }

    public function delete()
    {
        $this->deleteImage();
        return parent::delete();
    }

    // *** Relationships ***
    public function entryCategory()
    {
        return $this->belongsTo(EntryCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
