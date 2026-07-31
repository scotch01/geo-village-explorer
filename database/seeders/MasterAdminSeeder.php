<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MasterAdminSeeder extends Seeder
{
    /**
     * Seed the default master admin account.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sipeta.test'],
            [
                'name' => 'Master Admin',
                'password' => Hash::make('password'),
                'role' => User::ROLE_MASTER_ADMIN,
                'must_change_password' => false,
            ]
        );
    }
}
