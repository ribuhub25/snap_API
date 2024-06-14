<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->as('character_tag')->withTimestamps();
    }
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
