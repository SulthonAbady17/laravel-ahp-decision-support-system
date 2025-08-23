@props([
    'variant' => 'solid', // Opsi: 'solid', 'outline'
    'size' => 'md', // Opsi: sm, md, lg, xl
    'href' => null,
    'route' => null,
    'disabled' => false,
])

@php
    // Tentukan URL. Prioritaskan 'route' jika ada, jika tidak, gunakan 'href'.
    $url = $route ? route($route) : $href;

    // Kelas dasar yang dimiliki semua tombol
    $baseClasses =
        'inline-block whitespace-nowrap rounded-radius font-medium tracking-wide transition text-center active:opacity-100 active:outline-offset-0';

    // Mendefinisikan semua gaya dalam satu array
    $variantStyles = [
        'solid' =>
            'bg-primary border border-primary text-on-primary hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark',
        'outline' =>
            'bg-transparent border border-primary text-primary hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:border-primary-dark dark:text-primary-dark dark:focus-visible:outline-primary-dark',
    ];

    // Mendefinisikan kelas untuk setiap 'size'
    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-base',
        'xl' => 'px-6 py-3 text-lg',
    ][$size];

    // Kelas untuk state disabled
    $disabledClasses = $disabled ? 'opacity-75 cursor-not-allowed' : '';

    // Pilih kelas gaya yang sesuai berdasarkan prop 'variant'
    $styleClasses = $variantStyles[$variant] ?? $variantStyles['solid'];

    // Gabungkan semua kelas menjadi satu string
    $classes = implode(' ', [$baseClasses, $styleClasses, $sizeClasses, $disabledClasses]);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} @if ($disabled) aria-disabled="true" @endif
    @if (!$disabled) href="{{ $url }}" @endif>
    {{ $slot }}
</a>
