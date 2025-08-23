@props(['align' => 'left', 'width' => '48'])

@php
    $alignmentClasses = $align === 'right' ? 'right-0' : 'left-0';
    $widthClasses =
        [
            '48' => 'w-48',
            '56' => 'w-56',
            '64' => 'w-64',
        ][$width] ?? 'w-fit min-w-48';
@endphp

<div class="relative w-fit" x-data="{ isOpen: false, openedWithKeyboard: false, leaveTimeout: null }" x-on:click.outside="isOpen = false; openedWithKeyboard = false"
    x-on:keydown.esc.prevent="isOpen = false; openedWithKeyboard = false"
    x-on:mouseenter="leaveTimeout ? clearTimeout(leaveTimeout) : true"
    x-on:mouseleave.prevent="leaveTimeout = setTimeout(() => { isOpen = false }, 250)">
    <!-- Toggle Button -->
    <div x-on:click="isOpen = !isOpen" x-on:keydown.down.prevent="isOpen = true; openedWithKeyboard = true"
        x-on:keydown.enter.prevent="isOpen = !isOpen; openedWithKeyboard = true"
        x-on:keydown.space.prevent="isOpen = !isOpen; openedWithKeyboard = true" x-on:mouseover="isOpen = true">
        {{ $trigger }}
    </div>

    <!-- Dropdown Menu -->
    <div class="rounded-radius border-outline bg-surface-alt dark:border-outline-dark dark:bg-surface-dark-alt {{ $alignmentClasses }} {{ $widthClasses }} absolute top-full mt-2 flex flex-col overflow-hidden border py-1.5"
        role="menu" x-cloak x-on:keydown.down.prevent="$focus.wrap().next()"
        x-on:keydown.up.prevent="$focus.wrap().previous()" x-show="isOpen || openedWithKeyboard" x-transition
        x-trap.noscroll="openedWithKeyboard">
        {{ $content }}
    </div>
</div>
