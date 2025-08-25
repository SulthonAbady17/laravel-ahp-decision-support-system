@extends('layouts.app')

@section('title', 'Tambah Alternatif Baru')

@section('content')
    <x-page-content>
        <form action="{{ route('admin.alternatives.store') }}" method="POST">
            @csrf
            <x-card>
                <x-slot name="header">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Tambah Alternatif (Kandidat) Baru
                    </h2>
                </x-slot>

                <div class="space-y-4">
                    {{-- Nama Kandidat --}}
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama Kandidat" />
                        <x-form.input :value="old('name')" autofocus id="name" name="name"
                            placeholder="Masukkan nama lengkap kandidat" required type="text" />
                    </div>
                    {{-- Detail (Visi & Misi) --}}
                    <div class="flex flex-col gap-1">
                        <x-form.label for="details" value="Detail (Visi & Misi)" />
                        <x-form.textarea id="details" name="details" placeholder="Jelaskan visi dan misi kandidat..."
                            rows="5">{{ old('details') }}</x-form.textarea>
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link href="{{ route('admin.alternatives.index') }}"
                            variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Simpan Alternatif</x-form.button>
                    </div>
                </x-slot>
            </x-card>
        </form>
    </x-page-content>
@endsection
