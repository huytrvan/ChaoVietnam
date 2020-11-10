<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function update(Request $request)
    {
        $dayRange = [
            'yesterday' => 1,
            'last 3 days' => 3,
            'last week' => 7,
            'last month' => 30,
        ];
        if (empty($request->input())) {
            $posts = Post::whereNotNull('property_id');
            $posts = $posts->latest()->paginate(10);
            $properties = $posts->map(function ($value) {
                return $value->property()->get();
            });
            $images = $posts->map(function ($value) {
                return $value->media()->get();
            });
            $neighborhoods = $posts->map(function ($value) {
                return $value->neighborhood()->get();
            });

            return view('search', [
                'posts' => $posts,
                'neighborhoods' => $neighborhoods,
                'data' => [],
                'properties' => $properties,
                'images' => $images,
            ]);
        }

        $originalData = collect($request->input())->reject(function ($value) {
            return $value === null || $value === 'any';
        });

        $data = $originalData->map(function ($value, $key) {
            if (in_array($key, ['price_min', 'price_max', 'area_min', 'area_max'])) {
                return $value = str_replace(',', '', $value);
            } else {
                return $value;
            }
        });
        $date = !empty($data['posted']) ? Carbon::now()->subDays($dayRange[$data['posted']])->toDateTimeString() : '';

        $n = $data
            ->filter(function ($value, $key) {
                return in_array($key, ["city", "district", "ward"]);
            })
            ->map(function ($value, $key) {
                return $key = $value;
            })
            ->toArray();
        $p = array_values($data->map(function ($value, $key) {
            $word = explode('_', $key);
            if (in_array($word[0], ["price", "area", "type", "bedrooms"])) {
                if (count($word) > 1 && $word[1] === "max") {
                    return [$word[0], '<=', $value];
                } else if (count($word) > 1 && $word[1] === "min") {
                    return [$word[0], '>=', $value];
                } else {
                    return [$word[0], '=', $value];
                }
            }
        })->filter(function ($value) {
            return gettype($value) === "array";
        })->toArray()
        );

        $posts =
        Post::whereHas('neighborhood', function ($query) use ($n) {
            $query->where(empty($n) ? [] : $n);
        })
            ->whereHas('property', function ($query) use ($p, $date) {
                if (empty($date)) {
                    $query->where($p);
                } else {
                    $query->where($p)->whereBetween('created_at', [$date, Carbon::now()->toDateTimeString()]);
                }
            })->paginate(10);

        $properties = $posts->map(function ($value) {
            return $value->property()->get();
        });

        $images = $posts->map(function ($value) {
            return $value->media()->get();
        });
        $neighborhoods = $posts->map(function ($value) {
            return $value->neighborhood()->get();
        });

        return view('search', [
            'posts' => $posts,
            'neighborhoods' => $neighborhoods,
            'data' => $originalData->toArray(),
            'properties' => $properties,
            'images' => $images,
        ]);
    }
}
