@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <x-page-content>
        <div class="mb-6">
            <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-2xl font-semibold">
                Selamat Datang, Admin!
            </h2>
            <p class="text-on-surface dark:text-on-surface-dark">
                Ringkasan data sistem SPK Paduan Suara.
            </p>
        </div>

        {{-- Grid untuk menampilkan ringkasan data --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">

            <x-card>
                <x-slot name="header">
                    <h3 class="text-on-surface-strong dark:text-on-surface-dark-strong font-semibold">
                        Manajemen Kriteria
                    </h3>
                </x-slot>
                <p class="text-on-surface-strong dark:text-on-surface-dark-strong text-3xl font-bold">
                    {{ $dashboardData->criteriaCount }}
                </p>
                <p class="text-on-surface dark:text-on-surface-dark">Total Kriteria</p>
                <x-slot name="footer">
                    <x-link :route="'admin.criteria.index'">
                        Kelola Kriteria &rarr;
                    </x-link>
                </x-slot>
            </x-card>

            <x-card>
                <x-slot name="header">
                    <h3 class="text-on-surface-strong dark:text-on-surface-dark-strong font-semibold">
                        Manajemen Alternatif
                    </h3>
                </x-slot>
                <p class="text-on-surface-strong dark:text-on-surface-dark-strong text-3xl font-bold">
                    {{ $dashboardData->alternativesCount }}
                </p>
                <p class="text-on-surface dark:text-on-surface-dark">Total Kandidat</p>
                <x-slot name="footer">
                    <x-link href="{{ route('admin.alternatives.index') }}">
                        Kelola Alternatif &rarr;
                    </x-link>
                </x-slot>
            </x-card>

            <x-card>
                <x-slot name="header">
                    <h3 class="text-on-surface-strong dark:text-on-surface-dark-strong font-semibold">
                        Manajemen Periode
                    </h3>
                </x-slot>
                <p class="text-on-surface-strong dark:text-on-surface-dark-strong text-3xl font-bold">
                    {{ $dashboardData->periodsCount }}
                </p>
                <p class="text-on-surface dark:text-on-surface-dark">Total Periode Seleksi</p>
                <x-slot name="footer">
                    <x-link href="{{ route('admin.periods.index') }}">
                        Kelola Periode &rarr;
                    </x-link>
                </x-slot>
            </x-card>

            <x-card>
                <x-slot name="header">
                    <h3 class="text-on-surface-strong dark:text-on-surface-dark-strong font-semibold">
                        Manajemen User
                    </h3>
                </x-slot>
                <p class="text-on-surface-strong dark:text-on-surface-dark-strong text-3xl font-bold">
                    {{ $dashboardData->usersCount }}
                </p>
                <p class="text-on-surface dark:text-on-surface-dark">Total Pengguna</p>
                <x-slot name="footer">
                    <x-link :route="'admin.users.index'">
                        Kelola User &rarr;
                    </x-link>
                </x-slot>
            </x-card>

        </div>
    </x-page-content>
@endsection
