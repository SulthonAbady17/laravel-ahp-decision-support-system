@extends('layouts.guest')

@section('title', 'Register')

@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="flex flex-col gap-1">
            <x-form.label for="name" value="Nama" />
            <x-form.input :value="old('name')" autocomplete="name" autofocus id="name" name="name"
                placeholder="Masukkan nama lengkap" required type="text" />
        </div>

        <div class="mt-4 flex flex-col gap-1">
            <x-form.label for="email" value="Email" />
            <x-form.input :value="old('email')" autocomplete="username" id="email" name="email"
                placeholder="contoh@email.com" required type="email" />
        </div>

        <div class="mt-4 flex flex-col gap-1">
            <x-form.label for="password" value="Password" />
            <x-form.password-input autocomplete="new-password" id="password" name="password"
                placeholder="Masukkan password baru" required />
        </div>

        <div class="mt-4 flex flex-col gap-1">
            <x-form.label for="password_confirmation" value="Konfirmasi Password" />
            <x-form.password-input autocomplete="new-password" id="password_confirmation" name="password_confirmation"
                placeholder="Ketik ulang password" required />
        </div>

        <div class="mt-6 flex items-center justify-end">
            <x-form.button class="w-full justify-center">
                Register
            </x-form.button>
        </div>

        <p class="text-on-surface dark:text-on-surface-dark mt-6 text-center text-sm">
            Sudah punya akun? <x-link :route="'login'">Login di sini</x-link>
        </p>
    </form>
@endsection
