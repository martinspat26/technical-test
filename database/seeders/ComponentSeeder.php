<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Turbine;
use App\Models\WindFarm;
use App\Models\Component;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $turbines = Turbine::get();
        foreach ($turbines as $turbine) {
            foreach (['Blade', 'Rotor', 'Generator', 'Hub'] as $value) {
                Component::factory()->create([
                    'name' => $value,
                    'turbine_id' => $turbine->id,
                ]);
            }
        }
    }
}
