@extends('layouts.app')

@section('title', 'Edit Alternatif')

@section('content')
    <x-page-content>
        <form action="{{ route('admin.alternatives.update', $alternative->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-card>
                <x-slot name="header">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Edit Alternatif: {{ $alternative->name }}
                    </h2>
                </x-slot>

                <div class="space-y-4">
                    {{-- Nama Kandidat --}}
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama Kandidat" />
                        <x-form.input :value="old('name', $alternative->name)" id="name" name="name" required type="text" />
                    </div>
                    {{-- Detail (Visi & Misi) --}}
                    <div class="flex flex-col gap-1">
                        <x-form.label for="details" value="Detail (Visi & Misi)" />
                        <x-form.textarea id="details" name="details"
                            rows="5">{{ old('details', $alternative->details) }}</x-form.textarea>
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link href="{{ route('admin.alternatives.index') }}"
                            variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Update Alternatif</x-form.button>
                    </div>
                </x-slot>
            </x-card>
        </form>
    </x-page-content>
@endsection
