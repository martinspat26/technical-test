<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Turbine;
use App\Models\WindFarm;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Turbine>
 */
class TurbineFactory extends Factory
{
    protected $model = Turbine::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $turbineCounter = 0;
        
        // Get an existing WindFarm ID from the database
        $existingWindFarm = WindFarm::inRandomOrder()->first();
        $wind_farm_id = $existingWindFarm ? $existingWindFarm->id : null;
        
        return [
            'name' => function() use (&$turbineCounter) {
                $turbineCounter ++;
                return 'Turbine ' . $turbineCounter;
            },
            'wind_farm_id' => $wind_farm_id,
        ];
    }
}


                
