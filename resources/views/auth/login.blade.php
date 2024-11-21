<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="align-items-center justify-content-center text-center" style="min-height: 21vh;">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('assets/img/logo_unib.png') }}" alt="" style="max-width: 100px; height: auto; display: block; margin: 0 auto;">
                <span class="d-none d-lg-block align-items-center" style="margin-top: 10px; font-weight: bold; font-size: 20px;">SIMPULS</span>
            </a>
        </div>                   

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
            <p>Belum punya akun? 
                <a href="{{ route('register') }}" style="text-decoration: none; transition: color 0.3s ease, text-decoration 0.3s ease;" onmouseover=" this.style.textDecoration='underline';" onmouseout=" this.style.textDecoration='none';">
                    Daftar disini
                </a>
            </p>            
        </div>
        
        {{-- @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/50 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white" style="font-size: 12px; margin-top: 20px;">
                Belum punya akun? Daftar disini
            </a>
        @endif --}}

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button class="ms-3" type="submit" style="padding: 8px 20px; background-color: #000000; color: white; border: none; border-radius: 4px; cursor: pointer;">
                {{ __('Log in') }}
            <button>
        </div>
    </form>
</x-guest-layout>
