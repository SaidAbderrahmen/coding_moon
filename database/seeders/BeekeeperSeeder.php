<?php

namespace Database\Seeders;

use App\Models\Beekeeper;
use Illuminate\Database\Seeder;

class BeekeeperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Beekeeper::factory()
            ->count(5)
            ->create();
    }
}
