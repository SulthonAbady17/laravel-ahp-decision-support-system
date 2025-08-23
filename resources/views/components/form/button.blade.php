@props([
    'variant' => 'solid', // Opsi: 'solid', 'outline', 'ghost'
    'size' => 'md', // Opsi: sm, md, lg, xl
    'disabled' => false,
])

@php
    // Kelas dasar yang dimiliki semua tombol
    $baseClasses =
        'whitespace-nowrap rounded-radius font-medium tracking-wide transition text-center active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed';

    // Mendefinisikan semua gaya dalam satu array sederhana berdasarkan variant
    $variantStyles = [
        // Varian Solid hanya tersedia dalam warna Primary
        'solid' =>
            'bg-primary border border-primary text-on-primary hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark',

        // Varian Outline hanya tersedia dalam warna Primary
        'outline' =>
            'bg-transparent border border-primary text-primary hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:border-primary-dark dark:text-primary-dark dark:focus-visible:outline-primary-dark',

        // Varian Ghost hanya tersedia dalam warna Danger
        'ghost' =>
            'bg-transparent text-danger hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-danger dark:text-danger dark:focus-visible:outline-danger',
    ];

    // Mendefinisikan kelas untuk setiap 'size'
    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-base',
        'xl' => 'px-6 py-3 text-lg',
    ][$size];

    // Pilih kelas gaya yang sesuai berdasarkan prop 'variant'
    $styleClasses = $variantStyles[$variant] ?? $variantStyles['solid'];

    // Gabungkan semua kelas menjadi satu string
    $classes = implode(' ', [$baseClasses, $styleClasses, $sizeClasses]);
@endphp

<button {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
    {{ $slot }}
</button>
