@props([
    'intent' => 'draft', // Opsi: active, completed, draft
])

@php
    // Kelas dasar yang dimiliki semua status
    $baseClasses = 'inline-flex overflow-hidden rounded-radius px-2 py-0.5 text-xs font-medium';

    // Mendefinisikan gaya untuk setiap 'intent'
    $intentStyles = [
        'active' => 'border-info text-info bg-info/10',
        'completed' => 'border-success text-success bg-success/10',
        'draft' => 'border-warning text-warning bg-warning/10',
        'danger' => 'border-danger text-danger bg-danger/10', // <-- TAMBAHKAN INI
    ];

    // Pilih kelas gaya yang sesuai, dengan 'draft' sebagai default
    $styleClasses = $intentStyles[$intent] ?? $intentStyles['draft'];

    // Gabungkan semua kelas
    $classes = implode(' ', [$baseClasses, $styleClasses]);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
