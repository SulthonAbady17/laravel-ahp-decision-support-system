@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
    <x-page-content>
        <x-card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Daftar Pengguna
                    </h2>
                    <x-button-link href="#">
                        Tambah Pengguna Baru
                    </x-button-link>
                </div>
            </x-slot>

            <x-table>
                <x-slot name="head">
                    <th class="p-4" scope="col">Nama</th>
                    <th class="p-4" scope="col">Email</th>
                    <th class="p-4" scope="col">Role</th>
                    <th class="p-4 text-right" scope="col">Aksi</th>
                </x-slot>

                <x-slot name="body">
                    {{-- Contoh Data Statis 1 --}}
                    <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                        <th class="text-on-surface-strong dark:text-on-surface-dark-strong p-4 font-medium" scope="row">
                            Admin Utama
                        </th>
                        <td class="p-4">admin@example.com</td>
                        <td class="p-4">
                            <x-status intent="danger">Admin</x-status>
                        </td>
                        <td class="p-4 text-right">
                            <x-link href="#">Edit</x-link>
                        </td>
                    </tr>

                    {{-- Contoh Data Statis 2 --}}
                    <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                        <th class="text-on-surface-strong dark:text-on-surface-dark-strong p-4 font-medium" scope="row">
                            Anggota Satu
                        </th>
                        <td class="p-4">member1@example.com</td>
                        <td class="p-4">
                            <x-status intent="active">Member</x-status>
                        </td>
                        <td class="p-4 text-right">
                            <x-link href="#">Edit</x-link>
                        </td>
                    </tr>
                </x-slot>
            </x-table>

        </x-card>
    </x-page-content>
@endsection
