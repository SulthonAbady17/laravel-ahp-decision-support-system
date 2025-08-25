@extends('layouts.app')

@section('title', 'Konfigurasi Periode')

@section('content')
    <x-page-content>
        <form action="{{ route('admin.periods.configure.update', $data->period->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-card>
                <x-slot name="header">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Konfigurasi Periode: {{ $data->period->name }}
                    </h2>
                    <p class="text-on-surface mt-1 text-sm">
                        Pilih kriteria dan alternatif yang akan disertakan dalam periode seleksi ini.
                    </p>
                </x-slot>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

                    {{-- Kolom Pemilihan Kriteria --}}
                    <div>
                        <h3 class="border-outline dark:border-outline-dark mb-4 border-b pb-2 text-lg font-semibold">Pilih
                            Kriteria Penilaian</h3>
                        <div class="space-y-3">
                            @foreach ($data->allCriteria as $criterion)
                                <x-form.checkbox :checked="$data->selectedCriteriaIds->contains($criterion->id)" :id="'criterion-' . $criterion->id" :label="$criterion->name" :value="$criterion->id"
                                    labelPosition="right" name="criteria[]" />
                            @endforeach
                        </div>
                    </div>

                    {{-- Kolom Pemilihan Alternatif --}}
                    <div>
                        <h3 class="border-outline dark:border-outline-dark mb-4 border-b pb-2 text-lg font-semibold">Pilih
                            Alternatif (Kandidat)</h3>
                        <div class="space-y-3">
                            @foreach ($data->allAlternatives as $alternative)
                                <x-form.checkbox :checked="$data->selectedAlternativesIds->contains($alternative->id)" :id="'alternative-' . $alternative->id" :label="$alternative->name" :value="$alternative->id"
                                    labelPosition="right" name="alternatives[]" />
                            @endforeach
                        </div>
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link :route="'admin.periods.index'" variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Simpan Konfigurasi</x-form.button>
                    </div>
                </x-slot>
            </x-card>
        </form>
    </x-page-content>
@endsection
