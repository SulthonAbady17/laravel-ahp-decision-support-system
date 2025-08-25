<?php

namespace App\Repositories;

use App\Data\User\UserCreateData;
use App\Data\User\UserUpdateData;
use App\Data\User\UserViewData;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * Mengambil semua data pengguna untuk halaman index.
     */
    public function getAllForIndex(): Collection
    {
        // Ambil semua user kecuali yang sedang login
        $users = User::where('id', '!=', Auth::id())
            ->select('id', 'name', 'email', 'role', 'created_at')
            ->latest()
            ->get();

        return $users->map(fn(User $user) => UserViewData::fromModel($user));
    }

    /**
     * Membuat data pengguna baru.
     */
    public function create(UserCreateData $data): User
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'role' => $data->role,
        ]);
    }

    /**
     * Memperbarui data pengguna yang ada.
     */
    public function update(User $user, UserUpdateData $data): bool
    {
        return $user->update([
            'name' => $data->name,
            'email' => $data->email,
            'role' => $data->role,
        ]);
    }

    /**
     * Menghapus data pengguna.
     */
    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
