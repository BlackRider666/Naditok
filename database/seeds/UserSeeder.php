<?php

use App\Users\User;
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
        User::create([
            'first_name' => 'system',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'admin'  => true,
        ]);
    }
}
