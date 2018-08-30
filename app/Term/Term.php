<?php

namespace App\Term;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Term extends Model
{
    use SoftDeletes,HasSlug;

    protected $fillable=['user_id','type','name'];
    protected $dates = ['deleted_at'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['type', 'name'])
            ->saveSlugsTo('slug')
            ->usingSeparator('/');
    }

    public function user(){
        return $this->belongsTo('App\Admin');
    }


}
