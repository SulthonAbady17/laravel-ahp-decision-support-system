@extends('layouts.app')

@section('title', 'Penilaian Selesai')

@section('content')
    <x-page-content maxWidth="4xl">
        <x-card>
            <div class="py-10 text-center">
                {{-- Ikon Sukses --}}
                <div class="bg-success/10 mx-auto flex h-12 w-12 items-center justify-center rounded-full">
                    <svg class="text-success h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>

                {{-- Pesan Konfirmasi --}}
                <h3 class="text-on-surface-strong dark:text-on-surface-dark-strong mt-5 text-2xl font-semibold">
                    Terima Kasih!
                </h3>
                <p class="text-on-surface dark:text-on-surface-dark mt-2">
                    Penilaian Anda telah berhasil kami rekam. Hasil akhir akan diumumkan setelah periode penilaian ditutup
                    oleh Admin.
                </p>
                <div class="mt-6">
                    <x-link :route="'dashboard'">
                        Kembali ke Dashboard
                    </x-link>
                </div>
            </div>
        </x-card>
    </x-page-content>
@endsection
