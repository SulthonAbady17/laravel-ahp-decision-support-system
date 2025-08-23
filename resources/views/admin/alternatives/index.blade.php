@extends('layouts.app')

@section('title', 'Manajemen Alternatif')

@section('content')
    <x-page-content>
        <x-card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Daftar Alternatif (Kandidat)
                    </h2>
                    <x-button-link href="#">
                        Tambah Alternatif Baru
                    </x-button-link>
                </div>
            </x-slot>

            <x-table>
                <x-slot name="head">
                    <th class="p-4" scope="col">Nama Kandidat</th>
                    <th class="p-4" scope="col">Detail (Visi & Misi)</th>
                    <th class="p-4 text-right" scope="col">Aksi</th>
                </x-slot>

                <x-slot name="body">
                    {{-- Contoh Data Statis 1 --}}
                    <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                        <th class="text-on-surface-strong dark:text-on-surface-dark-strong p-4 font-medium" scope="row">
                            John Doe
                        </th>
                        <td class="p-4">
                            Visi: Memajukan paduan suara ke tingkat internasional.
                        </td>
                        <td class="p-4 text-right">
                            <x-link href="#">Edit</x-link>
                            <span class="text-outline dark:text-outline-dark mx-1">|</span>
                            <x-link href="#" intent="danger">Hapus</x-link>
                        </td>
                    </tr>

                    {{-- Contoh Data Statis 2 --}}
                    <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                        <th class="text-on-surface-strong dark:text-on-surface-dark-strong p-4 font-medium" scope="row">
                            Jane Smith
                        </th>
                        <td class="p-4">
                            Misi: Meningkatkan kualitas vokal dan kebersamaan anggota.
                        </td>
                        <td class="p-4 text-right">
                            <x-link href="#">Edit</x-link>
                            <span class="text-outline dark:text-outline-dark mx-1">|</span>
                            <x-link href="#" intent="danger">Hapus</x-link>
                        </td>
                    </tr>
                </x-slot>
            </x-table>

        </x-card>
    </x-page-content>
@endsection
