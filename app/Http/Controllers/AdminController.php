<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function indexPost()
    {
        // dd(Post::whereNull('property_id')->get());
        // Post::whereNull('property_id')->get()
        return view('admin.indexPost', ['posts' => Post::all()]);

    }

    public function editPost(Post $post)
    {
        if (empty($post->description)) {
            $post->original_description = str_replace("<br>", "\r\n", $post->original_description);
            $neighborhood = "";
            $property = "";
            $feature = "";

        } else {
            $post->description = str_replace("<br>", "\r\n", $post->description);
            $neighborhood = $post->neighborhood()->first();
            $property = $post->property()->first();
            $feature = implode(", ", $post->property->feature()->get()->pluck('feature')->toArray());
        }

        $images = $post->media()->get();

        return view('admin.edit', [
            'post' => $post,
            'neighborhood' => $neighborhood,
            'property' => $property,
            'feature' => $feature,
            'images' => $images,
        ]);

    }
    public function updatePost(Request $request, Post $post)
    {
        Post::updatePost($request, $post);
        return $this->indexPost();
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        app('App\Http\Controllers\MediaController')->delete($post);
        return $this->indexPost();
    }

    public function test(Request $request)
    {
        return redirect()->route('homepage');
    }
    //     // $fileName = "";
    //     // dd(Storage::file(public_path("img/{2}/")));
    //     // return view('test');
    //     // ->get('_token')
    //     // $request->session()->push('user.teams', 'developers');
    //     // $request->session()->put('product.phone', 'samsung');
    //     // $request->session()->flash('test.test', 'test2');
    //     // $session_id = $request->session()->getId();
    //     // Storage::move("img/1", "img/{$session_id}");
    //     dd(
    //         // Storage::move("img/{$session_id}", "img/1")->allFiles()
    //     // );

//     // $a = Storage::allFiles('img/2/');
    //     // $b = count($a);

//     // for ($i = 0; $i < $b; $i++) {
    //     //     $extension = explode('.', $a[$i])[1];
    //     //     Storage::move($a[$i], "img/2/{$i}-{$b}.{$extension}");
    //     // }

//     // // dd(explode(".", "hey.yo"));
    //     // dd(Storage::allFiles('img/2/'));

//     // dd(empty(Post::latest()->first()) ? 1 : Post::latest()->first()->id + 1);

//     // dd($request->all());
    // }

}
