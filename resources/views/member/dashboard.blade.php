@extends('layouts.app')

@section('title', 'Member Dashboard')

@section('content')
    <x-page-content>

        {{-- Skenario 1: ADA Periode Seleksi yang Aktif --}}
        <x-card>
            <x-slot name="header">
                <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                    Periode Penilaian Aktif
                </h2>
            </x-slot>

            <div class="text-center">
                <h3 class="text-on-surface-strong dark:text-on-surface-dark-strong text-2xl font-bold">
                    Pemilihan Ketua Umum 2025
                </h3>
                <p class="text-on-surface dark:text-on-surface-dark mt-2">
                    Periode penilaian dibuka hingga 15 September 2025. Silakan berikan penilaian Anda untuk menentukan ketua
                    selanjutnya.
                </p>
                <div class="mt-6">
                    <x-button-link href="#" size="lg">
                        Mulai Isi Penilaian
                    </x-button-link>
                </div>
            </div>
        </x-card>

        {{-- Skenario 2: TIDAK ADA Periode Seleksi yang Aktif --}}
        {{--
        <x-card>
            <div class="text-center py-8">
                <h3 class="text-xl font-semibold text-on-surface-strong dark:text-on-surface-dark-strong">
                    Tidak Ada Periode Penilaian Aktif
                </h3>
                <p class="mt-2 text-on-surface dark:text-on-surface-dark">
                    Saat ini belum ada periode seleksi yang dibuka. Silakan cek kembali nanti.
                </p>
            </div>
        </x-card>
        --}}

    </x-page-content>
@endsection
