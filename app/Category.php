<?php

namespace App;

use App\Image;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['order', 'name', 'description', 'image', 'has_subcategory'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
