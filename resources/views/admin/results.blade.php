@extends('layouts.app')

@section('title', 'Hasil Akhir')

@section('content')
    <x-page-content maxWidth="4xl">
        <x-card>
            <x-slot name="header">
                <div class="text-center">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-2xl font-bold leading-tight">
                        Hasil Akhir Peringkat
                    </h2>
                    <p class="text-md text-on-surface dark:text-on-surface-dark mt-1">
                        Pemilihan Ketua Umum 2025
                    </p>
                </div>
            </x-slot>

            {{-- Daftar Peringkat --}}
            <div class="space-y-4">

                {{-- Peringkat 1 --}}
                <div
                    class="rounded-radius bg-primary text-on-primary dark:bg-primary-dark dark:text-on-primary-dark flex items-center justify-between p-4 shadow-md">
                    <div class="flex items-center">
                        <span class="mr-4 text-4xl font-bold">1</span>
                        <div>
                            <p class="text-lg font-semibold">Jane Smith</p>
                            <p class="text-sm">Skor Akhir: <strong>0.4571</strong></p>
                        </div>
                    </div>
                    <div>
                        <svg class="text-warning h-8 w-8 fill-current" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                    </div>
                </div>

                {{-- Peringkat 2 --}}
                <div class="rounded-radius border-outline flex items-center justify-between border p-4">
                    <div class="flex items-center">
                        <span class="text-on-surface dark:text-on-surface-dark mr-4 text-3xl font-bold">2</span>
                        <div>
                            <p class="text-on-surface-strong dark:text-on-surface-dark-strong text-lg font-semibold">John
                                Doe</p>
                            <p class="text-on-surface dark:text-on-surface-dark text-sm">Skor Akhir: <strong>0.3015</strong>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Peringkat 3 --}}
                <div class="rounded-radius border-outline flex items-center justify-between border p-4">
                    <div class="flex items-center">
                        <span class="text-on-surface dark:text-on-surface-dark mr-4 text-3xl font-bold">3</span>
                        <div>
                            <p class="text-on-surface-strong dark:text-on-surface-dark-strong text-lg font-semibold">Richard
                                Roe</p>
                            <p class="text-on-surface dark:text-on-surface-dark text-sm">Skor Akhir: <strong>0.2414</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <x-slot name="footer">
                <div class="text-on-surface dark:text-on-surface-dark flex items-center justify-center gap-2 text-sm">
                    <span>Rasio Konsistensi (CR):</span>
                    <span class="font-bold">0.0867</span>
                    <x-status intent="completed">Konsisten</x-status>
                </div>
            </x-slot>
        </x-card>
    </x-page-content>
@endsection
