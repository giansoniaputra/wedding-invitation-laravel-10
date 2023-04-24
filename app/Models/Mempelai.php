<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mempelai extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'mempelai';
    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getCreatedAtAttribute()
    {   
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }
}
