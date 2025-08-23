@props(['name', 'label' => null, 'value' => null])

@php
    $hasError = $errors->has($name);
    $id = $attributes->get('id', $name);
@endphp

<div class="flex w-full flex-col gap-1" x-data="datepicker({ initialValue: @js($value) })">
    <x-form.label :for="$id" :value="$label" />

    <div class="relative">
        {{-- Input tersembunyi untuk mengirim data ke backend (format YYYY-MM-DD) --}}
        <input name="{{ $name }}" type="hidden" x-model="datePickerValue">

        {{-- Input yang dilihat pengguna --}}
        <input @click="datePickerOpen = !datePickerOpen" {{-- Tampilkan format tanggal yang mudah dibaca --}}
            class="rounded-radius bg-surface-alt text-on-surface focus-visible:outline-primary dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:text-on-surface-dark dark:focus-visible:outline-primary-dark {{ $hasError ? 'border-danger' : 'border-outline' }} w-full border px-4 py-2 text-sm transition focus-visible:outline-2 focus-visible:outline-offset-2"
            placeholder="Pilih tanggal" readonly type="text"
            x-bind:value="datePickerValue ? formatDateForDisplay(new Date(Date.parse(datePickerValue))) : ''"
            x-on:keydown.escape="datePickerOpen = false">

        {{-- Ikon Kalender --}}
        <div @click="datePickerOpen = !datePickerOpen"
            class="text-on-surface/70 absolute right-0 top-0 cursor-pointer px-3 py-2">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
        </div>

        {{-- Panel Datepicker --}}
        <div @click.away="datePickerOpen = false"
            class="bg-surface rounded-radius border-outline dark:bg-surface-dark dark:border-outline-dark absolute left-0 top-full z-10 mt-2 w-full border-2 p-4 shadow-lg"
            x-show="datePickerOpen" x-transition>
            {{-- Header Navigasi Bulan & Tahun --}}
            <div class="mb-2 flex items-center justify-between">
                <div>
                    <span class="text-on-surface-strong dark:text-on-surface-dark-strong text-lg font-bold"
                        x-text="datePickerMonthNames[datePickerMonth]"></span>
                    <span class="text-on-surface dark:text-on-surface-dark ml-1 text-lg font-normal"
                        x-text="datePickerYear"></span>
                </div>
                <div>
                    <button @click.prevent="datePickerPreviousMonth()"
                        class="hover:bg-surface-alt dark:hover:bg-surface-dark-alt rounded-full p-1 transition duration-100 ease-in-out"
                        type="button">
                        <svg class="text-on-surface/70 h-6 w-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </button>
                    <button @click.prevent="datePickerNextMonth()"
                        class="hover:bg-surface-alt dark:hover:bg-surface-dark-alt rounded-full p-1 transition duration-100 ease-in-out"
                        type="button">
                        <svg class="text-on-surface/70 h-6 w-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Nama Hari --}}
            <div class="mb-3 grid grid-cols-7">
                <template :key="index" x-for="(day, index) in datePickerDays">
                    <div class="px-0.5">
                        <div class="text-on-surface/70 dark:text-on-surface-dark/70 text-center text-xs font-medium"
                            x-text="day"></div>
                    </div>
                </template>
            </div>

            {{-- Tanggal --}}
            <div class="grid grid-cols-7">
                <template x-for="blankDay in datePickerBlankDaysInMonth">
                    <div class="border border-transparent p-1 text-center text-sm"></div>
                </template>
                <template :key="dayIndex" x-for="(day, dayIndex) in datePickerDaysInMonth">
                    <div class="mb-1 aspect-square px-0.5">
                        <div :class="{
                            'bg-surface-alt dark:bg-surface-dark-alt': datePickerIsToday(day),
                            'text-on-surface hover:bg-surface-alt dark:text-on-surface-dark dark:hover:bg-surface-dark-alt':
                                !datePickerIsSelectedDate(day),
                            'bg-primary text-on-primary dark:bg-primary-dark dark:text-on-primary-dark': datePickerIsSelectedDate(
                                day)
                        }"
                            @click="datePickerDayClicked(day)"
                            class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full text-center text-sm leading-none"
                            x-text="day"></div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    @error($name)
        <small class="text-danger pl-0.5">{{ $message }}</small>
    @enderror
</div>
