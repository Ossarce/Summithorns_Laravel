<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name'];

    // *** Helper Methods ***

    // *** Relationships ***
    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
