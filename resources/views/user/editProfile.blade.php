@extends('layout.base')
@section('title', 'Edit Profile | ChaoVietnam.com.vn')

@section('body')
<x-nav :url="route('user.profile', ['username' => $user->username ]) " />
<div class="relative w-full">
    <div
        class="flex justify-center px-4 mt-2 md:absolute md:w-36 xl:w-40 md:justify-start md:flex-col sm:top-0 md:pt-4">
        <a href="{{ route('user.editProfile', ['username' => $user->username ])}}"
            class="px-10 py-1 text-green-100 bg-green-600 md:px-2">Edit
            Profile</a>
        <a href="{{ route('user.editPassword', ['username' => $user->username ])}}"
            class="px-10 py-1 text-green-600 border border-green-200 md:mt-2 md:px-2">Edit
            Password</a>
    </div>
    <div class="mt-6 md:mt-0 mb-52 md:pb-2 md:mb-56 sm:flex sm:flex-col sm:items-center">
        <h1 class="hidden mb-4 text-sm font-bold text-center md:block">
            Edit Profile
        </h1>
        <form action="{{ route('user.updateProfile', ['user' => $user->id ]) }}" class="px-4 sm:w-96" method="POST">
            @csrf
            @method('PUT')
            <x-message :message="$message" :type="$type" />
            <x-input input="username" :value="$user->username ?? session('user') " />
            <x-submit-button label="Apply Changes" class="mt-16" color="green" />
        </form>
    </div>
</div>
@endsection