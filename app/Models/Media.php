<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    public $fillable = ['title', 'post_id', 'alt'];

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
}
