@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    @if ($errors->any())
        <div class="mb-4">
            <x-alert intent="danger" title="Error">
                {{ $errors->first() }}
            </x-alert>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="flex flex-col gap-1">
            <x-form.label for="email" value="Email" />
            <x-form.input :value="old('email')" autocomplete="username" autofocus id="email" name="email"
                placeholder="contoh@email.com" required type="email" />
        </div>

        <div class="mt-4 flex flex-col gap-1">
            <x-form.label for="password" value="Password" />
            <x-form.password-input autocomplete="current-password" id="password" name="password"
                placeholder="Masukkan password" required />
        </div>

        <div class="mt-4 flex items-center justify-between">
            <x-form.checkbox id="remember_me" labelPosition="right" label="Ingat saya" name="remember" />

            @if (Route::has('password.request'))
                <x-link :route="'password.request'">
                    Lupa password?
                </x-link>
            @endif
        </div>

        <div class="mt-6 flex items-center justify-end">
            <x-form.button class="w-full justify-center">
                Log In
            </x-form.button>
        </div>

        <p class="text-on-surface dark:text-on-surface-dark mt-6 text-center text-sm">
            Belum punya akun?
            <x-link :route="'register'">
                Daftar di sini
            </x-link>
        </p>
    </form>
@endsection
