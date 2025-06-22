<?php

namespace Database\Factories;

use Faker\Factory as FakerFactory;
use Faker\Provider\Base; 
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\FakeCar; 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterMake>
 */
class MasterMakeFactory extends Factory
{
    public function definition(): array
    {
        // Add the FakeCar provider to Laravel's injected faker instance
        $Faker=FakerFactory::create();
        $this->faker->addProvider(new FakeCar($this->faker));

        return [
            'name' => $this->faker->unique()->vehicleBrand(),
        ];
    }
}
