@extends('layouts.app')

@section('title', 'Konfigurasi Periode')

@section('content')
    @php
        // Simulasi data master yang akan dipilih
        $allCriteria = [
            ['id' => 1, 'name' => 'Kemampuan Komunikasi', 'checked' => true],
            ['id' => 2, 'name' => 'Kontribusi Organisasi', 'checked' => true],
            ['id' => 3, 'name' => 'Manajemen Konflik', 'checked' => false],
            ['id' => 4, 'name' => 'Pengalaman Organisasi', 'checked' => true],
        ];
        $allAlternatives = [
            ['id' => 1, 'name' => 'John Doe', 'checked' => true],
            ['id' => 2, 'name' => 'Jane Smith', 'checked' => true],
            ['id' => 3, 'name' => 'Richard Roe', 'checked' => true],
        ];
    @endphp

    <x-page-content>
        <x-card>
            <x-slot name="header">
                <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                    Konfigurasi Periode: Pemilihan Ketua Umum 2025
                </h2>
                <p class="text-on-surface mt-1 text-sm">
                    Pilih kriteria dan alternatif yang akan disertakan dalam periode seleksi ini.
                </p>
            </x-slot>

            <form action="#" method="POST">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

                    {{-- Kolom Pemilihan Kriteria --}}
                    <div>
                        <h3 class="border-outline dark:border-outline-dark mb-4 border-b pb-2 text-lg font-semibold">Pilih
                            Kriteria Penilaian</h3>
                        <div class="space-y-3">
                            @foreach ($allCriteria as $criterion)
                                <x-form.checkbox :checked="$criterion['checked']" :id="'criterion-' . $criterion['id']" :label="$criterion['name']" :name="'criteria[]'"
                                    :value="$criterion['id']" labelPosition="right" />
                            @endforeach
                        </div>
                    </div>

                    {{-- Kolom Pemilihan Alternatif --}}
                    <div>
                        <h3 class="border-outline dark:border-outline-dark mb-4 border-b pb-2 text-lg font-semibold">Pilih
                            Alternatif (Kandidat)</h3>
                        <div class="space-y-3">
                            @foreach ($allAlternatives as $alternative)
                                <x-form.checkbox :checked="$alternative['checked']" :id="'alternative-' . $alternative['id']" :label="$alternative['name']" :name="'alternatives[]'"
                                    :value="$alternative['id']" labelPosition="right" />
                            @endforeach
                        </div>
                    </div>

                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link href="#" variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Simpan Konfigurasi</x-form.button>
                    </div>
                </x-slot>
            </form>
        </x-card>
    </x-page-content>
@endsection
