<div class="{{ $class }}">
    <span>{{ $label }}</span>
    <div class="flex w-full mt-r9">
        <input type=text" name="{{ $input }}_min" id="{{ $input }}_min" min="0" step="1"
            placeholder="{{ ($min ==='')? 'Min' : '' }}" value="{{ !($min === '') ? $min : '' }}"
            oninput="toLocale(this)" class="w-1/2 p-2 border border-gray-200 rounded appearance-none">
        <span class="px-1 pt-2 text-green-200">-</span>
        <input type="text" name="{{ $input }}_max" id="{{ $input }}_max" min="0" step="1"
            placeholder="{{ ($max === '') ? 'Max' : '' }}" value="{{ !($max === '') ? $max : '' }}"
            oninput="toLocale(this)" class="w-1/2 p-2 border border-gray-200 rounded appearance-none">
    </div>
</div>