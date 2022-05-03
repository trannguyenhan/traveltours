<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Mạo hiểm', 'description' => 'Du lịch mạo hiểm'],
            ['name' => 'Du lịch biển', 'description' => 'Du lịch tới những vùng biển'],
            ['name' => 'Leo núi', 'description' => 'Du lịch tới những vùng cao'],
            ['name' => 'Đi chùa', 'description' => 'Đi chùa cầu duyên, cầu may']
        ]);
    }
}
