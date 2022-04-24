<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'admin', 'guard_name' => 'api', 'display_name' => 'Quản trị viên'],
            ['id' => 2, 'name' => 'member', 'guard_name' => 'api', 'display_name' => 'Thành viên']
        ]);
    }
}
