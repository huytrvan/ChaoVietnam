<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;

    public $fillable = ['city', 'district', 'ward'];
    public $timestamps = false;

    public function post()
    {
        return $this->hasMany('App\Models\Post');
    }
}
