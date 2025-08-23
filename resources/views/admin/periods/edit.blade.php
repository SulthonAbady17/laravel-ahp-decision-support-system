@extends('layouts.app')

@section('title', 'Edit Periode')

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
                    Edit Periode: Pemilihan Ketua Umum 2025
                </h2>
            </x-slot>

            <form action="#" method="POST">
                <div class="space-y-4">
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama Periode" />
                        <x-form.input id="name" name="name" required type="text"
                            value="Pemilihan Ketua Umum 2025" />
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="flex flex-col gap-1">
                            <x-form.label for="start_date" value="Tanggal Mulai" />
                            <x-form.input id="start_date" name="start_date" type="date" value="2025-09-01" />
                        </div>
                        <div class="flex flex-col gap-1">
                            <x-form.label for="end_date" value="Tanggal Selesai" />
                            <x-form.input id="end_date" name="end_date" type="date" value="2025-09-15" />
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="status" value="Status" />
                        {{-- Atribut value ditambahkan untuk mengisi nilai awal combobox --}}
                        <x-form.combobox :options="$statusOptions" id="status" name="status" value="active" />
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link href="#" variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Update Periode</x-form.button>
                    </div>
                </x-slot>
            </form>
        </x-card>
    </x-page-content>
@endsection
