@extends('layout.base')
@section('title', 'Index Post | ChaoVietnam.com.vn')

@section('body')
<div class="">
    <x-nav :url="route('search')" />
    <table class="table w-screen text-center bg-white border table-hover table-sm">
        <thead class="">
            <tr class="">
                <th scope="col">#</th>
                <th scope="col">Title</th>
            </tr>
        </thead>
        <tbody class="border">
            @foreach ($posts as $post)
            <tr class="{{ $post->id === 1 ? 'table-active' : '' }}">
                <td>{{ $post->id }}</td>
                <td class="p-4">
                    <a href="{{ route('admin.editPost',['post' => $post]) }}"
                        class="font-bold text-green-500">{{ empty($post->title) ? $post->original_title : $post->title  }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection