@extends('layouts.app')

@section('title', 'Tambah Pengguna Baru')

@section('content')
    @php
        // Opsi untuk peran (role)
        $roleOptions = [['value' => 'member', 'label' => 'Member'], ['value' => 'admin', 'label' => 'Admin']];
    @endphp

    <x-page-content>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <x-card>
                <x-slot name="header">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Tambah Pengguna Baru
                    </h2>
                </x-slot>

                <div class="space-y-4">
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama" />
                        <x-form.input autofocus id="name" name="name" placeholder="Masukkan nama lengkap" required
                            type="text" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="email" value="Email" />
                        <x-form.input id="email" name="email" placeholder="contoh@email.com" required
                            type="email" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="password" value="Password" />
                        <x-form.password-input id="password" name="password" placeholder="Masukkan password" required />
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="password_confirmation" value="Konfirmasi Password" />
                        <x-form.password-input id="password_confirmation" name="password_confirmation"
                            placeholder="Ketik ulang password" required />
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="role" value="Role" />
                        <x-form.combobox :options="$roleOptions" id="role" name="role" placeholder="Pilih Peran" />
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link href="{{ route('admin.users.index') }}" variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Simpan Pengguna</x-form.button>
                    </div>
                </x-slot>
            </x-card>
        </form>
    </x-page-content>
@endsection
