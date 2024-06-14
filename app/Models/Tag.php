<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }
}
