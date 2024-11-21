{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'justify-content-end px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> --}}

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary font-weight-medium auth-form-btn', 'style' => 'width: 200px;']) }}>
    {{ $slot }}
</button>