<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;
    public $fillable = ['slug', 'original_title', 'original_description', 'title', 'description', 'neighborhood_id', 'property_id', 'user_id'];

    public function property()
    {
        return $this->belongsTo('App\Models\Property');
    }

    public function neighborhood()
    {
        return $this->belongsTo('App\Models\Neighborhood');
    }

    public function feature()
    {
        return $this->hasManyThrough('App\Models\Property', 'App\Models\Feature');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function media()
    {
        return $this->hasMany('App\Models\Media');
    }

    public static function updatePost($request, $post)
    {
        $data = collect($request->except('_token', '_method'));

        $neighborhoodId = Neighborhood::firstOrCreate([
            'city' => $data['city'],
            'district' => $data['district'],
            'ward' => $data['ward'],
        ])->id;

        $featureId = Str::of($data['features'])
            ->replace("\r\n", "")
            ->explode(",")
            ->filter(function ($value) {
                return $value !== "";
            })->map(function ($value) {
            $value = ltrim($value);
            return Feature::firstOrCreate([
                'feature' => $value,
            ])->id;
        });

        $property = Property::firstOrCreate([
            'price' => ((int) $data['price']),
            'type' => Str::lower($data['type']),
            'bedrooms' => ((int) $data['bedrooms']),
            'area' => ((int) $data['area']),
            'furnishing' => $data->contains(function ($value, $key) {
                return $key === "fullyFurnished";
            }),
            'post_id' => ((int) $post->id),
        ]);

        $property->feature()->syncWithoutDetaching($featureId);

        $post->update([
            'slug' => Str::of($data['title'])->words(5)->slug('-'),
            'title' => $data['title'],
            'description' => Str::of($data['description'])->replace("\r\n", "<br>"),
            'neighborhood_id' => ((int) $neighborhoodId),
            'property_id' => ((int) $property->id),
        ]);
    }

    public function search()
    {
        $posts = Post::latest()->simplePaginate(10);
        $images = $posts->map(function ($value) {
            return Media::where('post_id', $value->id)->get();
        });
        $properties = $posts->map(function ($value) {
            return Property::where('post_id', $value->id)->get();
        });

        return view('search', [
            'posts' => $posts,
            'data' => [],
            'images' => $images,
            'properties' => $properties,
        ]);

    }
}
