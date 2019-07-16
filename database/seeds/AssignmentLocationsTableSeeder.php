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

        foreach(range(1, 10) as $index) {
            DB::table('assignment_locations')->insert([
                'assignment_id' => $this->getRandomAssignmentId(),
                'country' => $faker->country,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }

    private function getRandomAssignmentId() {
        $assignment = Assignment::inRandomOrder()->first();
        return $assignment->id;
    }
}
