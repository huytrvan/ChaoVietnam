@extends('layout.base')
@section('title', 'Create New Post | ChaoVietnam.com')

@section('body')
<link rel="stylesheet" href="{{ url('css/basic.min.css') }}">
<link rel="stylesheet" href="{{ url('css/dropzone.min.css') }}">
<x-nav />
<form id=" myForm" action="{{ route('post.store') }}" enctype="multipart/form-data" method="POST" class="mx-4">
    @csrf
    <x-input input="title" rows="1" required />
    <x-my-textarea input="description" required />
    <div class="mt-4">
        <label for="dropzone" class="inline-block text-sm text-gray-600">Upload images (minimum 4) <span
                class="text-base text-red-600">*</span></label>
        <div class="pt-4 mt-4 border-gray-100 rounded my-dropzone">
            <div id="dropzone" class="dropzone">

            </div>
        </div>
    </div>
    <x-submit-button label="Submit" color="green" class="my-16" />
</form>
<script src="{{ url('js/dropzone.min.js')}}"></script>
<script>
    Dropzone.autoDiscover = false;
    const dropzone = new Dropzone("#dropzone", {
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
    dropzone.on("maxfilesexceeded", function (file) {
        this.removeFile(file);
    });
</script>
@endsection