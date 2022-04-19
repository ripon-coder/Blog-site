<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class adminCategory extends Model
{
    use HasFactory,HasSlug;

    protected $fillable = [
        'category', 'slug'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category')
            ->saveSlugsTo('slug');
    }

    public function blog(){
        return $this->hasMany(blogModel::class,'category');
    }

}
