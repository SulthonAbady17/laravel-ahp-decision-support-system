@props([
    'href' => null,
    'route' => null,
    'intent' => 'primary',
])

@php
    // Perbaikan ada di baris ini
    $url = $route ? route(...is_array($route) ? $route : [$route]) : $href;

    // Kelas dasar yang dimiliki semua link
    $baseClasses = 'font-medium underline-offset-2 hover:underline focus:underline focus:outline-none';

    // Mendefinisikan kelas warna untuk setiap 'intent'
    $intentClasses = [
        'primary' => 'text-primary dark:text-primary-dark',
        'danger' => 'text-danger dark:text-danger-dark',
        // ... warna lain ...
    ][$intent];

    // Menggabungkan semua kelas
    $classes = implode(' ', [$baseClasses, $intentClasses]);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} href="{{ $url }}">
    {{ $slot }}
</a>
