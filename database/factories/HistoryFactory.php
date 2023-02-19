<?php

namespace Database\Factories;

use App\Models\History;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = History::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'action' => 'spray',
            'date' => $this->faker->date,
            'hive_id' => \App\Models\Hive::factory(),
        ];
    }
}
