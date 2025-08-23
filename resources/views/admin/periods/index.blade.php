@extends('layouts.app')

@section('title', 'Manajemen Periode')

@section('content')
    <x-page-content>
        <x-card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Daftar Periode Seleksi
                    </h2>
                    <x-button-link href="#">
                        Tambah Periode Baru
                    </x-button-link>
                </div>
            </x-slot>

            <x-table>
                <x-slot name="head">
                    <th class="p-4" scope="col">Nama Periode</th>
                    <th class="p-4" scope="col">Tanggal Mulai</th>
                    <th class="p-4" scope="col">Tanggal Selesai</th>
                    <th class="p-4" scope="col">Status</th>
                    <th class="p-4 text-right" scope="col">Aksi</th>
                </x-slot>

                <x-slot name="body">
                    {{-- Contoh Data Statis 1 --}}
                    <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                        <th class="text-on-surface-strong dark:text-on-surface-dark-strong p-4 font-medium" scope="row">
                            Pemilihan Ketua Umum 2025
                        </th>
                        <td class="p-4">1 September 2025</td>
                        <td class="p-4">15 September 2025</td>
                        <td class="p-4">
                            <x-status intent="active">Aktif</x-status>
                        </td>
                        <td class="p-4 text-right">
                            <x-link href="#">Konfigurasi</x-link>
                            <span class="text-outline dark:text-outline-dark mx-1">|</span>
                            <x-link href="#">Edit</x-link>
                        </td>
                    </tr>

                    {{-- Contoh Data Statis 2 --}}
                    <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                        <th class="text-on-surface-strong dark:text-on-surface-dark-strong p-4 font-medium" scope="row">
                            Pemilihan Ketua Umum 2024
                        </th>
                        <td class="p-4">1 Oktober 2024</td>
                        <td class="p-4">15 Oktober 2024</td>
                        <td class="p-4">
                            <x-status intent="completed">Selesai</x-status>
                        </td>
                        <td class="p-4 text-right">
                            <x-link href="#">Lihat Hasil</x-link>
                            <span class="text-outline dark:text-outline-dark mx-1">|</span>
                            <x-link href="#">Edit</x-link>
                        </td>
                    </tr>

                    {{-- Contoh Data Statis 3 --}}
                    <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                        <th class="text-on-surface-strong dark:text-on-surface-dark-strong p-4 font-medium" scope="row">
                            Rencana Pemilihan 2026
                        </th>
                        <td class="p-4">-</td>
                        <td class="p-4">-</td>
                        <td class="p-4">
                            <x-status intent="draft">Draft</x-status>
                        </td>
                        <td class="p-4 text-right">
                            <x-link href="#">Konfigurasi</x-link>
                            <span class="text-outline dark:text-outline-dark mx-1">|</span>
                            <x-link href="#">Edit</x-link>
                        </td>
                    </tr>
                </x-slot>
            </x-table>

        </x-card>
    </x-page-content>
@endsection
