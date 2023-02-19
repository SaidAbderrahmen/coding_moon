<?php

namespace Database\Factories;

use App\Models\Hive;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class HiveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hive::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->randomNumber,
            'total_bees' => $this->faker->randomNumber(0),
            'present_bees' => $this->faker->randomNumber(0),
            'infected_bees' => $this->faker->randomNumber(0),
            'tempreture' => $this->faker->text(255),
            'humidity' => $this->faker->text(255),
            'status' => 'working',
            'beekeeper_id' => \App\Models\Beekeeper::factory(),
        ];
    }
}
