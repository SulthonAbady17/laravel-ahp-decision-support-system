@extends('layouts.app')

@section('title', 'Edit Alternatif')

@section('content')
    <x-page-content>
        <x-card>
            <x-slot name="header">
                <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                    Edit Alternatif: John Doe
                </h2>
            </x-slot>

            <form action="#" method="POST">
                <div class="space-y-4">
                    {{-- Nama Kandidat --}}
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama Kandidat" />
                        <x-form.input id="name" name="name" required type="text" value="John Doe" />
                    </div>

                    {{-- Detail (Visi & Misi) --}}
                    <div class="flex flex-col gap-1">
                        <x-form.label for="details" value="Detail (Visi & Misi)" />
                        <x-form.textarea id="details" name="details" rows="5">
                            Visi: Memajukan paduan suara ke tingkat internasional.
                            Misi: Meningkatkan repertoar lagu dan mengadakan konser tahunan.
                        </x-form.textarea>
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link href="#" variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Update Alternatif</x-form.button>
                    </div>
                </x-slot>
            </form>
        </x-card>
    </x-page-content>
@endsection
