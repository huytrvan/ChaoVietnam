@extends('layout.base')
@section('title')

@section('body')
<div class="sm:mb-40">
    <x-notify message="success" />
    <div class="flex justify-between p-4 md:w-80">
        <div class="">
            <h1 class="text-lg font-bold">Posts By: {{ $user->username }}</h1>
            <p class="text-sm text-gray-400">Joined {{ $user->created_at->diffForHumans() }}</p>
        </div>
        @if (Auth::user()->username === $user->username)
        <a href="{{ route('user.editProfile', ['username' => $user->username]) }}"
            class="mt-0.5 mr-1 text-green-500">Edit profile</a>
        @endif
    </div>
    @if (empty($properties[0][0]))
    <div class="text-center py-36">
        <p>No posts available</p>
    </div>
    @else
    <div class="flex flex-col items-center justify-center md:grid md:grid-cols-2 md:gap-4 lg:grid-cols-3">
        @php
        $count = count($properties);
        @endphp
        @for ($i=0; $i
        <2; $i++) <x-post :post="$posts[$i]" :images="$images[$i]" :property="$properties[$i]"
            :neighborhood="$neighborhoods[$i]" />
        @endfor
    </div>
    @endif
</div>
@endsection