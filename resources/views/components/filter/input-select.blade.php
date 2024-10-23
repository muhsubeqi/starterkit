@props([
    'name' => '',
    'label' => "",
    'options' => [],
])
<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="filter mb-2">{{ $label }}</label>
    @endif
    <select {{ $attributes->class(['filter form-select js-select2']) }} id="{{ $name }}" name="{{ $name }}"
            style="width: 100%;">
        @foreach($options as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
</div>
