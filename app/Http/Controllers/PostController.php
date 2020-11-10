<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Media;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $postId = Post::firstOrcreate([
            'slug' => Str::of($request['title'])->words(5)->slug('-'),
            'original_title' => Str::title($request['title']),
            'original_description' => Str::of($request['description'])->replace("\r\n", "<br>"),
            'user_id' => Auth::id(),
        ])->id;

        app('App\Http\Controllers\MediaController')->create($postId, $request);

        return redirect()->route('user.profile', ['user' => Auth::user()->username])->with('success', "Your post will be reviewed by our admins <br> We will notify you when it is accepted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $post = Post::where('slug', $slug)->first();
        $property = $post->property()->first();
        $images = $post->media()->get();

        return view('post.show', [
            'post' => $post,
            'property' => $property,
            'images' => $images,
            'username' => $post->user()->first()->username,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $post->description = Str::of($post->description)->replace("<br>", "\r\n");
        $images = $post->media()->get();
        return view('post.edit', [
            'post' => $post,
            'images' => $images,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        dd($request);
        Post::where(id, $post->id)->update([
            'title' => $post->title,
            'description' => $post->description,
            'original_title' => $post->title,
            'original_description' => $post->description,
        ]);
        return redirect()->route('user.profile', ['user' => Auth::user()->username])->with('success', "Your post has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $post)
    {
        //

    }

}
