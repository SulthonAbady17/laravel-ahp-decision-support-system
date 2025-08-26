@extends('layouts.app')

@section('title', 'Member Dashboard')

@section('content')
    <x-page-content>

        @if ($data->activePeriod)
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
                        {{ $data->activePeriod->endDateFormatted ?? 'waktu yang ditentukan' }}. Silakan berikan penilaian
                        Anda untuk menentukan ketua selanjutnya.
                    </p>
                    <div class="mt-6">
                        <x-button-link :route="'member.comparisons.criteria'" size="lg">
                            Mulai Isi Penilaian
                        </x-button-link>
                    </div>
                </div>
            </x-card>
        @else
            <x-card>
                <div class="py-8 text-center">
                    <h3 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold">
                        Tidak Ada Periode Penilaian Aktif
                    </h3>
                    <p class="text-on-surface dark:text-on-surface-dark mt-2">
                        Saat ini belum ada periode seleksi yang dibuka. Silakan cek kembali nanti.
                    </p>
                </div>
            </x-card>
        @endif

    </x-page-content>
@endsection
