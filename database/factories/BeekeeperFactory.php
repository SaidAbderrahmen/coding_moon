<?php

namespace Database\Factories;

use App\Models\Beekeeper;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeekeeperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Beekeeper::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'password' => $this->faker->password,
        ];
    }
}
