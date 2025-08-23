@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
    <x-page-content maxWidth="4xl">
        <div class="space-y-6">
            {{-- Form Update Informasi Profil --}}
            <x-card>
                <x-slot name="header">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-lg font-medium">
                        Informasi Profil
                    </h2>
                    <p class="text-on-surface mt-1 text-sm">
                        Perbarui informasi profil dan alamat email akun Anda.
                    </p>
                </x-slot>

                <form action="#" class="space-y-4" method="POST">
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama" />
                        <x-form.input id="name" name="name" required type="text"
                            value="Nama Pengguna Saat Ini" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="email" value="Email" />
                        <x-form.input id="email" name="email" required type="email" value="email@example.com" />
                    </div>

                    <div class="flex items-center justify-end">
                        <x-form.button>Simpan</x-form.button>
                    </div>
                </form>
            </x-card>

            {{-- Form Update Password --}}
            <x-card>
                <x-slot name="header">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-lg font-medium">
                        Ubah Password
                    </h2>
                    <p class="text-on-surface mt-1 text-sm">
                        Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
                    </p>
                </x-slot>

                <form action="#" class="space-y-4" method="POST">
                    <div class="flex flex-col gap-1">
                        <x-form.label for="current_password" value="Password Saat Ini" />
                        <x-form.password-input autocomplete="current-password" id="current_password"
                            name="current_password" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="password" value="Password Baru" />
                        <x-form.password-input autocomplete="new-password" id="password" name="password" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="password_confirmation" value="Konfirmasi Password" />
                        <x-form.password-input autocomplete="new-password" id="password_confirmation"
                            name="password_confirmation" />
                    </div>

                    <div class="flex items-center justify-end">
                        <x-form.button>Simpan</x-form.button>
                    </div>
                </form>
            </x-card>
        </div>
    </x-page-content>
@endsection
