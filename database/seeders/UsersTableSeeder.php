<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'aiman@aiman.com',
        ], [
            'name' => 'Aiman Al-Raidi',
            'email' => 'aiman@aiman.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->count(5)->create();
//        $roles = Role::query()->get();
//        $users->each(function ($user) use ($roles) {
//            $role_id = $roles->random()->id;
//            $user->roles()->syncWithoutDetaching($role_id);
//        });
    }
}
