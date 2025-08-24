@props([
    'intent' => 'info', // Opsi: info, success, warning, danger
    'title' => null,
    'showIcon' => true,
    'dismissible' => true,
])

@php
    // Pusat data untuk setiap variasi 'intent'
    $intentData = [
        'info' => [
            'border' => 'border-info',
            'bg' => 'bg-info/10',
            'iconWrapper' => 'bg-info/15 text-info',
            'titleText' => 'text-info',
            'svgPath' =>
                'M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z',
        ],
        'success' => [
            'border' => 'border-success',
            'bg' => 'bg-success/10',
            'iconWrapper' => 'bg-success/15 text-success',
            'titleText' => 'text-success',
            'svgPath' =>
                'M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z',
        ],
        'warning' => [
            'border' => 'border-warning',
            'bg' => 'bg-warning/10',
            'iconWrapper' => 'bg-warning/15 text-warning',
            'titleText' => 'text-warning',
            'svgPath' =>
                'M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z',
        ],
        'danger' => [
            'border' => 'border-danger',
            'bg' => 'bg-danger/10',
            'iconWrapper' => 'bg-danger/15 text-danger',
            'titleText' => 'text-danger',
            'svgPath' =>
                'M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z',
        ],
    ];

    // Pilih data intent yang sesuai
    $currentIntent = $intentData[$intent];
@endphp

<div @if ($dismissible) x-data="{ alertIsVisible: true }"
        x-show="alertIsVisible"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90" @endif
    class="bg-surface text-on-surface dark:bg-surface-dark dark:text-on-surface-dark {{ $currentIntent['border'] }} relative mb-4 w-full overflow-hidden rounded-md border"
    role="alert">
    <div class="{{ $currentIntent['bg'] }} flex w-full items-start gap-2 p-4">

        {{-- Ikon --}}
        @if ($showIcon)
            <div aria-hidden="true" class="{{ $currentIntent['iconWrapper'] }} flex-shrink-0 rounded-full p-1">
                <svg aria-hidden="true" class="size-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="{{ $currentIntent['svgPath'] }}" fill-rule="evenodd" />
                </svg>
            </div>
        @endif

        {{-- Konten Teks --}}
        <div class="flex-grow">
            @if ($title)
                <h3 class="{{ $currentIntent['titleText'] }} text-sm font-semibold">{{ $title }}</h3>
            @endif
            <div class="text-xs font-medium sm:text-sm">
                {{ $slot }}
            </div>
        </div>

        {{-- Tombol Close --}}
        @if ($dismissible)
            <button @click="alertIsVisible = false" aria-label="dismiss alert" class="ml-auto flex-shrink-0"
                type="button">
                <svg aria-hidden="true" class="h-4 w-4 shrink-0" fill="none" stroke-width="2.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        @endif
    </div>
</div>
