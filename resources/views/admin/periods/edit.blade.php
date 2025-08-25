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
        <form action="{{ route('admin.periods.update', $period->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-card>
                <x-slot name="header">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Edit Periode: {{ $period->name }}
                    </h2>
                </x-slot>

                <div class="space-y-4">
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama Periode" />
                        <x-form.input :value="old('name', $period->name)" id="name" name="name" required type="text" />
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="flex flex-col gap-1">
                            <x-form.label for="start_date" value="Tanggal Mulai" />
                            {{-- Mengambil tanggal dari DTO yang belum diformat --}}
                            <x-form.input :value="old('start_date', $period->start_date)" id="start_date" name="start_date" type="datetime-local" />
                        </div>
                        <div class="flex flex-col gap-1">
                            <x-form.label for="end_date" value="Tanggal Selesai" />
                            <x-form.input :value="old('end_date', $period->end_date)" id="end_date" name="end_date" type="datetime-local" />
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="status" value="Status" />
                        <x-form.combobox :options="$statusOptions" :value="old('status', $period->status)" id="status" name="status" />
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link :route="'admin.periods.index'" variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Update Periode</x-form.button>
                    </div>
                </x-slot>
            </x-card>
        </form>
    </x-page-content>
@endsection
