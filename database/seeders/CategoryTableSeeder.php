<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            [
                'name' => 'Laravel',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PHP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Javascript',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
