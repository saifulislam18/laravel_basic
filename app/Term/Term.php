<?php

namespace App\Term;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Term extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','type','name'];
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\Admin');
    }


}
