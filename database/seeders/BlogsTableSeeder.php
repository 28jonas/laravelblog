<?php

namespace Database\Seeders;

use App\Models\Blogpost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Blogpost::factory(50)->create();
    }
}
