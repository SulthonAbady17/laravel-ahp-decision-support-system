@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    @php
        $roleOptions = [['value' => 'member', 'label' => 'Member'], ['value' => 'admin', 'label' => 'Admin']];
    @endphp

    <x-page-content>
        <x-card>
            <x-slot name="header">
                <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                    Edit Pengguna: Anggota Satu
                </h2>
            </x-slot>

            <form action="#" method="POST">
                <div class="space-y-4">
                    <div class="flex flex-col gap-1">
                        <x-form.label for="name" value="Nama" />
                        <x-form.input id="name" name="name" required type="text" value="Anggota Satu" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="email" value="Email" />
                        <x-form.input id="email" name="email" required type="email" value="member1@example.com" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <x-form.label for="role" value="Role" />
                        <x-form.combobox :options="$roleOptions" id="role" name="role" value="member" />
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button-link href="#" variant="outline">Batal</x-button-link>
                        <x-form.button class="ml-4">Update Pengguna</x-form.button>
                    </div>
                </x-slot>
            </form>
        </x-card>
    </x-page-content>
@endsection
