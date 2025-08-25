@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    @php
        $roleOptions = [['value' => 'member', 'label' => 'Member'], ['value' => 'admin', 'label' => 'Admin']];
    @endphp

    <x-page-content>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-card>
                <x-slot name="header">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Edit Pengguna: {{ $user->name }}
                    </h2>
                </x-slot>

                <div class="space-y-4">
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama" />
                        <x-form.input :value="old('name', $user->name)" id="name" name="name" required type="text" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="email" value="Email" />
                        <x-form.input :value="old('email', $user->email)" id="email" name="email" required type="email" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="role" value="Role" />
                        <x-form.combobox :options="$roleOptions" :value="old('role', $user->role)" id="role" name="role" />
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link href="{{ route('admin.users.index') }}" variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Update Pengguna</x-form.button>
                    </div>
                </x-slot>
            </x-card>
        </form>
    </x-page-content>
@endsection
