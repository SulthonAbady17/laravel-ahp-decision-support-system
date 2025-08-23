@props(['disabled' => false, 'name'])

@php
    $hasError = $errors->has($name);

    $baseClasses =
        'w-full rounded-md bg-surface-alt px-2 py-2 text-sm text-gray-900 dark:text-gray-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark placeholder:text-gray-400 dark:placeholder:text-gray-500';

    $errorClasses = $hasError ? 'border border-danger' : 'border border-gray-300';

    $classes = $baseClasses . ' ' . $errorClasses;
@endphp

<div class="w-full">
    {{-- Alpine.js diinisialisasi di sini --}}
    <div class="relative" x-data="{ showPassword: false }">

        {{-- Input yang tipenya bisa berubah (text/password) --}}
        <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classes]) !!} name="{{ $name }}"
            x-bind:type="showPassword ? 'text' : 'password'">

        {{-- Tombol untuk toggle show/hide --}}
        <button aria-label="Show password"
            class="text-on-surface dark:text-on-surface-dark absolute right-2.5 top-1/2 -translate-y-1/2" type="button"
            x-on:click="showPassword = !showPassword">
            {{-- Ikon mata terbuka (hide password) --}}
            <svg aria-hidden="true" class="size-5" fill="none" stroke-width="1.5" stroke="currentColor"
                viewBox="0 0 24 24" x-show="!showPassword" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            {{-- Ikon mata tertutup (show password) --}}
            <svg aria-hidden="true" class="size-5" fill="none" stroke-width="1.5" stroke="currentColor"
                style="display: none;" viewBox="0 0 24 24" x-show="showPassword" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>

    {{-- Tampilkan pesan error di bawah input jika ada --}}
    @error($name)
        <small class="text-danger pl-0.5">{{ $message }}</small>
    @enderror
</div>
