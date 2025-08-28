@extends('layouts.app')

@section('title', 'Member Dashboard')

@section('content')
    <x-page-content>

        @if ($data->activePeriod)
            {{-- Skenario 1: ADA Periode Penilaian yang Aktif --}}
            <x-card>
                <x-slot name="header">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Periode Penilaian Aktif
                    </h2>
                </x-slot>
                <div class="text-center">
                    <h3 class="text-on-surface-strong dark:text-on-surface-dark-strong text-2xl font-bold">
                        {{ $data->activePeriod->name }}
                    </h3>
                    <p class="text-on-surface dark:text-on-surface-dark mt-2">
                        Periode penilaian dibuka hingga
                        {{ $data->activePeriod->endDateFormatted ?? 'waktu yang ditentukan' }}.
                    </p>
                    <div class="mt-6">
                        <x-button-link :route="'member.comparisons.create'" size="lg">
                            Mulai Isi Penilaian
                        </x-button-link>
                    </div>
                </div>
            </x-card>
        @elseif ($data->latestCompletedPeriod)
            {{-- Skenario 2: TIDAK ADA Periode Aktif, TAPI ADA Hasil yang Tersedia --}}
            <x-card>
                <x-slot name="header">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Hasil Penilaian Tersedia
                    </h2>
                </x-slot>
                <div class="text-center">
                    <h3 class="text-on-surface-strong dark:text-on-surface-dark-strong text-2xl font-bold">
                        {{ $data->latestCompletedPeriod->name }}
                    </h3>
                    <p class="text-on-surface dark:text-on-surface-dark mt-2">
                        Hasil penilaian untuk periode ini sudah tersedia.
                    </p>
                    <div class="mt-6">
                        <x-button-link :route="'member.results'" size="lg">
                            Lihat Hasil Akhir
                        </x-button-link>
                    </div>
                </div>
            </x-card>
        @else
            {{-- Skenario 3: TIDAK ADA Periode Aktif dan TIDAK ADA Hasil --}}
            <x-card>
                <div class="py-8 text-center">
                    <h3 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold">
                        Tidak Ada Periode Penilaian Aktif
                    </h3>
                    <p class="text-on-surface dark:text-on-surface-dark mt-2">
                        Saat ini belum ada periode seleksi yang dibuka atau hasil yang dipublikasikan.
                    </p>
                </div>
            </x-card>
        @endif

    </x-page-content>
@endsection
