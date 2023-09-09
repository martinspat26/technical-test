<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Component;
use App\Models\Turbine;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Component>
 */
class ComponentFactory extends Factory
{
    protected $model = Component::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Get an existing Turbine ID from the database
        $existingTurbine = Turbine::inRandomOrder()->first();
        $turbine_id = $existingTurbine ? $existingTurbine->id : null;

        return [
            'name' => $this->faker->randomElement(['Blade', 'Rotor', 'Generator', 'Hub']),
            'turbine_id' => $turbine_id,
            'grade' => $this->faker->numberBetween(1,5),
        ];

    }
}
