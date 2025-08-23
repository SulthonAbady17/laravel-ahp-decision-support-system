@props(['name', 'options', 'label' => null, 'placeholder' => 'Please Select'])

@php
    $hasError = $errors->has($name);
    $id = $attributes->get('id', $name);
@endphp

<div class="flex w-full flex-col gap-1" x-data="combobox({ options: @js($options) })" x-init="init()"
    x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false">
    {{-- Menggunakan komponen label cerdas kita --}}
    <x-form.label :for="$id" :value="$label" />

    <div class="relative">
        <button aria-haspopup="listbox"
            class="rounded-radius bg-surface-alt text-on-surface focus-visible:outline-primary dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:text-on-surface-dark dark:focus-visible:outline-primary-dark {{ $hasError ? 'border-danger' : 'border-outline' }} inline-flex w-full items-center justify-between gap-2 whitespace-nowrap border px-4 py-2 text-sm font-medium tracking-wide transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2"
            role="combobox" type="button" x-bind:aria-expanded="isOpen || openedWithKeyboard"
            x-on:click="isOpen = !isOpen">
            <span class="text-sm font-normal"
                x-text="selectedOption ? selectedOption.label : '{{ $placeholder }}'"></span>
            <svg class="size-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd"
                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                    fill-rule="evenodd" />
            </svg>
        </button>

        <input id="{{ $id }}" name="{{ $name }}" type="hidden" value="{{ old($name) }}"
            x-ref="hiddenTextField" />

        <ul class="rounded-radius border-outline bg-surface-alt dark:border-outline-dark dark:bg-surface-dark-alt absolute left-0 top-full z-10 mt-1 flex max-h-44 w-full flex-col overflow-hidden overflow-y-auto border py-1.5"
            role="listbox" x-cloak x-on:click.outside="isOpen = false, openedWithKeyboard = false"
            x-show="isOpen || openedWithKeyboard" x-transition x-trap.noscroll="openedWithKeyboard">
            <template x-bind:key="item.value" x-for="item in options">
                <li class="combobox-option bg-surface-alt text-on-surface hover:bg-surface-dark-alt/5 hover:text-on-surface-strong dark:bg-surface-dark-alt dark:text-on-surface-dark dark:hover:bg-surface-alt/5 dark:hover:text-on-surface-dark-strong inline-flex justify-between gap-6 px-4 py-2 text-sm focus-visible:outline-none"
                    role="option" tabindex="0" x-on:click="setSelectedOption(item)"
                    x-on:keydown.enter.prevent="setSelectedOption(item)">
                    <span x-bind:class="{ 'font-bold': selectedOption?.value == item.value }"
                        x-text="item.label"></span>
                    <svg class="size-4" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"
                        x-cloak x-show="selectedOption?.value == item.value" xmlns="http://www.w3.org/2000/svg">
                        <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </li>
            </template>
        </ul>
    </div>

    @error($name)
        <small class="text-danger pl-0.5">{{ $message }}</small>
    @enderror
</div>
