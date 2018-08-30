<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use SoftDeletes,HasSlug;

    protected $fillable=['user_id','title','content','excerpt','category','tag','status','featured'];


    public function user(){
        return $this->belongsTo('App\Admin');
    }
    public function seos(){
        return $this->hasOne('App\Model\Seo');
    }
    public function files(){
        return $this->hasMany('App\Model\File');
    }
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }
}
