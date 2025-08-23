@extends('layouts.app')

@section('title', 'Edit Kriteria')

@section('content')
    <x-page-content>
        <x-card>
            <x-slot name="header">
                <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                    Edit Kriteria: Kemampuan Komunikasi
                </h2>
            </x-slot>

            <form action="#" method="POST">
                <div class="space-y-4">
                    {{-- Nama Kriteria --}}
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama Kriteria" />
                        <x-form.input id="name" name="name" required type="text" value="Kemampuan Komunikasi" />
                    </div>

                    {{-- Deskripsi --}}
                    <div class="flex flex-col gap-1">
                        <x-form.label for="description" value="Deskripsi" />
                        <x-form.textarea id="description" name="description" rows="3">
                            Kemampuan kandidat dalam menyampaikan ide dan gagasan secara jelas dan efektif.
                        </x-form.textarea>
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link href="#" variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Update Kriteria</x-form.button>
                    </div>
                </x-slot>
            </form>
        </x-card>
    </x-page-content>
@endsection
