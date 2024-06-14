<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $guarded = [];
    
    use HasFactory;
    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
