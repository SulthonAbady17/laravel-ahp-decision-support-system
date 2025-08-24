@extends('layouts.app')

@section('title', 'Manajemen Kriteria')

@section('content')
    <x-page-content>
        <x-card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-xl font-semibold leading-tight">
                        Daftar Kriteria Penilaian
                    </h2>
                    <x-button-link :route="'admin.criteria.create'">
                        Tambah Kriteria Baru
                    </x-button-link>
                </div>
            </x-slot>

            {{-- Menampilkan pesan sukses setelah create/update/delete --}}
            @if (session('success'))
                <x-alert intent="success">
                    {{ session('success') }}
                </x-alert>
            @endif

            <x-table>
                <x-slot name="head">
                    <th class="p-4 text-center" scope="col">Nama Kriteria</th>
                    <th class="p-4 text-center" scope="col">Deskripsi</th>
                    <th class="p-4 text-center" scope="col">Aksi</th>
                </x-slot>

                <x-slot name="body">
                    @forelse ($criteria as $criterion)
                        <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                            <th class="text-on-surface-strong dark:text-on-surface-dark-strong p-4 font-medium"
                                scope="row">
                                {{ $criterion->name }}
                            </th>
                            <td class="@if (!$criterion->description) text-center @endif p-4">
                                {{ $criterion->description ?? '-' }}
                            </td>
                            <td class="p-4 text-center">
                                <x-link :route="['admin.criteria.edit', $criterion->id]">Edit</x-link>
                                <span class="text-outline dark:text-outline-dark mx-1">|</span>
                                <form action="{{ route('admin.criteria.destroy', $criterion->id) }}" class="inline"
                                    method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus kriteria ini?');">
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
                            <td class="p-4 text-center" colspan="3">
                                Belum ada data kriteria.
                            </td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table>

        </x-card>
    </x-page-content>
@endsection
