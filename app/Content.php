<?php

namespace App;

use App\Section;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['section_id', 'order', 'content_1', 'content_2', 'content_3', 'content_4', 'content_5', 'content_6', 'image', 'image2', 'image3', 'image4'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
