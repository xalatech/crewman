<?php

use Illuminate\Database\Seeder;
use App\Models\Assignment;
use Faker\Factory as Faker;

class AssignmentLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Models\AssignmentLocation');
        $faker->addProvider(new \Faker\Provider\en_US\Company($faker));

        $assignments = Assignment::select('*')->get();

        foreach($assignments as $assignment) {
            for($i = 0; $i <= 2; $i++) {
                DB::table('assignment_locations')->insert([
                    'assignment_id' => $assignment->id,
                    'country' => $faker->country,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}
