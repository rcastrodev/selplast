<?php

namespace App;

use App\Industry;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['order', 'content_1', 'image', 'outstanding'];

    public function industries()
    {
        return $this->belongsToMany(Industry::class);
    }
}
