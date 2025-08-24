@extends('layouts.app')

@section('title', 'Edit Kriteria')

@section('content')
    <x-page-content>
        <form action="{{ route('admin.criteria.update', $criterion->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-card>
                <x-slot name="header">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Edit Kriteria: {{ $criterion->name }}
                    </h2>
                </x-slot>

                <div class="space-y-4">
                    {{-- Nama Kriteria --}}
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama Kriteria" />
                        <x-form.input :value="old('name', $criterion->name)" id="name" name="name" required type="text" />
                    </div>

                    {{-- Deskripsi --}}
                    <div class="flex flex-col gap-1">
                        <x-form.label for="description" value="Deskripsi" />
                        <x-form.textarea id="description" name="description"
                            rows="3">{{ old('description', $criterion->description) }}</x-form.textarea>
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link :route="'admin.criteria.index'" variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Update Kriteria</x-form.button>
                    </div>
                </x-slot>
            </x-card>
        </form>
    </x-page-content>
@endsection
