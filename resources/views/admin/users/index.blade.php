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
                    <x-button-link :route="'admin.users.create'">
                        Tambah Pengguna Baru
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
                    <th class="p-4" scope="col">Nama</th>
                    <th class="p-4" scope="col">Email</th>
                    <th class="p-4" scope="col">Role</th>
                    <th class="p-4" scope="col">Tanggal Bergabung</th>
                    <th class="p-4 text-right" scope="col">Aksi</th>
                </x-slot>

                <x-slot name="body">
                    @forelse ($users as $user)
                        <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                            <th class="text-on-surface-strong dark:text-on-surface-dark-strong p-4 font-medium"
                                scope="row">
                                {{ $user->name }}
                            </th>
                            <td class="p-4">{{ $user->email }}</td>
                            <td class="p-4">
                                <x-status :intent="$user->role === 'admin' ? 'danger' : 'active'">{{ ucfirst($user->role) }}</x-status>
                            </td>
                            <td class="p-4">{{ $user->createdAtFormatted }}</td>
                            <td class="p-4 text-right">
                                <x-link :route="['admin.users.edit', $user->id]">Edit</x-link>
                                <span class="text-outline dark:text-outline-dark mx-1">|</span>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" class="inline" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
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
                            <td class="p-4 text-center" colspan="5">Belum ada data pengguna lain.</td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table>

        </x-card>
    </x-page-content>
@endsection
