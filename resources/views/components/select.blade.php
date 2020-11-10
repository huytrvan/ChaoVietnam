<div class="{{ $class }}">
    <label for="{{ $input }}" class="block">{{ $label }}</label>
    <select name="{{ $input }}" id="{{ $input }}" class="bg-white border border-gray-200 rounded mt-r9"
        onchange="{{ $form }}">
        @foreach ($options as $option)
        <option value="{{ $option }}" {{$option === $selected ? 'selected' : ''}}>
            {{ ($option === $upper) ? strtoupper($option) : ucwords($option) }}</option>
        @endforeach
    </select>
</div>