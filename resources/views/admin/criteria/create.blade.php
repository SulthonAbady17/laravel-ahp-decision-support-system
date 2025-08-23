@extends('layouts.app')

@section('title', 'Tambah Kriteria Baru')

@section('content')
    <x-page-content>
        <x-card>
            <x-slot name="header">
                <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                    Tambah Kriteria Baru
                </h2>
            </x-slot>

            <form action="#" method="POST">
                <div class="space-y-4">
                    {{-- Nama Kriteria --}}
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama Kriteria" />
                        <x-form.input autofocus id="name" name="name" placeholder="Contoh: Kemampuan Komunikasi"
                            required type="text" />
                    </div>

                    {{-- Deskripsi --}}
                    <div class="flex flex-col gap-1">
                        <x-form.label for="description" value="Deskripsi" />
                        <x-form.textarea id="description" name="description"
                            placeholder="Jelaskan kriteria secara singkat..." rows="3"></x-form.textarea>
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link href="#" variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Simpan Kriteria</x-form.button>
                    </div>
                </x-slot>
            </form>
        </x-card>
    </x-page-content>
@endsection
