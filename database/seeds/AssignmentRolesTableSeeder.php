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

        foreach(range(1, 10) as $index) {
            DB::table('assignment_roles')->insert([
                'assignment_id' => $this->getRandomAssignmentId(),
                'title' => $faker->jobTitle,
                'description' => $faker->bs,
                'start_date' => $faker->dateTimeBetween('last year', 'now'),
                'end_date' => $faker->dateTimeBetween('now', '+1 year'),
                'role_type' => $roleTypes[rand(0,1)],
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }

    private function getRandomAssignmentId() {
        $assignment = Assignment::inRandomOrder()->first();
        return $assignment->id;
    }
}
