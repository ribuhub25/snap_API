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
    public function scopeSearch($query, $params)
    {
        $query
            ->when($params['name'] ?? false, function ($query, $name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            })
            ->when($params['cost'] ?? false, function ($query, $cost) {
                $query->where('cost', $cost);
            })
            ->when($params['power'] ?? false, function ($query, $power) {
                $query->where('power', $power);
            })
            ->when($params['serie'] ?? false, function ($query, $serie) {
                $query->where('source_slug', 'LIKE', '%' . $serie .'%');
            })
            ->when($params['power_order'] ?? false, function ($query, $power_order) {
                $query->orderBy('power', $power_order);
            })
            ->when($params['status'] ?? false, function ($query, $status) {
                $query->where('status', 'LIKE', $status);
            });
    }
}
