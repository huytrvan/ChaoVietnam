@extends('layout.base')
@section('title', 'Search | ChaoVietnam.com.vn')

@section('body')
@php
$data = !empty($data) ? $data : [];
@endphp
<x-nav :url="route('homepage')" />
<div class="sm:flex">
    <form action="{{ route('search') }}"
        class="pt-1 mx-4 sm:pt-0 sm:rounded sm:pr-8 sm:w-80 sm:mr-12 sm:border-r sm:border-green-200">
        <div class="flex justify-between mt-4">
            @php
            $cities = ['da nang'];
            $districts = ['any', 'cam le', 'hai chau', 'lien chieu', 'ngu hanh son', 'son tra', 'thanh khe'];
            @endphp
            <x-select input="city" :options="$cities" :selected="$cities[0]" upper="hcmc" />
            <x-select input="district" :options="$districts" />
        </div>
        @php
        $priceMin = in_array('price_min', array_keys($data)) ? $data['price_min'] : '';
        $priceMax = in_array('price_max', array_keys($data)) ? $data['price_max'] : '';
        $areaMin = in_array('area_min', array_keys($data)) ? $data['area_min'] : '';
        $areaMax = in_array('area_max', array_keys($data)) ? $data['area_max'] : '';
        @endphp
        <x-range-input label="Price (VND)" input="price" class="mt-8" :min="$priceMin" :max="$priceMax" />
        <x-range-input label="Area (m2)" input="area" class="mt-8" :min="$areaMin" :max="$areaMax" />
        <div class="flex justify-between mt-8 sm:grid sm:grid-cols-2">
            @php
            $types = ['any','family', 'villa', 'apartment', 'studio'];
            $bedrooms = ['any','1', '2', '3', '3+'];
            $dates = ['any','yesterday', 'last 3 days' ,'last week', 'last month'];
            $bedroomsSelected = in_array('bedrooms', array_keys($data)) ? $data['bedrooms'] : '';
            $typesSelected = in_array('types', array_keys($data)) ? $data['types'] : '';
            $postedSelected = in_array('posted', array_keys($data)) ? $data['posted'] : '';
            @endphp
            <x-select input="type" label="Property Type" :options="$types" :selected="$typesSelected" />
            <x-select input="bedrooms" :options="$bedrooms" :selected="$bedroomsSelected" />
            <x-select input="posted" :options="$dates" :selected="$postedSelected" class="sm:mt-8" />
        </div>
        <button class="flex items-center justify-center w-full mt-12 mb-8 text-white bg-green-700 rounded-full py-r8">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="ml-r4">Search</span>
        </button>
    </form>
    <div class="">
        <hr class="sm:hidden">
        <form action="{{ route('search') }}" id="sortForm" class="pt-4 pb-4 mx-4 sm:m-0 sm:pt-1.5">
            @php
            $sort = ['most recent', 'lowest price', 'highest price', 'most area']
            @endphp
            <x-select form=" sortForm" input="sort" :options="$sort" label="Sort By"
                class="flex items-baseline justify-between text-gray-500 w-96 sm:w-48" />
        </form>
        @php
        $count = count($posts);
        @endphp
        @if ($posts[0] === null)
        <div class="pb-40 mt-4">
            <p class="">No result found. Try different search or
                <a href="{{ route('post.create') }}" class="text-green-400"> create new post</a>
            </p>
        </div>
        @else
        <div class="pb-20 mt-2 md:grid md:grid-cols-2 md:gap-12">
            @for ($i=0; $i
            <$count; $i++) <x-post :post="$posts[$i]" :images="$images[$i]" :property="$properties[$i]"
                :neighborhood="$neighborhoods[$i]" />
            @endfor
        </div>
        @endif
    </div>
</div>
@endsection