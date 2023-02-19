<?php

namespace Database\Seeders;

use App\Models\Hive;
use Illuminate\Database\Seeder;

class HiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hive::factory()
            ->count(5)
            ->create();
    }
}
