@props(['disabled' => false, 'name'])

@php
    $hasError = $errors->has($name);

    $baseClasses =
        'w-full appearance-none rounded-md bg-surface-alt px-4 py-2 text-sm text-gray-900 dark:text-gray-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:bg-surface-dark/50 dark:focus-visible:outline-primary-dark';

    // Tambahkan kelas border-danger jika ada error, jika tidak, gunakan border default
    $errorClasses = $hasError ? 'border border-danger' : 'border border-gray-300';

    $classes = $baseClasses . ' ' . $errorClasses;
@endphp

<div class="w-full">
    <div class="relative w-full">
        {{-- Ikon Dropdown Arrow --}}
        <svg aria-hidden="true" class="pointer-events-none absolute right-3 top-1/2 size-5 -translate-y-1/2 text-gray-500"
            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w.org/2000/svg">
            <path clip-rule="evenodd"
                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                fill-rule="evenodd" />
        </svg>

        {{-- Elemen Select --}}
        <select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classes]) !!} name="{{ $name }}">
            {{ $slot }}
        </select>
    </div>

    {{-- Tampilkan pesan error di bawah select jika ada --}}
    @error($name)
        <small class="text-danger pl-0.5">{{ $message }}</small>
    @enderror
</div>
