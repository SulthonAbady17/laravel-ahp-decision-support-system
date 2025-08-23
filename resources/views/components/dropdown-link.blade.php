@props(['href' => null, 'route' => null])

@php
    $url = $route ? route($route) : $href;
@endphp

<a {{ $attributes->merge(['class' => 'bg-surface-alt px-4 py-2 text-sm text-on-surface hover:bg-surface-dark-alt/5 hover:text-on-surface-strong focus-visible:bg-surface-dark-alt/10 focus-visible:text-on-surface-strong focus-visible:outline-none dark:bg-surface-dark-alt dark:text-on-surface-dark dark:hover:bg-surface-alt/5 dark:hover:text-on-surface-dark-strong dark:focus-visible:bg-surface-alt/10 dark:focus-visible:text-on-surface-dark-strong']) }}
    href="{{ $url }}" role="menuitem">
    {{ $slot }}
</a>
