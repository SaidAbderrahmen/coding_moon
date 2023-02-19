<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        //$this->call(BeekeeperSeeder::class);
        //$this->call(HistorySeeder::class);
        //$this->call(HiveSeeder::class);
        //$this->call(NotificationSeeder::class);
        //$this->call(TipSeeder::class);
        //$this->call(UserSeeder::class);
    }
}
