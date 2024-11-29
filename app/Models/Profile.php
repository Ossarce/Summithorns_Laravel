<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
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

    // *** Relationships ***

    public function user() {
        return $this->belongsTo(User::class, 'id');
    }
}
