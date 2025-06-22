<?php

namespace Database\Seeders;

use App\Models\MasterMake;
use App\Models\MasterModel;
use Faker\Provider\FakeCar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class MasterModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var\Faker\Generator|\faker\Provider\FakeCar $faker */

        $faker=FakerFactory::create();
        $faker -> addProvider(new FakeCar($faker));//
        $makes = MasterMake::all();//plural for list of arry ie 'makes'

        for($i=0; $i<20; $i++)
        {
            $make =$makes->random();

            MasterModel::firstOrCreate([
                'name' => $faker->vehicleModel($make->name),
                'master_make_id' => $make->id,
            ]);
        }
    }
}