<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WindFarm;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WindFarm>
 */
class WindFarmFactory extends Factory
{
    protected $model = WindFarm::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $windFarmCounter = 0;
        return [
            'name' => function () use (&$windFarmCounter) {
                $windFarmCounter++;
                return 'WindFarm ' . $windFarmCounter;
            },
            'location' => $this->faker->city,
        ];
    }
}
