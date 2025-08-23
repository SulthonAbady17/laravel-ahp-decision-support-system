@props(['maxWidth' => '7xl'])

@php
    // Mendefinisikan kelas-kelas lebar maksimum yang tersedia
    $maxWidthClass = [
        '4xl' => 'max-w-4xl',
        '5xl' => 'max-w-5xl',
        '6xl' => 'max-w-6xl',
        '7xl' => 'max-w-7xl',
    ][$maxWidth];
@endphp

<div {{ $attributes->merge(['class' => 'py-12']) }}>
    <div class="{{ $maxWidthClass }} mx-auto sm:px-6 lg:px-8">
        {{ $slot }}
    </div>
</div>
