@extends('layout.base')
@section('title', 'Sign-up | ChaoVietnam.com.vn')

@section('body')
<x-nav url="route('user.signin')" />
<div class="sm:flex sm:flex-col sm:items-center md:block" style="padding-bottom:3.5rem;">
    <form action="{{ route('user.signup') }}" method="POST" class="px-4 md:ml-40 sm:w-96">
        @csrf
        @if(!empty(session('message')))
        <div class="alert alert-warning">
            <h6>{{ session('message') }}</h6>
        </div>
        @endif
        <x-input input="username" :value="!empty(session('username')) ? session('username') : ''" required />
        <x-input input="password" type="password" required />
        <x-input input="repeat password" type="password" required />
        <x-submit-button label="Sign Up" class="mt-12" color="green" />
    </form>
</div>
@endsection