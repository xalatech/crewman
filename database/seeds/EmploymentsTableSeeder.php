<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\Employment;

class EmploymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Models\Employment');
        $faker->addProvider(new \Faker\Provider\en_US\Company($faker));

        $employers = Employer::select('*')->get();

        foreach($employers as $employer) {
            for($i = 0; $i <= 10; $i++) {
                DB::table('employments')->insert([
                    'employer_id' => $employer->id,
                    'employee_id' => $this->getRandomEmployeeId(),
                    'title' => $faker->jobTitle,
                    'description' => $faker->bs,
                    'start_date' => $faker->dateTimeBetween('last year', 'now'),
                    'end_date' => $faker->dateTimeBetween('now', '+1 year'),
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }

    private function getRandomEmployeeId() {
        $employee = Employee::inRandomOrder()->first();
        return $employee->id;
    }
}
