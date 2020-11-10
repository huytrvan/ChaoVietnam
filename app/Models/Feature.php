<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    public $fillable = ['feature'];
    public $timestamps = false;

    public function property()
    {
        return belongsToMany('App\Models\Property', 'properties_features');
    }
}
