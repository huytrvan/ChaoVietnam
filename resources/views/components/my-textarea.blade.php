<div class="py-4">
    <label for="{{ $input }}" class="inline-block text-sm text-gray-600">
        {{ $label }}
        @if ($required === true)
        <span class="text-base text-red-600">*</span>
        @endif
    </label>
    <textarea name="{{ $input }}" id="{{ $input }}"
        class="w-full p-2 mt-4 border border-green-200 rounded appearance-none"
        {{ ($required === true) ? 'required' : '' }} rows="{{$rows}}">{!! $value !!}</textarea>
</div>