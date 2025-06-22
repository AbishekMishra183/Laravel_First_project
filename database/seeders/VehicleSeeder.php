<?php

namespace Database\Seeders;

use App\Models\MasterMake;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makes = MasterMake::with('models')->get(); // load models too

        for ($i = 0; $i < 20; $i++) {
            $make = $makes->random();

            // Make sure the make has at least one model
            if ($make->models->isNotEmpty()) {
                $model = $make->models->random();

                Vehicle::create([
                    'master_make_id' => $make->id,
                    'master_model_id' => $model->id,
                    'registration_no' => fake()->unique()->numberBetween(1000000, 9999999),
                ]);
            }
        }
    }
}
