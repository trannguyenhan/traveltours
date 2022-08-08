<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin123',
            'username' => 'admin123',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'status' => 'active'
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'seller123',
            'username' => 'seller123',
            'email' => 'seller@seller.com',
            'password' => Hash::make('123456'),
            'status' => 'active'
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 3,
            'model_id' => 2,
            'model_type' => \App\Models\User::class
        ]);
    }
}
