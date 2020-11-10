<link rel="stylesheet" href="{{ url('css/viewer.min.css') }}">
<style>
    .viewer-backdrop {
        background-color: rgba(0, 0, 0, 0.95) !important;
    }
</style>
<div class="block py-4 bg-gray-900 h-1/2">
    @php
    $count = count($images);@endphp <div id="images" class="flex pr-4 overflow-y-scroll" style="scrollbar-width: none">
        @for ($i = 0; $i<$count; $i++) <img src='{{ asset("storage/img/{$post->id}/{$images[$i]->title}")}}'
            alt="{{ !empty($images[$i]->alt) ? $images[$i]->alt : '' }}"
            class="object-cover my-h w-p9 {{ $i === 0 ? 'ml-4' : '' }} shadow rounded mx-0.5">
            @endfor
    </div>
    <span class="block text-xs text-center text-gray-400 mt-r4">Tap image to expand</span>

    <script src=" {{ url('js/viewer.min.js')}}"></script>
    <script>
        const gallery = new Viewer(images, {
            backdrop: true,
            button: false,
            fullscreen: true,
            loading: false,
            loop: true,
            keyboard: true,
            movable: false,
            navbar: true,
            rotatable: false,
            scalable: false,
            slideOnTouch: true,
            title: false,
            toggleOnDblClick: false,
            toolbar: false,
            tooltip: false,
            transition: false,
            zoomable: true,
            zoomOnTouch: false,
            zoomOnWheel: false,
        });
    </script>