<?php

namespace App\Actions\Fortify;

use App\Data\User\RegisterUserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateNewUser
{
    /**
     * Membuat pengguna yang baru terdaftar dengan data yang sudah divalidasi.
     *
     * @param  array<string, string>  $input Data yang sudah divalidasi oleh RegisterRequest.
     */
    public function create(RegisterUserData $data): User
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);
    }
}
