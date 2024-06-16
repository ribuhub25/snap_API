<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
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

    // public function scopeFilter(Builder $query, Request $request)
    // {

    //     return $query->when($request->name,function($query) use ($request){
    //         return $query->where('name','like','%'.$request->name.'%');
    //     })->when($request->has('cost'), function ($query) use ($request) {
    //         return $query->where('cost', '=',5);
    //     });
    // }
}
