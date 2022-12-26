<?php

namespace App;

use App\Image;
use App\Client;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $fillable = ['order', 'content_1', 'content_2', 'image', 'outstanding'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }    
}
