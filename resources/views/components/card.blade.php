<div {{ $attributes->merge(['class' => 'bg-surface dark:bg-surface-dark-alt shadow-sm rounded-radius']) }}>
    {{-- Slot untuk Header Card --}}
    @if (isset($header))
        <div class="border-outline dark:border-outline-dark border-b px-6 py-4">
            {{ $header }}
        </div>
    @endif

    {{-- Slot untuk Konten Utama (Body) Card --}}
    <div class="text-on-surface-dark dark:text-on-surface-dark p-6">
        {{ $slot }}
    </div>

    {{-- Slot untuk Footer Card --}}
    @if (isset($footer))
        <div class="bg-surface-alt dark:bg-surface-dark border-outline dark:border-outline-dark border-t px-6 py-4">
            {{ $footer }}
        </div>
    @endif

</div>
