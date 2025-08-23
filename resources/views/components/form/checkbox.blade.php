@props([
    'id',
    'name',
    'label' => '',
    'size' => 'md',
    'labelPosition' => 'right', // Opsi: 'left' atau 'right'
    'disabled' => false,
])

@php
    // Logika untuk menentukan ukuran (tetap sama)
    $sizeClasses = [
        'sm' => ['label' => 'text-xs', 'input' => 'size-3', 'svg' => 'size-2'],
        'md' => ['label' => 'text-sm', 'input' => 'size-4', 'svg' => 'size-3'],
        'lg' => ['label' => 'text-base', 'input' => 'size-5', 'svg' => 'size-4'],
        'xl' => ['label' => 'text-lg', 'input' => 'size-6', 'svg' => 'size-5'],
    ][$size];

    // Kelas dasar untuk elemen <label> (tetap sama)
    $labelBaseClasses =
        'flex items-center gap-2 font-medium text-on-surface dark:text-on-surface-dark has-checked:text-on-surface-strong dark:has-checked:text-on-surface-dark-strong';
    $labelStateClasses = $disabled ? 'has-disabled:cursor-not-allowed has-disabled:opacity-75' : '';
    $labelFinalClasses = implode(' ', [$labelBaseClasses, $sizeClasses['label'], $labelStateClasses]);

    // Kelas untuk elemen <input> dan <svg> (tetap sama)
    $inputClasses =
        "before:content[''] peer relative appearance-none overflow-hidden rounded-sm border border-outline bg-surface-alt before:absolute before:inset-0 checked:border-primary checked:before:bg-primary focus:outline-2 focus:outline-offset-2 focus:outline-outline-strong checked:focus:outline-primary active:outline-offset-0 disabled:cursor-not-allowed dark:border-outline-dark dark:bg-surface-dark-alt dark:checked:border-primary-dark dark:checked:before:bg-primary-dark dark:focus:outline-outline-dark-strong dark:checked:focus:outline-primary-dark " .
        $sizeClasses['input'];
    $svgClasses =
        'pointer-events-none invisible absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-on-primary peer-checked:visible dark:text-on-primary-dark ' .
        $sizeClasses['svg'];
@endphp

{{-- STRUKTUR YANG DIPERBAIKI --}}
<label class="{{ $labelFinalClasses }}" for="{{ $id }}">

    {{-- Tampilkan label teks di KIRI jika labelPosition adalah 'left' --}}
    @if ($labelPosition === 'left')
        <span>{{ $label }}</span>
    @endif

    {{-- Elemen Checkbox --}}
    <span class="relative flex items-center">
        <input {{ $attributes }} {{ $disabled ? 'disabled' : '' }} class="{{ $inputClasses }}" id="{{ $id }}"
            name="{{ $name }}" type="checkbox" />
        <svg aria-hidden="true" class="{{ $svgClasses }}" fill="none" stroke-width="4" stroke="currentColor"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.5 12.75l6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </span>

    {{-- Tampilkan label teks di KANAN jika labelPosition adalah 'right' --}}
    @if ($labelPosition === 'right')
        <span>{{ $label }}</span>
    @endif

</label>
