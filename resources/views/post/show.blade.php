@extends('layout.base')
@section('title', $post->title . " | ChaoVietnam.com.vn")

@section('body')
<x-nav />
<div class="">
    <x-image-viewer :post="$post" :images="$images" />
    <hr>
    <div class="p-4 pb-6 bg-white">
        <h1 class="inline-block font-bold">{{ $post->title }}</h1>
        <div class="py-2">
            {!! $post->description !!}
        </div>
        <p class="py-2 text-sm">By
            <a href="{{ route('user.profile', ['user' => $username])}}"
                class="font-bold text-green-500">{{ $username }}</a>
            <span class="text-gray-400 ">--- {{ $property->created_at->diffForHumans()}}</span>
        </p>
    </div>
</div>
</div>
@endsection