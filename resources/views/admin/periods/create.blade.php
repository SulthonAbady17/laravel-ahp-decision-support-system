@extends('layouts.app')

@section('title', 'Tambah Periode Baru')

@section('content')
    @php
        // Opsi untuk status periode
        $statusOptions = [
            ['value' => 'draft', 'label' => 'Draft'],
            ['value' => 'active', 'label' => 'Aktif'],
            ['value' => 'completed', 'label' => 'Selesai'],
        ];
    @endphp

    <x-page-content>
        <x-card>
            <x-slot name="header">
                <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                    Tambah Periode Seleksi Baru
                </h2>
            </x-slot>

            <form action="#" method="POST">
                <div class="space-y-4">
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama Periode" />
                        <x-form.input autofocus id="name" name="name" placeholder="Contoh: Pemilihan Ketua 2025"
                            required type="text" />
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="flex flex-col gap-1">
                            <x-form.label for="start_date" value="Tanggal Mulai" />
                            <x-form.input id="start_date" name="start_date" type="date" />
                        </div>
                        <div class="flex flex-col gap-1">
                            <x-form.label for="end_date" value="Tanggal Selesai" />
                            <x-form.input id="end_date" name="end_date" type="date" />
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="status" value="Status" />
                        <x-form.combobox :options="$statusOptions" id="status" name="status" placeholder="Pilih Status" />
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link href="#" variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Simpan Periode</x-form.button>
                    </div>
                </x-slot>
            </form>
        </x-card>
    </x-page-content>
@endsection
