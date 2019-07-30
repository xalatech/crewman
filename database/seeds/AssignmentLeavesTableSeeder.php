<?php

use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\AssignmentLeave;
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

        $assignments = Assignment::select('*')->get();

        foreach($assignments as $assignment) {
            for($i = 0; $i <= 2; $i++) {
                DB::table('assignment_leaves')->insert([
                    'assignment_id' => $assignment->id,
                    'description' => $faker->sentence,
                    'start_date' => $faker->dateTimeBetween('last year', 'now'),
                    'end_date' => $faker->dateTimeBetween('now', '+1 year'),
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }

    }
}
