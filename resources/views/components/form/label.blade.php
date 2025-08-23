@props(['value', 'for'])

@php
    // Cek apakah ada error validasi untuk field yang berhubungan dengan label ini
    $hasError = $errors->has($for);

    // Tentukan kelas CSS berdasarkan ada atau tidaknya error
    $labelClasses = 'flex w-fit items-center gap-1 pl-0.5 text-sm';
    $labelClasses .= $hasError ? ' text-danger' : ' text-on-surface dark:text-on-surface-dark';
@endphp

<label class="{{ $labelClasses }}" for="{{ $for }}">
    {{-- Tampilkan ikon error jika ada error --}}
    @if ($hasError)
        <svg aria-hidden="true" class="h-4 w-4" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
        </svg>
    @endif

    {{ $value ?? $slot }}
</label>
