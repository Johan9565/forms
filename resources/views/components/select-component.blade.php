@props([
    'id',
    'name',
    'model' => null,
    'placeholder' => 'Seleccione una opción',
    'options' => [],
    'selected' => null,
    'required' => false,
    'disabled' => false,
    'class' => '',
])

<div wire:ignore x-data x-init="$nextTick(() => {
    if (typeof window.initializeSelect2Simple === 'function') {
        window.initializeSelect2Simple('#{{ $id }}');
    } else {
        // Wait for the function to be available
        const checkFunction = setInterval(() => {
            if (typeof window.initializeSelect2Simple === 'function') {
                window.initializeSelect2Simple('#{{ $id }}');
                clearInterval(checkFunction);
            }
        }, 100);
    }
})">
    <select id="{{ $id }}" name="{{ $name }}"
        @if ($model) data-model="{{ $model }}" @endif data-placeholder="{{ $placeholder }}"
        class="select2-simple input input-sm input-bordered {{ $class }}" {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}>
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $option)
            <option value="{{ $option['value'] }}" {{ $selected == $option['value'] ? 'selected' : '' }}>
                {{ $option['text'] }}
            </option>
        @endforeach
    </select>
</div>
