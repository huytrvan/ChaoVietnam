@extends('layout.base')
@section('title', 'Affordable Home Rental in Vietnam | ChaoVietnam.com.vn')

@section('body')
<div class="flex flex-col items-center">
    <div class="pl-6 pr-4 mt-1/6 sm:mt-1/9">
        <h1 class="text-lg">Welcome to <span class="font-bold">ChaoVietnam.com.vn</span>!
        </h1>
        <p class="mt-4 text-lg">We help you find rental homes in Vietnam.</p>
    </div>
    <div class="px-4 pb-48 mt-8 mb-1 md:pb-32">
        <a href="{{ route('search') }}"
            class="flex items-center justify-center w-full py-4 pl-3 pr-5 text-green-600 bg-green-100 shadow sm:w-80">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="ml-1">Search</span>
        </a>
        @if (!Auth::check())
        <a href="{{ route('user.signin') }}"
            class="flex items-stretch justify-center w-full py-4 pl-3 pr-4 my-8 text-green-700 bg-gray-100 shadow sm:w-80">

            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                </path>
            </svg>
            <span class="ml-1">Sign in</span>
        </a>
        @else
        <a href="{{ route('post.create') }}"
            class="flex items-center justify-center w-full py-4 pl-3 pr-4 my-8 text-green-700 bg-gray-100 shadow sm:w-80">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                </path>
            </svg>
            <span class="ml-1">Create post</span>
        </a>
        @endif
    </div>
</div>
@endsection