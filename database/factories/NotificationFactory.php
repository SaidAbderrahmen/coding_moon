<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event' => 'infected bee',
            'details' => $this->faker->sentence(20),
            'date' => $this->faker->date,
            'hive_id' => \App\Models\Hive::factory(),
        ];
    }
}
