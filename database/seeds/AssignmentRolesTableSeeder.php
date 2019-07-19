<?php

use Illuminate\Database\Seeder;
use App\Models\Assignment;
use Faker\Factory as Faker;

class AssignmentRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Models\AssignmentRole');
        $faker->addProvider(new \Faker\Provider\en_US\Company($faker));

        $roleTypes = ['Qualification', 'Position'];
        $assignments = Assignment::select('*')->get();

        foreach($assignments as $assignment) {
            for($i = 0; $i <= 5; $i++) {
                DB::table('assignment_roles')->insert([
                    'assignment_id' => $assignment->id,
                    'title' => $faker->jobTitle,
                    'description' => $faker->bs,
                    'start_date' => $faker->dateTimeBetween('last year', 'now'),
                    'end_date' => $faker->dateTimeBetween('now', '+1 year'),
                    'role_type' => $roleTypes[rand(0,1)],
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}
