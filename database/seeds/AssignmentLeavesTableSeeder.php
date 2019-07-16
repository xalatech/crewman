<?php

use Illuminate\Database\Seeder;
use App\Models\Assignment;
use Faker\Factory as Faker;

class AssignmentLeavesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Models\AssignmentLeave');
        $faker->addProvider(new \Faker\Provider\en_US\Company($faker));

        foreach(range(1, 10) as $index) {
            DB::table('assignment_leaves')->insert([
                'assignment_id' => $this->getRandomAssignmentId(),
                'description' => $faker->text,
                'start_date' => $faker->dateTimeBetween('last year', 'now'),
                'end_date' => $faker->dateTimeBetween('now', '+1 year'),
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }

    private function getRandomAssignmentId() {
        $assignment = Assignment::inRandomOrder()->first();
        return $assignment->id;
    }
}
