<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'title', 'image', 'description'];

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
