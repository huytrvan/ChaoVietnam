@extends('layout.base')
@section('title', 'Create New Post | ChaoVietnam.com')

@section('body')
<link rel="stylesheet" href="{{ url('css/basic.min.css') }}">
<link rel="stylesheet" href="{{ url('css/dropzone.min.css') }}">
<x-nav />
<form id="myForm" action="{{ route('post.update', ['post' => $post->id ]) }}" enctype="multipart/form-data"
    method="POST" class="mx-4">
    @csrf
    @method('DELETE')
    <x-input input="title" :value="$post->title" required />
    <x-my-textarea input="description" :value="$post->description" required />
    <div class="mt-4">
        <label for="dropzone" class="inline-block text-sm text-gray-600">Add/ remove images (minimum 4) <span
                class="text-base text-red-600">*</span></label>
        <div class="pt-4 mt-4 border-gray-100 rounded my-dropzone">
            <div id="dropzone" class="dropzone">

            </div>
            <p class="text-sm text-center text-gray-400">Click background to add images</p>
        </div>
    </div>
    <x-submit-button label="Update Post" color="green" class="my-16" />
</form>
<script src="{{ url('js/dropzone.min.js')}}"></script>
@foreach($images as $image)
<img src='{{ url("storage/img/{$post->id}/{$image->title}")}}' alt="" class="hidden" post-id="{{ $post->id }}">
@endforeach
<script>
    images = document.querySelectorAll('img.hidden');
    count = images.length;
    Dropzone.autoDiscover = false;
    const dropzone = new Dropzone("#dropzone", {
        autoProcessQueue: false,
        maxFiles: 15,
        thumbnailHeight: 250,
        parallelUpload: 15,
        uploadMultiple: true,
        url: "/media",
        withCredentials: true,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        resizeThumbnail: false,
        headers: {
            'X-CSRF-Token': document.head.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        },
    });
    images.forEach(function (value) {
        let mockFile = {
            name: value.src.split('/')[6],
            size: 12345,
        };
        dropzone.emit("addedfile", mockFile);
        dropzone.emit("thumbnail", mockFile, value.src);
        dropzone.emit("complete", mockFile);

    });

    dropzone.options.maxFiles = dropzone.options.maxFiles - count;

    dropzone.on("maxfilesexceeded", function (file) {
        this.removeFile(file);
    });

    dropzone.on("addedfile", function (file) {
        dropzone.emit('complete', file);
    });

    // dropzone.on('removedfile', function (file) {
    //     xhr = new XMLHttpRequest();
    //     xhr.open("POST", file.name + "/delete", true);
    //     xhr.setRequestHeader('X-CSRF-Token', document.head.querySelector('meta[name="csrf-token"]').content);
    //     text = "image=" + file.name;
    //     console.log(text);
    //     xhr.send(text);
    // });
</script>
@endsection