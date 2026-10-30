<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasTUSeeder extends Seeder
{
    /**
     * Membuat (atau mengatur ulang) akun Petugas TU.
     * Jalankan: php artisan db:seed --class=PetugasTUSeeder
     */
    public function run(): void
    {
        $tu = User::where('role', 'tu')->first() ?? new User();

        $tu->forceFill([
            'name'     => $tu->name ?: 'Sarah Amalia',
            'email'    => $tu->email ?: 'tu@smartclassroom.sch.id',
            'role'     => 'tu',
            'status'   => 'Aktif',
            'password' => Hash::make('tu12345'),
        ])->save();

        $this->command->info('Akun Petugas TU siap dipakai.');
        $this->command->info('Email         : '.$tu->email);
        $this->command->info('Kata sandi    : tu12345');
    }
}