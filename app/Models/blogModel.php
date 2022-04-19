<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\adminCategory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class blogModel extends Model
{
    use HasFactory,HasSlug;

    protected $fillable = [
        'slug','title','image','category','description','status'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    public function cat(){
        return $this->belongsTo(adminCategory::class,'category');
    }
}
