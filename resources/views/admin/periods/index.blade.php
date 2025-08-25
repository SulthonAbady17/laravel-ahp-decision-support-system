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
                    <x-button-link :route="'admin.periods.create'">
                        Tambah Periode Baru
                    </x-button-link>
                </div>
            </x-slot>

            @if (session('success'))
                <x-alert :dismissible="true" class="mb-4" intent="success">
                    {{ session('success') }}
                </x-alert>
            @endif

            <x-table>
                <x-slot name="head">
                    <th class="p-4" scope="col">Nama Periode</th>
                    <th class="p-4" scope="col">Tanggal Mulai</th>
                    <th class="p-4" scope="col">Tanggal Selesai</th>
                    <th class="p-4" scope="col">Status</th>
                    <th class="p-4 text-right" scope="col">Aksi</th>
                </x-slot>

                <x-slot name="body">
                    @forelse ($periods as $period)
                        <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                            <th class="text-on-surface-strong dark:text-on-surface-dark-strong whitespace-nowrap p-4 font-medium"
                                scope="row">
                                {{ $period->name }}
                            </th>
                            <td class="whitespace-nowrap p-4">{{ $period->startDateFormatted ?? '-' }}</td>
                            <td class="whitespace-nowrap p-4">{{ $period->endDateFormatted ?? '-' }}</td>
                            <td class="p-4">
                                <x-status :intent="$period->status">{{ ucfirst($period->status) }}</x-status>
                            </td>
                            <td class="whitespace-nowrap p-4 text-right">
                                <x-link :route="['admin.periods.configure', $period->id]">Konfigurasi</x-link>
                                <span class="text-outline dark:text-outline-dark mx-1">|</span>
                                <x-link :route="['admin.periods.edit', $period->id]">Edit</x-link>
                                <span class="text-outline dark:text-outline-dark mx-1">|</span>
                                <form action="{{ route('admin.periods.destroy', $period->id) }}" class="inline"
                                    method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus periode ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="text-danger dark:text-danger font-medium underline-offset-2 hover:underline focus:underline focus:outline-none"
                                        type="submit">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="p-4 text-center" colspan="5">
                                Belum ada data periode.
                            </td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table>

        </x-card>
    </x-page-content>
@endsection
