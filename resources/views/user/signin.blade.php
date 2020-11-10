@extends('layout.base')
@section('title', 'Sign-in | ChaoVietnam.com')

@section('body')
<div class="mt-4 mb-28 sm:flex sm:flex-col sm:items-center md:block">
    <form action="{{ route('user.signin') }}" method="POST" class="px-4 md:ml-40 sm:w-96">
        @csrf
        @if(!empty(session('message')))
        <div id="alert">
            <h6>{{ session('message') }}</h6>
        </div>
        @endif
        <x-input input="username" :value="!empty(session('username')) ? session('username') : ''" />
        <x-input input="password" type="password" />
        <x-submit-button label="Sign In" class="mt-16" color="green" />
    </form>
    <div class="pt-5 mt-5 text-center md:text-left md:ml-60">
        <span class="">Don't have an account?</span>
        <a href="{{ route('user.signup') }}" class="text-green-500">Sign-up</a>
    </div>
</div>
@endsection