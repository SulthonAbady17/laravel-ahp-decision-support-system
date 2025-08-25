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
                    <x-button-link :route="'admin.alternatives.create'">
                        Tambah Alternatif Baru
                    </x-button-link>
                </div>
            </x-slot>

            @if (session('success'))
                <x-alert class="mb-4" intent="success">
                    {{ session('success') }}
                </x-alert>
            @endif

            <x-table>
                <x-slot name="head">
                    <th class="p-4" scope="col">Nama Kandidat</th>
                    <th class="p-4" scope="col">Detail (Visi & Misi)</th>
                    <th class="p-4 text-right" scope="col">Aksi</th>
                </x-slot>

                <x-slot name="body">
                    @forelse ($alternatives as $alternative)
                        <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                            <th class="text-on-surface-strong dark:text-on-surface-dark-strong p-4 font-medium"
                                scope="row">
                                {{ $alternative->name }}
                            </th>
                            <td class="p-4">
                                {{ Str::limit($alternative->details, 70) ?? '-' }}
                            </td>
                            <td class="p-4 text-right">
                                <x-link :route="['admin.alternatives.edit', $alternative->id]">Edit</x-link>
                                <span class="text-outline dark:text-outline-dark mx-1">|</span>
                                <form action="{{ route('admin.alternatives.destroy', $alternative->id) }}" class="inline"
                                    method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus alternatif ini?');">
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
                                Belum ada data alternatif.
                            </td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table>

        </x-card>
    </x-page-content>
@endsection
