<div class="pb-8 sm:w-80 sm:border sm:h-full sm:rounded sm:hover:shadow sm:px-0 sm:pb-4 sm:mt-4">
    @php
    $count = count($images)
    @endphp <a href="{{ route('post.show', ['slug' => $post->slug])}}" class="w-screen text-green-700">
        <div class="flex pr-4 overflow-y-scroll bg-gray-900 sm:grid sm:grid-cols-2 sm:p-0 sm:gap-0.5 py-4"
            style="scrollbar-width: none">
            @for ($i = 0; $i<$count; $i++) <img src='{{ asset("storage/img/{$post->id}/{$images[$i]->title}")}}'
                alt="{{ !empty($images[$i]->alt) ? $images[$i]->alt : '' }}"
                class="block object-cover sm:h-24 sm:w-full w-p9 {{ $i === 0 ? 'ml-4' : '' }} {{$i > 3 ? 'sm:hidden' : ''}}  shadow sm:rounded-none rounded mx-1 my-h sm:p-0 sm:m-0">
                @endfor
        </div>
    </a>
    <div class="mx-4 mt-6 sm:mt-2 sm:mx-2 sm:pb-2">
        <a href="{{ route('post.show', ['slug' => $post->slug]) }}"
            class="block text-lg font-bold text-green-600 active:underline focus:underline hover:underline">{{ $post->title }}</a>
        <div class="flex justify-between mt-2 text-sm text-green-500">
            <div class="text-gray-500">
                <p> {{ $property->price/1000000 }}M <span class="text-sm">vnđ</span> /Month</p>
                <p>{{ $property->area }}m<sup>2</sup></p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-400">{{ ucwords($neighborhood->district) }},
                    {{ ucwords($neighborhood->city) }}
                </p>
                <p class="text-sm text-gray-400">{{ $property->created_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>
</div>