@extends('layout.base')
@section('title', $post->title. '| ChaoVietnam.com.vn')

@section('body')
<div class="flex justify-between">
    <a href="{{ route('admin.indexPost') }}"
        class="flex items-center justify-start py-2 pl-2 pr-4 text-sm text-gray-400 bg-gray-50">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                clip-rule="evenodd"></path>
        </svg>
        <span>Back</span>
    </a>
    <form action="{{ route('admin.deletePost', ['post' =>$post]) }}" method="POST" class="">
        @csrf
        @method('DELETE')
        <button class="p-2 bg-white border-0 text-decoration-underline text-danger">xRemove listing</button>
    </form>
</div>

<table class="table text-black table-bordered table-sm">
    <tbody class="">
        <tr class="">
            <th scope="row">User_id</th>
            <td>{{$post->user_id}}</td>
        </tr>
        <tr>
            <th scope="row">Source</th>
            <td>Facebook</td>
        </tr>
    </tbody>
</table>
</div>
<form action="{{ route('admin.updatePost', ['post' => $post] ) }}" method="POST" class="pb-12 mx-4 ">
    @csrf
    @method('PUT')
    <div class="">
        @php
        $description = empty($post->description) ? $post->original_description : $post->description;
        $title = empty($post->title) ? $post->original_title : $post->title;
        @endphp
        <x-input input="title" :value="$title" />
        <x-my-textarea input="description" :value="$description" />
    </div>
    <div class="mt-4 border-top">
        <div class="flex mt-4 justify-content-between">
            <x-input input="city" :value="$neighborhood->city" required />
            <x-input input="district" :value="$neighborhood->district" required />
            <x-input input="ward" :value="$neighborhood->ward" required />
        </div>
        <div class="flex mt-4">
            <x-input input="price" type="number" :value="$property->price" required />
            <x-input input="type" :value="$property->type" required />
        </div>
        <div class="flex mt-4">
            <x-input input="bedrooms" type="number" :value="$property->bedrooms" required />
            <x-input input="area" type="number" :value="$property->area" required />
            <div class="flex flex-col justify-center py-4">
                <label for="fully_furnished" class="inline-block text-sm text-gray-600">
                    Fully Furnished
                    <span class="text-base text-red-600">*</span>
                </label>
                <input type="checkbox" name="fully_furnished" id="fully_furnished"
                    class="p-2 mt-4 text-center border border-green-200"
                    {{$property->furnishing === 1 ? 'checked' : '' }}>
            </div>
        </div>
        <x-my-textarea input="features" :value="$feature" required />
        <div class="block mx-2 sm:grid sm:grid-cols-4">
            @php
            $imageCount = count($images)
            @endphp
            @for ($i=$imageCount; $i--;)
            <div class="object-cover w-full h-40">
                <img src='{{ asset("storage/img/{$post->id}/{$images[$i]->title}")}}' <textarea rows="1"
                    placeholder="Caption.." name="{{$images[$i]->title}}" id="{{$images[$i]->title}}"
                    class="w-full p-r9">{{ !empty($images[$i]->alt) ? $images[$i]->alt : '' }}</textarea>
            </div>
            @endfor
        </div>
    </div>
    <x-submit-button label="Save" color="green" class="mt-32" />
</form>
@endsection