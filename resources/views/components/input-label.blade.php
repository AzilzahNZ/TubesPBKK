@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700', 'style' => 'font-weight:bold']) }}>
    {{ $value ?? $slot }}
</label>
