<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Administrator';
        $user->email = 'admin@sandbox.com';
        $user->password = Hash::make('adminpass');
        $user->role = 'ADMIN';
        $user->save();

        $user = new User;
        $user->name = 'Neem';
        $user->email = 'neem@sandbox.com';
        $user->password = Hash::make('neempass');
        $user->save();

        User::factory()
            ->count(10)
            ->hasPosts(4)
            ->create();
    }
}
