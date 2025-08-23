@props(['disabled' => false, 'name'])

@php
    $hasError = $errors->has($name);

    $baseClasses =
        'w-full rounded-md bg-surface-alt px-2 py-2 text-sm text-gray-900 dark:text-gray-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:bg-surface-dark/50 dark:focus-visible:outline-primary-dark placeholder:text-gray-400 dark:placeholder:text-gray-500';

    $errorClasses = $hasError ? 'border border-danger' : 'border border-gray-300';

    $classes = $baseClasses . ' ' . $errorClasses;
@endphp

<div class="w-full">
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classes]) !!} name="{{ $name }}">

    {{-- Tampilkan pesan error di bawah input jika ada --}}
    @error($name)
        <small class="text-danger pl-0.5">{{ $message }}</small>
    @enderror
</div>
