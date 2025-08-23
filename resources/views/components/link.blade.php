@props([
    'href' => null,
    'route' => null,
    'intent' => 'primary',
])

@php
    // Tentukan URL. Prioritaskan 'route' jika ada, jika tidak, gunakan 'href'.
    $url = $route ? route($route) : $href;

    // Kelas dasar yang dimiliki semua link
    $baseClasses = 'font-medium underline-offset-2 hover:underline focus:underline focus:outline-none';

    // Mendefinisikan kelas warna untuk setiap 'intent'
    $intentClasses = [
        'primary' => 'text-primary dark:text-primary-dark',
        'secondary' => 'text-secondary dark:text-secondary-dark',
        'danger' => 'text-danger dark:text-danger-dark',
        // ... warna lain ...
    ][$intent];

    // Menggabungkan semua kelas
    $classes = implode(' ', [$baseClasses, $intentClasses]);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} href="{{ $url }}">
    {{ $slot }}
</a>
