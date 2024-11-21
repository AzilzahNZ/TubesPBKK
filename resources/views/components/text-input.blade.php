@props(['disabled' => false])

<div class="col mb-3">
    <input @disabled($disabled) {{ $attributes->merge(['class' => 'form-control']) }}>
    {{-- <input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}> --}}
</div>
