<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public $fillable = ['type', 'bedrooms', 'price', 'area', 'furnishing', 'post_id'];
    public $timestamps = true;

    public function feature()
    {
        return $this->belongsToMany('App\Models\Feature', 'properties_features');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

}
