<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateNewUser
{
    /**
     * Membuat pengguna yang baru terdaftar dengan data yang sudah divalidasi.
     *
     * @param  array<string, string>  $input Data yang sudah divalidasi oleh RegisterRequest.
     */
    public function create(array $input): User
    {
        // Langsung membuat user karena data sudah dijamin aman oleh Form Request
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
