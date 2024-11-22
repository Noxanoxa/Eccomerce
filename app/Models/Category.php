<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;
    protected  $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function sluggable(): array
    {
        return [
            'slug'    => [
                'source' => 'name',
            ],
        ];
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function status()
    {
        return $this->status ==1 ? "Active": "Inactive";
    }
}
