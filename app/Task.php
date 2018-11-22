<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Task extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable = [
        'title',
        'description'
    ];

    /**
     * Spatie media library collections
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('image')->singleFile();
    }
}
